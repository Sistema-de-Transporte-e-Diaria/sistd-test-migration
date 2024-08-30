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
<u><i><b>Banco de Horas</b></i></u>
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
    <br>

    <table align='left' border='1' style='width: 100%'>
        <tr style="background-color: #b2dba1">
            <td style='text-align: center'>Horas Extra do Motorista</td>
        </tr>
    </table>
    <br>
    <table align='left' border='1' style='width: 100%'>

        <tr style="background-color: #CCC">
            <td style='font-size: medium; width: 3%; text-align: center'>ID</td>
            <td style='font-size: medium; width: 15%; text-align: center'>Motorista</td>
            <td style='font-size: medium; width: 12%; text-align: center'>Quantidade de Horas Extra</td>
            <td style='font-size: medium; width: 12%; text-align: center'>Mês/Ano</td>
        </tr>
    </table>

    <?php
    conecta();
// Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
    $pesquisa = "SELECT * FROM listarhoraextramot
                        WHERE idMotorista_FK='$getEscolhaMotorista'
                        AND quantHoraExtra <> '00:00:00'
                        AND statusHoraExtra <> 0
                        ORDER BY idHoraExtra";

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
            <td style='font-size: small; width: 3%; text-align: left'><?= $registro['idHoraExtra'] ?></td>
            <td style='font-size: small; width: 15%; text-align: left'><?= $registro['motorista'] ?></td>
            <td style='font-size: small; width: 12%; text-align: center'><?= $registro['quantHoraExtra'] ?></td>
            <td style='font-size: small; width: 12%; text-align: left'><?= $registro['mesHoraExtra'] ?></td>
        </tr>     
    </table>
<?php } ?>
<br>
<br>
<br>
<br>
<br>



<table align='left' border='1' style='width: 100%'>
    <tr style="background-color: #b2dba1">
        <td style='text-align: center'>Folgas do Motorista</td>
    </tr>
</table>
<br>
<table align='left' border='1' style='width: 100%'>

    <tr style="background-color: #CCC">
        <td style='font-size:medium; width: 5%; text-align: center'>ID</td>
        <td style='font-size: medium; width: 25%; text-align: center'>Motorista</td>
        <td style='font-size: medium; width: 10%; text-align: center'>Data</td>
        <td style='font-size: medium; width: 10%; text-align: center'>Quantidade de Horas Folgadas</td>
        <td style='font-size: medium; width: 20%; text-align: center'>Justificativa</td>
    </tr>
</table>

<?php
conecta();
// Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
$pesquisa3 = "SELECT * FROM listarfolga
                        WHERE idMotorista_FK='$getEscolhaMotorista'
                        AND statusFolga <> 0
                        ORDER BY idFolga";

$resultado3 = mysql_query($pesquisa3) or die("Houve um erro de banco de dados: " . mysql_error());

While ($registro3 = mysql_fetch_array($resultado3)) {
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
        <td style='font-size: small; width: 5%; text-align: left'><?= $registro3['idFolga'] ?></td>
        <td style='font-size: small; width: 25%; text-align: left'><?= $registro3['motorista'] ?></td>
        <td style='font-size: small; width: 10%; text-align: center'><?= formatoData($registro3['dataFolga']) ?></td>
        <td style='font-size: small; width: 10%; text-align: center'><?= $registro3['quantHoraFolga'] ?></td>
        <td style='font-size: small; width: 20%; text-align: left'><?= $registro3['justificativaFolga'] ?></td>
    </tr>     
    </table>
<?php } ?>

<br>



<table  style="margin-top: 1%; width: 15%;" align="right" border="1">
    <?php
    $sqlTotalHoras = "SELECT * FROM motoristas
                            WHERE codMotorista='$getEscolhaMotorista' 
                            AND statusMotorista <> '0'";

    $resultado1 = mysql_query($sqlTotalHoras) or die("Houve um erro de banco de dados: " . mysql_error());
    While ($registro = mysql_fetch_array($resultado1)) {
        $bancoHoras = $registro['saldoHoras'];
    }
    ?>
    <tr>
        <td style="color: #000000; width: 7%;" align="right">Banco de Horas:</td>
        <td style="width: 8%;" ><b><input type="text" style="color: #800000; width: 100%; font-size: medium; text-align: center;"  value='<? echo $bancoHoras?>'</b></td>
    </tr>
</table>      
</body>
</html>







