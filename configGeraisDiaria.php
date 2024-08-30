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
    <?php include "menuDiarias.php"; ?>
    <body  style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Configurações Gerais</h3>
                </div>
                <div class="panel-body "> 

                    <form method="post" action="cadConfigGeraisDiaria.php" name="config">

                        <?php
                        conecta();
                        $pesquisa1 = "SELECT * FROM manutencao";
                        $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro1 = mysql_fetch_array($resultado1)) {
                            ?> 
                        <table class="table" hidden="true">
                                <tr>
                                    <td colspan="9">
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 "> Configuração Ldap</label>        
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group pull-right">
                                            <label for="Host">Host</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input style="height: 30px" type="text" name="setLdapHost" 
                                               value="<?= $registro1['ldapHost'] ?>"required="true"/>
                                    </td>                              
                                    <td>
                                        <div class="form-group pull-right">
                                            <label for=" Porta">Porta</label>
                                        </div>                                       
                                    </td>
                                    <td>
                                        <input  style="height: 30px" type="text" name="setLdapPort"
                                                value="<?= $registro1['ldapPort'] ?>"required="true"/>
                                    </td>                                
                                    <td>
                                        <div class="form-group pull-right">
                                            <label for="BaseDN">Base DN</label>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <input  style="height: 30px;width: 350px" type="text" name="setLdapBaseDN"
                                                value="<?= $registro1['ldapBaseDN'] ?>"required="true"/>
                                    </td>                                
                                    <td>
                                        <div class="form-group pull-right" >
                                            <label for="Campo">Campo</label>
                                        </div>                                        
                                    </td>
                                    <td>
                                        <input  style="height: 30px" type="text" name="setLdapCampo" 
                                                value="<?= $registro1['ldapCampo'] ?>"required="true"/>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>


                        <?php
                        conecta();
                        $pesquisa2 = "SELECT * FROM manutencao";
                        $resultado2 = mysql_query($pesquisa2) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro2 = mysql_fetch_array($resultado2)) {
                            ?> 
                        <table class="table" hidden="true">
                                <tr>
                                    <td colspan="9">
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 "> Atualizações</label>        
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group pull-right">
                                            <label for="VersaoSistema">Versão sistema</label>
                                        </div>                                            
                                    </td>
                                    <td>
                                        <input  style="height: 30px" type="text" name="setVersaoSis"
                                                value="<?= $registro2['versaoSistema'] ?>"required="true"/>
                                    </td>

                                    <td>
                                        <div class="form-group pull-right">
                                            <label for="UpdateSistema">Update sistema</label>
                                        </div>                                          
                                    </td>
                                    <td>
                                        <input type="text" id="calendario"  value="<?= formatoData($registro2["dtUpdateSistema"]) ?>"
                                               name="setUpdateSis" style="height: 100%" required="true"/>      
                                    </td>

                                    <td>
                                        <div class="form-group pull-right">
                                            <label for="VersaoBD">Versão BD</label>
                                        </div>                                        
                                    </td>
                                    <td><input  style="height: 30px" type="text" name="setVersaoBD" 
                                                value="<?= $registro2['versaoBD'] ?>"/>
                                    </td>

                                    <td>
                                        <div class="form-group pull-right">
                                            <label for=" UpdateBD">Update BD</label>
                                        </div>                                       
                                    </td>
                                    <td>
                                        <input type="text"  id="calendario1"  value="<?= formatoData($registro2["dtUpdateBD"]) ?>"
                                               name="setUpdateBD" style="height: 100%" required="true"/>
                                    </td>
                                </tr>
                        </table>
                        <table class="table">
                            <?php } ?>

                            <?php
                            conecta();
                            $pesquisa = "SELECT * FROM manutencao";
                            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro = mysql_fetch_array($resultado)) {
                                ?> 

                                <tr>
                                    <td colspan="8">
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 "> Diárias</label>        
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <div>
                                            <label for="AdministradorDiariasSIAPE">Administrador das Diárias - SIAPE</label>
                                        </div>                                            
                                    
                                        <input  style="height: 30px" type="text" name="setAdminDiaria" required="true"
                                                value="<?= $registro['adminDiaria'] ?>" class="form-group pull-left"/>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>

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
                                    Alterar
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
