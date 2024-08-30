
<?php include ('validar_session_diaria.php'); 
conecta();

?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finalizar de Diária</title>
        
       <script language="JavaScript" type="text/javascript" src="script.js"></script>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
 <body style="font-family: courier">
 <?php 
       $codDiariaFinalizar = $_GET['id'];
       //  Atualiza o campus statusMotorista para 0, deixando o registro como excluído para o sistema
        conecta();
        $sql = "UPDATE diarias SET statusDiaria=3
                                WHERE codDiaria='$codDiariaFinalizar'";
        $resultado = mysql_query($sql) or die ("Houve um erro de banco de dados: ".mysql_error());       
        gravaLog("Finalizou a diária nº $codDiariaFinalizar");
?>
  
   
     <script language=javascript>alert('Diária Finalizada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarDiariasSolicitante.php";
        </script>
  </body>
</html>
