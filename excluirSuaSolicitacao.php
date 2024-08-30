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
        <title>Exclusão de Solicitação</title>  
    <script language="JavaScript" type="text/javascript" src="script.js"></script>
    <br> 
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body style="font-family: courier">
    <?php
    $codSolicitadoExcluir = $_GET['id'];
    conecta();
    $sqlStatus1 = "UPDATE solicitacao SET statusSolicitacao=0
                                WHERE codSolicitacao='$codSolicitadoExcluir'";
    $resultado = mysql_query($sqlStatus1) or die("Houve um erro de banco de dados: " . mysql_error());
    gravaLog("Excluiu uma solicitação nº $codSolicitadoExcluir");
    ?>

    <script language=javascript>alert('Solicitação excluída com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarSolicitacaoSolicitante.php";
    </script>
</body>
</html>
