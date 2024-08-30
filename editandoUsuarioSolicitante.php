<?php include ('validar_session_diaria.php');

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
        $getCodSetorUsuario = $_POST[setSetorUsuario];
        $getEmailUsuario = $_POST[setEmailUsuario];
        $getSenhaUsuario = $_POST[setSenhaUsuario];
        $getNivelUsuario = $_POST[setNivelUsuario];
        $getCPF = $_POST[setCPF];
        $getBanco = $_POST[setBanco];
        $getAgencia = $_POST[setAgencia];
        $getConta = $_POST[setConta];
        $getDtNasc1 = $_POST[setDtNasc];
         $getDtNasc = converteData($getDtNasc1);


        $senhaCrip = md5($getSenhaUsuario);
        $sql = "UPDATE solicitantes set nome='$getNomeUsuario',
                                senha='$senhaCrip',
                                idSetor='$getCodSetorUsuario',    
                                telefone='$getFoneUsuario',
                                email='$getEmailUsuario',administrador='$getNivelUsuario',
                                cpf='$getCPF',
                                banco='$getBanco',
                                agencia='$getAgencia',    
                                conta='$getConta',
                                dtNasc='$getDtNasc'
	                 WHERE siape='$getSiape'";



        conecta();
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Editou o usuário nº $getSiape");
        ?>

        <script language=javascript>alert('Usuário alterado com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarUsuariosSolicitanteDiaria.php";
        </script>
    </body>
</html>




