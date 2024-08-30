<?php include ('validar_session_diaria.php');

?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Exclusão de Diária</title>   
    <script language="JavaScript" type="text/javascript" src="script.js"></script>
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive">
<body style="font-family: courier">
    <?php
    $codDiariaExcluir = $_GET['id'];
    //  Atualiza o campus statusMotorista para 0, deixando o registro como excluído para o sistema
    conecta();
    $sql = "UPDATE diarias SET statusDiaria=0
                                WHERE codDiaria='$codDiariaExcluir'";
    $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
    gravaLog("Excluiu a diária nº $codDiariaExcluir");
    ?>


    <script language=javascript>alert('Diária excluída com sucesso!');</script>   
    <script language= "JavaScript">
        location.href = "listarDiariasSolicitante.php";
    </script>
</body>
</html>
