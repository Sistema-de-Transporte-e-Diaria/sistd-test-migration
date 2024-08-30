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
        <title>Cadastrando Hora Extra</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
        $getCodMotorista = $_POST[setEscolhaMotorista];
        $getMes = $_POST[mes];
        $getHoraExtra = $_POST[setHoraExtra];




        $sql1 = "insert into horaExtraMot (idMotorista_FK, quantHoraExtra,mesHoraExtra)
                        VALUES ('$getCodMotorista', '$getHoraExtra','$getMes')";
        conecta();
        $sql5 = mysql_query($sql1) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Cadastrou hora extra");



        $pesquisaSet1 = "SELECT  saldoHoras FROM motoristas WHERE codMotorista='$getCodMotorista'";
        $resultadoSet1 = mysql_query($pesquisaSet1) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroSet1 = mysql_fetch_array($resultadoSet1)) {
            $saldoMot = $registroSet1['saldoHoras'];
        }
         $pesquisaSet2 = "SELECT  * FROM horaExtraMot WHERE idMotorista_FK='$getCodMotorista'";
        $resultadoSet2 = mysql_query($pesquisaSet2) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroSet2 = mysql_fetch_array($resultadoSet2)) {
            $horaExtra = $registroSet2['quantHoraExtra'];
        }
        
          $saldo= saldoHoras($saldoMot,$horaExtra);
         
        $sql3 = "UPDATE  motoristas SET saldoHoras='$saldo' WHERE codMotorista='$getCodMotorista'";
        $sql4 = mysql_query($sql3) or die("Houve um erro de banco de dados: " . mysql_error());
        ?>

        <script language=javascript>alert('Hora Extra cadastrada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarHoraExtra.php";
        </script>
        <!-- Gera o PDF da solicitacao após 1 segundo do click no botão enviar 
        <script type="text/javascript">
            window.setTimeout("location.href='pdfBancoHoras.php';", 1000);
        </script>-->
    </body>
</html>




