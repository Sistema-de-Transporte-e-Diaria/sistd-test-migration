<?php include ('validar_session_diaria.php'); 

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finaliza Diária</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">

        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodDiaria = $_POST[setCodDiaria];
        $getDesc = $_POST[setDesc];
       

        $sql = "UPDATE diarias set descPrestarConta='$getDesc',
                          statusDiaria='2'
                          WHERE codDiaria='$getCodDiaria'";

        conecta();
        $sql11 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        ?>
       
            <script type="text/javascript">
                var idDiaria = '<?php echo $getCodDiaria; ?>';               
                window.open('pdfPrestarContas.php?id='+idDiaria);
            </script>
            
            <script language=javascript>alert('Diária finalizada com sucesso!');</script>   
            <script language= "JavaScript">
                location.href = "listarDiariasSolicitante.php";
            </script>


    </body>
</html>




