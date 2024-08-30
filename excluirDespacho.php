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
        <title>Exclusão de Despacho</title>  
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body  style="font-family: courier">
    <?php
    $codDespExcluir = $_GET['id'];
    conecta();
    $sqlStatus1 = "UPDATE despacho SET statusDespacho=0
                                WHERE idDespacho='$codDespExcluir'";
    $resultado = mysql_query($sqlStatus1) or die("Houve um erro de banco de dados: " . mysql_error());

    $sql = "UPDATE solicitacao SET statusSolicitacao=5 WHERE codSolicitacao =
                (SELECT idSolicitacao_FK from despacho WHERE idDespacho = '$codDespExcluir')";
    $result = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());

    gravaLog("Excluiu o despacho nº  $codDespExcluir");
    ?>

    <script language=javascript>alert('Despacho excluído com sucesso!');</script>
    <script language= "JavaScript">
        location.href = "listarDespachos.php";
    </script>
</body>
</html>
