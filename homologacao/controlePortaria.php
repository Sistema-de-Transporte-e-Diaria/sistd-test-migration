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


                    <?php
// Recebe o código da página listarSolicitacao.php
                    $codSolicitado = $_GET['id'];
                    ?>

                    <!-- Início do formulário para preencimento do controle da solicitação   -->
                    <form  method="post" action="atualizaControlePortaria.php" name="controle" onsubmit="return validaCampos();">

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
                                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                        $pesquisa = " SELECT * FROM listarcontrole
                                                    WHERE codSolicitacaoControle = '$codSolicitado'";
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                            <?php
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
                                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                        $pesquisa1 = " SELECT * FROM listarcontrole
                                                                        WHERE codSolicitacaoControle = '$codSolicitado'";
                                        $resultado1 = mysql_query($pesquisa1) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro1 = mysql_fetch_array($resultado1)) {
                                            ?>       
                                            <option  value="<?= $registro1['codVeiculo'] ?>"><?= $registro1['modelo'] ?></option>
                                            <?php
                                        }
                                        ?>
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
                                    ?> 
                                </td>
                            </tr> 
                        </table>



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
                                <?php
                                $sql = "SELECT * FROM listarcontrole WHERE codSolicitacaoControle = '$codSolicitado'";
                                $res1 = mysql_query($sql) or die("Não foi possível realizar a consulta ao banco de dados");
                                while ($reg = mysql_fetch_array($res1)) {
                                    ?>
                                    <td >
                                        <div >
                                            <label for="Saida">Saída</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="setKmSaida"style="height:30px" value="<?= $reg['kmSaidaControle'] ?>" />
                                    </td>
                                    <td> 
                                        <input type="text"  id="calendario1" class="form-control" name="setDtSaida"value="<?= formatoData($reg['dtSaidaControle']) ?>"
                                               style="height: 100%;width: 200px" style="height:30px"/>
                                    </td>
                                    <td>
                                        <input type="text" name="setHrSaida" class="form-control" maxlength="5" placeholder="00:00"value="<?= $reg['hrSaidaControle'] ?>"
                                               class="hora"style="height:30px;width: 100px"/>
                                    </td>
                                    <td>
                                        <input type="text" name="setPlantonistaSaida"  value="<?= $reg['plantonistaSaida'] ?>"
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
                                        <input type="text" name="setKmRetorno" style="height:30px" value="<?= $reg['kmRetornoControle'] ?>"/>
                                    </td>
                                    <td>
                                        <input type="text"  id="calendario" class="form-control" name="setDtRetorno"value="<?= formatoData($reg['dtRetornoControle']) ?>"
                                               style="height: 100%;width: 200px" style="height:30px"/>
                                    </td>
                                    <td>
                                        <input type="text" name="setHrRetorno"class="form-control"
                                               maxlength="5" placeholder="00:00" value="<?= $reg['hrRetornoControle'] ?>"
                                               class="hora"style="height:30px;width: 100px"/>
                                    </td>
                                    <td>
                                        <input type="text" name="setPlantonistaRetorno" value="<?= $reg['plantonistaRetorno'] ?>"
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
                                    <?php if ($reg["combustivel"] == 'reserva') { ?>
                                        <td>
                                            <input type="radio" name="setCombus" checked="true"
                                                   value="reserva"class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div>
                                                <label>Reserva</label>
                                            </div> 
                                        </td>
                                    <?php } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setCombus"
                                                   value="reserva"class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div>
                                                <label>Reserva</label>
                                            </div> 
                                        </td>
                                    <?php }
                                    ?>


                                    <?php if ($reg["combustivel"] == 'um_quarto') { ?>
                                        <td>
                                            <input type="radio" name="setCombus" checked="true"
                                                   value="um_quarto"class="form-group pull-right"> 
                                        </td>
                                        <td>
                                            <div>
                                                <label>1/4</label>
                                            </div>   
                                        </td>
                                    <?php } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setCombus" 
                                                   value="um_quarto"class="form-group pull-right"> 
                                        </td>
                                        <td>
                                            <div>
                                                <label>1/4</label>
                                            </div>   
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <?php if ($reg["combustivel"] == 'um_meio') { ?>
                                        <td>
                                            <input type="radio" name="setCombus"  checked="true"
                                                   value="um_meio"class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div>
                                                <label>1/2</label>
                                            </div>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setCombus" 
                                                   value="um_meio"class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div>
                                                <label>1/2</label>
                                            </div>
                                        </td>
                                    <?php } ?>                                 

                                    <?php if ($reg["combustivel"] == 'tres_quarto') { ?>
                                        <td>
                                            <input type="radio" name="setCombus" checked="true"
                                                   value="tres_quarto"class="form-group pull-right">  
                                        </td>
                                        <td>
                                            <div>
                                                <label>3/4</label>
                                            </div>
                                        </td>
                                    <?php } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setCombus" 
                                                   value="tres_quarto"class="form-group pull-right">  
                                        </td>
                                        <td>
                                            <div>
                                                <label>3/4</label>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <?php if ($reg["combustivel"] == 'cheio') { ?>
                                        <td>
                                            <input type="radio" name="setCombus" checked="true"
                                                   value="cheio"class="form-group pull-right">  
                                        </td>
                                        <td>
                                            <div>
                                                <label>Cheio</label>
                                            </div>
                                        </td>
                                    <?php } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setCombus" 
                                                   value="cheio"class="form-group pull-right">  
                                        </td>
                                        <td>
                                            <div>
                                                <label>Cheio</label>
                                            </div>
                                        </td>
                                    <?php } ?>

                                <?php } ?>
                            </tr>
                        </table>

                        <div class="btn-lg">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                    Voltar
                                </button>                              
                                <button type="submit" class="btn btn-success">                                   
                                    Atualizar
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
