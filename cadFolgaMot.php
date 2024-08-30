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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cadastrando Folga</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php

        $getCodMotorista = $_POST[setEscolhaMotorista];
        $getData1 = $_POST[setDataFolga];
        $getHora = $_POST[setFolga];
        $getJustificativa = $_POST[setJustificativa];

        $getData = converteData($getData1);


        $sql1 = "insert into folgaMotorista (idMotorista_FK, quantHoraFolga, dataFolga, justificativaFolga)
                        VALUES ('$getCodMotorista', '$getHora', '$getData', '$getJustificativa')";
        conecta();
        $sql = mysql_query($sql1) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Cadastrou folga");
        
        
         $pesquisaSet1 = "SELECT  saldoHoras FROM motoristas WHERE codMotorista='$getCodMotorista'";
        $resultadoSet1 = mysql_query($pesquisaSet1) or die("Houve um erro de banco de dados: " . mysql_error());
         While ($registroSet1 = mysql_fetch_array($resultadoSet1)) {
            $saldoMot = $registroSet1['saldoHoras'];
        }
         $pesquisaSet2 = "SELECT  * FROM folgaMotorista WHERE idMotorista_FK='$getCodMotorista'";
        $resultadoSet2 = mysql_query($pesquisaSet2) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroSet2 = mysql_fetch_array($resultadoSet2)) {
            $quantHoraFolga = $registroSet2['quantHoraFolga'];
        }
        
          $saldoFolga= retiraSaldoHoras($saldoMot, $quantHoraFolga);
         
        $sql3 = "UPDATE  motoristas SET saldoHoras='$saldoFolga' WHERE codMotorista='$getCodMotorista'";
        $sql4 = mysql_query($sql3) or die("Houve um erro de banco de dados: " . mysql_error());
        ?>
   
            <script language=javascript>alert('Folga cadastrada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarFolgaMot.php";
             window.open('pdfBancoHoras.php');
        </script>
        
    </body>
</html>




