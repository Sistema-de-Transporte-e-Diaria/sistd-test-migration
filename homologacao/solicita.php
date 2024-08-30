<?php
include ('validar_session.php');
include ('jquery.php');
$admin = $_SESSION['nivel'];
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
    <?php include "menu.php"; ?>   
    <body style="font-family: courier">

        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Efetuar Solicitação</h3>
                </div>
                <div class="panel-body "> 
                    <form method="post" action="cadSolicita.php" name="solicita"onsubmit="return validaCampos();" >


                        <table class="table">

                            <tr>
                                <td >
                                    <div >
                                        <label for="Solicitante"> Solicitante</label>
                                    </div>                               

                                    <select  name="setEscolhaSolicitante"
                                             id="escolha" required="true" class="input-xxlarge" >
                                                 <?php
                                                 if ($admin == 1) {
                                                     //Capitura o usuário logado para preencher os campos solicitante.
                                                     $l = $_SESSION['login_usuario'];
                                                     conecta();
                                                     $pesquisa = "SELECT * FROM solicitantes
                                            WHERE siape='$l' ";
                                                     $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                                     While ($registro1 = mysql_fetch_array($resultado)) {
                                                         ?>       
                                                <option value="<?= $l ?>"><?= $registro1["nome"] ?></option>
                                                <?php
                                            }
                                        } elseif ($admin == 2 || $admin == 3) {
                                            //Capitura o usuário logado para preencher os campos solicitante.
                                            $l = $_SESSION['login_usuario'];
                                            conecta();
                                            $pesquisa = "SELECT * FROM solicitantes
                                              WHERE statusSolicitante <>0
                                              ORDER BY nome";

                                            $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                            ?>    
                                            <option style="color: brown" >SELECIONE O SOLICITANTE</option>
                                            <?php
                                            While ($registro1 = mysql_fetch_array($resultado)) {
                                                ?>    
                                                <option value="<?= $registro1['siape'] ?>"><?= $registro1["nome"] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>	
                                    </select>
                                </td>
                            </tr> 
                        </table>
                        <!-- Início do formulário -->  

                        <table class="table">                          
                            <legend id="legendDadosViagem" class="panel panel-success" 
                                    style="background-color:#C1FFC1">Dados Previstos da Viagem</legend>   
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
                                <td >
                                    <div >
                                        <label for=" DataSaída"> Data </label>
                                    </div>                                   

                                    <input name="prevDtSaida" type="text" id="calendario"  style=" height:100%"class="input-medium" required="true"/>                                  
                                </td>

                                <td >
                                    <div >
                                        <label for="DataRetorno">Data </label>
                                    </div>  
                                    <input type="text" id="calendario1" 
                                           name="prevDtRetorno"  class="input-medium" style=" height:100%"required="true"/>        
                                </td>

                            </tr>
                            <tr>
                                <td >
                                    <div >
                                        <label for="HoraSaída">Hora </label>
                                    </div>                                    
                                    <select name="prevHrSaida"class="input-medium" required="true"class="form-control">
                                        <option></option>
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
                                <td >
                                    <div >
                                        <label for=" HoraRetorno"> Hora </label>
                                    </div>                                   

                                    <select name="prevHrRetorno"class="input-medium" required="true"class="form-control">
                                        <option></option>
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
                                        <label for=" Destino/Itinerario" style="background-color:#d6e9c6 "class="input-xxxlarge"> Destino/Itinerário</label>
                                    </div>                                    
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <textarea name="destino" type="text" maxlength="200"
                                              placeholder="Origem/Destino/Origem" class="input-xxlarge"
                                              id="destino" required="true"
                                              required="true" ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div >
                                        <label for="Finalidade" style="background-color:#d6e9c6 "class="input-xxxlarge">Finalidade</label>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>                                  

                                    <textarea name="finalidade" type="text" maxlength="200"
                                              placeholder="Finalidade da viagem"class="input-xxlarge"
                                              id="just" 
                                              required="true" ></textarea>

                                </td>


                            </tr>
                        </table>  

                        <table class="table "> 
                            <tr>
                                <td colspan="6">                                    
                                    <div> 
                                        <label for="OcVeiculo"style="background-color:#d6e9c6 "class="input-xxxlarge">Ocupantes do Veículo </label>        
                                    </div>
                                </td>
                            </tr>

                            <tr class=" input-xxxlarge">
                                <td>
                                    <div >
                                        <label for="QuantidadePassageiros">Quantidade de Passageiros(as)</label>
                                    </div>

                                    <input type="text" name="qtdPassageiros"required="true"class="form-control"
                                           style="height: 100%;width: 50px" id="qtPassageiros">
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
                                        <label for="Fone"class="input-medium"> Fone</label>
                                    </div>                                   
                                </td>
                            </tr>
                            <tr>
                                <td>1º
                                    <input type="text" name="ocupante1" class="input-large"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text"  name="siapeOcup1"class="input-medium"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text"  name="foneOcup1"  placeholder="(00)0000-0000" class="input-medium"style="height: 100%"
                                           />
                                </td>
                            </tr>

                            <tr>
                                <td >2º
                                    <input type="text" name="ocupante2"
                                           class="input-large"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text"  name="siapeOcup2" class="input-medium"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text" name="foneOcup2"placeholder="(00)0000-0000"
                                           class="input-medium"style="height: 100%"/>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    3º <input type="text" name="ocupante3" 
                                              class="input-large"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text"  name="siapeOcup3"class="input-medium" style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text" name="foneOcup3" placeholder="(00)0000-0000"
                                           class="input-medium"style="height: 100%"/>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    4º <input type="text" name="ocupante4"
                                              class="input-large"style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text"  name="siapeOcup4" class="input-medium" style="height: 100%"/>
                                </td>
                                <td>
                                    <input type="text" name="foneOcup4" placeholder="(00)0000-0000"
                                           class="input-medium"style="height: 100%"/>
                                </td>
                            </tr>
                        </table>

                        <table class="table input-xxxlarge">

                            <tr>
                                <td >
                                    <div >
                                        <label for="obs">OBS: Acima de 4 passageiros deve ser anexado a lista com NOME, SIAPE, Nº RG ou CPF.</label>
                                    </div>

                                </td>
                            </tr>                        

                        </table> 
                        <div class="btn-lg">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-warning btn-xs " onClick="history.go(-1)">
                                    Voltar
                                </button>
                                <button type="submit" class="btn btn-danger " onclick="location.href = 'sair.php'">                                    
                                    Cancelar
                                </button>     
                                <button type="submit" class="btn btn-primary ">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    Enviar/Imprimir
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
                           

                                return true;
                            }

                        </script>
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
            });</script>
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
