<?php include ('validar_session.php');

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Configurando configurações gerais</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário motoristas.php
        $getldapHost = $_POST['setLdapHost'];
        $getLdapPort = $_POST['setLdapPort'];
        $getLdapBaseDN = $_POST['setLdapBaseDN'];
        $getLdapCampo = $_POST['setLdapCampo'];
        $getVersaoSis = $_POST['setVersaoSis'];
        $getUpdateSis = $_POST['setUpdateSis'];
        $getVersaoBD = $_POST['setVersaoBD'];
        $getUpdateBD = $_POST['setUpdateBD'];
        $getAdminDiaria = $_POST['setAdminDiaria'];


        $getUpdateSis = converteData($getUpdateSis);
        $getUpdateBD = converteData($getUpdateBD);
        conecta();
        $sql = "UPDATE manutencao set ldapHost='$getldapHost',
                                          ldapPort='$getLdapPort',
                                          ldapBaseDN='$getLdapBaseDN',
                                          ldapCampo='$getLdapCampo',
                                          versaoSistema='$getVersaoSis',
                                          dtUpdateSistema='$getUpdateSis',
                                          versaoBD='$getVersaoBD',
                                          dtUpdateBD='$getUpdateBD',
                                          adminDiaria='$getAdminDiaria'
                                  WHERE  codConfig = 1";
        mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Alterou configurações gerais");
        ?>

       <script language=javascript>
            alert('Configurações gravada com sucesso!');
        </script>   
        <script language= "JavaScript">
            location.href = "configGeraisDiaria.php";
        </script>
    </body>
</html>




