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
        <title>Editando Abastecimento</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $codAlterarAbastecimento = $_POST[codAbastecimento];
        $getVlrLitro = $_POST[setVlrLitro];
        $getQtd = $_POST[setQtd];
        $getVlrTotal = $_POST[setVlrTotal];
        $getKmAtual = $_POST[setKmAtual];
        $getDtAbastecimento = $_POST[setDtAbastecimento];
        $getVeiculo = $_POST[setVeiculo];
        $getMotorista = $_POST[setMotorista];

        $getDtAbastecimento = converteData($getDtAbastecimento);

// Atualiza dos dados da tabela abastecimentos
        $sql = "UPDATE abastecimentos set vlrLitro='$getVlrLitro',
                               qtd='$getQtd',
                               vlrTotal='$getVlrTotal',
			       kmAtualAbast='$getKmAtual',
                               dtAbastecimento='$getDtAbastecimento',
                               idVeiculo = '$getVeiculo',
                               idMotorista ='$getMotorista'
                               WHERE codAbastecimento='$codAlterarAbastecimento'";



        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou abastecimento nº $codAlterarAbastecimento");
        ?>


        <script language=javascript>alert('Abastecimento alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarAbast.php";
        </script>
    </body>
</html>    



