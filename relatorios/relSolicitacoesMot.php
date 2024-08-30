<?php
include '../funcoes.php';

$sqlManut = "SELECT * FROM manutencao";
$resManut = mysql_query($sqlManut);
while ($rowManut = mysql_fetch_assoc($resManut)) {
    $nomeCampus = $rowManut['nomeCampus'];
    $endCampus = $rowManut['enderecoCampus'];
    $telCampus = $rowManut['telCampus'];
    $nomeSetorResp = $rowManut['nomeSetorCampus'];
    $siglaSetorResp = $rowManut['siglaSetorCampus'];
}



$status2 = $_POST["status2"];
$status3 = $_POST["status3"];
$getEscolhaMotorista = $_POST[setEscolhaMotorista];
$getDtInicio1 = $_POST[setDtInicio];
$getDtFinal1 = $_POST[setDtFinal];
$getDtInicio = converteData($getDtInicio1);
$getDtFinal = converteData($getDtFinal1);

     
$agora = date("d/m/Y H:i:s ");
?>                  
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilo.css"/>
    </head>
    <body>
        <font face='arial'>
        <br>
        <table style="width: 100%" border="0">
            <head>
            <tr>
            <hr></hr>   
        </tr>
        <tr>
            <td style="width: 43.5%">
                <img src='../imagens/logo_ifpe_rel.png'>
            </td>
            <td align=center>
        <u><h3>RELATÓRIO</h3></u>
    </td>
    <td align=right>
        <h2 style="font-family: Comic Sans MS; font-style: italic "><?= $siglaSetorResp ?></h2><br>
        <font face=" Comic Sans MS" color=""> Sistema de Solicitação de Transporte e Diárias. </font>
    </td>   
</table>
<table style="width: 100%" border="0">
    <tr><hr></hr>
</tr>
<tr>
    <td style="width: 33%" align="left">
<u><i><b>Campus <?= $nomeCampus ?></b></i></u>
</td>
<td style="width: 33%" align="center">
<u><i><b>Solicitações por Motorista</b></i></u>
</td>
<td style="width: 33%" align="right">
<u><i><b>Emitido em: <?= $agora ?></b></i></u>
</td>
</tr>
<tr>
    <td colspan="3" align="right">
        <button onclick="imprimir();">Imprimir</button>
    </td>
</tr>
</table>
</font>
</head>
<body>
    <br>
    <table align='left' border='1' style='width: 100%;' >
        <tr style="background-color: #CCC">
            <td style='font-size: small; width: 5%; text-align: center'>ID</td>
            <td style='font-size: small; width: 20%; text-align: center'>Solicitante</td>
            <td style='font-size: small; width: 7.5%; text-align: center'>Data Saída</td>
            <td style='font-size: small; width: 7.5%; text-align: center'>Data Retorno</td>
            <td style='font-size: small; width: 30%; text-align: center'>Destino</td>
            <td style='font-size: small; width: 15%; text-align: center'>Motorista</td>
            <td style='font-size: small; width: 15%; text-align: center'>Situação da Solicitação</td>
        </tr>
    </table>

    <?php
    conecta();

    
    // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
    $pesquisa = "SELECT * FROM listarsolicitacaocontrole WHERE
                        motorista LIKE '%$getEscolhaMotorista%'
                        AND dtSaida BETWEEN '$getDtInicio' AND '$getDtFinal' 
                        AND statusSolicitacao REGEXP '^[$status2,$status3]'
                        ORDER BY dtSaida";

    
    $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());

    While ($registro = mysql_fetch_array($resultado)) {
        ?>                
        <table align='left' border='1' style='width: 100%'>    
            <?php
            $cont++;
            if (($cont % 2) == 1) {
                ?> 
                <tr align='left' style="background-color: #C1FFC1"> 
                    <?php
                } else {
                    ?>
                <tr align='left'> 
                <?php } ?>
            <br>
            <td style='font-size: small; width: 5%; text-align: center'><?= $registro['codSolicitacao'] ?></td>
            <td style='font-size: small; width: 20%; text-align: left'><?= $registro['nome'] ?></td>
            <td style='font-size: small; width: 7.5%; text-align: center'><?= formatoData($registro["dtSaida"]) ?></td> 
            <td style='font-size: small; width: 7.5%; text-align: center'><?= formatoData($registro["dtRetorno"]) ?></td> 
            <td style='font-size: small; width: 30%; text-align: left'><?= $registro['destino'] ?></td>                
            <td style='font-size: small; width: 15%; text-align: center'><?= $registro['motorista'] ?></td> 
            <td style='font-size: small; width: 15%; text-align: center'>
                <?php               
                if ($registro['statusSolicitacao'] == '2') {
                    echo 'Autorizada';
                }
                if ($registro['statusSolicitacao'] == '3') {
                    echo 'Finalizada';
                }
              
                ?>
            </td> 
        </tr>     
    </table>
<?php } ?>
<script>
    function imprimir() {
        window.print();
    }
</script>
</body>
</html>







