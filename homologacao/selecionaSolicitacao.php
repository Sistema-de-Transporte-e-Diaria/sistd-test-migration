<?php include ('validar_session.php'); 
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
                    <h3 class="panel-title" >Solicitação Específica</h3>
                </div>
                <div class="panel-body "> 
                    <form method="post" action="pdfSolicitacaoFinalizada.php" name="relSolicitacaoListar">
                        <table id="tableDadosEvento" class="table" >
                            <tr>
                                <td colspan="6">                                    
                                    <div> 
                                        <label for="sel"style="background-color:#d6e9c6 "> Selecionar Solicitação</label>        
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div >
                                        <label for=" ID/SOLICITANTE/DESTINO/VEÍCULO/MOTORISTA">
                                            ID/SOLICITANTE/DESTINO/VEÍCULO/MOTORISTA
                                        </label>
                                    </div>                                       
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="setEscolhaSolicitacao" id="solictacao"style="width: 1000px">
                                        <?php
                                        conecta();
                                        $pesquisa = "SELECT * FROM listarsolicitacaocontrole
                                            ORDER BY codSolicitacao;";
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['codSolicitacao'] ?>"><?= $registro['codSolicitacao'] ?> - <?= $registro['nome'] ?> - <?= $registro['destino'] ?> - <?= $registro['modelo'] ?> -  <?= $registro['motorista'] ?></option>
                                        <?php } ?> 
                                    </select>
                                </td>
                            </tr>
                            <tr>        
                                <td>
                                    <button type="submit" class="btn btn-primary">
                                        Consultar
                                    </button>                
                                </td>                   
                            </tr>
                        </table>
                    </form>

                    <form  method="post" action="pdfSolicitacaoFinalizada.php" name="relSolicitacaoCodigo">
                        <table class="table">
                            <tr>
                                <td colspan="6" >                                    
                                    <div> 
                                        <label for="sel"style="background-color:#d6e9c6 "> Digite o Código da Solicitação</label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div>
                                        <label for="SolicitaçãoN">Solicitação Nº</label>
                                    </div>                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="setCodSolicitacao"  style="height: 30px"/>
                                </td>
                            </tr>   
                        
                           <tr>        
                                <td>
                                    <button type="submit" class="btn btn-primary">
                                        Consultar
                                    </button>                
                                </td>                   
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>




