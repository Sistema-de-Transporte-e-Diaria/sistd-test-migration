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
        <title>Cadastrando Marca</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
 <body style="font-family: courier">
<?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
$getMarca = $_POST[setMarca];

// Inseri os dados na tabela motoristas
$sql = "insert into marcas (nomeMarca)
                        VALUES ('$getMarca')";
conecta();
$sql = mysql_query($sql) or die ("Houve um erro de banco de dados: ".mysql_error());
gravaLog("Cadastrou marca");
?>
   
     <script language=javascript>alert('Marca de Veículo cadastrada com sucesso!');</script>   
     <script language= "JavaScript">
         location.href = "listarMarcas.php";
     </script>

  </body>
</html>




