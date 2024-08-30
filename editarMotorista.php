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

    <?php
    include "menu.php";
    $codMotoristaEditar = $_GET['id'];
    conecta();
    // Seleciona o registro do motorista a ser aditado
    $pesquisa = "SELECT * FROM motoristas
                         WHERE codMotorista='$codMotoristaEditar'";
    $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
    While ($registro = mysql_fetch_array($resultado)) {
        ?> 


        <body style="font-family: courier">
            <div  class="container-fluid">    
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Editar de Motorista</h3>
                    </div>
                    <div class="panel-body "> 
                        <form  method="post" action="editandoMotorista.php" name="editaMotorista">

                            <table class="table">
                                <tr>
                                    <td > 
                                        <div >
                                            <label for="Codigo">Código</label>
                                        </div> 
                                   
                                        <input style="color: brown;height: 20px; width: 50px" type="text" name="setCodMotorista"
                                               size="3" readonly="true" value="<?= $codMotoristaEditar ?>">
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div >
                                            <label for="Nome">Nome</label>
                                        </div>                                        
                                 
                                        <input type="text" name="setNomeMotorista" style="height: 30px;width: 500px"
                                               required="true" value="<?= $registro["motorista"] ?>">
                                    </td>
                                    <td>
                                        <div >
                                            <label for="CategoriaCNH">Categoria CNH</label>
                                        </div>
                                  
                                        <select type="text" name="setCNHcategoria" required="true" 
                                                style="height: 30px;width: 100px">
                                            <option><?= $registro["cnhCategoria"] ?></option>
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
                                            <label for="CNHNumero">CNH Número</label>
                                        </div>                                        
                                 
                                        <input type="text" name="setCNHnumero" style="height: 30px" maxlength="11"
                                               required="true" value="<?= $registro["cnhNumero"] ?>"/>
                                    </td>
                                    <td>
                                        <div >
                                            <label for="Validade">Validade</label>
                                        </div>                                        
                                  
                                        <input type="text" id="calendario" style="height: 30px"
                                               value="<?= formatoData($registro["cnhValidade"]) ?>"
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
                                        Editar
                                    </button>                
                                </div> 
                            </div>
                        </form>
                    <?php } ?>   
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
</div>
</html>
