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
    <?php include "menu.php"; ?>
    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Relátorio de Solicitações por Motorista</h3>
                </div>
                <div class="panel-body "> 
                    <form  method="post" action="relatorios/relSolicitacoesMot.php"target="_blank">  

                        <legend id="legendDadosPessoais" class="panel panel-success" 
                                style="background-color: #C1FFC1 "> Relatório com Filtro de Motorista</legend> 
                                
                        <table class="table"> 
                            <tr>
                                <td>
                                    <div>
                                        <label for="SelecioneMotorista"style="background-color: #d6e9c6">
                                            Selecione o Motorista
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="setEscolhaMotorista"  style="width: 500px">
                                        <option> </option>
                                        <?php
                                        conecta();
                                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                        $pesquisa1 = "SELECT * FROM motoristas
                                          WHERE statusMotorista = '1'
                                       ORDER BY motorista;";
                                        $resultado1 = mysql_query($pesquisa1) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro1 = mysql_fetch_array($resultado1)) {
                                            ?>       
                                            <option><?= $registro1['motorista'] ?></option>
                                            <?php
                                        }
                                        ?> 
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div>
                                        <label for="PorDataSaida"style="background-color: #d6e9c6">
                                            Por Data de Saida
                                        </label>
                                    </div>
                                </td>
                            </tr>                            
                            <tr>
                                <?php
                                $hoje = date("d/m/Y");
                                $atrazo = "01/01/2013";
                                ?>
                                <td> 
                                    <input type="text" id="calendario1" class="form-control" value="<?= $atrazo ?>"
                                           name="setDtInicio" style="height: 100%;width: 150px" />

                                    <input type="text" id="calendario" class="form-control" value="<?= $hoje ?>"
                                           name="setDtFinal"  style="height: 100%;width: 150px" /> 
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td colspan="10">
                                    <div>
                                        <label for="Sit"style="background-color: #d6e9c6">Situação</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>                               
                                <td>
                                    <input name="status2" type="checkbox" value="2" checked="true" class=" form-group pull-right"/>
                                </td>
                                <td>
                                    <div>
                                        <label for="Autorizadas">Autorizadas</label>
                                    </div>                                
                                </td>
                                <td>
                                    <input name="status3" type="checkbox" value="3" checked="true" class=" form-group pull-right"/>
                                </td>
                                <td>
                                    <div>
                                        <label for=" Finalizadas"> Finalizadas</label>
                                    </div>                               
                                </td>                                
                            </tr>
                        </table>
                        <div class="btn-lg">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                    Voltar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Emitir
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




