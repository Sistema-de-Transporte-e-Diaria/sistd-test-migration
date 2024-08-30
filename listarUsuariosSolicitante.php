<?php
include ('validar_session.php');
$solicitante = $_SESSION['login_usuario'];
$admin = $_SESSION['nivel'];


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
                    <h2>Usuário</h2>
                </div>

            </div>
            <div id="list" class="row">
                <div class="table-responsive col-md-12">
                    <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">                      
                        <thead>  
                            <tr>

                                <td>SIAPE</td>
                                <td style="width: 25%">Nome</td>
                                <td>Fone</td>
                                <td style="width: 5%">Setor</td>
                                <td>Email</td>
                                <td  style="width: 13%">Nível de Acesso</td>
                                <td style="width: 10%">Operações</td>
                            </tr>


                        </thead>
                        <tbody>
                            <?php
                            $pesquisa = "SELECT * FROM listarsolicitantes
                         WHERE siape = '$solicitante'
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
                                        <a class="btn btn-warning btn-small"   
                                           href=editarUsuario.php?id=<?= $registro["siape"] ?> title="Editar"><img src="imagens/editar.png"></a>                                            
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

