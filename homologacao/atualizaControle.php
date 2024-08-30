<?php
include ('validar_session.php');
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
        <title>Atualizando Solicitação</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário controle.php
        $getCodSolicitacaoControle = $_POST[setCodControleSolicite];
        $getIdMotoristaControle = $_POST[setMotorista];
        $getDiaria = $_POST[setDiaria];
        $getIdVeiculoControle = $_POST[setVeiculo];

// Conexão com o banco de dados
        conecta();

// Verifia os status da solicitação
        $sqlConsultaStatus = "SELECT statusSolicitacao FROM solicitacao 
                    WHERE codSolicitacao = '$getCodSolicitacaoControle'";
        $resultadoConsultaStatus = mysql_query($sqlConsultaStatus) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroConsultaStatus = mysql_fetch_array($resultadoConsultaStatus)) {
            $y = $registroConsultaStatus["statusSolicitacao"];
        }

// Caso a solicitação esteja com status 1, o código abaixo será executado.
        if ($y == 1 || $y == 5) {
            $sql = "INSERT INTO controle   (codSolicitacaoControle,
                idMotorista,
                diaria,
                idVeiculo)
         VALUES ('$getCodSolicitacaoControle',
                 '$getIdMotoristaControle',
                 '$getDiaria',
                 '$getIdVeiculoControle')";

            $sqlStatus = "UPDATE solicitacao SET statusSolicitacao=2
                              WHERE codSolicitacao = '$getCodSolicitacaoControle'";
            $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
            $sqlStatus1 = mysql_query($sqlStatus) or die("Houve um erro de banco de dados: " . mysql_error());

            email($getCodSolicitacaoControle);
            gravaLog("Cadastrou um controle a solicitação nº $getCodSolicitacaoControle");
            ?>

            <script language=javascript>alert('Solicitação atualizada com sucesso!');</script>   
            <script language= "JavaScript">
                location.href = "listarSolicitacao.php";
            </script>
            <?php
        } else {
            ?>
            <script language=javascript>alert('Não é possível atualizar uma solicitação mais de 1 vez!');</script>   
            <script language= "JavaScript">
                location.href = "listarSolicitacao.php";
            </script>

<?php } ?>
    </body>
</html>





