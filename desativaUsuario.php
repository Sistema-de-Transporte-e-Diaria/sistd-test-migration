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
        <title>Desativação de Usuário</title>        
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
   </head>
   <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
 <body  style="font-family: courier">
  <?php 
       $codUsuarioDesativa = $_GET['id'];
       //  Atualiza o campus statusMotorista para 0, deixando o registro como excluído para o sistema
        conecta();
        $sql = "UPDATE solicitantes SET statusSolicitante=0
                                WHERE siape='$codUsuarioDesativa'";
        $resultado = mysql_query($sql) or die ("Houve um erro de banco de dados: ".mysql_error());
      
 ?>
     
     <script language=javascript>alert('Usuário desativado com sucesso!');</script>   
     <script language= "JavaScript">
         location.href = "listarUsuarios.php";
     </script>
   </body>
</html>
