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
        <title>Editando Veículo</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodVeiculo = $_POST[setCodVeiculo];
        $getMarca = $_POST[setMarca];
        $getModelo = $_POST[setModelo];
        $getPlaca = $_POST[setPlaca];
        $getOcupacao = $_POST[setOcupacao];
        $getValiExtintor = $_POST[setValiExtintor];
        $getKmAtual = $_POST[setKmAtual];
        $getTrocaOleo = $_POST[setTrocaOleo];
        $getTrocaFiltroOleo = $_POST[setTrocaFiltroOleo];
        $getTrocaFiltroAR = $_POST[setTrocaFiltroAR];
        $getTrocaFiltroCombus = $_POST[setTrocaFiltroCombus];

        $getValiExtintor = converteData($getValiExtintor);

// Atualiza os dados da tabela veículos
        $sql = "UPDATE veiculos  set   marca='$getMarca',
                               modelo='$getModelo',
                               placa='$getPlaca',
                               ocupacao='$getOcupacao',
                               validadeExtintor='$getValiExtintor',
                               kmAtual='$getKmAtual',
                               pxTrOleo='$getTrocaOleo',
                               pxTrFiltroOleo='$getTrocaFiltroOleo',
                               pxTrFiltroAR='$getTrocaFiltroAR',
                               pxTrFiltroCombus='$getTrocaFiltroCombus'    
	                 WHERE codVeiculo='$getCodVeiculo'";

        conecta();
        $sql = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou o veículo nº $getCodVeiculo");
        ?>

        <script language=javascript>alert('Veículo alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarVeiculos.php";
        </script>
    </body>
</html>




