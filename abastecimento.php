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
  <!--  <table align="right">
        <tr>
            <td style="color: #B9BDB6; font-size: small;"><?php echo "Seja bem vindo: " . $_SESSION['logado']; ?>
            </td>
        </tr>
    </table>-->
    <?php include "menu.php"; ?>

    <body  style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Cadastro de Abastecimento</h3>
                </div>
                <div class="panel-body "> 

                    <form  method="post" action="cadAbastecimento.php" name="abastecimento">                
                        <table class="table">
                            <tr>
                                <td>
                                    <div >
                                        <label for="veiculo">Veículo</label>
                                    </div>
                               
                                    <select name="setVeiculo" id="veiculo"
                                            required="true" style="height: 25px;width: 300px">
                                                <?php
                                                conecta();
                                                // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                                $pesquisa1 = "SELECT * FROM veiculos
                                                  WHERE statusVeiculo=1";
                                                $resultado1 = mysql_query($pesquisa1) or die("Não foi possível realizar a consulta ao banco de dados");
                                                While ($registro1 = mysql_fetch_array($resultado1)) {
                                                    ?>       
                                            <option value="<?= $registro1['codVeiculo'] ?>">
                                                <?= $registro1['modelo'] ?> - <?= $registro1['placa'] ?></option>
                                        <?php } ?> 
                                    </select>
                                </td> 

                                <td  >
                                    <div>
                                        <label for="motorista">Motorista</label>
                                    </div>
                               
                                    <select name="setMotorista" id="veiculo" required="true" 
                                            style="width: 350px;height: 25px">
                                                <?php
                                                conecta();
                                                // Recebe todos os campos da tabela controle do registro de código da variável $codSolicitado             
                                                $pesquisa = "SELECT * FROM motoristas
                                                 WHERE statusMotorista=1";
                                                $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                                While ($registro = mysql_fetch_array($resultado)) {
                                                    ?>       
                                            <option value="<?= $registro['codMotorista'] ?>">
                                                <?= $registro['motorista'] ?></option>
                                        <?php } ?> 
                                    </select>
                                </td> 

                                <td>
                                    <div >
                                        <label for="dataAbast">Data do Abastecimento</label>
                                    </div>    
                              
                                    <input type="text" id="calendario" 
                                           name="setDtAbastecimento" style="height: 100%" required="true"/>                             
                                </td>

                            </tr>  

                            <tr>
                                <td>
                                    <div>
                                        <label>
                                            Valor por Litro R$
                                        </label>
                                    </div>
                                
                                    <input type="text" name="setVlrLitro" class="real" id="vlrLitro"placeholder="00.00"
                                           required="true"style="height: 100%" >
                                </td>

                                <td >
                                    <div>
                                        <label for="quantidade">Quantidade</label>
                                    </div>
                               
                                    <input  type="text" name="setQtd" id="qtd"
                                            required="true"style="height: 100%" >
                                </td>

                                <td>
                                    <div>
                                        <label for="vTotal">Valor Total R$</label>
                                    </div>
                               
                                    <input style="color: brown" type="text" name="setVlrTotal" id="vTotal"
                                           required="true"style="height: 100%"
                                           class="Total" readonly="true" onfocus="totalAbast()">
                                </td>
                            </tr>

                            <tr>   

                                <td>
                                    <div c>
                                        <label for="kmAtual">Km Atual</label>
                                    </div>
                               
                                    <input type="text" name="setKmAtual" id="kmAtual"
                                           style="height: 100%" required="true">
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

        <!-- Função para calcular o valor total do combustível -->
        <script type="text/javascript">
            function totalAbast()
            {
                var VL = (document.abastecimento.setVlrLitro.value);
                var QTD = (document.abastecimento.setQtd.value);
                var total = VL * QTD;
                document.abastecimento.setVlrTotal.value = total;
            }
        </script>  

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
