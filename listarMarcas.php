<html>
    <?php
    include 'validar_session.php';
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

    <head>       
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script.js"></script>  

        <title></title>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
</head>

<?php include 'menu.php'; ?>
<body style="font-family: courier">

    <div id="main" class="container-fluid">
        <div id="top" class="row">
            <div class="col-md-3">
                <h2>Marcas de Veículo</h2>
            </div>


            <div class="col-md-3" style="left: 45%">
                <a href="marca.php" class="btn btn-primary pull-right h2">Nova Marca de Veículo</a>
            </div>
        </div> <!-- /#top -->

        <hr />
        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>
                        <tr>
                            <th style="width: 80%" >Nome</th>                            
                            <th class="actions">Operações</th>
                        </tr>
                        <tr>
                            <th><input style="height: 25px; width: 80%" type="text" id="txtColuna1"/></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        conecta();
                        $sql = "SELECT * FROM marcas
                          WHERE statusMarca='1'
                          ORDER BY nomeMarca ASC";
                        $res = mysql_query($sql);
                        while ($row = mysql_fetch_assoc($res)) {
                            ?>

                            <tr>
                                <td ><?= $row["nomeMarca"]; ?></td>
                                <td class="actions">                                   
                                    <a class="btn btn-warning btn-xs" href="editarMarca.php?id=<?= $row["idMarca"] ?>"><img src="imagens/editar.png"></a>
                                    <a class="btn btn-danger btn-xs"  href=excluirMarca.php?id=<?= $row["idMarca"] ?>"><img src="imagens/excluir.png"></a>
                                </td>
                            <?php } ?>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div> <!-- /#list -->

    </div>


</body>
</html>


