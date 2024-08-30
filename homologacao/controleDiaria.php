<?php
include ('validar_session_diaria.php');
include ('jquery.php');
?>
<html> 
    <head> 
        <title>Fechamento de diária</title>
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
                    <h3 class="panel-title">Finalizar Diária</h3>
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

                        <form method="post" name="diaria" action="prestarContas.php" >
                            <table class="table"> 
                                <tr hidden="true">
                                    <td class=" pull-right">
                                        <input style="color: brown;height: 20px" type="text" name="setCodDiaria"
                                               size="3" readonly="true" value="<?= $registro["codDiaria"] ?>" >
                                    </td>
                                    <td class=" pull-right"> 
                                        <div class=" pull-right">
                                            <label for="nDiaria">Diária Nº</label>
                                        </div> 
                                    </td>
                                </tr>
                            </table>
                            <?php if ($registro['statusDiaria'] == 2 || $registro['statusDiaria'] == 3) { ?>
                                <legend id="legendDadosPessoais" class="panel panel-success" 
                                        style="background-color: #C1FFC1">ESCREVA NO CAMPO ABAIXO A DESCRIÇÃO SUCINTA DA VIAGEM PARA A PRESTAÇÃO DE CONTAS</legend> 
                                <table class="table">
                                    <tr>                                                        
                                        <td >                                
                                            <textarea name="setDesc" type="text" maxlength="1000" readonly="true"
                                                      id="setDesc" style="width: 1000px; height: 100px" ><?= $registro['descPrestarConta'] ?></textarea>
                                        </td>
                                    </tr>
                                </table>

                                <table>
                                    <tr>
                                        <td >
                                            <div class="btn-lg">  
                                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                                    Voltar
                                                </button>                                             
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                                <?php } if ($registro['statusDiaria'] == 1) {
                                ?>
                                <legend id="legendDadosPessoais" class="panel panel-success" 
                                        style="background-color: #C1FFC1">ESCREVA NO CAMPO ABAIXO A DESCRIÇÃO SUCINTA DA VIAGEM PARA A PRESTAÇÃO DE CONTAS</legend> 
                                <table class="table">
                                    <tr>                                                        
                                        <td >                                
                                            <textarea name="setDesc" type="text" maxlength="1000" required="true"
                                                      id="setDesc" style="width: 1000px; height: 100px" ></textarea>
                                        </td>
                                    </tr>
                                </table>

                                <table>
                                    <tr>
                                        <td >
                                            <div class="btn-lg">                                                                                    
                                                <button class="btn btn-primary btn-xs">
                                                    Finalizar/Imprimir
                                                </button> 
                                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                                    Voltar
                                                </button>                                             
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                                <?php
                            }
                            ?>



                            <legend id="legendDadosPessoais" class="panel panel-success" 
                                    style="background-color: #C1FFC1 ">Dados Insititucionais</legend> 
                            <table id="tableDadosPessoais" class="table" >                           
                                <tr>                             
                                    <?php
                                    if ($registro['tipoSolicitante'] == "Servidor Campus Garanhuns") {
                                        ?>                                        
                                        <td> 
                                            <input type="radio"  id="tipoSolicitante" disabled="true"
                                                   onClick="return Verifica(this.form, this.name, event)" checked="checked"
                                                   name="setTipoSolicitante" value="Servidor Campus Garanhuns"/>   
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="ServCampGus">Servidor - Campus Garanhuns</label>
                                            </div>                                    
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td> 
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Servidor Campus Garanhuns"/>   
                                        </td>
                                        <td>
                                            <div> 
                                                <label for="ServCampGus">Servidor - Campus Garanhuns</label>
                                            </div>                                    
                                        </td>
                                        Servidor - Campus Garanhuns
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Servidor - Outros Campi") {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Servidor - Outros Campi" checked="checked"/>  
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="ServOutroCamp">Servidor - Outros Campi</label>
                                            </div>                                                                                                                 
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Servidor - Outros Campi"/>  
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="ServOutroCamp">Servidor - Outros Campi</label>
                                            </div>                                                                                                                 
                                        </td>     
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Colaborador") {
                                        ?>

                                        <td>
                                            <input type="radio" id="tipoSolicitante"  
                                                   onClick="return Verifica(this.form, this.name, event)"disabled="true"
                                                   name="setTipoSolicitante" value="Colaborador"checked="checked"/>   
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
                                                   name="setTipoSolicitante" value="Colaborador"/>   
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Colaborador">Colaborador Eventual</label>
                                            </div> 
                                        </td> 
                                        <?php
                                    }
                                    if ($registro['tipoSolicitante'] == "Convidado") {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante"  
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Convidado"checked="checked"/> 
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Convidado">Convidado </label>
                                            </div>                         
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td>
                                            <input type="radio" id="tipoSolicitante" 
                                                   onClick="return Verifica(this.form, this.name, event)" disabled="true"
                                                   name="setTipoSolicitante" value="Convidado"/> 
                                        </td>
                                        <td>
                                            <div > 
                                                <label for="Convidado">Convidado </label>
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
                                            <input type="text" name="setTipoSolicitanteOutros" size="30px" style="height: 100%" 
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
                                            <input type="text" name="setTipoSolicitanteOutros" size="30px" style="height: 100%" 
                                                   disabled="true"  value="<?= $registro['tipoSolicitanteOutro'] ?>"/>                            
                                        </td>
                                    <?php } ?>  
                                </tr>
                            </table>

                            <table class="table">
                                <tr >
                                    <td colspan="7">                                    
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
                                                   class="form-group pull-right"
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
                                                   class="form-group pull-right"
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
                                                   class="form-group pull-right"
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
                                                   class="form-group pull-right"
                                                   name="setFuncao" value="Aluno"/>  
                                        </td>
                                        <td>
                                            <div>                                
                                                <label for="Aluno"> Aluno </label>        
                                            </div>
                                        </td>
                                    <?php }
                                    ?>
                                </tr>

                                <tr>
                                    <td colspan="7">                                    
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
                                                   class="form-group pull-right" disabled="true"
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
                                                   class="form-group pull-right" disabled="true"
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
                                </tr>
                                <tr>
                                    <td >    
                                        <div > 
                                            <label for="Celular"> Celular </label>        
                                        </div>

                                        <input type="text"  name="setCelular" disabled="true"
                                               class="form-control" value="<?= $registro['celular'] ?>"
                                               class="fone"   id="celular" style="height: 100%;width: 200px"required="true"/>
                                    </td>

                                    <td>
                                        <div> 
                                            <label for="OrgaoESetorOrig">  Órgão e Setor de Origem </label>        
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
                                        <div > 
                                            <label for="Agencia"> Agência </label>        
                                        </div>

                                        <input type="text"   class="form-control " disabled="true"
                                               name="setAgencia" value="<?= $registro['agencia'] ?>"
                                               id="ag" style="height: 100%;width: 200px"required="true">
                                    </td>

                                    <td>
                                        <div > 
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
                                <tr>
                                    <td>
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 "> Origem</label>        
                                        </div> 
                                    </td>
                                    <td >
                                        <div > 
                                            <label for="Destino" style="background-color:#d6e9c6 ">Destino</label>        
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

                                        <select name="cod_estados1" id="cod_estados1"disabled="true">
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

                                        <select name="cod_cidades" id="cod_cidades"disabled="true">
                                            <option value="<?= $registro['cidOrigem'] ?>"> <?= $registro['nomeCidOrigem'] ?> </option>
                                        </select>
                                    </td>  
                                    <td>
                                        <div >                                        
                                            <label for="cod_cidades1">Cidade</label>
                                        </div>

                                        <select name="cod_cidades1" id="cod_cidades1"disabled="true">
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
                                               name="setDtInicio"  style="height: 100%;width: 250px"disabled="true"/>                            
                                    </td>

                                    <td> 
                                        <div >  
                                            <label for="DtFim">Data </label>
                                        </div>

                                        <input type="text"  id="calendario1" class="form-control" value="<?= formatoData($registro["dtFim"]) ?>"
                                               name="setDtFim"  style="height: 100%;width: 250px"disabled="true"/>                               
                                    </td>  

                                </tr>
                            </table>


                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

    </body>
</html>

