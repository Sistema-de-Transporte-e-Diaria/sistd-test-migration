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
        <title>Cadastrando Motorista</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
        $getCadMotorista = $_POST[setNomeMotorista];
        $getCNHcategoria = $_POST[setCNHcategoria];
        $getCNHnumero = $_POST[setCNHnumero];
        $getCNHvalidade = $_POST[setCNHvalidade];

        $getCNHvalidade = converteData($getCNHvalidade);

// Inseri os dados na tabela motoristas
        $sql = "insert into motoristas (motorista, cnhCategoria, cnhNumero, cnhValidade)
                        VALUES ('$getCadMotorista','$getCNHcategoria','$getCNHnumero','$getCNHvalidade')";
        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
      gravaLog("Cadastrou motorista");
        ?>
        
        <script language=javascript>alert('Motorista cadastrado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarMotoristas.php";
        </script>
    </body>
</html>




