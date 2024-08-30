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
        <div class="menu_listar">
            <?php include ('menu.php'); ?> 
            <div id="main" class="container-fluid">
                <div id="top" class="row">
                    <div class="col-md-3">
                        <h2>Abastecimentos</h2>
                    </div>
                    <div class="col-md-3" style="left: 45%">
                        <a href="abastecimento.php" class="btn btn-primary pull-right h2">Novo Abastecimento</a>
                    </div>
                </div>
                <div id="list" class="row">
                    <div class="table-responsive col-md-12">
                        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">                      
                            <thead>  

                                <tr>
                                    <th>Motorista</th>
                                    <th style="width: 15%">Veículo</th>
                                    <th style="width: 10%">Data do Abastecimento</th>
                                    <th style="width: 10%">Valor por Litro</th>
                                    <th style="width: 7%">Quantidade</th>
                                    <th>Valor Total</th>
                                    <th style="width: 8%">Km Atual</th>
                                    <th style="width: 10%">Operações</th>
                                </tr>
                                <tr>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna2"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna3"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna4"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna5"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna6"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna7"/></th>
                                    <th><input style="height: 25px;width: 100%" type="text" id="txtColuna8"/></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                conecta();
                                $pesquisa = "SELECT * FROM listarabastecimento
                            WHERE statusAbast = '1'
                            ORDER BY codAbastecimento";
                                $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                                While ($registro = mysql_fetch_array($resultado)) {
                                    ?>

                                    <tr align="left">
                                        <td ><?= $registro["motorista"] ?></td>
                                        <td ><?= $registro["modelo"] ?></td>
                                        <td ><?= formatoData($registro["dtAbastecimento"]) ?></td> 
                                        <td >&nbsp;&nbsp;R$ <?= $registro["vlrLitro"] ?></td> 
                                        <td ><?= $registro["qtd"] ?></td> 
                                        <td >&nbsp;R$ <?= $registro["vlrTotal"] ?></td> 
                                        <td ><?= $registro["kmAtual"] ?></td> 
                                        <td  class="actions">                                                                                                                              
                                            <a class="btn btn-warning btn-small"   href=editarAbast.php?id=<?= $registro["codAbastecimento"] ?>
                                               title="Editar"><img src="imagens/editar.png"></a>                                            
                                            <a class="btn btn-danger btn-small" href=excluirAbast.php?id=<?= $registro["codAbastecimento"] ?>
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
