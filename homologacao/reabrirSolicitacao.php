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
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body style="font-family: courier">
    <?php
    $codSolicitadoReabrir = $_POST[setEscolhaSolicitacao];
    conecta();
    $sqlStatus1 = "UPDATE solicitacao SET statusSolicitacao=2
                                WHERE codSolicitacao='$codSolicitadoReabrir'";
    $resultado = mysql_query($sqlStatus1) or die("Houve um erro de banco de dados: " . mysql_error());
    gravaLog("Reabriu a solicitação nº $codSolicitadoReabrir");
    ?>

    <script language=javascript>
        alert('Solicitação reaberta com sucesso!');
    </script>   
    <script language= "JavaScript">
        location.href = "listarSolicitacao.php";
    </script>
</body>
</html>
