<?php include ('validar_session.php');
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
    <?php
    // Captura o usuário logado para saber se é administrador

    include "menu.php";
    ?>        

    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Informações da Viagem</h3>
                </div>

                <!-- Funções para direcionar os botões do formulário para as páginas atualizaControle.php e controlando.php -->           
                <?php
                // Recebe o código da página listarSolicitacao.php
                $codSolicitado = $_GET['id'];
                ?>

                <!-- Início do formulário para preencimento do controle da solicitação   -->

                <form  name="controle">

                    <table class="table">
                        <?php
                        conecta();
                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                        $pesquisa = " SELECT * FROM listarcontrole
                                                    WHERE codSolicitacaoControle = '$codSolicitado'";
                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        gravaLog("Visualizou o controle da solicitação nº $codSolicitado");
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?>
                            <tr>

                                <td >
                                    <div >
                                        <label for=" SolicitacaoN"> Solicitação Nº</label>
                                    </div>                                   
                               
                                    <input style="height: 30px" type="text"
                                           name="setCodControleSolicite" 
                                           readonly="true" value="<?php echo $codSolicitado; ?>"/>
                                </td>
                                
                                <td >
                                    <div >
                                        <label for=" Motorista"> Motorista</label>
                                    </div>                                   
                               
                                    <select name="setMotorista"  disabled="true"
                                            id="escolhaMotorista" style="width: 400px;height: 30px">
                                        <option><?= $registro['motorista'] ?></option>
                                    </select>   
                                </td>
                            </tr>

                        </table>            
                        <table class="table">  
                            <tr >
                                <td colspan="6">                                    
                                    <div> 
                                        <label for="Funcao" style="background-color: #d6e9c6"> Dados do Veículo</label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div >
                                        <label for="Veiculo">Veículo</label>
                                    </div>                                 
                                
                                    <select name="setVeiculo"  disabled="true"
                                            id="escolhaVeiculo" style="height: 30px;width: 300px" 
                                            onchange="indiceVeiculo()">
                                        <option><?= $registro['modelo'] ?></option>
                                    </select>      
                                </td>
                                
                                <td>
                                    <div>
                                        <label for="Placa">Placa</label>
                                    </div>                                   
                               
                                    <input style="height: 30px;width: 200px" type="text" disabled="true"
                                           name="displayPlaca"  value="<?= $registro["placa"] ?>">
                                </td>

                                <td>
                                    <div >
                                        <label> Capacidade</label>
                                    </div>                                   
                                
                                    <input style="height: 30px;width: 100px" type="text"
                                           name="displayCapacidade" readonly="true"
                                           size="1" value="<?= $registro["ocupacao"] ?>">
                                </td>
                            </tr>
                        </table>
                    <?php } ?>                             
                    <div class="btn-lg">
                        <div class="pull-right">
                            <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                Voltar
                            </button>                                              
                        </div>
                    </div>
                </form> 

            </div>
        </div>        
    </div> 
</body>
</html>
