<?php include ('validar_session_diaria.php');

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
<body  style="font-family: courier">

    <?php
    // Caso o usuário seja administrador será exibido o menu */
    $usuario = $_SESSION['login_usuario'];
    $admin = $_SESSION['nivel'];
    include "menuDiarias.php";
    ?>
   <div id="main" class="container-fluid">
        <div id="top" class="row">
            <div class="col-md-3">
                <h2>Diárias</h2>
            </div>

            <div class="col-md-3" style="left: 45%">
                <a href="diaria.php" class="btn btn-primary pull-right h2">Nova Diária</a>
            </div>
        </div> 

        <div id="list" class="row">
            <div class="table-responsive col-md-12">
                <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                    <thead>
                        <tr>                           
                            <th style="width: 5%">ID</th> 
                            <th style="width: 20%">Solicitante</th>
                            <th style="width: 10%">Cidade Destino</th>
                            <th style="width: 20%">Local do Evento</th>
                            <th style="width: 10%">Data Início</th>
                            <th style="width: 10%">Data Término</th>
                            <th class="actions"style="width:25%">Operações</th>
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
                        $pesquisaAdminDiaria = "SELECT * FROM manutencao";                       
                        $resultadoAdminDiaria = mysql_query($pesquisaAdminDiaria) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registroAdminDiaria = mysql_fetch_array($resultadoAdminDiaria)) {
                            $adminDiaria = $registroAdminDiaria['adminDiaria'];
                        }

                        if ($_SESSION['login_usuario'] == $adminDiaria) {

                            $pesquisa = "SELECT * FROM listardiarias
                        WHERE statusDiaria <> 0 AND  statusDiaria <> 3
                        ORDER BY statusDiaria DESC";
                            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro = mysql_fetch_array($resultado)) {
                                $statusDiaria = $registro['statusDiaria'];
                                if ($statusDiaria == 1) {
                                    ?>

                                    <tr>                                    
                                        <td style="background: darkseagreen"><a href=controleDiaria.php?id=<?= $registro["codDiaria"] ?>><?= $registro["codDiaria"] ?></td>
                                        <td style="background: darkseagreen"><?= $registro["solicitante"] ?></td>
                                        <td style="background: darkseagreen"><?= $registro["nome"] ?></td> 
                                        <td style="background: darkseagreen"><?= $registro["localEvento"] ?></td>
                                        <td style="background: darkseagreen"><?= formatoData($registro["dtInicio"]) ?></td> 
                                        <td style="background: darkseagreen"><?= formatoData($registro["dtFim"]) ?></td>           
                                        <td style="background: darkseagreen" class="actions">
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href="visualizarDiaria.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href="editarDiaria.php?id=<?= $registro["codDiaria"] ?>" 
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn btn-primary btn-small" title="Imprimir" 
                                               href="pdfSolicitaDiariaSolicitante.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/imprimir.png"></a>  
                                            <a class="btn btn-danger btn-small"  href=excluirDiaria.php?id=<?= $registro["codDiaria"] ?> 
                                               title="Excluir"><img src="imagens/excluir.png"></a>
                                        </td>
                                    </tr>

                                    <?php
                                }if($statusDiaria == 2){ 
                                    ?>
                                    <tr >            
                                        <td style="background: #da4f49"><a href=controleDiaria.php?id=<?= $registro["codDiaria"] ?>><?= $registro["codDiaria"] ?></td>
                                        <td style="background: #da4f49"><?= $registro["solicitante"] ?></td>
                                        <td style="background: #da4f49"><?= $registro["nome"] ?></td> 
                                        <td style="background: #da4f49"><?= $registro["localEvento"] ?></td>
                                        <td style="background: #da4f49"><?= formatoData($registro["dtInicio"]) ?></td> 
                                        <td style="background: #da4f49"><?= formatoData($registro["dtFim"]) ?></td>           
                                        <td style="background: #da4f49" class="actions">
                                             <a class="btn  btn-small"  href="finalizarDiaria.php?id=<?= $registro["codDiaria"] ?>"
                                               title="Finalizar"><img src="imagens/ok.png"></a>
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href="visualizarDiaria.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href="editarDiaria.php?id=<?= $registro["codDiaria"] ?>" 
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn btn-primary  btn-small" title="Imprimir" 
                                               href="pdfSolicitaDiariaSolicitante.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/imprimir.png"></a>  
                                             <a class="btn btn  btn-small" title="Imprimir Pretação de Contas" 
                                                href="pdfPrestarContas.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/imprimir.png"></a>  
                                            
                                            <a class="btn btn-danger btn-small"  href="excluirDiaria.php?id=<?= $registro["codDiaria"] ?> "
                                               title="Excluir"><img src="imagens/excluir.png"></a>
                                           
                                    </tr>     

                                    <?php
                                }
                            }
                        } else {
                            $nomeSolicitante = $_SESSION['logado'];

                            $pesquisa = "SELECT * FROM listardiarias
                        WHERE statusDiaria = 1 AND solicitante = '$nomeSolicitante'
                        ORDER BY codDiaria";


                            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro = mysql_fetch_array($resultado)) {
                                if (strtotime($registro['dtFim']) > strtotime(date("Y-m-d"))) {
                                    ?>
                                    <tr>                                    
                                        <td style="background: #C4B14A"><a href=controleDiaria.php?id=<?= $registro["codDiaria"] ?> title="Prestar Contas"><?= $registro["codDiaria"] ?></td>
                                        <td style="background: #C4B14A"><?= $registro["solicitante"] ?></td>
                                        <td style="background: #C4B14A"><?= $registro["nome"] ?></td> 
                                        <td style="background: #C4B14A"><?= $registro["localEvento"] ?></td>
                                        <td style="background: #C4B14A"><?= formatoData($registro["dtInicio"]) ?></td> 
                                        <td style="background: #C4B14A"><?= formatoData($registro["dtFim"]) ?></td>           
                                        <td style="background: #C4B14A" class="actions">                                          
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href="visualizarDiaria.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href="editarDiaria.php?id=<?= $registro["codDiaria"] ?>" 
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn  btn-small  btn-primary "title="Imprimir" 
                                               href="pdfSolicitaDiariaSolicitante.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/imprimir.png"></a>  
                                            <a class="btn btn-danger btn-small"  href=excluirDiaria.php?id=<?= $registro["codDiaria"] ?> 
                                               title="Excluir"><img src="imagens/excluir.png"></a>

                                        </td>
                                    </tr>                                  

                                    <?php
                                } else {
                                    ?>

                                    <tr>                                    
                                        <td style="background: indianred"><a href=controleDiaria.php?id=<?= $registro["codDiaria"] ?> title="Prestar Contas"><?= $registro["codDiaria"] ?></td>
                                        <td style="background: indianred"><?= $registro["solicitante"] ?></td>
                                        <td style="background: indianred"><?= $registro["nome"] ?></td> 
                                        <td style="background: indianred"><?= $registro["localEvento"] ?></td>
                                        <td style="background: indianred"><?= formatoData($registro["dtInicio"]) ?></td> 
                                        <td style="background: indianred"><?= formatoData($registro["dtFim"]) ?></td>           
                                        <td style="background: indianred" class="actions">
                                             <a class="btn  btn-info btn-lg btn-primary"  href="controleDiaria.php?id=<?= $registro["codDiaria"] ?>"
                                               title="Prestar Contas"><img src="imagens/ok.png"></a>
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href="visualizarDiaria.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href="editarDiaria.php?id=<?= $registro["codDiaria"] ?>" 
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn  btn-small btn-primary"  title="Imprimir" 
                                               href="pdfSolicitaDiariaSolicitante.php?id=<?= $registro["codDiaria"] ?>"><img src="imagens/imprimir.png"></a>  
                                            <a class="btn btn-danger btn-small"  href=excluirDiaria.php?id=<?= $registro["codDiaria"] ?> 
                                               title="Excluir"><img src="imagens/excluir.png"></a>

                                        </td>
                                    </tr>  
                                    <?php
                                }
                            }
                        }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
