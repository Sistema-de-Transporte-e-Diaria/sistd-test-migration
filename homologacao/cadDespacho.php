<?php include ('validar_session.php'); ?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Despacho Efetuada</title>
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php

        $getCodSolicitacao = $_POST[setSolicit];
        $Just = $_POST[setJust];

        $sql = "INSERT INTO listardespachos (idSolicitacao_FK, descricaoDespacho) 
                                VALUES ('$getCodSolicitacao','$Just') ";
                     
         $sql2 = "UPDATE listardespachos set  statusSolicitacao=4 WHERE idSolicitacao_FK='$getCodSolicitacao'"; 
        conecta();
       
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
         $ras = mysql_query($sql2) or die("Houve um erro de banco de dados: " . mysql_error());
    
     
        $sqlUltimoCod = "SELECT * FROM listardespachos
                        ORDER BY idDespacho DESC LIMIT 1";
        $resultadoUltimoCod = mysql_query($sqlUltimoCod) or die("Não foi possível realizar a consulta ao banco de dados");
        While ($registroUltimoCod = mysql_fetch_array($resultadoUltimoCod)) {
            $ultimoDespacho = $registroUltimoCod['idDespacho'];
        }

        emailDespacho($ultimoDespacho);
        gravaLog("Cadastrou despacho");
        
        
       ?>
            <script language=javascript>alert('Despacho cadastrado com sucesso!');</script> 
        
        <script>
            location.href = "listarDespachos.php";
        </script>

    </body>
</html>


