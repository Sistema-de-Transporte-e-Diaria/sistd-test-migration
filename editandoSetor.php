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
        <title>Editando Setor</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodSetor = $_POST[setCodSetor];
        $getSiglaSetor = $_POST[setSiglaSetor];
        $getDescricaoSetor = $_POST[setDescricaoSetor];
        $getTipoPriv = $_POST[tipoPriv];
// Atualiza os dados na tabela motoristas
        $sql = "UPDATE setor set nomeSetor='$getSiglaSetor',
                               descricao='$getDescricaoSetor',
                               privilegioSetor='$getTipoPriv'
                         WHERE codSetor='$getCodSetor'";

        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou setor nº $getCodSetor");
        ?>

        <script language=javascript>alert('Setor alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarSetores.php";
        </script>
    </body>
</html>




