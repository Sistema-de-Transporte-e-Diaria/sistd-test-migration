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
<body style="font-family: courier">
    <?php include ('menu.php'); ?> 
    <div id="main" class="container-fluid">
        <div id="top" class="row">
            <div class="col-md-3">
                <h2>Folgas Motoristas</h2>
            </div>
             <div class="col-md-3" style="left: 45%">
                 <a href="folgaMot.php" class="btn btn-primary pull-right h2">Nova Folga</a>
            </div>
        </div> 
        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>  


                        <tr>
                            <th style="width: 35%">Motorista</th>
                            <th>Quantidade de Horas</th>
                            <th>Data Folga</th>
                            <th style="width: 15%">Operações</th>
                        </tr>
                        <tr>
                            <th><input style="height: 25px;width: 90%" type="text" id="txtColuna2"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna3"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna4"/></th>
                    </thead>
                    <tbody>
                        <?php
                        conecta();
                        $pesquisa = "SELECT * FROM listarfolga
                           WHERE statusFolga = '1'";
                        gravaLog("Listou as folgas");
                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?>

                            <tr >
                                <td><?= $registro["motorista"] ?></td>
                                <td ><?= $registro["quantHoraFolga"] ?></td> 
                                <td ><?= formatoData($registro["dataFolga"]) ?></td>
                                <td class="actions">  
                                    <a class="btn btn-success btn-small"  href=visualizarFolgaMot.php?id=<?= $registro["idFolga"] ?>
                                       title="Visualizar"><img src="imagens/lupa.png"></a>
                                    <a class="btn btn-warning btn-small"  href=editarFolgaMot.php?id=<?= $registro["idFolga"] ?>
                                       title="Editar"><img src="imagens/editar.png"></a>
                                    <a class="btn btn-primary btn-small"  href=pdfBancoHorasReimprime.php?id=<?= $registro["idFolga"] ?>
                                       title="Imprimir"><img src="imagens/imprimir.png"></a>
                                    <a class="btn btn-danger btn-small"  href=excluirFolgaMot.php?id=<?= $registro["idFolga"] ?>
                                       title="Excluir"><img src="imagens/excluir.png"></a>
                                </td>
                            </tr>  
                        </tbody>
                    <?php } ?>
                </table>

            </div>
        </div>
    </div>
</body>
</html>
