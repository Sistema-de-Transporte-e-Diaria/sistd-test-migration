<?php
include ('validar_session.php');

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
    <?php include "menu.php"; ?>
    <body  style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Configurações Gerais</h3>
                </div>
                <div class="panel-body "> 

                    <form method="post" action="cadConfigGerais.php" name="config">

                        <?php
                        conecta();
                        $pesquisa = "SELECT * FROM manutencao";
                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?> 
                            <table class="table">
                                <tr>
                                    <td>
                                        <div > 
                                            <label for="Origem3" style="background-color:#d6e9c6;width: 100% ">Dados do Campus</label>        
                                        </div> 
                                    </td>
                                    
                                    <td >
                                        <div > 
                                            <label for="Origem1" style="background-color:#d6e9c6 "> Configuração da Base</label>        
                                        </div> 
                                    </td>
                                     
                                    <td>
                                        <div > 
                                            <label for="Origem2" style="background-color:#d6e9c6 "> Atualizações</label>        
                                        </div> 
                                    </td>
                                    <td>
                                        <div > 
                                            <label for="Origem3" style="background-color:#d6e9c6 "> Intervalo mínimo de horas para veículos</label>        
                                        </div> 
                                    </td>
                                </tr>
                               
                                <tr>
                                     <td>
                                        <div>
                                            <label>Campus</label>
                                        </div>
                                        <input style="height:30px; width: 300px" 
                                                type="text" name="setNomeCampus" value="<?= $registro['nomeCampus'] ?>" required="true" />
                                        
                                        <div>
                                            <label>Endereço</label>
                                        </div>
                                        <input style="height:30px; width: 300px" 
                                                type="text" name="setEndCampus" value="<?= $registro['enderecoCampus'] ?>" required="true" />
                                        
                                        <div>
                                            <label>Telefone</label>
                                        </div>
                                        <input style="height:30px; width: 300px" placeholder="(00) 0000-0000" maxlength="14"
                                                type="text" name="setTelCampus" value="<?= $registro['telCampus'] ?>" required="true" />
                                        
                                        <div>
                                            <label>Nome do Setor Responsável pelo Transporte</label>
                                        </div>
                                        <input style="height:30px; width: 300px" 
                                                type="text" name="setNomeSetorCampus" value="<?= $registro['nomeSetorCampus'] ?>" required="true" />
                                        
                                         <div>
                                            <label>Sigla do Setor Responsável pelo Transporte</label>
                                        </div>
                                        <input style="height:30px; width: 300px" 
                                                type="text" name="setSiglaSetorCampus" value="<?= $registro['siglaSetorCampus'] ?>" required="true" />
                                    </td>
                                    <td>
                                        <?php if ($registro['statusBase'] == '1') { ?>
                                            <label>LDAP</label><input type="radio" name="base" value="1" checked="true"/> 
                                        <?php } else { ?>
                                            <label>LDAP</label><input type="radio" name="base" value="1"/> 
                                        <?php } ?>
                                        <?php if ($registro['statusBase'] == '2') { ?>
                                            <label>MS-AD</label><input type="radio" name="base" value="2" checked="true"/> 
                                        <?php } else { ?>
                                            <label>MS-AD</label><input type="radio" name="base" value="2"/> 
                                        <?php } ?>
                                        
                                        <div >
                                            <label for="Host">Host</label>
                                        </div>
                                    
                                        <input style="height: 30px; width: 300px" type="text" name="setLdapHost" 
                                               value="<?= $registro['ldapHost'] ?>"required="true"/>
                                   
                                        <div >
                                            <label for=" Porta">Porta</label>
                                        </div>                                       
                                   
                                        <input  style="height: 30px; width: 300px" type="text" name="setLdapPort"
                                                value="<?= $registro['ldapPort'] ?>"required="true"/>
                                   
                                        <div >
                                            <label for="BaseDN">Base DN</label>
                                        </div>                                        
                                   
                                        <input  style="height: 30px;width: 350px" type="text" name="setLdapBaseDN"
                                                value="<?= $registro['ldapBaseDN'] ?>"required="true"/>
                                    
                                        <div  >
                                            <label for="Campo">Campo</label>
                                        </div>                                        
                                   
                                        <input  style="height: 30px; width: 300px" type="text" name="setLdapCampo" 
                                                value="<?= $registro['ldapCampo'] ?>"required="true"/>
                                         <div >
                                            <label>Usuário ADM-DN</label>
                                        </div>

                                        <input  style="height: 30px; width: 300px" 
                                                type="text" name="setUser" value="<?= $registro['ldapuser'] ?>"required="true">
                                  
                                        <div >
                                            <label>Senha ADM-DN</label>
                                        </div>

                                        <input  style="height: 30px; width: 300px" 
                                                type="password" name="setPass" value="<?= $registro['ldappass'] ?>"required="true" >
                                    
                                        
                                    </td>
                           
                                    <td>
                                        <div >
                                            <label for="VersaoSistema">Versão sistema</label>
                                        </div>                                            
                                   
                                        <input  style="height: 30px" type="text" name="setVersaoSis"
                                                value="<?= $registro['versaoSistema'] ?>"required="true"/>
                                    
                                        <div >
                                            <label for="UpdateSistema">Update sistema</label>
                                        </div>                                          
                                    
                                        <input type="text"  id="calendario"  value="<?= formatoData($registro["dtUpdateSistema"]) ?>"
                                               name="setUpdateSis" style="height: 100%" required="true"/>      
                                    
                                        <div >
                                            <label for="VersaoBD">Versão BD</label>
                                        </div>                                        
                                    
                                        <input  style="height: 30px" type="text" name="setVersaoBD" 
                                                value="<?= $registro['versaoBD'] ?>"/>
                                   
                                        <div >
                                            <label for="UpdateBD">Update BD</label>
                                        </div>                                       
                                    
                                        <input type="text"  id="calendario1"  value="<?= formatoData($registro["dtUpdateBD"]) ?>"
                                               name="setUpdateBD" style="height: 100%" required="true"/>
                                        
                                       
                                            
                                    </td>
                                    <td>
                                         <div >
                                            <label for="veiculoPeq">Veículo de até 4 passageiros</label>
                                        </div>                                       
                                    
                                        <input type="text"  id="veiculopeq"  value="<?= formatoData($registro["veiculoPassageiro"]) ?>"
                                               name="setVeiculoPasBD" style="height: 100%" required="true"/>
                                         <div >
                                            <label for="VeiculoGrande">Veículo Coletivo/Outros</label>
                                        </div>                                       
                                    
                                        <input type="text"  id="veiculogrande"  value="<?=formatoData($registro["veiculoColetivo"]) ?>"
                                               name="setVeiculoGrandeBD" style="height: 100%" required="true"/>
                                    </td>
                                </tr>

                            <?php } ?>

                            <?php
                            conecta();
                            $pesquisa1 = "SELECT * FROM manutencao";
                            $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro1 = mysql_fetch_array($resultado1)) {
                                ?> 

                                <tr hidden="true">
                                    <td colspan="9">
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 "> Diárias</label>        
                                        </div> 
                                    </td>
                                </tr>
                                <tr hidden="true">
                                    <td colspan="2">
                                        <div>
                                            <label for="AdministradorDiariasSIAPE">Administrador das Diárias - SIAPE</label>
                                        </div>                                            
                                    </td>
                                    <td>
                                        <input  style="height: 30px" type="text" name="setAdminDiaria" required="true"
                                                value="<?= $registro1['adminDiaria'] ?>" class="form-group pull-left"/>
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
