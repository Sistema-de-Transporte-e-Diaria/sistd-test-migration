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
        <title>Exclusão de Marca</title>
  
    <script language="JavaScript" type="text/javascript" src="script.js"></script>
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body style="font-family: courier">
    <?php
    $IdMarcaExcluir = $_GET['id'];
    conecta();
    $sql = "UPDATE marcas SET statusMarca=0
                                WHERE idMarca='$IdMarcaExcluir'";
    $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
    gravaLog("Excluiu a marca nº  $IdMarcaExcluir");
    ?>

    <script language=javascript>alert('Marca de Veículo excluída com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarMarcas.php";
    </script>
</body>
</html>
