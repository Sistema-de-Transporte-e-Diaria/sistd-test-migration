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
                <h2>Setores</h2>
            </div>


            <div class="col-md-3" style="left: 45%">
                <a href="setor.php" class="btn btn-primary pull-right h2">Novo Setor</a>
            </div>
        </div> <!-- /#top -->

        <hr />
        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>
                        <tr>
                            <th>Sigla</th>
                            <th style="width: 50%" >Nome</th>  
                            <th style="width: 10%" >Privilégio</th> 
                            <th class="actions">Operações</th>
                        </tr>
                        <tr>
                            <th><input style="height: 25px" type="text" id="txtColuna1"/></th>
                            <th><input style="height: 25px; width: 600px" type="text" id="txtColuna2"/></th>
                            <th><input style="height: 25px" type="text" id="txtColuna3"/></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        conecta();
                        $sql = "SELECT * FROM setor
                          WHERE statusSetor='1'
                          ORDER BY nomeSetor ASC";
                        $res = mysql_query($sql);
                        
                        while ($row = mysql_fetch_assoc($res)) {
                            $priv =$row["privilegioSetor"];
                            ?>

                            <tr>
                                <td ><?= $row["nomeSetor"]; ?></td>
                                <td ><?= $row["descricao"]; ?></td>
                                <td ><?php
                                    if ($priv == "1") {
                                        echo "Sim";
                                    }
                                    if ($priv == "2") {
                                        echo "Não";
                                    }
                                    ?></td>
                                <td class="actions">                                   
                                    <a class="btn btn-warning btn-xs" href="editarSetor.php?id=<?= $row["codSetor"] ?>"><img src="imagens/editar.png"></a>
                                    <a class="btn btn-danger btn-xs"  href=excluirSetor.php?id=<?= $row["codSetor"] ?>"><img src="imagens/excluir.png"></a>
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


