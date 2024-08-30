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
        <title>Exclusão de Abastecimento</title>  
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body  style="font-family: courier">
    <?php
    $codAbastecimentoExcluir = $_GET['id'];
    conecta();
    $sqlStatus1 = "UPDATE abastecimentos SET statusAbast=0
                                WHERE codAbastecimento='$codAbastecimentoExcluir'";
    $resultado = mysql_query($sqlStatus1) or die("Houve um erro de banco de dados: " . mysql_error());
     gravaLog("Excluiu o abastecimento nº  $codAbastecimentoExcluir");
    ?>

    <script language=javascript>alert('Abastecimento excluído com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarAbast.php";
    </script>
</body>
</html>
