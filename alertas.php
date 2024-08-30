<?php include 'funcoes.php';
?>
<html> 
    <head>
        <link rel="shortcut icon" href="imagens/favicon.ico">
        <link rel="icon" type="img/x-icon" href="animated_favicon1.gif">
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">     
    </head>
    <body>
        <?php
// ALERTAS PARA A VALIDADE DAS CNH DOS MOTORISTAS
        conecta();
        $pesquisa = "SELECT * FROM motoristas
                               WHERE statusMotorista = 1";
        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registro = mysql_fetch_array($resultado)) {
            $tDias = calculaDias(date('d/m/Y'), formatoData($registro['cnhValidade']));
            $motorista = $registro['motorista'];
            if ($tDias < 0) {
                print"<script>window.alert('CNH vencida do motorista $motorista')</script>";
            }
            if ($tDias < 30 && $tDias > 0) {
                print"<script>window.alert('Faltam apenas $tDias dias para vencer a CNH do motorista $motorista')</script>";
            }
        }

        // ALERTAS PARA A VALIDADE DOS EXTITORES DOS VEÍCULOS              
        $pesquisaVeiculo = "SELECT * FROM veiculos
                               WHERE statusVeiculo = 1";
        $resultadoVeiculo = mysql_query($pesquisaVeiculo) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroVeiculo = mysql_fetch_array($resultadoVeiculo)) {


            $tDiasVeiculo = calculaDias(date('d/m/Y'), formatoData($registroVeiculo['validadeExtintor']));
            $veiculo = $registroVeiculo['modelo'];

            if ($tDiasVeiculo < 0) {
                print"<script>window.alert('O extintor do veículo $veiculo está vencido')</script>";
            }
            //   print"<script>window.alert($tDias)</script>";
            if ($tDiasVeiculo < 30 && $tDiasVeiculo > 0) {
                print"<script>window.alert('Faltam apenas $tDiasVeiculo dias para vencer a validade do extintor do veículo $veiculo')</script>";
            }

            //EXIBIR OS ALERTAS DE ACORDO COM OS PARÂMETROS ABAIXO:

            $setTrocaOleo = 2000;
            $setTrocaFiltroOleo = 2000;
            $setTrocaFiltroAR = 2000;
            $setTrocaFiltroCombus = 2000;

            //VALORES CADASTRADO NO SISTEMA

            $getKmAtual = $registroVeiculo['kmAtual'];


            $getTrocaOleo = $registroVeiculo['pxTrOleo'];
            $getTrocaFiltroOleo = $registroVeiculo['pxTrFiltroOleo'];
            $getTrocaFiltroAR = $registroVeiculo['pxTrFiltroAR'];
            $getTrocaFiltroCombus = $registroVeiculo['pxTrFiltroCombus'];

            $statusTrocaOleo = ($getTrocaOleo - $getKmAtual);
            $statusTrocaFiltroOleo = ($getTrocaFiltroOleo - $getKmAtual);
            $statusTrocaFiltroAR = ($getTrocaFiltroAR - $getKmAtual);
            $statusTrocaFiltroCombus = ($getTrocaFiltroCombus - $getKmAtual);


            if ($statusTrocaOleo <= $setTrocaOleo) {
                print"<script>window.alert('Falta apenas $statusTrocaOleo Km para a troca de óleo do veículo $veiculo')</script>";
            }
            if ($statusTrocaFiltroOleo <= $setTrocaFiltroOleo) {
                print"<script>window.alert('Falta apenas $statusTrocaFiltroOleo Km para a troca do filtro de óleo do veículo $veiculo')</script>";
            }
            if ($statusTrocaFiltroAR <= $setTrocaFiltroAR) {
                print"<script>window.alert('Falta apenas $statusTrocaFiltroAR Km para a troca do filtro de AR do veículo $veiculo')</script>";
            }
            if ($statusTrocaFiltroCombus <= $setTrocaFiltroCombus) {
                print"<script>window.alert('Falta apenas $statusTrocaFiltroCombus Km para a troca do filtro de combustível do veículo $veiculo')</script>";
            }
        }
        ?>
    </body>
</html>
<script>window.location.href = 'listarSolicitacao.php';</script>