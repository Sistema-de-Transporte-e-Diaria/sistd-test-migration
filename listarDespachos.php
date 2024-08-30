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
                <h2>Despachos de Solicitações</h2>
            </div>


            <div class="col-md-3" style="left: 45%">
                <a href="despacho.php" class="btn btn-primary pull-right h2">Novo Despacho</a>
            </div>
        </div> <!-- /#top -->

        <hr />
        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>
                        <tr>
                            <th style="width: 5%" >Nº Solicitação</th>
                            <th style="width: 30%" >Solicitante</th> 
                            <th style="width: 45%" >Descrição</th> 
                            <th class="actions"style="width: 15%">Operações</th>
                        </tr>
                        <tr>
                            <th><input style="height: 25px; width: 80%" type="text" id="txtColuna1"/></th>
                            <th><input style="height: 25px; width: 100%" type="text" id="txtColuna2"/></th>
                            <th><input style="height: 25px; width: 100%" type="text" id="txtColuna3"/></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        conecta();
                        $sql1 = "SELECT * FROM listardespachos
                          WHERE statusDespacho<>0
                          ORDER BY idDespacho DESC";
                        $res1 = mysql_query($sql1);
                        while ($row1 = mysql_fetch_assoc($res1)) {
                            ?>

                            <tr>
                                <td ><?= $row1["idSolicitacao_FK"]; ?></td>
                                <td ><?= $row1["nome"]; ?></td>
                                <td ><?= $row1["descricaoDespacho"]; ?></td>
                                <td class="actions">       
                                    <a class="btn btn-success btn-xs" href="visualizarDespacho.php?id=<?= $row1["idDespacho"] ?>"><img src="imagens/lupa.png"></a>
                                    <a class="btn btn-warning btn-xs" href="editarDespacho.php?id=<?= $row1["idDespacho"] ?>"><img src="imagens/editar.png"></a>
                                    <a class="btn btn-danger btn-xs"  href=excluirDespacho.php?id=<?= $row1["idDespacho"] ?>"><img src="imagens/excluir.png"></a>
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


