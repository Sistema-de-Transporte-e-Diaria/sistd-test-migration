<?php
include ('validar_session.php');

conecta();
$usuario = $_SESSION['login_usuario'];
$sql = "select administrador,direcao from solicitantes where siape='$usuario'";
$resultado = mysql_query($sql) or die("Não foi possível realizar a consulta ao banco de dados");
while ($registro = mysql_fetch_array($resultado)) {
    $admin = $registro["administrador"];
    $direcao = $registro["direcao"];
}

if ($direcao == 1) {
    $codSolicitacao = $_GET['id'];
    $auth = $_GET['auth'];
    if ($auth == 'true') {
        $update = "UPDATE solicitacao set statusSolicitacao='6' WHERE codSolicitacao='$codSolicitacao'";
        gravaLog(" aprovou a solicitacao ");
        emailAprovouSolicitacao($codSolicitacao);
    } else {
        $update = "UPDATE solicitacao set statusSolicitacao='1' WHERE codSolicitacao='$codSolicitacao'";
        gravaLog(" rejeitou a solicitacao ");
    }
    $sql = mysql_query($update) or die("Houve um erro de banco de dados: " . mysql_error());
    ?> <script language=javascript>alert('Solicitação alterada com sucesso!');</script> <?php
}

if ($admin == 2 || $admin == 3) {
    ?>
    <script language= "JavaScript">
        location.href = "listarSolicitacao.php";
    </script>
    <?php
} else {
    ?>
    <script language= "JavaScript">
        location.href = "listarSolicitacaoOutros.php";
    </script>
    <?php
}

?>