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
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script.js"></script>  

    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
</head>
<?php include ('menu.php'); ?> 
<body  style="font-family: courier">
    <div id="main" class="container-fluid">
        <div id="top" class="row">
            <div class="col-md-3">
                <h2>Registro de Acessos</h2>
            </div>
        </div> 
        <div id="list" class="row">
            <div class="table-responsive col-md-12">               
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>   
                        <tr>
                            <td>ID</td>
                            <td>Usuário</td>
                            <td>Tipo</td>
                            <td>Data</td>
                            <td>Hora</td>
                            <td>IP</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        conecta();
                        $pesquisa = "SELECT * FROM log
                        ORDER BY idLog DESC LIMIT 22";

                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?>

                        <td ><?= $registro["idLog"] ?></td>
                        <td><?= $registro["usuario"] ?></td>
                        <td ><?= $registro["tipoModificacao"] ?></td> 
                        <td ><?= formatoData($registro["data"]) ?></td> 
                        <td ><?= $registro["hora"] ?></td> 
                        <td ><?= $registro["ip"] ?></td> 
                        </tbody>  
                         <?php } ?>
                    </table>
               
            </div>
        </div>
    </div>
</body>
</html>
