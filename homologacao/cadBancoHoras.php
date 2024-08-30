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
        <title>Cadastrando Hora Extra</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php

        $getCodMotorista = $_POST[setEscolhaMotorista];
        $getDataBancoHoras = $_POST[setDataBancoHoras];
        $getSolicitacaoHoraExtra = $_POST[setEscolhaHoraExtra];
        $getHoraExtra = $_POST[setHoraExtra];
        $getJustificativa = $_POST[setJustificativa];

        $getDataBancoHoras = converteData($getDataBancoHoras);


        $sql = "insert into bancoHoras (idMotoristaBancoHoras, idSolicitacaoBancoHoras, horaExtra, dataFolga, justificativa)
                        VALUES ('$getCodMotorista', '$getSolicitacaoHoraExtra', '$getHoraExtra', '$getDataBancoHoras', '$getJustificativa')";
        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Cadastrou hora extra");
        ?>
   
        <script language=javascript>alert('Hora cadastrada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarMotoristas.php";
             window.setTimeout("location.href='pdfBancoHoras.php';", 1000);
        </script>
        <!-- Gera o PDF da solicitacao após 1 segundo do click no botão enviar 
        <script type="text/javascript">
            window.setTimeout("location.href='pdfBancoHoras.php';", 1000);
        </script>-->
    </body>
</html>




