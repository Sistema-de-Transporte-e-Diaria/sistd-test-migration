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
        <title>Editando Hora Extra</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodHE = $_POST[setCodHE];
        $getMotoristaHE = $_POST[setEscolhaMotorista];
        $getMesHE = $_POST[mes];
        $getQuantHE = $_POST[setHoraExtra];

// Atualiza os dados na tabela motoristas
        $sql1 = "UPDATE horaExtraMot set idMotorista_FK='$getMotoristaHE',
                               mesHoraExtra='$getMesHE',
                               quantHoraExtra='$getQuantHE'
                         WHERE idHoraExtra='$getCodHE'";

        conecta();
        $sql = mysql_query($sql1) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou hora extra nº $getCodHE");



        ?>

        <script language=javascript>alert('Hora Extra alterada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarHoraExtra.php";
        </script>
    </body>
</html>




