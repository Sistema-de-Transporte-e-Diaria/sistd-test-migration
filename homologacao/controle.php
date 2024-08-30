<?php
include ('validar_session.php');
include ('jquery.php');
conecta();
$sql = "SELECT siape, administrador "
        . " FROM solicitantes WHERE siape='$login_usuario'";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    $nivel = $row['administrador'];
}
if ($nivel == 1) {
    header("Location: listarSolicitacaoOutros.php");
    exit();
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen"
              href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">       
        <script type="text/javascript"
                src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
        </script> 
        <script type="text/javascript"
        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
        <script type="text/javascript"
                src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
        </script>
        <script type="text/javascript"
                src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
        </script>      
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
        <script language="JavaScript" type="text/javascript">
                    function validaCampos() {
                        qtdDiaria = document.controle.setDiaria.value;
                        if (qtdDiaria == "") {
                            alert("Selecione a quantidade de diárias do motorista!");
                            controle.setDiaria.focus();
                            return false;
                        }
                        return true;
                    }
        </script>          
    </head> 
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">  
    <?php include "menu.php" ?>
    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Controle</h3>
                </div>
                <div class="panel-body "> 


                    <!-- Funções para direcionar os botões do formulário para as páginas atualizaControle.php e controlando.php -->           
                    <script language="JavaScript">
                        function atualizar()
                        {
                            document.controle.action = "atualizaControle.php";
                            document.forms.controle.submit();
                        }
                        function salvar()
                        {
                            qtdDiaria = document.controle.setDiaria.value;
                            if (qtdDiaria == "") {
                                controle.setDiaria.focus();

                            }
                            else {
                                document.controle.action = "controlando.php";
                                document.forms.controle.submit();
                            }
                        }
                        function excluir()
                        {
                            document.controle.action = "excluirControle.php";
                            document.forms.controle.submit();
                        }
                    </script>

                    <?php
// Recebe o código da página listarSolicitacao.php
                    $codSolicitado = $_GET['id'];
                    ?>

                    <!-- Início do formulário para preencimento do controle da solicitação   -->
                    <form  method="post" action="controlando.php" name="controle" onsubmit="return validaCampos();">

                        <table class="table"> 
                            <tr>
                                <td > 
                                    <div >
                                        <label for="nSolicitacao">Solicitação Nº</label>
                                    </div>

                                    <input style="color: brown;height: 20px;width: 100px" type="text" name="setCodControleSolicite"
                                           readonly="true" value="<?php echo $codSolicitado; ?>"/>
                                </td>

                                <td >
                                    <div>
                                        <label for="Motorista">Motorista</label>
                                    </div>

                                    <select name="setMotorista" id="escolhaMotorista" required="true" style="width: 300px">
                                        <?php
                                        conecta();
                                        // Verifia os status da solicitação
                                        $sqlConsultaStatus1 = "SELECT * FROM solicitacao 
                                            WHERE codSolicitacao = '$codSolicitado'";
                                        $resultadoConsultaStatus1 = mysql_query($sqlConsultaStatus1) or die("Houve um erro na gravação dos dados - CONSULTAR REGISTRO");
                                        While ($registroConsultaStatus1 = mysql_fetch_array($resultadoConsultaStatus1)) {
                                            $y = $registroConsultaStatus1["statusSolicitacao"];
                                            $dataSaida = $registroConsultaStatus1['dtSaida'];
                                            $dataRetorno = $registroConsultaStatus1['dtRetorno'];
                                            $horaSaida = $registroConsultaStatus1['hrSaida'];
                                            $horaRetorno = $registroConsultaStatus1['hrRetorno'];
                                        }
                                        if ($y == 2) {
                                            // Conexão com o banco de dados             
                                            conecta();
                                            // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                            $pesquisa = " SELECT * FROM listarcontrole
                                                    WHERE codSolicitacaoControle = '$codSolicitado'";
                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                                <?php
                                            }
                                        }if ($y == 1) {
                                            // MOSTRA APENAS OS MOTORISTAS QUE ESTÃO DISPONÍVIES PARA A SOLICITAÇÃO                   
                                            $pesquisa = "SELECT * FROM motoristas
                                              WHERE statusMotorista = '1' AND codMotorista NOT IN 
                                                     (SELECT codMotorista FROM listarsolicitacaocontrole
                                                      WHERE statusSolicitacao = '2'  
                                                      AND dtSaida IN (SELECT dtSaida FROM listarsolicitacaocontrole 
                                                                      WHERE dtSaida BETWEEN '$dataSaida' AND '$dataRetorno' OR dtRetorno BETWEEN '$dataSaida' AND '$dataRetorno')
                                                                      AND hrSaida IN (SELECT hrSaida FROM listarsolicitacaocontrole 
                                                                                      WHERE (hrSaida BETWEEN '$horaSaida' AND '$horaRetorno' OR hrRetorno BETWEEN '$horaSaida' AND '$horaRetorno')))";
                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                                <?php
                                            }
                                        } if ($y == 5) {
                                            // MOSTRA APENAS OS MOTORISTAS QUE ESTÃO DISPONÍVIES PARA A SOLICITAÇÃO                   
                                            $pesquisa = "SELECT * FROM motoristas
                                              WHERE statusMotorista = '1' AND codMotorista NOT IN 
                                                     (SELECT codMotorista FROM listarsolicitacaocontrole
                                                      WHERE statusSolicitacao = '2'  
                                                      AND dtSaida IN (SELECT dtSaida FROM listarsolicitacaocontrole 
                                                                      WHERE dtSaida BETWEEN '$dataSaida' AND '$dataRetorno' OR dtRetorno BETWEEN '$dataSaida' AND '$dataRetorno')
                                                                      AND hrSaida IN (SELECT hrSaida FROM listarsolicitacaocontrole 
                                                                                      WHERE (hrSaida BETWEEN '$horaSaida' AND '$horaRetorno' OR hrRetorno BETWEEN '$horaSaida' AND '$horaRetorno')))";
                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                                    <div>
                                        <label for="Veiculo">Veículo</label>
                                    </div>

                                    <select name="setVeiculo" required="true" id="escolhaVeiculo" style="width: 300px">
                                        <?php
                                        conecta();
// Verifia os status da solicitação
                                        $sqlConsultaStatus2 = "SELECT * FROM solicitacao 
                                                            WHERE codSolicitacao = $codSolicitado";
                                        $resultadoConsultaStatus2 = mysql_query($sqlConsultaStatus2) or die("Houve um erro na gravação dos dados - CONSULTAR REGISTRO");
                                        While ($registroConsultaStatus2 = mysql_fetch_array($resultadoConsultaStatus2)) {
                                            $y = $registroConsultaStatus2["statusSolicitacao"];
                                            $dataSaida = $registroConsultaStatus2['dtSaida'];
                                            $dataRetorno = $registroConsultaStatus2['dtRetorno'];
                                            $horaSaida = $registroConsultaStatus2['hrSaida'];
                                            $horaRetorno = $registroConsultaStatus2['hrRetorno'];
                                        }
                                        if ($y == 2) {
                                            // Conexão com o banco de dados             
                                            conecta();

                                            // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                            $pesquisa = " SELECT * FROM listarcontrole
                                                                        WHERE codSolicitacaoControle = '$codSolicitado'";
                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option  value="<?= $registro['codVeiculo'] ?>"><?= $registro['modelo'] ?></option>
                                                <?php
                                            }
                                        } if ($y == 1) {
                                            // MOSTRA APENAS OS VEÍCULOS QUE ESTÃO DISPONÍVIES PARA A SOLICITAÇÃO         
                                            echo
                                            $pesquisa = "SELECT * FROM veiculos 
                                                              WHERE statusVeiculo = '1' AND codVeiculo NOT IN 
                                                                       (SELECT codVeiculo FROM listarsolicitacaocontrole
                                                                        WHERE statusSolicitacao ='2' 
                                                                        AND dtSaida IN (SELECT dtSaida FROM listarsolicitacaocontrole 
                                                                                        WHERE dtSaida BETWEEN '$dataSaida' AND '$dataRetorno' OR dtRetorno BETWEEN '$dataSaida' AND '$dataRetorno')
                                                                                        AND hrSaida IN (SELECT hrSaida FROM listarsolicitacaocontrole 
                                                                                                        WHERE (hrSaida BETWEEN '$horaSaida' AND '$horaRetorno' OR hrRetorno BETWEEN '$horaSaida' AND '$horaRetorno')))";

                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option  value="<?= $registro['codVeiculo'] ?>"><?= $registro['modelo'] ?></option>
                                                <?php
                                            }
                                        } if ($y == 5) {
                                            // MOSTRA APENAS OS VEÍCULOS QUE ESTÃO DISPONÍVIES PARA A SOLICITAÇÃO         
                                            echo
                                            $pesquisa = "SELECT * FROM veiculos 
                                                              WHERE statusVeiculo = '1' AND codVeiculo NOT IN 
                                                                       (SELECT codVeiculo FROM listarsolicitacaocontrole
                                                                        WHERE statusSolicitacao ='2' 
                                                                        AND dtSaida IN (SELECT dtSaida FROM listarsolicitacaocontrole 
                                                                                        WHERE dtSaida BETWEEN '$dataSaida' AND '$dataRetorno' OR dtRetorno BETWEEN '$dataSaida' AND '$dataRetorno')
                                                                                        AND hrSaida IN (SELECT hrSaida FROM listarsolicitacaocontrole 
                                                                                                        WHERE (hrSaida BETWEEN '$horaSaida' AND '$horaRetorno' OR hrRetorno BETWEEN '$horaSaida' AND '$horaRetorno')))";

                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registro = mysql_fetch_array($resultado)) {
                                                ?>       
                                                <option  value="<?= $registro['codVeiculo'] ?>"><?= $registro['modelo'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                                    <div >
                                        <label for="Diaria">Diária(as)</label>
                                    </div>

                                    <select name="setDiaria" id="escolhaDiaria"required="true" style="width: 100px">
                                        <?php
                                        conecta();
// Verifia os status da solicitação
                                        $sqlConsultaStatus = "SELECT statusSolicitacao FROM solicitacao 
                                                         WHERE codSolicitacao = '$codSolicitado'";
                                        $resultadoConsultaStatus = mysql_query($sqlConsultaStatus) or die("Houve um erro na gravação dos dados - CONSULTAR REGISTRO");
                                        While ($registroConsultaStatus = mysql_fetch_array($resultadoConsultaStatus)) {
                                            $y = $registroConsultaStatus["statusSolicitacao"];
                                        }
                                        if ($y == 2) {
                                            ?>          
                                            <option> </option>
                                            <option>0</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <?php
                                        } elseif ($y == 1 || $y == 5) {
                                            ?>     
                                            <option>0</option>
                                        <?php } ?>      
                                    </select>
                                </td> 
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td>
                                    <div >
                                        <label for="DadosVeiculo"style="background-color:#d6e9c6 ">Dados do Veículo</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php if ($y == 2) { ?>
                                        <?php
                                        $sqlDisplay = "SELECT * FROM listarcontrole
                                                          WHERE codSolicitacaoControle = '$codSolicitado'";
                                        $resultadoDisplay = mysql_query($sqlDisplay) or die("Não foi possível realizar a consulta ao banco de dados");
                                        while ($registroDisplay = mysql_fetch_array($resultadoDisplay)) {
                                            ?>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <label for="Placa">Placa</label>
                                                        </div>

                                                        <input style="color: brown" type="text" 
                                                               name="displayPlaca" readonly="true" style="height:50px"
                                                               value="<?= $registroDisplay["placa"] ?>"></td>

                                                    <td>
                                                        <div >
                                                            <label for="Capacidade">Capacidade</label>
                                                        </div>

                                                        <input style="color: brown" type="text" 
                                                               name="displayCapacidade" readonly="true" style="height:50px"
                                                               value="<?= $registroDisplay["ocupacao"] ?>"></td>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                    }
                                    ?> 
                                </td>
                            </tr> 
                        </table>
                        <?php if ($y == 1) { ?>
                            <table class="table">
                                <tr>
                                    <td>
                                        <?php
                                        $sqlQtdPassageiros = "SELECT * FROM solicitacao
                                                          WHERE codSolicitacao = '$codSolicitado'";
                                        $resultadoSqlQtdPassageiros = mysql_query($sqlQtdPassageiros) or die("Não foi possível realizar a consulta ao banco de dados");
                                        while ($registroSqlQtdPassageiros = mysql_fetch_array($resultadoSqlQtdPassageiros)) {

                                            $qtd = $registroSqlQtdPassageiros['qtdPassageiros'];

                                            echo 'Selecione um veículo para ' . $qtd . ' passageiro(os).';
                                        }
                                        ?>

                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
                        <?php if ($y == 5) { ?>
                            <table class="table">
                                <tr>
                                    <td>
                                        <?php
                                        $sqlQtdPassageiros = "SELECT * FROM solicitacao
                                                          WHERE codSolicitacao = '$codSolicitado'";
                                        $resultadoSqlQtdPassageiros = mysql_query($sqlQtdPassageiros) or die("Não foi possível realizar a consulta ao banco de dados");
                                        while ($registroSqlQtdPassageiros = mysql_fetch_array($resultadoSqlQtdPassageiros)) {

                                            $qtd = $registroSqlQtdPassageiros['qtdPassageiros'];

                                            echo 'Selecione um veículo para ' . $qtd . ' passageiro(os).';
                                        }
                                        ?>

                                    </td>
                                </tr>
                            </table>
                        <?php } ?>


                        <legend id="legendDadosRe" class="panel panel-success" 
                                style="background-color: #C1FFC1">Dados Realizados da Viagem</legend> 
                        <table id="tableDadosRe" class="table" >

                            <tr>
                                <td></td>
                                <td>
                                    <div >
                                        <label for="km">Km</label>
                                    </div>
                                </td>
                                <td >
                                    <div >
                                        <label for=" Data"> Data</label>
                                    </div>
                                </td>
                                <td >
                                    <div >
                                        <label for="Hora">Hora</label>
                                    </div>
                                </td>
                                <td> 
                                    <div >
                                        <label for=" Plantonista"> Plantonista</label>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div >
                                        <label for="Saida">Saída</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="setKmSaida"style="height:30px" />
                                </td>
                                <td> 
                                    <input type="text"  id="calendario1" class="form-control" name="setDtSaida"
                                           style="height: 100%;width: 200px" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setHrSaida" class="form-control" maxlength="5" placeholder="00:00"
                                           class="hora"style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setPlantonistaSaida" 
                                           style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div >
                                        <label for="Retorno">Retorno</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="setKmRetorno" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text"  id="calendario" class="form-control" name="setDtRetorno"
                                           style="height: 100%;width: 200px" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setHrRetorno"class="form-control"
                                           maxlength="5" placeholder="00:00"
                                           class="hora"style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setPlantonistaRetorno" 
                                           style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>

                            </tr>
                        </table>
                        <table class="table">
                            <tr >
                                <td >
                                    <div  >
                                        <label style="background-color:#d6e9c6 "for="Combustivel">
                                            Combustível
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>

                                <td>
                                    <input type="radio" name="setCombus"
                                           value="reserva"class="form-group pull-right">
                                </td>
                                <td>
                                    <div>
                                        <label>Reserva</label>
                                    </div> 
                                </td>

                                <td>
                                    <input type="radio" name="setCombus" 
                                           value="um_quarto"class="form-group pull-right"> 
                                </td>
                                <td>
                                    <div>
                                        <label>1/4</label>
                                    </div>   
                                </td>


                                <td>
                                    <input type="radio" name="setCombus" 
                                           value="um_meio"class="form-group pull-right">
                                </td>
                                <td>
                                    <div>
                                        <label>1/2</label>
                                    </div>
                                </td>


                                <td>
                                    <input type="radio" name="setCombus" 
                                           value="tres_quarto"class="form-group pull-right"> 
                                </td>
                                <td>
                                    <div>
                                        <label>3/4</label>
                                    </div>
                                </td>


                                <td>
                                    <input type="radio" name="setCombus" 
                                           value="cheio"class="form-group pull-right">  
                                </td>
                                <td>
                                    <div>
                                        <label>Cheio</label>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <legend id="legendDadosEvento" class="panel panel-success" 
                                style="background-color: #C1FFC1">Deslocamento Fora da Rota</legend> 
                        <table class="table">
                            <tr>
                                <td >
                                    <div>
                                        <label for="Km1">Km</label>
                                    </div>
                                </td>
                                <td > 
                                    <div>
                                        <label for="Hora1">Hora</label>
                                    </div>
                                </td>
                                <td >
                                    <div>
                                        <label for="Deslocamento">Deslocamento</label>
                                    </div> 
                                </td>
                                <td > 
                                    <div>
                                        <label for="Finalidade">Finalidade</label>
                                    </div>
                                </td>
                                <td >
                                    <div>
                                        <label for="Solicitante">Solicitante</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota1"style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota1"class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota1"style="height:30px" />
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota1" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota1" style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota2"style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota2" class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota2" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota2" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota2"style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota3" style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota3" class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota3" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota3"style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota3" style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota4"style="height:30px;width: 100px" />
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota4"class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota4" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota4" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota4"style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota5"style="height:30px;width: 100px" />
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota5"  class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota5"style="height:30px" />
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota5" style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota5" style="height:30px;width: 400px"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setKmForaRota6"style="height:30px;width: 100px" />
                                </td>
                                <td>
                                    <input type="text" name="setHrForaRota6"  class="form-control" maxlength="5" placeholder="00:00"
                                           style="height:30px;width: 100px"/>
                                </td>
                                <td>
                                    <input type="text" name="setDeslocForaRota6"style="height:30px" />
                                </td>
                                <td>
                                    <input type="text" name="setFinaleForaRota6"style="height:30px"/>
                                </td>
                                <td>
                                    <input type="text" name="setSoliciForaRota6"style="height:30px;width: 400px" />
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <div >
                                        <label for="Ocorrencia">Ocorrência</label>
                                    </div>

                                    <textarea name="setOcorrencia" type="text" maxlength="1000" 
                                              id="setDesc" style="width: 500px; height: 70px" ></textarea>                                    
                                </td>
                            </tr>

                        </table>
                        <div class="btn-lg">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                    Voltar
                                </button>
                                <button type="submit" class="btn btn-danger" onclick="excluir();">                                    
                                    Excluir
                                </button>  
                                <button type="submit" class="btn btn-success"onclick="atualizar();">                                   
                                    Atualizar
                                </button>  
                                <button type="submit" class="btn btn-primary"onclick="salvar();">
                                    <span class="glyphicon glyphicon-ok" ></span>
                                    Finalizar
                                </button> 

                            </div> 
                        </div>
                    </form>   
                </div>
            </div>
        </div>


        <script>
            $(function () {
                $("#calendario").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']


                });
            });
        </script>
        <script>
            $(function () {
                $("#calendario1").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']


                });
            });
        </script>
    </body>
</html>
