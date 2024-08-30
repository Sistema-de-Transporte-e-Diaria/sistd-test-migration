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
        <title>Exclusão Hora Extra</title>   
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
        $codHoraExtraExcluir = $_GET['id'];
       
        conecta();
        $sql1 = "UPDATE listarhoraextramot SET statusHoraExtra= '0' WHERE idHoraExtra= '$codHoraExtraExcluir' ";
        $resultado1 = mysql_query($sql1) or die("Houve um erro de banco de dados: " . mysql_error());
        
        $sql = "SELECT * FROM listarhoraextramot WHERE idHoraExtra= '$codHoraExtraExcluir'";
        $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroSet1 = mysql_fetch_array($resultado)) {
            $horaExcluida = $registroSet1['quantHoraExtra'];
            $saldoMot = $registroSet1['saldoHoras'];
          //  echo $horaExcluida;
           // echo $saldoMot ;
        }
    
        $saldoSub = excluirHorasExtra($saldoMot,  $horaExcluida);
        //echo $saldoSub;
        
        $sql3 = "UPDATE  listarhoraextramot SET saldoHoras= '$saldoSub' WHERE idHoraExtra= '$codHoraExtraExcluir' ";
        $sql4 = mysql_query($sql3) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Excluiu a hora extra nº $codHoraExtraExcluir");
        
        
        ?>


        <script language=javascript>alert('Hora Extra excluída com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarHoraExtra.php";
        </script>
    </body>
</html>
