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
                    <h3 class="panel-title" >Diária de Motorista Avulso</h3>
                </div>
                <div class="panel-body ">

                    <form method="post" action="cadDiariaMotoristaAvulso.php" name="solicita">
                        <table class="table">

                            <tr>
                                <td>
                                    <div >
                                        <label for="Motorista">Motorista</label>
                                    </div>                 
                                
                                    <select name="setEscolhaMotorista" style="height: 30px;width: 500px" required="true">

                                        <?php
                                        conecta();
                                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                        $pesquisa = "SELECT * FROM motoristas
                                            WHERE statusMotorista = 1
                                       ORDER BY motorista;";
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['codMotorista'] ?>"><?= $registro['motorista'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>                  
                                <td>
                                    <div >
                                        <label for="Data">Data</label>
                                    </div>                                    
                                
                                    <input type="text"  id="calendario" 
                                           name="setDataDiariaMotAvulso" style="height: 100%;width: 300px" required="true"/>                             
                                </td>

                                <td>
                                    <div >
                                        <label for=" Diaria"> Diária(as)</label>
                                    </div>                
                               
                                    <select name="setDiaria" style="height: 30px;width: 100px" id="escolhaDiaria" required="true">
                                        <option value=""> </option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <td >
                                    <div >
                                        <label for="Solicitacao">Solicitação</label>
                                    </div>                                    
                               
                                    <select name="setEscolhaSolicitacao" style="height: 30px;width: 650px" required="true">

                                        <?php
                                        conecta();
                                        // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                        $pesquisa1 = "SELECT * FROM listarsolicitacaocontrole
                                            WHERE statusSolicitacao = 3
                                            order by codSolicitacao";



                                        $resultado1 = mysql_query($pesquisa1) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro1 = mysql_fetch_array($resultado1)) {
                                            ?>       
                                            <option value="<?= $registro1['codSolicitacao'] ?>"><?= $registro1['codSolicitacao'] ?> - <?= $registro1['nome'] ?> - <?= formatoData($registro1['dtSaidaControle']) ?> - <?= $registro1['motorista'] ?></option>
                                            <?php
                                        }
                                        ?> 
                                    </select>
                                </td>
                           
                                <td  >
                                    <div>
                                        <label for="Justificativa">Justificativa</label>
                                    </div>                                   
                                    <textarea type="text" name="setJustificativa" style="width:500px" required="true"></textarea>
                                                                    
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
