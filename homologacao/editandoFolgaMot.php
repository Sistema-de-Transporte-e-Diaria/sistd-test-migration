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
        <title>Editando Folga</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodFolga = $_POST[setCodFolga];
        $getMotorista = $_POST[setEscolhaMotorista];
        $getDataFolga1 = $_POST[setDataFolga];
        $getQuantHoraFolga = $_POST[setFolga];
        $getJustif = $_POST[setJustificativa];
        $getDataFolga = converteData($getDataFolga1);

        $sql2 = "UPDATE folgaMotorista set idMotorista_FK='$getMotorista',
                               dataFolga='$getDataFolga',
                               quantHoraFolga='$getQuantHoraFolga',
                                justificativaFolga='$getJustif'
                         WHERE idFolga='$getCodFolga'";

        conecta();
        $sql = mysql_query($sql2) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou folga nº $getCodFolga");
        ?>

        <script language=javascript>alert('Folga alterada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarFolgaMot.php";
        </script>
    </body>
</html>




