<?php
include ('validar_session_diaria.php');
$_SESSION['nivel'];
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
    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Reimprimir Prestação de Contas</h3>
                </div>
                <div class="panel-body ">
                    <form  method="post" action="pdfPrestarContasReimprime.php" name="relSolicitacaoListar">
                        <table class="table">
                            <tr>
                                <td>
                                    <div>
                                        <label for="SelecionarDiaria"style="background-color: #d6e9c6">
                                            Selecionar Diária
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="setEscolhaDiaria" class="input-xxlarge">
                                        <?php
                                        conecta();
                                        $usuario = $_SESSION['login_usuario'];
                                        $pesquisa1 = "SELECT nome FROM solicitantes
                                            WHERE siape = $usuario";                                       
                                        $resultado1 = mysql_query($pesquisa1) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro1 = mysql_fetch_array($resultado1)) {
                                            $nomeSol = $registro1["nome"];
                                        }
                                        
                                        $pesquisa = "SELECT * FROM listardiarias
                                            WHERE statusDiaria = 2 AND solicitante = '$nomeSol'
                                            ORDER BY codDiaria;";
                                        gravaLog("Listou reimprimir prestação de contas");
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['codDiaria'] ?>"><?= $registro['codDiaria'];?> - <?= $registro['motivoViagem'] ?> - <?= $registro['localEvento'] ?> -  <?= formatoData($registro['dtInicio']) ?> - <?= formatoData($registro['dtFim']) ?> - <?= $registro['nome'] ?></option>
                                        
                                        <?php  }?> 
                                    </select>
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
    </body>
</html>




