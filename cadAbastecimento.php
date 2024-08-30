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
        <title>Cadastrando Abastecimento</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário abastecimento.php
        $getCodVeiculoAbast = $_POST[setVeiculo];
        $getCodMotoristaAbast = $_POST[setMotorista];
        $getValorLitro = $_POST[setVlrLitro];
        $getQtd = $_POST[setQtd];
        $getVlrTotal = $_POST[setVlrTotal];
        $getKmAtual = $_POST[setKmAtual];
        $getDtAbastecimento = $_POST[setDtAbastecimento];

        $getDtAbastecimento = converteData($getDtAbastecimento);

// Inseri os dados na tabela abastecimento
        $sql = "insert into abastecimentos (idVeiculo, idMotorista, vlrLitro, qtd, vlrTotal, kmAtualAbast, dtAbastecimento)
                        VALUES ('$getCodVeiculoAbast','$getCodMotoristaAbast','$getValorLitro','$getQtd','$getVlrTotal','$getKmAtual','$getDtAbastecimento')";
        conecta();
        $sql= mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        
        /*
          $sqlKm = "UPDATE veiculos  set kmAtual='$getKmAtual'
          WHERE codVeiculo='$getCodVeiculoAbast'";
          $sql = mysql_query($sqlKm) or die ("Houve um erro de banco de dados: ".mysql_error());
         */
        gravaLog("Cadastrou um abastecimento");
        ?>

        <script language=javascript>alert('Abastecimento cadastrado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarAbast.php";
        </script>

    </body>
</html>



