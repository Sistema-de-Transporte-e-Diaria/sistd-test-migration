<?php
include '../funcoes.php';
include ('jquery.php');

$sqlManut = "SELECT * FROM manutencao";
$resManut = mysql_query($sqlManut);
while ($rowManut = mysql_fetch_assoc($resManut)) {
    $nomeCampus = $rowManut['nomeCampus'];
    $endCampus = $rowManut['enderecoCampus'];
    $telCampus = $rowManut['telCampus'];
    $nomeSetorResp = $rowManut['nomeSetorCampus'];
    $siglaSetorResp = $rowManut['siglaSetorCampus'];
}

$getEscolhaMotorista = $_POST[setEscolhaMotorista];
$getEscolhaVeiculo = $_POST[setEscolhaVeiculo];
$getDtInicio = $_POST[setDtInicio];
$getDtFinal = $_POST[setDtFinal];

$getDtInicio = converteData($getDtInicio);
$getDtFinal = converteData($getDtFinal);


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
        <h2 style="font-family: Comic Sans MS; font-style: italic "><?=$siglaSetorResp?></h2><br>
        <font face=" Comic Sans MS" color=""> Sistema de Solicitação de Transporte e Diárias. </font>
    </td>   
</table>
<table style="width: 100%" border="0">
    <tr><hr></hr>
</tr>
<tr>
    <td style="width: 33%" align="left">
<u><i><b>Campus <?= $nomeCampus?></b></i></u>
</td>
<td style="width: 33%" align="center">
<u><i><b>Abastecimentos</b></i></u>
</td>
<td style="width: 33%" align="right">
<u><i><b>Emitido em: <?= $agora ?></b></i></u>
</td>
</tr>
</table>
</font>
</head>
<body>
    <br>
    <table align='left' border='1' style='width: 100%' >
        <tr style="background-color: #CCC">
            <td style='font-size: small; width: 2%; text-align: center'>ID</td>
            <td style='font-size: small; width: 20%; text-align: center'>Motorista</td>
            <td style='font-size: small; width: 20%; text-align: center'>Veículo</td>
            <td style='font-size: small; width: 10%; text-align: center'>Data do Abastecimento</td>
            <td style='font-size: small; width: 10%; text-align: center'>Valor por Litro</td>
            <td style='font-size: small; width: 5%; text-align: center'>Quantidade</td>
            <td style='font-size: small; width: 10%; text-align: center'>Valor Total</td>
            <td style='font-size: small; width: 15%; text-align: center'>Km Atual</td>
        </tr>
    </table>

    <?php
    conecta();
    // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
    $pesquisa = "SELECT * FROM listarabastecimento
                            WHERE codAbastecimento LIKE '%$getEscolhaSolicitante%'    
                            AND codMotorista LIKE '%$getEscolhaMotorista%'
                            AND codVeiculo LIKE '$getEscolhaVeiculo' 
                            AND dtAbastecimento BETWEEN '$getDtInicio' AND '$getDtFinal'
                            AND statusAbast = '1' 
                            AND statusVeiculo = '1'
                            AND statusMotorista = '1'
                            ORDER BY codAbastecimento";

    $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());

    While ($registro = mysql_fetch_array($resultado)) {
        $qtdTotal += $registro['qtd'];
        $vlrTotal += $registro['vlrTotal'];
        $cont++;
        $km[] = $registro['kmAtual'];

        $idVeiculo = $registro['codVeiculo'];
        ?>              
        <table align='left' border='1' style='width: 100%'>    
        <?php
        $cont1++;
        if (($cont1 % 2) == 1) {
            ?> 
                <tr align='left' style="background-color: #C1FFC1"> 
            <?php
            } else {
                ?>
                <tr align='left'> 
                <?php } ?>
            <br>
            <td style='font-size: small; width: 2%; text-align: center'><?= $registro['codAbastecimento'] ?></td>
            <td style='font-size: small; width: 20%; text-align: center'><?= $registro['motorista'] ?></td>
            <td style='font-size: small; width: 20%; text-align: center'><?= $registro["modelo"] ?></td> 
            <td style='font-size: small; width: 10%; text-align: center'><?= formatoData($registro["dtAbastecimento"]) ?></td> 
            <td style='font-size: small; width: 10%; text-align: center'><?= $registro['vlrLitro'] ?></td> 
            <td style='font-size: small; width: 5%; text-align: center'><?= $registro['qtd'] ?></td> 
            <td style='font-size: small; width: 10%; text-align: center'><?= $registro['vlrTotal'] ?></td> 
            <td style='font-size: small; width: 15%; text-align: center'><?= $registro['kmAtual'] ?></td> 
        </tr>     
    </table>
<?php } ?>
<br>

<?php
if ($getEscolhaMotorista == null && $getEscolhaVeiculo != null) {
    ?>
    <table style="margin-top: 1%" align="right" border="1">
    <?php
    $kmFiltro = $km[($cont - 1)] - $km[0];
    ?>
        <tr>
            <td style="color: #000000" align="right">Valor Total:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= 'R$ ' . $vlrTotal ?>'></b></td>
        </tr>
        <tr>
            <td style="color: #000000" align="right">Km do Filtro:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= $kmFiltro ?>'></b></td>
        </tr>
        <tr>
            <td style="color: #000000" align="right">Qtd de Litros do Filtro:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= $qtdTotal ?>'></b></td>
        </tr>
        <tr>
            <td style="color: #000000" align="right">Km por Litro</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= consumoCombus($idVeiculo); ?>'></b></td>
        </tr>
    </table> 

    <?php
} elseif ($getEscolhaVeiculo != null) {

    $kmFiltro = $km[($cont - 1)] - $km[0];
    ?>    
    <table style="margin-top: 1%" align="right" border="1">
        <tr>
            <td style="color: #000000" align="right">Valor Total:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= 'R$ ' . $vlrTotal ?>'></b></td>
        </tr>
        <tr>
            <td style="color: #000000" align="right">Km do Filtro:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= $kmFiltro ?>'></b></td>
        </tr>
    </table> 
<?php } else {
    ?>
    <table style="margin-top: 1%" align="right" border="1">
        <tr>
            <td style="color: #000000" align="right">Valor Total:</td>
            <td><b><input style="color: #800000; font-size: medium; " type="text" class="real" value='<?= 'R$ ' . $vlrTotal ?>'></b></td>
        </tr>
    </table> 
<?php } ?>
</body>
</html>







