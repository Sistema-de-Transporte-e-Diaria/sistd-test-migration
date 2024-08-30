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
        <title>Cadastrando Usuário</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
        $getSiape = $_POST[setSiape];
        $getNomeUsuario = $_POST[setNomeUsuario];
        $getFoneUsuario = $_POST[setFoneUsuario];
        $getCodSetorUsuario = $_POST[setSetorUsuario];
        $getEmailUsuario = $_POST[setEmailUsuario];
        $getNivelUsuario = $_POST[setNivelUsuario];
        $getSenhaUsuario = $_POST[setSenhaUsuario];
        $getDtNasc1 = $_POST[setDtNasc];
        $getDtNasc = converteData($getDtNasc1);
        
        $getCPF = $_POST[setCPF];
        $getBanco = $_POST[setBanco];
        $getAgencia = $_POST[setAgencia];
        $getConta = $_POST[setConta];


        $senhaCrip = md5($getSenhaUsuario);
        $sql = "insert into solicitantes (siape, nome, senha, idsetor, administrador, telefone, email, cpf, banco, agencia, conta, dtNasc)
                        VALUES ('$getSiape','$getNomeUsuario','$senhaCrip', '$getCodSetorUsuario',
                                 '$getNivelUsuario','$getFoneUsuario','$getEmailUsuario','$getCPF','$getBanco','$getAgencia','$getConta', '$getDtNasc')";
        conecta();
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Cadastrou usuário");
        ?>

        <script language=javascript>alert('Usuário cadastrado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarUsuarios.php";
        </script>
    </body>
</html>




