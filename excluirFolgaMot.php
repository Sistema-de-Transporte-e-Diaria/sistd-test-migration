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
        <title>Exclusão Folga</title>   
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
        $codFolExcluir = $_GET['id'];
        //  Atualiza o campus statusMotorista para 0, deixando o registro como excluído para o sistema
        conecta();
        $sql = "UPDATE  folgaMotorista SET statusFolga =0 WHERE idFolga=$codFolExcluir";
        $result = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());

        $pesquisaSet1 = "SELECT * FROM listarfolga WHERE idFolga=$codFolExcluir";
        $resultadoSet1 = mysql_query($pesquisaSet1) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroSet1 = mysql_fetch_array($resultadoSet1)) {
            $saldoMot = $registroSet1['saldoHoras'];
            $quantHoraFolga = $registroSet1['quantHoraFolga'];
        }
       

        $saldoFolga = somarHorasFolga($saldoMot, $quantHoraFolga);

        $sql3 = "UPDATE  listarfolga SET saldoHoras='$saldoFolga' WHERE idFolga=$codFolExcluir";
        $resultado = mysql_query($sql3) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Excluiu a folga nº $codFolExcluir");
        ?>


        <script language=javascript>alert('Folga excluída com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarFolgaMot.php";
        </script>
    </body>
</html>
