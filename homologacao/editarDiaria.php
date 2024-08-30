<?php
include ('validar_session_diaria.php');
include ('jquery.php');
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

    <?php
// Caso o usuário seja administrador será exibido o menu */
    include "menuDiarias.php";

//Capitura o usuário logado para preencher os campos solicitante.
    $l = $_SESSION['login_usuario'];
    conecta();
    $pesquisa1 = "SELECT * FROM listarsolicitantes
                                       WHERE siape='$l'";
    $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
    While ($registro1 = mysql_fetch_array($resultado1)) {
    $nome = $registro1['nome'];
    $setor = $registro1['nomeSetor'];
    $cpf = $registro1['cpf'];
    $celular = $registro1['telefone'];
    $email = $registro1['email'];
    $banco = $registro1['banco'];
    $agencia = $registro1['agencia'];
    $conta = $registro1['conta'];
    $dt = formatoData($registro['dtNasc']);
    }
    ?>   
    <body  style="font-family: courier">
        <script language="JavaScript" type="text/javascript">


                    function validaCampos() {
                        // ---------- VERIFICA SE O CAMPO JUSTIFICATIVA  EVENTO FOI PREENCHIDO ---------             
                        just = document.editarDiaria.setJustificativa.value;
                        if (just === "") {
                            var dias = 0;
                            var date2 = new String(document.editarDiaria.setDtInicio.value);
                            var date1 = '<?php echo date("d/m/Y"); ?>';
                            date1 = date1.split("/");
                            date2 = date2.split("/");
                            var sDate = new Date(date1[1] + "/" + date1[0] + "/" + date1[2]);
                            var eDate = new Date(date2[1] + "/" + date2[0] + "/" + date2[2]);
                            var dias = Math.round((eDate - sDate) / 86400000);
                            just = document.editarDiaria.setJustificativa.value;
                            if (dias < 5) {
                                alert("Faltam apenas " + dias + " dias para o evento. Justifique!");
                                editarDiaria.setJustificativa.focus();
                                return false;
                            }

                        }
                        carg = document.editarDiaria.setCargoFunOrigServMunEst.value;
                        if (carg === "") {
                            sol = document.editarDiaria.setTipoSolicitante.value;
                            if (sol === "Servidor Estadual" || sol === "Servidor Municipal"|| sol === "Empregado Público") {
                                alert("Por favor, responder campos para servidores municipais, estaduais e empregados público");
                                editarDiaria.setCargoFunOrigServMunEst.focus();
                                return false;
                            }
                        }


                        vt = document.editarDiaria.setValeTranspServMunEst.value;
                        if (vt === "") {
                            sol = document.editarDiaria.setTipoSolicitante.value;
                            if (sol === "Servidor Estadual" || sol === "Servidor Municipal" || sol === "Empregado Público") {
                                alert("Por favor, responder campos para servidores municipais, estaduais e empregados público");
                                editarDiaria.setValeTranspServMunEst.focus();
                                return false;
                            }
                        }

                        va = document.editarDiaria.setValeAlimentServMunEst.value;
                        if (va === "") {
                            sol = document.editarDiaria.setTipoSolicitante.value;
                            if (sol === "Servidor Estadual" || sol === "Servidor Municipal" || sol === "Empregado Público") {
                                alert("Por favor, responder campos para servidores municipais, estaduais e empregados público");
                                editarDiaria.setValeAlimentServMunEst.focus();
                                return false;
                            }
                        }
                       /*  dtEmbIda = document.editarDiaria.setDtEmbarqueIDA.value;
                        if (dtEmbIda === "") {
                            diar = document.editarDiaria.setTipoDiaria.value;
                            if (diar === "Diária e Passagem") {
                                alert("Por favor, responder campos para o tipo de viagem diária e passagem");
                                editarDiaria.setDtEmbarqueIDA.focus();
                                return false;
                            }
                        }

                         dtEmbVolta = document.editarDiaria.setDtEmbarqueVOLTA.value;
                         if (dtEmbVolta === "") {
                         di ar= document.editarDiaria.setTipoDiaria.value;
                         if (diar === "Diária e Passagem") {
                         alert("Por favor, responder campos para o tipo de viagem diária e passagem");
                         editarDiaria.setDtEmbarqueVOLTA.focus();
                         return false;
                         }
                         }
                         
                         justD = document.editarDiaria.setJustificativaDiariaEmbarque.value;
                         if (justD === "") {
                         diar = document.editarDiaria.setTipoDiaria.value;
                         if (diar === "Diária e Passagem") {
                         alert("Por favor, responder campos para o tipo de viagem diária e passagem");
                         editarDiaria.setJustificativaDiariaEmbarque.focus();
                         return false;
                         }
                         }*/


                        return true;
                    }

        </script>

        <script language="JavaScript">
            function Verifica(objForm, strField, evtKeyPress) {
                var valor = "";
                var id = "";
                var radio = "";
                var texto = "";

                radio = document.getElementsByName("setTipoSolicitante");

                for (var i = 0; i < radio.length; i++)
                {
                    if (radio[i].checked)
                    {
                        valor = radio[i].value;
                        id = radio[i].id;
                    }
                }
                if (valor === 'Servidor Federal') {
                    var siape = '<?php echo $l; ?>';
                    document.editarDiaria.setSiape.value = siape;

                    var nome = '<?php echo $nome; ?>';
                    document.editarDiaria.setSolicitante.value = nome;

                    var setor = '<?php echo $setor; ?>';
                    document.editarDiaria.setSetor.value = setor;

                    var cpf = '<?php echo $cpf; ?>';
                    document.editarDiaria.setCpf.value = cpf;

                    var celular = '<?php echo $celular; ?>';
                    document.editarDiaria.setCelular.value = celular;

                    var banco = '<?php echo $banco; ?>';
                    document.editarDiaria.setBanco.value = banco;

                    var agencia = '<?php echo $agencia; ?>';
                    document.editarDiaria.setAgencia.value = agencia;

                    var conta = '<?php echo $conta; ?>';
                    document.editarDiaria.setConta.value = conta;

                    var email = '<?php echo $email; ?>';
                    document.editarDiaria.setEmail.value = email;

                    var dtNasc = '<?php echo $dt; ?>';
                    document.editarDiaria.setDtNasc.value = dtNasc;
                }

                else {

                    document.editarDiaria.setSiape.value = "";

                    document.editarDiaria.setSolicitante.value = "";

                    document.editarDiaria.setSetor.value = "";

                    document.editarDiaria.setCpf.value = "";

                    document.editarDiaria.setCelular.value = "";

                    document.editarDiaria.setBanco.value = "";

                    document.editarDiaria.setAgencia.value = "";

                    document.editarDiaria.setConta.value = "";

                    document.editarDiaria.setEmail.value = "";

                    document.editarDiaria.setDtNasc.value = "";
                }
            }

        </script>

        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Editar Diária</h3>
                </div>
                <div class="panel-body "> 

                    <?php
                    $idDiaria = $_GET['id'];
                    conecta();
                    $pesquisa = "SELECT * FROM listardiarias
                                WHERE codDiaria='$idDiaria'";

                    $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                    While ($registro = mysql_fetch_array($resultado)) {
                    ?>

                    <form  method="post" name="diaria" action="editandoDiaria.php"onsubmit="return validaCampos()">
                        <table class="table"> 
                            <tr >
                                <td > 
                                    <div class="form-group pull-left">
                                        <label for="nDiaria">Diária Nº</label>
                                    </div> 

                                    <input style="color: brown;height: 20px" type="text" name="codDiaria"
                                           size="3" readonly="true" value="<?= $registro["codDiaria"] ?>">
                                </td>

                            </tr>
                        </table>
                        <legend id="legendDadosPessoais" class="panel panel-success" 
                                style="background-color: #C1FFC1 ">Dados Institucionais</legend> 
                        <table id="tableDadosPessoais" class="table" >  
                            <tr>                             
                                <?php
                                if ($registro['tipoSolicitante'] == "Servidor Federal") {
                                ?>                                        
                                <td> 
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)" checked="checked"
                                           name="setTipoSolicitante" value="Servidor Federal"/>   
                                </td>
                                <td>
                                    <div> 
                                        <label for="ServCampGus">Servidor Federal</label>
                                    </div>                                    
                                </td>
                                <?php
                                } else {
                                ?>
                                <td> 
                                    <input type="radio"  id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)"
                                           name="setTipoSolicitante" value="Servidor Federal"/>   
                                </td>
                                <td>
                                    <div> 
                                        <label for="ServCampGus">Servidor Federal</label>
                                    </div>                                    
                                </td>                                        
                                <?php
                                }
                                if ($registro['tipoSolicitante'] == "Servidor Estadual") {
                                ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Servidor Estadual" checked="checked"/>  
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServOutroCamp">Servidor Estadual</label>
                                    </div>                                                                                                                 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Servidor Estadual"/>  
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServOutroCamp">Servidor Estadual</label>
                                    </div>                                                                                                                 
                                </td>     
                                <?php
                                }
                                if ($registro['tipoSolicitante'] == "Servidor Municipal") {
                                ?>

                                <td>
                                    <input type="radio" id="tipoSolicitante"  
                                           onClick="return Verifica(this.form, this.name, event)"
                                           name="setTipoSolicitante" value="Servidor Municipal"checked="checked"/>   
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServidorMunicipal">Servidor Municipal</label>
                                    </div> 
                                </td>  
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante"  
                                           onClick="return Verifica(this.form, this.name, event)"
                                           name="setTipoSolicitante" value="Servidor Municipal"/>   
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServidorMunicipal">Servidor Municipal</label>
                                    </div> 
                                </td> 
                                <?php }?>
                                <?php
                                if($registro['tipoSolicitante'] == "Empregado Público") { ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante" checked="true"
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Empregado Público"/> 
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServMunicipal">Empregado Público</label>
                                    </div> 
                                </td>  
                                <?php }else{ ?>
                                 <td>
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Empregado Público"/> 
                                </td>
                                <td>
                                    <div > 
                                        <label for="ServMunicipal">Empregado Público</label>
                                    </div> 
                                </td>  
                                <?php
                                }
                                ?>

                                <?php
                                if ($registro['tipoSolicitante'] == "Colaborador Eventual") {
                                ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante"  
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Colaborador Eventual"checked="checked"/> 
                                </td>
                                <td>
                                    <div > 
                                        <label for="ColaboradorEventual">Colaborador Eventual</label>
                                    </div>                         
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoSolicitante"  
                                           onClick="return Verifica(this.form, this.name, event)" 
                                           name="setTipoSolicitante" value="Colaborador Eventual"/> 
                                </td>
                                <td>
                                    <div > 
                                        <label for="ColaboradorEventual">Colaborador Eventual</label>
                                    </div>                         
                                </td>      
                                <?php
                                }
                                if ($registro['tipoSolicitante'] == "Outros") {
                                ?>                                
                                <td >
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)"
                                           name="setTipoSolicitante" value="Outros"checked="checked"/>     
                                </td>
                                <td>
                                    <div> 
                                        <label for="Outros"> Outros: </label>        
                                    </div>   
                                    <input type="text" name="setTipoSolicitanteOutros" size="30px" 
                                           style="height: 100%" 
                                           value="<?= $registro['tipoSolicitanteOutro'] ?>"/>  
                                </td> 

                                <?php
                                } else {
                                ?>
                                <td >
                                    <input type="radio" id="tipoSolicitante" 
                                           onClick="return Verifica(this.form, this.name, event)"
                                           name="setTipoSolicitante" value="Outros"/>     
                                </td>
                                <td>
                                    <div> 
                                        <label for="Outros"> Outros: </label>        
                                    </div>  
                                    <input type="text" name="setTipoSolicitanteOutros" 
                                           size="30px" style="height: 100%" 
                                           value="<?= $registro['tipoSolicitanteOutro'] ?>"/>                            
                                </td>
                                <?php } ?>  
                            </tr>
                        </table>

                        <table class="table">
                            <tr >
                                <td colspan="8">                                    
                                    <div> 
                                        <label for="Funcao" style="background-color: #d6e9c6">Campos para Servidor Municipal, Estadual ou Empregado Público</label>        
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td  style="width: 500px">
                                    <div> 
                                        <label for="cargo">Cargo / Função no órgão de origem</label>        
                                    </div>

                                    <input type="text" name="setCargoFunOrigServMunEst" value="<?= $registro['cargoFunOrigServMunEst'] ?>"
                                           size="300px" style="height: 100%;width: 500px" > 
                                </td>                                
                                <td style="width: 250px">
                                    <div> 
                                        <label for="vt">Valor do Vale Transporte</label>        
                                    </div>

                                    <input type="text" name="setValeTranspServMunEst"value="<?= $registro['valeTranspServMunEst'] ?>"
                                           size="100px" style="height: 100%"> 
                                </td >
                                <td style="width: 250px">
                                    <div> 
                                        <label for="va">Valor do Vale Alimentação</label>        
                                    </div>

                                    <input type="text" name="setValeAlimentServMunEst" value="<?= $registro['valeAlimentServMunEst'] ?>"
                                           size="100px" style="height: 100%"> 
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr >
                                <td colspan="20">                                    
                                    <div> 
                                        <label for="Funcao" style="background-color: #d6e9c6"> Função </label>        
                                    </div>
                                </td>
                            </tr>

                            <?php
                            if ($registro['funcaoSolicitante'] == "Professor") {
                            ?>  
                            <tr> 
                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Professor"checked="checked"/>
                                </td>
                                <td>
                                    <div> 
                                        <label for="Professor"> Professor </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Professor">
                                </td>
                                <td>
                                    <div> 
                                        <label for="Professor"> Professor </label>        
                                    </div>
                                </td>                                    
                                <?php
                                }


                                if ($registro['funcaoSolicitante'] == "Administrativo") {
                                ?>
                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Administrativo"checked="checked"/>  
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Administrativo "> Administrativo </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Administrativo"/>  
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Administrativo "> Administrativo </label>        
                                    </div>
                                </td>
                                <?php
                                }


                                if ($registro['funcaoSolicitante'] == "Aluno") {
                                ?>

                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Aluno" checked="checked"/>  
                                </td>
                                <td>
                                    <div>                                
                                        <label for="Aluno"> Aluno </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>                                
                                <td>
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Aluno"/>  
                                </td>
                                <td>
                                    <div>                                
                                        <label for="Aluno"> Aluno </label>        
                                    </div>
                                </td>
                                <?php } ?>
                                <?php //if ($registro['funcaoSolicitante'] == "Outros") {   ?>
                    <!--    <td >
                            <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                   name="setFuncao" value="Outros" checked="checked"/>     
                        </td>
                        <td>
                            <div> 
                                <label for="Outros"> Outros: </label>                                        
                            </div>                                   
                        </td> 
                                <?php //} else {
                                ?>
                        <td >
                            <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                   name="setFuncao" value="Outros" />     
                        </td>
                        <td>
                            <div> 
                                <label for="Outros"> Outros: </label>                                        
                            </div>                                   
                        </td> 
                                <?php
// }
                                ?>
                </tr>
                <tr>
                    <td colspan="8">
                        <input type="text" name="setFuncaoOutros" value="<?= $registro['tipoFuncaoOutro'] ?>" size="30px" style="height: 100%"class=" form-group pull-right">
                    </td>-->
                            </tr> 
                        </table>

                        <table class="table">
                            <tr>
                                <td colspan="20">                                    
                                    <div> 
                                        <label for="EscolaridadeFunc" style="background-color:#d6e9c6 ">
                                            Escolaridade da Função </label>        
                                    </div>
                                </td>
                            </tr>

                            <?php
                            if ($registro['escolaridade'] == "Fundamental") {
                            ?>
                            <tr>
                                <td>
                                    <input type="radio" id="tipoEscolaridade" 
                                           class=" form-group pull-right" 
                                           name="setEscolaridade" value="Fundamental" checked="checked">  
                                </td>
                                <td>
                                    <div> 
                                        <label for="Fundamental"> Fundamental </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoEscolaridade" 
                                           class="form-group pull-right" 
                                           name="setEscolaridade" value="Fundamental">  
                                </td>
                                <td>
                                    <div> 
                                        <label for="Fundamental"> Fundamental </label>        
                                    </div>
                                </td>
                                <?php
                                }


                                if ($registro['escolaridade'] == "Médio") {
                                ?>
                                <td>
                                    <input type="radio" id="tipoEscolaridade"
                                           class=" form-group pull-right" 
                                           name="setEscolaridade" value="Médio" checked="checked">  
                                </td>
                                <td>
                                    <div> 
                                        <label for="Médio"> Médio </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoEscolaridade"
                                           class=" form-group pull-right" 
                                           name="setEscolaridade" value="Médio">  
                                </td>
                                <td>
                                    <div> 
                                        <label for="Médio"> Médio </label>        
                                    </div>
                                </td>
                                <?php
                                }


                                if ($registro['escolaridade'] == "Superior") {
                                ?>
                                <td>
                                    <input type="radio" id="tipoEscolaridade" 
                                           class="form-group pull-right" 
                                           name="setEscolaridade" value="Superior" checked="checked">     
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Superior">  Superior  </label>        
                                    </div>
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" id="tipoEscolaridade" 
                                           class="form-group pull-right" 
                                           name="setEscolaridade" value="Superior">     
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Superior">  Superior  </label>        
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>                           

                        </table>

                        <legend id="legendDadosPessoais" class="panel panel-success" 
                                style="background-color: #C1FFC1 ">Dados Pessoais</legend>
                        <table class="table">
                            <tr >
                                <td >                                   
                                    <div> 
                                        <label for="RG/Siape"> RG/Siape </label>        
                                    </div>

                                    <input type="text" style="height: 100%; width: 200px"  class="form-control" 
                                           name="setSiape" required="true" value="<?= $registro['siape'] ?>" >
                                </td>

                                <td >
                                    <div > 
                                        <label for="Nome"> Nome </label>        
                                    </div>

                                    <input type="text" class="form-control" required="true" value="<?= $registro['beneficiado'] ?>"
                                           name="setSolicitante" style="height: 100%;width: 400px">
                                </td>  

                                <td >
                                    <div > 
                                        <label for="CPF"> CPF </label>        
                                    </div>

                                    <input type="text"  style="height: 100%;width: 200px" name="setCpf"
                                           placeholder="000.000.000-00" required="true" value="<?= $registro['cpf'] ?>"
                                           class="form-control" id="cpf" class="cpf" maxlength="14">
                                </td>
                                <td>
                                    <div > 
                                        <label for="dtnasc">Data de Nascimento</label>        
                                    </div>

                                    <input type="text"  id="calendario2" class="form-control"required="true"
                                           name="setDtNasc"  style="height: 100%; width: 200px" value="<?= formatoData($registro['dtNasc']) ?>"/>      
                                </td>
                            </tr>
                            <tr>
                                <td >    
                                    <div > 
                                        <label for="Celular"> Celular </label>        
                                    </div>

                                    <input type="text"  name="setCelular" class="form-control"
                                           placeholder="(00)0000-0000" required="true"value="<?= $registro['celular'] ?>"
                                           class="fone"   id="celular" style="height: 100%;width: 200px" maxlength="15">
                                </td>

                                <td>
                                    <div  > 
                                        <label for="OrgaoESetorOrig">  Órgão ou Setor de Exercício </label>        
                                    </div>

                                    <input type="text"    class="form-control"  required="true" value="<?= $registro['setor'] ?>"
                                           name="setSetor"id="setor" style="height: 100%;width: 200px">
                                </td>

                                <td>
                                    <div > 
                                        <label for="Email">  E-mail </label>        
                                    </div>

                                    <input type="text"  class="form-control"  placeholder="email@exemplo.com"  value="<?= $registro['email'] ?>" 
                                           name="setEmail"  id="email" style="height: 100%;width: 330px"required="true">
                                </td>

                            </tr>
                        </table>

                        <table class="table">
                            <tr>
                                <td colspan="6">                                    
                                    <div> 
                                        <label for="DadosBanc"style="background-color:#d6e9c6 "> Dados Bancários </label>        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td >  
                                    <div > 
                                        <label for="Banco"> Banco </label>        
                                    </div>

                                    <input type="text"  class="form-control " name="setBanco"
                                           value="<?= $registro['banco'] ?>"required="true"
                                           id="banco" style="height: 100%;width: 200px">
                                </td>

                                <td>
                                    <div > 
                                        <label for="Agencia"> Agência </label>        
                                    </div>

                                    <input type="text"   class="form-control " name="setAgencia"
                                           value="<?= $registro['agencia'] ?>"required="true"
                                           id="ag" style="height: 100%;width: 200px"/>
                                </td>

                                <td>
                                    <div > 
                                        <label for=" C/C">  C/C </label>        
                                    </div>

                                    <input type="text"  class="form-control"  name="setConta" 
                                           value="<?= $registro['conta'] ?>"required="true"
                                           id="cc" style="height: 100%;width: 200px"/>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6" >                                       
                                    <a class="btn  btn-lg pull-right"   
                                       href=listarUsuariosSolicitanteDiaria.php
                                       title="Atualize seu Cadastro">Atualize seu Cadastro</a>   
                                </td>
                            </tr>
                        </table>






                        <legend id="legendDadosViagem" class="panel panel-success" 
                                style="background-color:#C1FFC1">Dados da Viagem</legend> 
                        <table id="tableDadosViagem" class="table" >
                            <tr>
                                <td colspan="10">
                                    <div> 
                                        <label for="TipoD" style="background-color:#d6e9c6 ">
                                            Tipo de Diária</label>        
                                    </div>
                                </td>                               
                            </tr>
                            <tr>
                                <?php if ($registro["tipoDiaria"] == "Diária") { ?>
                                <td>
                                    <input type="radio" name="setTipoDiaria" value="Diária" class=" form-group pull-right" checked="true"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Diaria"> Diária </label>        
                                    </div> 
                                </td> 
                                <?php } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTipoDiaria" value="Diária" class=" form-group pull-right" > 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Diaria"> Diária </label>        
                                    </div> 
                                </td> 
                                <?php
                                }
                                ?>
                                <?php if ($registro["tipoDiaria"] == "Diária e Passagem") { ?>
                                <td >
                                    <input type="radio" name="setTipoDiaria" value="Diária e Passagem"checked="true"
                                           class=" form-group pull-right"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="DiariaPass"> Diária e Passagem</label>        
                                    </div> 
                                </td>  
                                <?php } else {
                                ?>
                                <td >
                                    <input type="radio" name="setTipoDiaria" value="Diária e Passagem" class=" form-group pull-right"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="DiariaPass"> Diária e Passagem</label>        
                                    </div> 
                                </td>  
                                <?php
                                }
                                ?>
                            </tr>
                        </table>
                        <table class="table">
                            <!--<tr>
                                <td colspan="20">
                                    <div> 
                                        <label for="inf" style="background-color:#d6e9c6 ">
                                            Campos para a opção DIÁRIA E PASSAGEM</label>        
                                    </div>
                                </td>                               
                            </tr>-->
                            <tr >
                                <td>
                                    <div > 
                                        <label for="dtembarq">Data de Viagem/ Embarque IDA</label>        
                                    </div>

                                    <input type="text"  id="calendario3" value="<?= formatoData($registro['dtEmbarqueIDA']) ?>"
                                           name="setDtEmbarqueIDA"  style="height: 100%; width: 200px" required="true"/>      
                                </td>

                                <td>
                                    <div > 
                                        <label for="dtembarq">Data de Viagem/ Embarque VOLTA</label>        
                                    </div>

                                    <input type="text"  id="calendario4" value="<?= formatoData($registro['dtEmbarqueVOLTA']) ?>"
                                           name="setDtEmbarqueVOLTA"  style="height: 100%; width: 200px"required="true"/>      
                                </td>

                                <td>
                                    <div > 
                                        <label for="just">Justificativa para as datas de viagem/embarque</label>        
                                    </div>
                                    <textarea type="text"  maxlength="500"
                                              name="setJustificativaDiariaEmbarque" required="true"
                                              style="height: 500%; width: 500px"><?= $registro['justificativaDiariaEmbarque'] ?></textarea>   
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td colspan="15">
                                    <div> 
                                        <label for="MeioTransp" style="background-color:#d6e9c6 ">
                                            Meio de Transporte Ida</label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>    
                                <?php
                                if ($registro['meioTransporte'] == "Oficial") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Oficial"
                                           checked="checked" class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Oficial"> Oficial</label>        
                                    </div>  
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Oficial" 
                                           class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Oficial"> Oficial</label>        
                                    </div>  
                                </td>
                                <?php }
                                ?>
                                <?php
                                if ($registro['meioTransporte'] == "Próprio") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Próprio" 
                                           class=" form-group pull-right"checked="checked"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Próprio"> Próprio </label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Próprio"
                                           class=" form-group pull-right"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Próprio"> Próprio </label>        
                                    </div> 
                                </td>
                                <?php }
                                ?>

                                <?php
                                if ($registro['meioTransporte'] == "Rodoviário") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Rodoviário" 
                                           checked="checked" class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Rodoviário"> Rodoviário</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Rodoviário"
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Rodoviário"> Rodoviário</label>        
                                    </div> 
                                </td>
                                <?php
                                }

                                if ($registro['meioTransporte'] == "Aereo") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Aereo" 
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Aereo"> Aereo</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporte" value="Aereo" 
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Aereo"> Aereo</label>        
                                    </div> 
                                </td>
                                <?php } ?>  

                            </tr> 
                        </table>
                        <table class="table">
                            <tr>
                                <td colspan="15">
                                    <div> 
                                        <label for="MeioTransp" style="background-color:#d6e9c6 ">
                                            Meio de Transporte Volta</label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>   
                                <?php
                                if ($registro['meioTransporteVolta'] == "Oficial") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Oficial"
                                           checked="checked" class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Oficial"> Oficial</label>        
                                    </div>  
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Oficial" 
                                           class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Oficial"> Oficial</label>        
                                    </div>  
                                </td>
                                <?php }
                                ?>
                                <?php
                                if ($registro['meioTransporteVolta'] == "Próprio") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Próprio" 
                                           class=" form-group pull-right"checked="checked"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Próprio"> Próprio </label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Próprio"
                                           class=" form-group pull-right"> 
                                </td>
                                <td>
                                    <div> 
                                        <label for="Próprio"> Próprio </label>        
                                    </div> 
                                </td>
                                <?php }
                                ?>

                                <?php
                                if ($registro['meioTransporteVolta'] == "Rodoviário") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Rodoviário" 
                                           checked="checked" class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Rodoviário"> Rodoviário</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Rodoviário"
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Rodoviário"> Rodoviário</label>        
                                    </div> 
                                </td>
                                <?php
                                }

                                if ($registro['meioTransporteVolta'] == "Aereo") {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Aereo" 
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Aereo"> Aereo</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setTransporteVolta" value="Aereo" 
                                           class=" form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Aereo"> Aereo</label>        
                                    </div> 
                                </td>
                                <?php } ?>  

                            </tr> 
                        </table>


                        <table class="table">
                            <tr>
                                <td>
                                    <div > 
                                        <label for="Origem" style="background-color:#d6e9c6 ">Cidade de Origem (Campus)</label>        
                                    </div> 
                                </td>
                                <td >
                                    <div > 
                                        <label for="Destino" style="background-color:#d6e9c6 ">Cidade de Destino</label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div >
                                        <label for="cod_estados">Estado</label>
                                    </div>

                                    <select name="cod_estados" id="cod_estados"required="true">

                                        <option value="<?= $registro['siglaUForigem'] ?>"><?= $registro['siglaUForigem'] ?></option>
                                        <?php
                                        conecta();
                                        $sql = "SELECT cod_estados, sigla
                                                            FROM estados
                                                            ORDER BY sigla";
                                        $res = mysql_query($sql);
                                        while ($row = mysql_fetch_assoc($res)) {
                                        echo '<option value="' . $row['cod_estados'] . '">' . $row['sigla'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td>
                                    <div >
                                        <label for="cod_estados1">Estado</label>
                                    </div>

                                    <select name="cod_estados1" id="cod_estados1"required="true">
                                        <option value="<?= $registro['cod_estados'] ?>"><?= $registro['sigla'] ?></option>
                                        <?php
                                        conecta();
                                        $sql1 = "SELECT cod_estados, sigla
                                                            FROM estados
                                                            ORDER BY sigla";
                                        $res1 = mysql_query($sql1);
                                        while ($row1 = mysql_fetch_assoc($res1)) {
                                        echo '<option value="' . $row1['cod_estados'] . '">' . $row1['sigla'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <div >                                        
                                        <label for="cod_cidades">Cidade</label>
                                    </div>

                                    <select name="cod_cidades" id="cod_cidades"required="true">
                                        <option value="<?= $registro['cidOrigem'] ?>"> <?= $registro['nomeCidOrigem'] ?> </option>
                                    </select>
                                </td>  
                                <td>
                                    <div >                                        
                                        <label for="cod_cidades1">Cidade</label>
                                    </div>

                                    <select name="cod_cidades1" id="cod_cidades1"required="true">
                                        <?php
                                        conecta();
                                        $getSet = $registro['cidDestino'];
                                        $sqlSL = "SELECT cod_cidades, nome
                                                            FROM cidades WHERE cod_cidades=$getSet ";
                                        $resSL = mysql_query($sqlSL);
                                        while ($rowSL = mysql_fetch_assoc($resSL)) {
                                        echo '<option value="' . $rowSL['cod_cidades'] . '">' . $rowSL['nome'] . '</option>';
                                        }
                                        ?>                                                                   

                                    </select>
                                </td>
                            </tr>
                        </table>


                        <table class="table">
                            <tr>
                                <td colspan="15">
                                    <div > 
                                        <label for="MotivoViagem"style="background-color:#d6e9c6 ">Motivo da Viagem</label>        
                                    </div>
                                </td>
                            </tr>

                            <?php
                            if ($registro['motivoViagem'] == "Visita") {
                            ?>  
                            <tr>                                
                                <td>
                                    <input type="radio" name="setMotivo" value="Visita" class="form-group pull-right"  checked="checked">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Visita"> Visita Técnica</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>

                                <td>
                                    <input type="radio" name="setMotivo" value="Visita" class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Visita"> Visita Técnica</label>        
                                    </div> 
                                </td>
                                <?php
                                }


                                if ($registro['motivoViagem'] == "Convocação") {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Convocação" class="form-group pull-right" checked="checked">
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Convocação">  Convocação </label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?> 
                                <td>
                                    <input type="radio" name="setMotivo" value="Convocação" class="form-group pull-right">
                                </td>
                                <td>
                                    <div> 
                                        <label for=" Convocação">  Convocação </label>        
                                    </div> 
                                </td>
                                <?php
                                }


                                if ($registro['motivoViagem'] == "Treinamento") {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Treinamento" class="form-group pull-right" checked="checked">
                                </td>
                                <td>
                                    <div> 
                                        <label for="Treinamento">   Treinamento </label>        
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Treinamento" class="form-group pull-right">
                                </td>
                                <td>
                                    <div> 
                                        <label for="Treinamento">   Treinamento </label>        
                                    </div> 
                                </td>
                            </tr>



                            <?php
                            }
                            if ($registro['motivoViagem'] == "Encontro") {
                            ?>  
                            <tr>
                                <td>
                                    <input type="radio" name="setMotivo" value="Encontro" 
                                           class="form-group pull-right"checked="checked">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Encontro">Encontro </label>        
                                    </div> 
                                </td>

                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Encontro" class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Encontro">Encontro </label>       
                                    </div> 

                                </td>

                                <?php
                                }

                                if ($registro['motivoViagem'] == "Reunião") {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Reunião" class="form-group pull-right" checked="checked">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Reunião"> Reunião</label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Reunião" class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Reunião"> Reunião</label>        
                                    </div> 
                                </td> 
                                <?php
                                }

                                if ($registro['motivoViagem'] == "Seminário") {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Seminário" class="form-group pull-right" checked="checked" >
                                </td>
                                <td>
                                    <div > 
                                        <label for="Seminário">   Seminário </label>        
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Seminário" class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Seminário">   Seminário </label>        
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <?php
                                }
                                if ($registro['motivoViagem'] == "Congresso") {
                                ?> 

                                <td >
                                    <input type="radio" name="setMotivo" value="Congresso" class="form-group pull-right" checked="checked">
                                </td>
                                <td>
                                    <div> 
                                        <label for="Congresso"> Congresso </label>        
                                    </div> 
                                </td>
                                <?php
                                } else {
                                ?>
                                <td >
                                    <input type="radio" name="setMotivo" value="Congresso" class="form-group pull-right">
                                </td>
                                <td>
                                    <div> 
                                        <label for="Congresso"> Congresso </label>        
                                    </div> 

                                </td>                                    
                                <?php
                                }

                                if ($registro['motivoViagem'] == "Outros") {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Outros" class="form-group pull-right" checked="checked">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Outros">  Outros </label>        
                                    </div>                                     
                                    <input type="text" name="setMotivoOutros" style="height: 30px" value="<?= $registro['motivoViagemOutro'] ?>">
                                </td>
                                <?php
                                } else {
                                ?>
                                <td>
                                    <input type="radio" name="setMotivo" value="Outros" class="form-group pull-right">
                                </td>
                                <td>
                                    <div > 
                                        <label for="Outros">  Outros </label>        
                                    </div> 
                                    <input type="text" name="setMotivoOutros" style="height: 30px" value="<?= $registro['motivoViagemOutro'] ?>">
                                </td>
                                <?php } ?>
                            </tr>


                        </table>



                        <legend id="legendDadosEvento" class="panel panel-success" 
                                style="background-color: #C1FFC1">Dados do Evento</legend> 
                        <table id="tableDadosEvento" class="table" >


                            <tr>
                                <td>
                                    <div > 
                                        <label style="background-color:#d6e9c6 ">Início</label>        
                                    </div>
                                </td>
                                <td>
                                    <div > 
                                        <label style="background-color:#d6e9c6 ">Término</label>        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td> 
                                    <div >  
                                        <label for="DtInicio">Data</label>
                                    </div>

                                    <input type="text"  id="calendario" class="form-control"value="<?= formatoData($registro["dtInicio"]) ?>"
                                           name="setDtInicio"  style="height: 100%;width: 250px" required="true"/>                            
                                </td>

                                <td> 
                                    <div >  
                                        <label for="DtFim">Data </label>
                                    </div>

                                    <input type="text"  id="calendario1" class="form-control" value="<?= formatoData($registro["dtFim"]) ?>"
                                           name="setDtFim"  style="height: 100%;width: 250px"required="true"/>                               
                                </td>                           


                            </tr>
                            <tr>
                                <td> 
                                    <div >  
                                        <label for="HrInicio">Hora </label>
                                    </div>

                                    <input type="text" id="HrInicio" class="form-control" maxlength="5" placeholder="00:00" 
                                           value="<?= formatoData($registro["hrInicio"]) ?>"
                                           name="setHrInicio"  style="height: 100%;width: 250px"required="true" />                                    
                                </td>  

                                <td> 
                                    <div>  
                                        <label for="HrFim">Hora </label>
                                    </div>

                                    <input type="text" id="HrFim" class="form-control" maxlength="5" placeholder="00:00" 
                                           value="<?= formatoData($registro["hrFim"]) ?>"
                                           name="setHrFim"  style="height: 100%;width: 250px"required="true" />                                  
                                </td>    


                            </tr>

                        </table>


                        <table class="table">
                            <tr>
                                <td >
                                    <div > 
                                        <label style="background-color:#d6e9c6; width: 650px "for="Desc">
                                            Descrição do motivo da viagem (Objetivo/Assunto/Evento)</label>        
                                    </div>
                                </td>
                                <td>
                                    <div > 
                                        <label for="LocalEvento"
                                               style="background-color:#d6e9c6; width: 680px " > Local do Evento </label>        
                                    </div>
                                </td>                                
                            </tr>                        

                            <tr>
                                <td>
                                    <textarea name="setDesc" type="text" maxlength="250"required="true"
                                              id="setDesc" style="width: 500px; height: 70px"  >
                                        <?= $registro['descMotivoViagem'] ?></textarea>
                                </td>
                                <td>
                                    <input type="text"   name="setLocalEvento"required="true"
                                           id="banco" style="height: 100%; width: 500px"  
                                           value="<?= $registro['localEvento'] ?>">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="6" >
                                    <div > 
                                        <label for="Just" style="background-color:#d6e9c6">
                                            Justificativa para o caso da solicitação ter sido feita com
                                            MENOS de 05 DIAS da data do evento</label>        
                                    </div>

                                    <input name="setJustificativa" type="text" maxlength="200"
                                           id="just" style="width: 1000px; height: 30px" value="<?= $registro['justificativa'] ?>"/>
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

                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
                                                                                                                                  <!--        <script src="http://www.google.com/jsapi"></script> -->

        <script type="text/javascript">
            /* Máscaras ER */
            function mascara(o, f) {
                v_obj = o
                v_fun = f
                setTimeout("execmascara()", 1);
            }
            function execmascara() {
                v_obj.value = v_fun(v_obj.value);
            }
            function mtel(v) {
                v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
                v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
                v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
                //de novo (para o segundo bloco de números)
                v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
                return v;
            }
            function id(el) {
                return document.getElementById(el);
            }
            window.onload = function () {
                id('cpf').onkeypress = function () {
                    mascara(this, mtel);
                }
            }
        </script>
        <script type="text/javascript" charset="ISO-8859-1">
            $(function () {
                $('#cod_estados').change(function () {
                    if ($(this).val()) {
                        $('#cod_cidades').hide();
                        $('.carregando').show();
                        $.getJSON('cidades.ajax.php?search=', {cod_estados: $(this).val(), ajax: 'true'}, function (j) {
                            var options = '<option value=""></option>';
                            for (var i = 0; i < j.length; i++) {
                                options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                            }
                            $('#cod_cidades').html(options).show();
                            $('.carregando').hide();
                        });
                    } else {
                        $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
                    }
                });
            });
        </script>
                                                                                                                                       <!--        <script src="http://www.google.com/jsapi"></script> -->

        <script type="text/javascript" charset="ISO-8859-1">
            $(function () {
                $('#cod_estados1').change(function () {
                    if ($(this).val()) {
                        $('#cod_cidades1').hide();
                        $('.carregando').show();
                        $.getJSON('cidades.ajaxDestino.php?search=', {cod_estados1: $(this).val(), ajax: 'true'}, function (j1) {
                            var options = '<option value=""></option>';
                            for (var i = 0; i < j1.length; i++) {
                                options += '<option value="' + j1[i].cod_cidades + '">' + j1[i].nome + '</option>';
                            }
                            $('#cod_cidades1').html(options).show();
                            $('.carregando').hide();
                        });
                    } else {
                        $('#cod_cidades1').html('<option value="">– Escolha um estado –</option>');
                    }
                });
            });
        </script>

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
        <script>
            $(function () {
                $("#calendario2").datepicker({
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
                $("#calendario3").datepicker({
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
                $("#calendario4").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'], dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']


                });
            });
        </script>

    </body>
</html>
