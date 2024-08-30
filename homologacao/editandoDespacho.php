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
        <title>Editando Despacho</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCod = $_POST[setCod];
        $getSolicit = $_POST[setSolicit];
        $Just = $_POST[setJust];
// Atualiza os dados na tabela motoristas
        $sql = "UPDATE despacho set idSolicitacao_FK='$getSolicit', descricaoDespacho='$Just'
                         WHERE idDespacho='$getCod'";

        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou despacho nº $getCod");
        ?>

        <script language=javascript>alert('Despacho alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarDespachos.php";
        </script>
    </body>
</html>




