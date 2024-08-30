<?php include ('validar_session.php');

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editando Usuário</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getSiape = $_POST[setSiape];
        $getNomeUsuario = $_POST[setNomeUsuario];
        $getFoneUsuario = $_POST[setFoneUsuario];
        $getEmailUsuario = $_POST[setEmailUsuario];
        $getNivelUsuario = $_POST[setNivelUsuario];
        $getSenhaUsuario = $_POST[setSenhaUsuario];
        $getSetorUsuario = $_POST[setSetorUsuario];
        $getDtNasc1 = $_POST[setDtNasc];
        $getDtNasc = converteData($getDtNasc1);
        
        $getCPF = $_POST[setCPF];
        $getBanco = $_POST[setBanco];
        $getAgencia = $_POST[setAgencia];
        $getConta = $_POST[setConta];
         
        $senhaCrip = md5($getSenhaUsuario);
        $sql = "UPDATE solicitantes set nome='$getNomeUsuario',
                                senha='$senhaCrip',
                                idSetor='$getSetorUsuario',    
                                administrador='$getNivelUsuario',
                                telefone='$getFoneUsuario',
                                email='$getEmailUsuario',
                                cpf='$getCPF',
                                banco='$getBanco',
                                agencia='$getAgencia',    
                                conta='$getConta',
                                dtNasc='$getDtNasc'
	                 WHERE siape='$getSiape'";



        conecta();
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou usuário  $getSiape");
        ?>

        <script language=javascript>alert('Usuário alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarUsuarios.php";
        </script>
    </body>
</html>




