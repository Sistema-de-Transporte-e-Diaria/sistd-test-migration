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
        <title>Exclusão de Motorista</title>  
    <script language="JavaScript" type="text/javascript" src="script.js"></script>
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body style="font-family: courier">
    <?php
    $codMotoristaExcluir = $_GET['id'];
    //  Atualiza o campus statusMotorista para 0, deixando o registro como excluído para o sistema
    conecta();
    $sql = "UPDATE motoristas SET statusMotorista=0
                                WHERE codMotorista='$codMotoristaExcluir'";
    $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
    gravaLog("Excluiu o motorista extra nº $codMotoristaExcluir");

    ?>


    <script language=javascript>alert('Motorista excluído com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarMotoristas.php";
    </script>
</body>
</html>
