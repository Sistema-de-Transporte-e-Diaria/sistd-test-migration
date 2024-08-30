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
    }
    ?>   
    <body  style="font-family: courier">


        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Visualizar Diária</h3>
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

                        <form >
                            <table class="table"> 
                                <tr>
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
                                            <input type="radio"  id="tipoSolicitante" disabled="true"
                                                   onClick="return Verifica(this.form, this.name, event)" checked="checked"
                                                   name="setTipoSolicitante" value="Servidor Federal"/>   
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="ServFed">Servidor Federal</label>
                                            </div>                                    
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td> 
                                            <input type="radio"  id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Servidor Federal"/>   
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="ServFed">Servidor Federal</label>
                                            </div>                                    
                                        </td>                                       
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Servidor Estadual") {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Servidor Estadual" checked="checked"/>  
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="ServEst">Servidor Estadual</label>
                                            </div>                                                                                                                 
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante"
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Servidor Estadual"/>  
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="ServEst">Servidor Estadual</label>
                                            </div>                                                                                                                 
                                        </td>     
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Servidor Municipal") {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
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
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Servidor Municipal"/> 
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="ServidorMunicipal">Servidor Municipal</label>
                                            </div>                         
                                        </td> 
                                    <?php } ?>                                 
                                    <?php if ($registro['tipoSolicitante'] == "Empregado Público") { ?>
                                        <td>
                                            <div > 
                                                <label for="ServMunicipal">Empregado Público</label>
                                            </div> 
                                        </td>                      
                                        <td>
                                            <input type="radio" id="tipoSolicitante"  checked="true"disabled="true"
                                                   onClick="return Verifica(this.form, this.name, event)" 
                                                   name="setTipoSolicitante" value="Empregado Público"/> 
                                        </td>
                                    <?php } else { ?>
                                        <td>
                                            <div > 
                                                <label for="ServMunicipal">Empregado Público</label>
                                            </div> 
                                        </td>                      
                                        <td>
                                            <input type="radio" id="tipoSolicitante" disabled="true"
                                                   onClick="return Verifica(this.form, this.name, event)" 
                                                   name="setTipoSolicitante" value="Empregado Público"/> 
                                        </td>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($registro['tipoSolicitante'] == "Colaborador Eventual") {
                                        ?>

                                        <td>
                                            <input type="radio" id="tipoSolicitante"
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Colaborador Eventual"checked="checked"/>   
                                        </td>

                                        <td>
                                            <div > 
                                                <label for="Colaborador">Colaborador Eventual</label>
                                            </div> 
                                        </td>  
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Colaborador Eventual"/>   
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Colaborador">Colaborador Eventual</label>
                                            </div> 
                                        </td> 
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Outros") {
                                        ?>                                
                                        <td >
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Outros"checked="checked"/>     
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="Outros"> Outros: </label>        
                                            </div>   
                                            <input type="text" name="setTipoSolicitanteOutros" 
                                                   size="30px" style="height: 100%" 
                                                   disabled="true" value="<?= $registro['tipoSolicitanteOutro'] ?>"/>  
                                        </td> 

                                        <?php
                                    } else {
                                        ?>
                                        <td >
                                            <input type="radio" id="tipoSolicitante" disabled="true"
                                                   onClick="return Verifica(this.form, this.name, event)"
                                                   name="setTipoSolicitante" value="Outros"/>     
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="Outros"> Outros: </label>        
                                            </div>  
                                            <input type="text" name="setTipoSolicitanteOutros"
                                                   size="30px" style="height: 100%" 
                                                   disabled="true"  value="<?= $registro['tipoSolicitanteOutro'] ?>"/>                            
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

                                        <input type="text" name="setCargoFunOrigServMunEst" disabled="true"
                                               value="<?= $registro['cargoFunOrigServMunEst'] ?>"
                                               size="300px" style="height: 100%;width: 500px" > 
                                    </td>                                
                                    <td style="width: 250px">
                                        <div> 
                                            <label for="vt">Valor do Vale Transporte</label>        
                                        </div>

                                        <input type="text" name="setValeTranspServMunEst"disabled="true"
                                               value="<?= $registro['valeTranspServMunEst'] ?>"
                                               size="100px" style="height: 100%"> 
                                    </td >
                                    <td style="width: 250px">
                                        <div> 
                                            <label for="va">Valor do Vale Alimentação</label>        
                                        </div>

                                        <input type="text" name="setValeAlimentServMunEst" disabled="true"
                                               value="<?= $registro['valeAlimentServMunEst'] ?>"
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
                                            <input type="radio" id="tipoFuncao" disabled="true"
                                                   class=" form-group pull-right"
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
                                            <input type="radio" id="tipoFuncao" disabled="true"
                                                   class=" form-group pull-right"
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
                                            <input type="radio" id="tipoFuncao"disabled="true"
                                                   class=" form-group pull-right"
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
                                            <input type="radio" id="tipoFuncao" disabled="true"
                                                   class=" form-group pull-right"
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
                                            <input type="radio" id="tipoFuncao" disabled="true"
                                                   class="form-group pull-right"
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
                                            <input type="radio" id="tipoFuncao" disabled="true"
                                                   class=" form-group pull-right"
                                                   name="setFuncao" value="Aluno"/>  
                                        </td>
                                        <td>
                                            <div>                                
                                                <label for="Aluno"> Aluno </label>        
                                            </div>
                                        </td>
                                        <?php
                                    }
                                    // if ($registro['funcaoSolicitante'] == "Outros") {
                                    ?>
                            <!--    <td >
                                    <input type="radio" id="tipoFuncao" class=" form-group pull-right"
                                           name="setFuncao" value="Outros" checked="checked"disabled="true"/>     
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
                                           name="setFuncao" value="Outros"disabled="true" />     
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
                                <input type="text" name="setFuncaoOutros"disabled="true"
                                       value="<?= $registro['tipoFuncaoOutro'] ?>" size="30px" style="height: 100%"class=" form-group pull-right">
                            </td>-->
                                </tr>     
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
                                                   class=" form-group pull-right" disabled="true"
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
                                                   class="form-group pull-right" disabled="true"
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
                                                   class=" form-group pull-right" disabled="true"
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
                                            <input type="radio" id="tipoEscolaridade" disabled="true"
                                                   class="form-group pull-right" 
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
                                                   class="form-group pull-right" disabled="true"
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
                                            <input type="radio" id="tipoEscolaridade" disabled="true"
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
                                        <div > 
                                            <label for="RG/Siape"> RG/Siape </label>        
                                        </div>

                                        <input type="text" style="height: 100%;width: 200px"  class="form-control" value="<?= $registro['siape'] ?>"
                                               disabled="true" name="setSiape"required="true" />
                                    </td>

                                    <td >
                                        <div > 
                                            <label for="Nome"> Nome </label>        
                                        </div>

                                        <input type="text" class="form-control" value="<?= $registro['beneficiado'] ?>"
                                               disabled="true"name="setSolicitante" 
                                               style="height: 100%;width: 400px"required="true"/>
                                    </td>                        
                                    <td >
                                        <div > 
                                            <label for="CPF"> CPF </label>        
                                        </div>

                                        <input type="text"  style="height: 100%;width: 200px" name="setCpf" value="<?= $registro['cpf'] ?>"
                                               disabled="true"class="form-control" id="cpf" class="cpf"required="true"/>
                                    </td>
                                    <td>
                                        <div > 
                                            <label for="dtnasc">Data de Nascimento</label>        
                                        </div>

                                        <input type="text"  id="calendario2" class="form-control"disabled="true"
                                               name="setDtNasc"  style="height: 100%; width: 200px" value="<?= formatoData($registro['dtNasc']) ?>"/>      
                                    </td>
                                </tr>
                                <tr>
                                    <td >    
                                        <div  > 
                                            <label for="Celular"> Celular </label>        
                                        </div>

                                        <input type="text"  name="setCelular" disabled="true"
                                               class="form-control" value="<?= $registro['celular'] ?>"
                                               class="fone"   id="celular" style="height: 100%;width: 200px"required="true"/>
                                    </td>

                                    <td>
                                        <div  > 
                                            <label for="OrgaoESetorOrig">  Órgão ou Setor de Origem </label>        
                                        </div>

                                        <input type="text"    class="form-control" 
                                               value="<?= $registro['setor'] ?>" disabled="true"
                                               name="setSetor"id="setor" style="height: 100%;width: 200px"required="true"/>
                                    </td>

                                    <td>
                                        <div > 
                                            <label for="Email">  E-mail </label>        
                                        </div>

                                        <input type="text"  class="form-control"   
                                               value="<?= $registro['email'] ?>" disabled="true"
                                               name="setEmail"  id="email" style="height: 100%;width: 330px"required="true"/>
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
                                        <div> 
                                            <label for="Banco"> Banco </label>        
                                        </div>

                                        <input type="text"  class="form-control " disabled="true"
                                               name="setBanco" value="<?= $registro['banco'] ?>"
                                               id="banco" style="height: 100%;width: 200px"required="true">
                                    </td>

                                    <td>
                                        <div> 
                                            <label for="Agencia"> Agência </label>        
                                        </div>

                                        <input type="text"   class="form-control " disabled="true"
                                               name="setAgencia" value="<?= $registro['agencia'] ?>"
                                               id="ag" style="height: 100%;width: 200px"required="true">
                                    </td>

                                    <td>
                                        <div> 
                                            <label for=" C/C">  C/C </label>        
                                        </div>

                                        <input type="text"  class="form-control"  disabled="true"
                                               name="setConta"  value="<?= $registro['conta'] ?>"
                                               id="cc" style="height: 100%;width: 200px"required="true" >
                                    </td>
                                </tr>
                            </table>


                            <legend id="legendDadosViagem" class="panel panel-success" 
                                    style="background-color:#C1FFC1">Dados da Viagem</legend> 
                            <table id="tableDadosViagem" class="table" >
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
                                            <input type="radio" name="setTipoDiaria" disabled="true"
                                                   value="Diária" class=" form-group pull-right" checked="true"> 
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="Diaria"> Diária </label>        
                                            </div> 
                                        </td> 
                                    <?php } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setTipoDiaria"disabled="true"
                                                   value="Diária" class=" form-group pull-right" > 
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
                                                   class=" form-group pull-right"disabled="true"> 
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="DiariaPass"> Diária e Passagem</label>        
                                            </div> 
                                        </td>  
                                    <?php } else {
                                        ?>
                                        <td >
                                            <input type="radio" name="setTipoDiaria" disabled="true"
                                                   value="Diária e Passagem" class=" form-group pull-right"> 
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
                                           name="setDtEmbarqueIDA"  style="height: 100%; width: 200px" disabled="true"/>      
                                </td>

                                <td>
                                    <div > 
                                        <label for="dtembarq">Data de Viagem/ Embarque VOLTA</label>        
                                    </div>

                                    <input type="text"  id="calendario4" value="<?= formatoData($registro['dtEmbarqueVOLTA']) ?>"
                                           name="setDtEmbarqueVOLTA"  style="height: 100%; width: 200px"disabled="true"/>      
                                </td>

                                <td>
                                    <div > 
                                        <label for="just">Justificativa para as datas de viagem/embarque</label>        
                                    </div>
                                    <textarea type="text"  maxlength="500"
                                              name="setJustificativaDiariaEmbarque" disabled="true"
                                              style="height: 500%; width: 500px"><?= $registro['justificativaDiariaEmbarque'] ?></textarea>   
                                </td>
                            </tr>
                        </table>

                            <table class="table">
                                <tr>
                                    <td colspan="8">
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
                                            <input type="radio" name="setTransporte" value="Oficial"disabled="true"
                                                   checked="checked" class="form-group pull-right">
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
                                            <input type="radio" name="setTransporte" disabled="true"
                                                   value="Oficial" class=" form-group pull-right">
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
                                            <input type="radio" name="setTransporte" value="Próprio" disabled="true"
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
                                            <input type="radio" name="setTransporte" disabled="true"
                                                   value="Próprio" class="form-group pull-right"> 
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
                                            <input type="radio" name="setTransporte" value="Rodoviário" disabled="true"
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
                                            <input type="radio" name="setTransporte" disabled="true"
                                                   value="Rodoviário" class=" form-group pull-right">
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
                                            <input type="radio" name="setTransporte" disabled="true"
                                                   value="Aereo" class="form-group pull-right">
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
                                            <input type="radio" name="setTransporte" disabled="true"
                                                   value="Aereo" class=" form-group pull-right">
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
                                            <input type="radio" name="setTransporteVolta" value="Oficial"disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Oficial" disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Próprio" disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Próprio"disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Rodoviário" disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Rodoviário"disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Aereo" disabled="true"
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
                                            <input type="radio" name="setTransporteVolta" value="Aereo"disabled="true" 
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

                                        <select name="cod_estados" id="cod_estados"required="true"disabled="true">

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

                                        <select name="cod_estados1" id="cod_estados1"required="true"disabled="true">
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

                                        <select name="cod_cidades" id="cod_cidades"required="true"disabled="true">
                                            <option value="<?= $registro['cidOrigem'] ?>"> <?= $registro['nomeCidOrigem'] ?> </option>
                                        </select>
                                    </td>  
                                    <td>
                                        <div >                                        
                                            <label for="cod_cidades1">Cidade</label>
                                        </div>

                                        <select name="cod_cidades1" id="cod_cidades1"required="true" disabled="true">
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
                                    <td colspan="12">
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
                                            <input disabled="true" type="radio" name="setMotivo"
                                                   value="Visita" class="form-group pull-right"  checked="checked">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Visita" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Convocação" class="form-group pull-right" checked="checked">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Convocação" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Treinamento" class="form-group pull-right" checked="checked">
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
                                            <input type="radio" name="setMotivo"disabled="true"
                                                   value="Treinamento" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" value="Encontro" disabled="true"
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Encontro" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Reunião" class="form-group pull-right" checked="checked">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Reunião" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Seminário" class="form-group pull-right" checked="checked" >
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Seminário" class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Seminário">   Seminário </label>        
                                            </div> 
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if ($registro['motivoViagem'] == "Congresso") {
                                    ?> 
                                    <tr>
                                        <td >
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Congresso" class="form-group pull-right" checked="checked">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Congresso" class="form-group pull-right">
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
                                            <input type="radio" name="setMotivo" disabled="true"
                                                   value="Outros" class="form-group pull-right" checked="checked">
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Outros">  Outros </label>        
                                            </div>                                     
                                            <input type="text" name="setMotivoOutros" disabled="true"
                                                   style="height: 30px" value="<?= $registro['motivoViagemOutro'] ?>">
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" name="setMotivo" value="Outros"disabled="true"
                                                   class="form-group pull-right">
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Outros">  Outros </label>        
                                            </div> 
                                            <input type="text" name="setMotivoOutros"disabled="true"
                                                   style="height: 30px" value="<?= $registro['motivoViagemOutro'] ?>">
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

                                        <input type="text"  id="calendario" class="form-control" disabled="true"
                                               value="<?= formatoData($registro["dtInicio"]) ?>"
                                               name="setDtInicio"  style="height: 100%;width: 250px" required="true"/>                            
                                    </td>

                                    <td> 
                                        <div >  
                                            <label for="DtFim">Data </label>
                                        </div>

                                        <input type="text"  id="calendario1" class="form-control" disabled="true"
                                               value="<?= formatoData($registro["dtFim"]) ?>"
                                               name="setDtFim"  style="height: 100%;width: 250px"required="true"/>                               
                                    </td>                           


                                </tr>
                                <tr>
                                    <td> 
                                        <div >  
                                            <label for="HrInicio">Hora </label>
                                        </div>

                                        <input type="text" id="HrInicio" class="form-control" 
                                               maxlength="5" placeholder="00:00" disabled="true"
                                               value="<?= formatoData($registro["hrInicio"]) ?>"
                                               name="setHrInicio"  style="height: 100%;width: 250px"required="true" />                                    
                                    </td>  

                                    <td> 
                                        <div>  
                                            <label for="HrFim">Hora </label>
                                        </div>

                                        <input type="text" id="HrFim" class="form-control"
                                               maxlength="5" placeholder="00:00" disabled="true"
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
                                                  id="setDesc" style="width: 500px; height: 70px"disabled="true"  >
                                            <?= $registro['descMotivoViagem'] ?></textarea>
                                    </td>
                                    <td>
                                        <input type="text"  class="form-control" name="setLocalEvento"required="true"
                                               id="banco" style="height: 100%; width: 500px"  
                                               value="<?= $registro['localEvento'] ?>"disabled="true">
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="6" >
                                        <div > 
                                            <label for="Just" style="background-color:#d6e9c6">
                                                Justificativa para o caso da solicitação ter sido feita com
                                                MENOS de 05 DIAS da data do evento</label>        
                                        </div>

                                        <input name="setJustificativa" type="text" maxlength="200"disabled="true"
                                               id="just" style="width: 1000px; height: 30px"value="<?= $registro['justificativa'] ?>"/>
                                    </td>
                                </tr>
                            </table>

                            <div class="btn-lg">
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                        Voltar
                                    </button>                                              
                                </div> 
                            </div>

                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

    </body>
</html>
