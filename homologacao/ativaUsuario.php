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
        <title>Ativa Usuário</title>    
    <script language="JavaScript" type="text/javascript" src="script.js"></script>
</head>
<body style="font-family: courier">
    <?php
    // ATIVA O USUÁRIO CADASTRADO
    $codUsuarioAtiva = $_GET['id'];
    conecta();
    $sql = "UPDATE solicitantes SET statusSolicitante=1
                                WHERE siape='$codUsuarioAtiva'";
    $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
    ?>

    <script language=javascript>alert('Usuário ativado com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarUsuarios.php";
    </script>
</body>
</html>
