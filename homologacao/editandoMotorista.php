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
        <title>Editando Motorista</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">

        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodMotorista = $_POST[setCodMotorista];
        $getNomeMotorista = $_POST[setNomeMotorista];
        $getCNHcategoria = $_POST[setCNHcategoria];
        $getCNHnumero = $_POST[setCNHnumero];
        $getCNHvalidade = $_POST[setCNHvalidade];

        $getCNHvalidade1 = converteData($getCNHvalidade);
// Atualiza os dados na tabela motoristas
        $sql = "UPDATE motoristas set motorista='$getNomeMotorista',
                               cnhCategoria='$getCNHcategoria',
                               cnhNumero='$getCNHnumero',
                               cnhValidade='$getCNHvalidade1'
	                 WHERE codMotorista='$getCodMotorista'";

        conecta();
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou motorista nº $getCodMotorista");
        ?>

        <script language=javascript>alert('Motorista alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarMotoristas.php";
        </script>
    </body>
</html>




