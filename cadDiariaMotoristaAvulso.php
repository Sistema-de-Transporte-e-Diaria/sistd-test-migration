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
        <title>Cadastrando Diária de Motorista</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
        $getCodMotorista = $_POST[setEscolhaMotorista];
        $getDataDiariaMotAvulso = $_POST[setDataDiariaMotAvulso];
        $getDiaria = $_POST[setDiaria];
        $getEscolhaSolicitacao = $_POST[setEscolhaSolicitacao];
        $getJustificativa = $_POST[setJustificativa];

        $getDataDiariaMotAvulso = converteData($getDataDiariaMotAvulso);


        $sql = "insert into diariaMotoristaAvulso (idMotorista, dataDiariaMotAvulso, qtdDiaria, idSolicitacao, justificativa)
                        VALUES ('$getCodMotorista', '$getDataDiariaMotAvulso', '$getDiaria', '$getEscolhaSolicitacao', '$getJustificativa')";
        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Cadastrou diária de motorista avulso");
        ?>


        <script language=javascript>
            alert('Diária cadastrada com sucesso!');
        </script>   
        <script language= "JavaScript">
            location.href = "listarDiariaMotoristaAvulso.php";
        </script>
    </body>
</html>




