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
        <?php
        $codHEEditar = $_GET['id'];
        conecta();
        // Seleciona o registro do motorista a ser aditado
        $pesquisa = "SELECT * FROM listarhoraextramot
                         WHERE idHoraExtra='$codHEEditar'";
        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
        While ($registro = mysql_fetch_array($resultado)) {
            ?>
            <div  class="container-fluid">    
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Editar Hora Extra</h3>
                    </div>
                    <div class="panel-body "> 
                        <form method="post" action="editandoHoraExtraMot.php" name=he" id="formHE">
                            <table class="table">
                                <tr >
                                    <td>
                                        <div >
                                            <label for="Codigo"> Código</label>
                                        </div>

                                        <input type="text" name="setCodHE" style="color: brown;width: 50px"
                                               readonly="true" value="<?= $registro['idHoraExtra'] ?>"/>
                                    </td>
                                </tr>
                              
                                 <tr>
                                <td>
                                    <div >
                                        <label for="Motorista">Motorista</label>
                                    </div>                
                               
                                    <select name="setEscolhaMotorista" style="height: 30px;width: 500px"readonly="true" >
                                        <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                        
                                    </select>
                                </td>
                                <td >
                                    <div >
                                        <label for="Horas">Quantidade de Horas Extra</label>
                                    </div>

                                    <input 
                                       value="<?= $registro['quantHoraExtra'] ?>"
                                        type="text" name="setHoraExtra" style="height: 30px;width: 100px" placeholder="00:00"
                                          readonly="true" maxlength="8"/>
                                </td>
                                <td>
                                    <div >
                                        <label for="mes">Mês/Ano</label>
                                    </div>                     
                                    
                                    <input 
                                     value="<?= $registro["mesHoraExtra"] ?>"
                                        type="text" name="mes" style="height: 30px;width: 300px" 
                                        required="true" class="text-uppercase" />
                                                   
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
    </body>

</html>
