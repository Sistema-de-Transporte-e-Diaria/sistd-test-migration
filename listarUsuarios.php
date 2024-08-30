<?php
include ('validar_session.php');

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
                <h2>Usuários</h2>
            </div>


            <div class="col-md-3" style="left: 45%">
                <a href="usuarios.php" class="btn btn-primary pull-right h2">Novo Usuário</a>
            </div>
        </div> <!-- /#top -->

        <hr />
        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>
                        
                        <tr>

                            <td style="width: 5%">SIAPE</td>
                            <td style="width: 25%">Nome</td>
                            <td style="width: 10%">Fone</td>
                            <td style="width: 10%">Setor</td>
                            <td style="width: 25%">Email</td>
                            <td  style="width: 10%">Nível de Acesso</td>
                            <td style="width: 15%">Operações</td>
                        </tr>
                        <tr>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna1"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna2"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna3"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna4"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna5"/></th>
                            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna6"/></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        conecta();
                        $pesquisa = "SELECT * FROM listarsolicitantes WHERE statusSolicitante = 1
                          ORDER BY nome ASC";

                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            $nivel = $registro['administrador'];
                            ?>

                            <tr >
                                <td ><?= $registro["siape"] ?></td>
                                <td><?= $registro["nome"] ?></td>
                                <td><?= $registro["telefone"] ?></td> 
                                <td><?= $registro["nomeSetor"] ?></td> 
                                <td><?= $registro["email"] ?></td>

                                <td>
                                    <?php
                                    if ($nivel == 1) {
                                        echo "Solicitante";
                                    }
                                    if ($nivel == 2) {
                                        echo "Administrador";
                                    }
                                    if ($nivel == 3) {
                                        echo "TI";
                                    }
                                    if($nivel == 4){
                                            echo "Portaria";
                                        }
                                    ?> 
                                </td>
                                <td  class="actions">    
                                    <a class="btn btn-warning btn-small" href=editarUsuario.php?id=<?= $registro["siape"] ?>
                                       title="Editar"><img src="imagens/editar.png"></a> 
                                    <a class="btn btn-danger btn-small" href=excluirUsuario.php?id=<?= $registro["siape"] ?>
                                       title="Excluir"><img src="imagens/excluir.png"></a> 
                                   <!-- <?php
                                       if ($registro['statusSolicitante'] == 1) {
                                           ?>           
                                        <a href=desativaUsuario.php?id=<?= $registro["siape"] ?> title="Desativar"/><img src="imagens/usuarioDesativa18x18.png"/>        
                                        <?php
                                    } else {
                                        ?>
                                        <a href=ativaUsuario.php?id=<?= $registro["siape"] ?> title="Ativar"/><img src="imagens/usuarioAtiva18x18.png"/>     
                                    <?php } ?> -->
                                </td>
                            <?php } ?>
                        </tr> 

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</body>
</html>
