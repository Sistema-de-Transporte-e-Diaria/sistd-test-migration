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
        $getVeiculoPasBD = $_POST['setVeiculoPasBD'];
        $getVeiculoColetivoBD = $_POST['setVeiculoGrandeBD'];
        $getAdminDiaria = $_POST['setVeiculoGrandeBD'];
        $user = $_POST['setUser'];
        $pass = $_POST['setPass'];
        $statusBase = $_POST['base'];
        $nomeCampus = $_POST['setNomeCampus'];
        $endCampus = $_POST['setEndCampus'];
        $telCampus = $_POST['setTelCampus'];
        $nomeSetorResp = $_POST['setNomeSetorCampus'];
        $siglaSetorResp = $_POST['setSiglaSetorCampus'];   

        $getUpdateSis1 = converteData($getUpdateSis);
        $getUpdateBD1 = converteData($getUpdateBD);
        conecta();
        $sql = "UPDATE manutencao set ldapHost='$getldapHost',
                                          ldapPort='$getLdapPort',
                                          ldapBaseDN='$getLdapBaseDN',
                                          ldapCampo='$getLdapCampo',
                                          versaoSistema='$getVersaoSis',
                                          dtUpdateSistema='$getUpdateSis1',
                                          versaoBD='$getVersaoBD',
                                          dtUpdateBD='$getUpdateBD1',
                                          adminDiaria='$getAdminDiaria',
                                          veiculoPassageiro = '$getVeiculoPasBD',
                                          veiculoColetivo= '$getVeiculoColetivoBD',
                                          ldappass='$pass',
                                          ldapuser='$user',
                                          statusBase='$statusBase',
                                          nomeCampus='$nomeCampus',
                                          enderecoCampus='$endCampus',
                                          telCampus='$telCampus',
                                          nomeSetorCampus='$nomeSetorResp',
                                          siglaSetorCampus='$siglaSetorResp'
                                  WHERE  codConfig = 1";
        mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        gravaLog("Alterou configurações gerais");
        ?>

       <script language=javascript>
            alert('Configurações gravada com sucesso!');
        </script>   
        <script language= "JavaScript">
            location.href = "configGerais.php";
        </script>
    </body>
</html>




