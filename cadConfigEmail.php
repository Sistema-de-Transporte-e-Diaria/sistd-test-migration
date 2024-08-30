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
        <title>Configurando envio de notificação</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
 <body style="font-family: courier">
<?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
$getTipoEmail = $_POST['setTipoEmail'];
$getHostEmail = $_POST['setHostEmail'];
$getSmtpSeguro = $_POST['setSmtpSeguro'];
$getPortEmail = $_POST['setPortEmail'];
$getDebugEmail = $_POST['setDebugEmail'];
$getUsuarioEmail = $_POST['setUsuarioEmail'];
$getSenhaEmail = $_POST['setSenhaEmail'];
$getRemetenteEmail = $_POST['setRemetenteEmail'];
$getRemetenteNomeEmail = $_POST['setRemetenteNomeEmail'];
$getDestinatarioCopiaEmail = $_POST['setDestinatarioCopiaEmail'];
$getsetEmailAdmin = $_POST['setEmailAdmin'];
$getAssuntoAutorizacaoEmail = $_POST['setAssuntoAutorizacaoEmail'];
$getAssuntoSolicitacaoEmail = $_POST['setAssuntoSolicitacaoEmail'];


conecta();
            $sql = "UPDATE manutencao set mailTipo='$getTipoEmail',
                                          mailHost='$getHostEmail',
                                          mailSmtpSeguro='$getSmtpSeguro',
                                          mailPort='$getPortEmail',
                                          mailDebug='$getDebugEmail',
                                          mailUsuario='$getUsuarioEmail',
                                          mailSenha='$getSenhaEmail',
                                          mailRemetente='$getRemetenteEmail',
                                          mailRemetenteNome='$getRemetenteNomeEmail',
                                          mailDestinatarioCopia='$getDestinatarioCopiaEmail',
                                          mailEmailAdmin='$getsetEmailAdmin',
                                          mailAssuntoAutorizacao='$getAssuntoAutorizacaoEmail',
                                          mailAssuntoSolicitacao='$getAssuntoSolicitacaoEmail'
                                    WHERE  codConfig = 1";            
mysql_query($sql) or die ("Houve um erro de banco de dados: ".mysql_error());
gravaLog("Alterou configuração das notificações de email");
?>
      
     <script language=javascript>
            alert('Configuração gravada com sucesso!');
     </script>   
     <script language= "JavaScript">
         location.href = "configEmail.php";
     </script>
   </body>
</html>




