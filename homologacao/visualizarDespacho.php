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
        $codDespEditar = $_GET['id'];
        conecta();
        // Seleciona o registro do motorista a ser aditado
        $pesquisa = "SELECT * FROM listardespachos
                         WHERE idDespacho='$codDespEditar'";
        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
        While ($registro = mysql_fetch_array($resultado)) {
            ?>
            <div  class="container-fluid">    
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title" >Editar Despacho</h3>
                    </div>
                    <div class="panel-body "> 
                        <form method="post" action="editandoDespacho.php" name="desp" id="swap">
                            <table class="table">
                                <tr >
                                    <td>
                                        <div >
                                            <label for="Codigo"> Código</label>
                                        </div>

                                        <input type="text" name="setCod" style="color: brown;width: 50px"
                                               readonly="true" value="<?= $registro['idDespacho'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div >
                                            <label for="solicit">Solicitação</label>
                                        </div>

                                        <select name="setSolicit" id="solicit"required="true" style="width: 500px"  readonly="true" >
                                            <option value="<?= $registro['idSolicitacao_FK'] ?>"><?= $registro['codSolicitacao'] . '-' . $registro['nome'] ?></option>
                                          
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div >
                                            <label for="just">Justificativa</label>
                                        </div>

                                        <textarea name="setJust" type="text" maxlength="500"disabled="true"
                                                  id="setJust" style="width: 500px; height: 70px"  >
                                            <?= $registro['descricaoDespacho'] ?></textarea>
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
