<?php
include ('validar_session.php');
include ('jquery.php');
$usuario = $_SESSION['login_usuario'];
$sql = "select * from solicitantes where siape='$usuario'";
$resultado2 = mysql_query($sql) or die("Não foi possível realizar a consulta ao banco de dados");
While ($registro2 = mysql_fetch_array($resultado2)) {
    $admin = $registro2["administrador"];
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
        <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    </head> 
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <?php
    // Captura o usuário logado para saber se é administrador
    // Caso o usuário seja administrador será exibido o menu

    include "menu.php";
    ?>         

    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Editar Solicitação</h3>
                </div>
                <div class="panel-body "> 
                    <?php
                    $codSolicitadoVisualizar = $_GET['id'];
                    conecta();
                    // Seleciona o registro da solicitação a ser editata
                    $pesquisa = "SELECT * FROM listarsolicitacao
                         WHERE codSolicitacao='$codSolicitadoVisualizar'";
                    $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                    While ($registro = mysql_fetch_array($resultado)) {
                        $horaDataSolicitacao = $registro['dataHoraSolicita'];
                        $data = date('d/m/Y H:i:s', strtotime($horaDataSolicitacao))
                        ?> 
                        <form method="post" action="editandoSolicitacao.php" name="solicita"onsubmit="return validaCampos();">                            
                            <table class="table"> 
                                <tr>
                                    <td > 
                                        <div >
                                            <label for="nSolicitacao">Solicitação Nº</label>
                                        </div> 

                                        <input style="color: brown;height: 30px"class="input-large" type="text" name="idSolicitacao"
                                               size="3" readonly="true" value="<?= $registro["codSolicitacao"] ?>"/>
                                    </td>
                                    <td>
                                        <div>
                                            <label > Data/Hora da Solicitação</label>
                                        </div>
                                        <?php
                                        if ($data == "31/12/1969 21:00:00") {
                                            ?>
                                            <input  type="text" name="idDataHoraSol"style="height: 100%"class="input-large"
                                                    readonly="true" value=""/>
                                                <?php } else { ?>
                                            <input  type="text" name="idDataHoraSol"style="height: 100%"class="input-large"
                                                    readonly="true" value="<?= $data ?>"/>
                                                <?php } ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td >
                                        <div >
                                            <label for="Solicitante">Solicitante</label>
                                        </div>                                      

                                        <input type="text" style="height: 100%;width: 70%"  
                                               name="Solicitante" value="<?= $registro["nome"] ?>"readonly="true"/>
                                    </td>



                                    <td>
                                        <div>
                                            <label for="Setor">Setor</label>
                                        </div>

                                        <input type="text" name="setorSolicitante" style="height: 100%" 
                                               class="input-medium"
                                               value="<?= $registro["nomeSetor"] ?>"readonly="true"/>
                                    </td>



                                    <td>
                                        <div >
                                            <label for="Fone">Fone</label>
                                        </div>

                                        <input type="text" style="height: 100%"  class="input-medium"
                                               name="foneSolicitante" value="<?= $registro["telefone"] ?>"readonly="true"/>
                                    </td>

                                </tr>
                            </table>

                            <legend id="legendDadosViagem" class="panel panel-success" 
                                    style="background-color:#C1FFC1">Dados Previstos da Viagem</legend> 

                            <table class="table"> 
                                <tr>
                                    <td>
                                        <div > 
                                            <label for="saida" style="background-color:#d6e9c6 "class="input-xxxlarge"> Saída</label>        
                                        </div> 
                                    </td>
                                    <td >
                                        <div > 
                                            <label for="retorno" style="background-color:#d6e9c6 "class="input-xxxlarge">Retorno</label>        
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td> 
                                        <div >  
                                            <label for="DtS">Data</label>
                                        </div>

                                        <input type="text" id="calendario"
                                               class="input-medium"value="<?= formatoData($registro["dtSaida"]) ?>"
                                               name="prevDtSaida"  style="height: 100%" required="true"/>                                   
                                    </td>
                                    <td> 
                                        <div >  
                                            <label for="DtR">Data</label>
                                        </div>

                                        <input type="text" id="calendario1" 
                                               class="input-medium"value="<?= formatoData($registro["dtRetorno"]) ?>"
                                               name="prevDtRetorno"  style="height: 100%" required="true"/>                                  
                                    </td>

                                </tr>
                                <tr>
                                    <td> 
                                        <div >  
                                            <label for="HrS">Hora </label>
                                        </div>
                                        <select name="prevHrSaida"style="height: 100%" required="true"class="input-medium">
                                            <option style="background-color: #761c19" 
                                                    value="<?= formatoData($registro["hrSaida"]) ?>">
                                                <?= formatoData($registro["hrSaida"]) ?></option>
                                            <option value="06:00">06:00</option>
                                            <option value="06:30">06:30</option>
                                            <option value="07:00">07:00</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                            <option value="20:30">20:30</option>
                                            <option value="21:00">21:00</option>
                                            <option value="21:30">21:30</option>
                                        </select>

                                    </td>         
                                    <td> 
                                        <div >  
                                            <label for="HrFim">Hora </label>
                                        </div>


                                        <select name="prevHrRetorno"style="height: 100%" required="true"class="input-medium">
                                            <option style="background-color: #761c19" 
                                                    value="<?= formatoData($registro["hrRetorno"]) ?>">
                                                <?= formatoData($registro["hrRetorno"]) ?></option>
                                            <option value="06:30">06:30</option>
                                            <option value="07:00">07:00</option>
                                            <option value="07:30">07:30</option>
                                            <option value="08:00">08:00</option>
                                            <option value="08:30">08:30</option>
                                            <option value="09:00">09:00</option>
                                            <option value="09:30">09:30</option>
                                            <option value="10:00">10:00</option>
                                            <option value="10:30">10:30</option>
                                            <option value="11:00">11:00</option>
                                            <option value="11:30">11:30</option>
                                            <option value="12:00">12:00</option>
                                            <option value="12:30">12:30</option>
                                            <option value="13:00">13:00</option>
                                            <option value="13:30">13:30</option>
                                            <option value="14:00">14:00</option>
                                            <option value="14:30">14:30</option>
                                            <option value="15:00">15:00</option>
                                            <option value="15:30">15:30</option>
                                            <option value="16:00">16:00</option>
                                            <option value="16:30">16:30</option>
                                            <option value="17:00">17:00</option>
                                            <option value="17:30">17:30</option>
                                            <option value="18:00">18:00</option>
                                            <option value="18:30">18:30</option>
                                            <option value="19:00">19:00</option>
                                            <option value="19:30">19:30</option>
                                            <option value="20:00">20:00</option>
                                            <option value="20:30">20:30</option>
                                            <option value="21:00">21:00</option>
                                            <option value="21:30">21:30</option>
                                            <option value="22:00">22:00</option>
                                        </select>

                                    </td> 
                                </tr>
                            </table>  

                            <table class="table">
                                <tr>
                                    <td >
                                        <div > 
                                            <label style="background-color:#d6e9c6 " for="DestinoItinerario"class="input-xxxlarge">
                                                Destino / Itinerário</label>        
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="destino" type="text" maxlength="200"  class="input-xxlarge"                                      
                                                  id="destino" required="true"
                                                  required="true" ><?= $registro["destino"] ?></textarea>
                                    </td>
                                </tr>
                                <tr>


                                    <td >
                                        <div > 
                                            <label style="background-color:#d6e9c6 
                                                   "for="Finalidade"class="input-xxxlarge">Finalidade</label>        
                                        </div>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="finalidade" type="text" maxlength="200"                                        
                                                  id="finalidade" required="true"class="input-xxlarge"
                                                  required="true" ><?= $registro["finalidade"] ?></textarea>                                       
                                    </td>
                                </tr>


                            </table>               

                            <table class="table"> 
                                <tr>
                                    <td colspan="6">                                    
                                        <div> 
                                            <label for="OcVeiculo"style="background-color:#d6e9c6 "class="input-xxxlarge">Ocupantes do Veículo </label>        
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td >
                                        <div>
                                            <label for="QuantPassageiros">Quantidade de Passageiros(as)</label>
                                        </div>

                                        <input type="text" name="qtdPassageiros" class="input-min"
                                               value="<?= $registro["qtdPassageiros"] ?>" style="height: 100%;width: 50px" >         
                                    </td>
                                </tr>



                                <tr>
                                    <td >
                                        <div>
                                            <label for="Ocupantes"class="input-large">Ocupantes</label>
                                        </div>                                    
                                    </td>
                                    <td >
                                        <div>
                                            <label for="Siape"class="input-large"> SIAPE/CPF</label>
                                        </div>                                   
                                    </td>
                                    <td >
                                        <div>
                                            <label for=" Fone"class="input-medium"> Fone</label>
                                        </div>                                   
                                    </td>
                                </tr>

                                <tr>
                                    <td>1º
                                        <input type="text" name="ocupante1" value="<?= $registro["ocupante1"] ?>"
                                               style="height:30px"class="input-large"/>
                                    </td>
                                    <td>
                                        <input type="text"  name="siapeOcup1" style="height:30px" class="input-medium"
                                               value="<?= $registro["siapeOcupante1"] ?>"/>
                                    </td>
                                    <td>
                                        <input type="text"  name="foneOcup1" value="<?= $registro["foneOcup1"] ?>"
                                               style="height:30px" class="input-medium"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td >2º
                                        <input type="text" name="ocupante2"value="<?= $registro["ocupante2"] ?>"
                                               style="height:30px"class="input-large"/>
                                    </td>
                                    <td>
                                        <input type="text"  name="siapeOcup2" style="height:30px" class="input-medium"
                                               value="<?= $registro["siapeOcupante2"] ?>"/>
                                    </td>
                                    <td>
                                        <input type="text" name="foneOcup2"value="<?= $registro["foneOcup2"] ?>"
                                               class="input-medium" style="height:30px"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        3º <input type="text" name="ocupante3" value="<?= $registro["ocupante3"] ?>"
                                                  style="height:30px"class="input-large"/>
                                    </td>
                                    <td>
                                        <input type="text"  name="siapeOcup3" style="height:30px"class="input-medium"
                                               value="<?= $registro["siapeOcupante3"] ?>"/>
                                    </td>
                                    <td>
                                        <input type="text" name="foneOcup3" value="<?= $registro["foneOcup3"] ?>"
                                               class="input-medium"style="height:30px"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        4º <input type="text" name="ocupante4"value="<?= $registro["ocupante4"] ?>"
                                                  style="height:30px" class="input-large"/>
                                    </td>
                                    <td>
                                        <input type="text"  name="siapeOcup4" style="height:30px" class="input-medium"
                                               value="<?= $registro["siapeOcupante4"] ?>"/>
                                    </td>
                                    <td>
                                        <input type="text" name="foneOcup4" value="<?= $registro["foneOcup4"] ?>"
                                               style="height:30px" class="input-medium"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div>
                                            <label>Anexar Solicitação</label>
                                        </div>  

                                        <select name="setEscolhaSolicitacao" >
                                            <option> </option>
                                            <?php
                                            conecta();
                                            $pesquisaAnexar = "SELECT * FROM listarsolicitacao
                                                     WHERE statusSolicitacao = 1 OR statusSolicitacao = 5
                                                     ORDER BY codSolicitacao;";
                                            $resultadoAnexar = mysql_query($pesquisaAnexar) or die("Não foi possível realizar a consulta ao banco de dados");
                                            While ($registroAnexar = mysql_fetch_array($resultadoAnexar)) {
                                                ?>       
                                                <option value="<?= $registroAnexar['codSolicitacao'] ?>"> <?= $registroAnexar['codSolicitacao'] ?></option>
                                            <?php } ?> 
                                        </select>
                                    </td>


                                    <td >
                                        <div >
                                            <label>Solicitações Anexas</label>
                                        </div>                                            

                                        <?php
                                        conecta();
                                        $sqlAnexadas = "SELECT idSecundaria FROM anexadas
                                                  WHERE idPrimaria =  '$codSolicitadoVisualizar'";
                                        $resultadoAnexadas = mysql_query($sqlAnexadas) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registroAnexadas = mysql_fetch_array($resultadoAnexadas)) {
                                            echo $registroAnexadas['idSecundaria'];
                                            echo " - ";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </table>
                            <div class="btn-lg">
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                        Voltar
                                    </button>
                                    <button type="submit" class="btn btn-danger" onclick="location.href = 'sair.php'">                                    
                                        Cancelar
                                    </button> 
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        Editar
                                    </button>                
                                </div> 
                            </div>
                            <script language="JavaScript" type="text/javascript">

                                function validaCampos() {
                                    // ---------- VERIFICA SE O CAMPO JUSTIFICATIVA  EVENTO FOI PREENCHIDO ---------             
                                    quantPas = document.solicita.qtdPassageiros.value;
                                    quantPas2 = document.solicita.qtdPassageiros.value;
                                    quantPas3 = document.solicita.qtdPassageiros.value;
                                    quantPas4 = document.solicita.qtdPassageiros.value;
                                    quantMaior48 = document.solicita.qtdPassageiros.value;
                                    ocup1 = document.solicita.ocupante1.value;
                                    fone1 = document.solicita.foneOcup1.value;
                                    siapeOcup1 = document.solicita.siapeOcup1.value;
                                    ocup2 = document.solicita.ocupante2.value;
                                    fone2 = document.solicita.foneOcup2.value;
                                    siapeOcup2 = document.solicita.siapeOcup2.value;
                                    ocup3 = document.solicita.ocupante3.value;
                                    fone3 = document.solicita.foneOcup3.value;
                                    siapeOcup3 = document.solicita.siapeOcup3.value;
                                    ocup4 = document.solicita.ocupante4.value;
                                    fone4 = document.solicita.foneOcup4.value;
                                    siapeOcup4 = document.solicita.siapeOcup4.value;
                                    if (quantPas === "1" || quantPas2 === "2" || quantPas3 === "3" || quantPas4 === "4") {
                                        if (ocup1 === "" || fone1 === "" || siapeOcup1 === "") {
                                            alert("Preencha o 1º campo com o nome do ocupante, siape e telefone");
                                            solicita.foneOcup1.focus();
                                            solicita.ocupante1.focus();
                                            return false;
                                        }
                                    }
                                    if (quantPas2 === "2" || quantPas3 === "3" || quantPas4 === "4") {
                                        if (ocup2 === "" || fone2 === "" || siapeOcup2 === "") {
                                            alert("Preencha o 2º campo com o nome do ocupante, siape e telefone");
                                            solicita.foneOcup2.focus();
                                            solicita.ocupante2.focus();
                                            return false;
                                        }
                                    }
                                    if (quantPas3 === "3" || quantPas4 === "4") {
                                        if (ocup3 === "" || fone3 === "" || siapeOcup3 === "") {
                                            alert("Preencha o 3º campo com o nome do ocupante, siape e telefone");
                                            solicita.foneOcup3.focus();
                                            solicita.ocupante3.focus();
                                            return false;
                                        }
                                    }
                                    if (quantPas4 === "4") {
                                        if (ocup4 === "" || fone4 === "" || siapeOcup4 === "") {
                                            alert("Preencha o 4º campo com o nome do ocupante, siape e telefone");
                                            solicita.foneOcup4.focus();
                                            solicita.ocupante4.focus();
                                            return false;
                                        }
                                    }
                                    //        if (quantMaior48 >= "49") {
                                    //         alert("Não temos veículo que suporte mais do que 48 passageiros!");
                                    //         solicita.foneOcup1.focus();
                                    //         solicita.ocupante1.focus();
                                    //         return false;
                                    //     }
                                    //     if ((quantPasAte48 >= "5") && (quantPasAte48 <= "48")) {

                                    //          window.open('Lista_passageiros.pdf');
                                    //          window.open('pdfSolicita.php');
                                    //       }

                                    return true;
                                }



                            </script>
                        </form> 
                    </div>
                </div>
            </div>

        <?php } ?>
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
</div>
</html>
