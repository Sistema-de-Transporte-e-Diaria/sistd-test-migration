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
                    <h3 class="panel-title" >Cadastro de Motoristas</h3>
                </div>
                <div class="panel-body ">     
                    <form  method="post" action="cadMotorista.php" name="solicita">
                        <table class="table">                          
                            <tr >
                                <td >
                                    <div>
                                        <label for="nome">
                                            Nome
                                        </label>
                                    </div>
                               
                                    <input type="text" name="setNomeMotorista" id="nomeMotorista"
                                           required="true"style="height: 100%;width: 400px">
                                </td>

                                <td>
                                    <div >
                                        <label for="cnh">
                                            Categoria CNH
                                        </label>
                                    </div>
                               
                                    <select type="text" name="setCNHcategoria" required="true" 
                                            style="height: 25px">
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                                        <option>AB</option>
                                        <option>AC</option>
                                        <option>AD</option>
                                        <option>AE</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div >
                                        <label for="nCNH"> CNH Número</label>
                                    </div>

                              
                                    <input type="text" name="setCNHnumero" required="true" maxlength="11"
                                           id="nCNH" style="height: 30px">
                                </td>

                                <td>
                                    <div>
                                        <label for="validade">
                                            Validade
                                        </label>
                                    </div>
                              
                                    <input type="text" id="calendario" 
                                           name="setCNHvalidade"  style="height: 100%" required="true"/>                            
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
                                    Cadastrar
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
    </body>
</html>
