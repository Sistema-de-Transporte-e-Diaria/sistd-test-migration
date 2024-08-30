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
    header("Location: listarSolicitacaoSolicitante.php");
    exit();
}
?>
<html>
 <head> 

        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script.js"></script>    
        <title></title>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
</head>
<body  style="font-family: courier">

    <div class="menu_listar">
        <?php
        $usuario = $_SESSION['login_usuario'];
        $admin = $_SESSION['nivel'];
        include ('menu.php');
        ?>  
        <div id="main" class="container-fluid">
            <!-- <div class="col-md-3" style="left: 45%">
                 <a href="solicita.php" class="btn btn-primary pull-right h2">Nova Solicitação</a>
             </div>-->
            <div id="top" class="row">
                <div style=" margin-left: 40%">
                    <h2>Solicitações</h2>
                </div>
            </div> 

            <div id="list" class="row">
                <div class="table-responsive col-md-12">


                    <div  style=" margin-left: 40%">
                        <h4>Solicitações Pendentes</h4>
                    </div>
                    <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                        <thead> 
                            <tr>                           
                                <th style="width: 5%">ID 
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th> 

                                <th style="width: 18%">Solicitante
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th>    
                                <th style="width: 3%">Setor</th>
                                <th style="width: 10%">Data Saída
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 11%">Data Retorno
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 15%">Destino</th>
                                <th class="actions"style="width: 21%">Operações</th>
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
                            if ($_GET['ordem'] == "crescente") {
                                $nomeCampo4 = $_GET['campo'];

                                $pesquisa4 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo4";
                            } elseif ($_GET['ordem'] == "decrescente") {
                                $nomeCampo4 = $_GET['campo'];
                                $pesquisa4 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo4 desc";
                            } elseif ($_GET['ordem'] == "") {
                                $pesquisa4 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY statusSolicitacao ASC, codSolicitacao DESC";
                            }


                            $resultado4 = mysql_query($pesquisa4) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro4 = mysql_fetch_array($resultado4)) {

                                $status4 = $registro4["statusSolicitacao"];

                                if ($status4 == 5) {
                                    ?>

                                    <tr >
                                        <td style="background: indianred"><a href=controle.php?id=<?= $registro4["codSolicitacao"] ?>> <?= $registro4["codSolicitacao"] ?></a></td>
                                        <td style="background: indianred"><?= $registro4["nome"] ?></td> 
                                        <td style="background: indianred"><?= $registro4["nomeSetor"] ?></td>
                                        <td style="background: indianred"><?= formatoData($registro4["dtSaida"]) ?><br> <?= $registro4["hrSaida"] ?></td> 
                                        <td style="background: indianred"><?= formatoData($registro4["dtRetorno"]) ?> <br><?= $registro4["hrRetorno"] ?></td> 
                                        <td style="background: indianred"><?= $registro4["destino"] ?></td> 
                                        <td style="background: indianred" class="actions">
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href=visualizarSolicitacao.php?id=<?= $registro4["codSolicitacao"] ?>><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href=editarSolicitacao.php?id=<?= $registro4["codSolicitacao"] ?>
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn  btn-small  btn-primary "title="Imprimir" 
                                               href=pdfSolicitaListar.php?id=<?= $registro4["codSolicitacao"] ?>><img src="imagens/imprimir.png"></a>

                                            <a class="btn btn-danger btn-small"  href=excluirSolicitacao.php?id=<?= $registro4["codSolicitacao"] ?>
                                               title="Excluir"><img src="imagens/excluir.png"></a>
                                            <a class="btn btn-warning  btn-small"  href=despachoSolicitacao.php?id=<?= $registro4["codSolicitacao"] ?>
                                               title="Despacho"><img src="imagens/despacho.png"></a>

                                        </td>
                                    </tr>   

                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>


                    <div style=" margin-left: 40%">
                        <h4>Solicitações a Autorizar</h4>
                    </div>
                    <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                        <thead>
                           <tr>                           
                                <th style="width: 5%">ID 
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th> 

                                <th style="width: 15%">Solicitante
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th>    
                                <th style="width: 3%">Setor</th>
                                <th style="width: 10%">Data Saída
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 11%">Data Retorno
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 15%">Destino</th>
                                <th class="actions"style="width: 18%">Operações</th>
                            </tr>


                        </thead>
                        <tbody>
                            <?php
                            conecta();
                            if ($_GET['ordem'] == "crescente") {
                                $nomeCampo = $_GET['campo'];

                                $pesquisa1 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo";
                            } elseif ($_GET['ordem'] == "decrescente") {
                                $nomeCampo = $_GET['campo'];
                                $pesquisa1 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo desc";
                            } elseif ($_GET['ordem'] == "") {
                                $pesquisa1 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY statusSolicitacao ASC, codSolicitacao DESC";
                            }



                            $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro1 = mysql_fetch_array($resultado1)) {

                                $status1 = $registro1["statusSolicitacao"];
                                $privilegioSetor = $registro1["privilegioSetor"];

                                if ($status1 == 1) {
                                    ?>  

                                    <tr >
                                        <td style="background: #F7E741"><a href=controle.php?id=<?= $registro1["codSolicitacao"] ?>><?= $registro1["codSolicitacao"] ?></td>
                                        <td style="background:  #F7E741"><?= $registro1["nome"] ?></td> 
                                        <td style="background:  #F7E741"><?= $registro1["nomeSetor"] ?></td>
                                        <td style="background:  #F7E741"><?= formatoData($registro1["dtSaida"]) ?><br> <?= $registro1["hrSaida"] ?></td> 
                                        <td style="background:  #F7E741"><?= formatoData($registro1["dtRetorno"]) ?><br><?= $registro1["hrRetorno"] ?></td> 
                                        <td style="background: #F7E741"><?= $registro1["destino"] ?></td> 
                                        <td style="background:  #F7E741" class="actions">
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href=visualizarSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href=editarSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn  btn-small  btn-primary "title="Imprimir" 
                                               href=pdfSolicitaListar.php?id=<?= $registro1["codSolicitacao"] ?>><img src="imagens/imprimir.png"></a> 

                                            <a class="btn btn-danger btn-small"  href=excluirSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>
                                               title="Excluir"><img src="imagens/excluir.png"></a>
                                        </td>

                                    </tr>   
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>



                    <div style=" margin-left: 40%">
                        <h4>Solicitações Autorizadas</h4>
                    </div>
                    <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                        <thead>  
                              <tr>                           
                                <th style="width: 5%">ID 
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th> 

                                <th style="width: 15%">Solicitante
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th>    
                                <th style="width: 3%">Setor</th>
                                <th style="width: 10%">Data Saída
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 11%">Data Retorno
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                                <th style="width: 15%">Destino</th>
                                <th class="actions"style="width: 18%">Operações</th>
                            </tr>


                        </thead>
                        <tbody>
                            <?php
                            conecta();
                            if ($_GET['ordem'] == "crescente") {
                                $nomeCampo2 = $_GET['campo'];

                                $pesquisa2 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo2";
                            } elseif ($_GET['ordem'] == "decrescente") {
                                $nomeCampo2 = $_GET['campo'];
                                $pesquisa2 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY $nomeCampo2 desc";
                            } elseif ($_GET['ordem'] == "") {
                                $pesquisa2 = "SELECT * FROM listarsolicitacao WHERE statusSolicitacao <> 0 AND statusSolicitacao <> 4 ORDER BY statusSolicitacao ASC, codSolicitacao DESC";
                            }


                            $resultado2 = mysql_query($pesquisa2) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registro2 = mysql_fetch_array($resultado2)) {

                                $status2 = $registro2["statusSolicitacao"];
                                // if ($status2 == 2 || $status2 == 3) {
                                if ($status2 == 2) {
                                    ?>   

                                    <tr >

                                        <td style="background:  #5eb95e"><a href=controle.php?id=<?= $registro2["codSolicitacao"] ?>><?= $registro2["codSolicitacao"] ?></td>
                                        <td style="background:  #5eb95e"><?= $registro2["nome"] ?></td>                                       
                                        <td style="background:  #5eb95e"><?= $registro2["nomeSetor"] ?></td> 
                                        <td style="background:  #5eb95e"><?= formatoData($registro2["dtSaida"]) ?> <br> <?= $registro2["hrSaida"] ?></td> 
                                        <td style="background:  #5eb95e"><?= formatoData($registro2["dtRetorno"]) ?> <br> <?= $registro2["hrRetorno"] ?></td> 
                                        <td style="background:  #5eb95e"><?= $registro2["destino"] ?></td> 
                                        <td class="actions"style="background: #5eb95e">
                                            <a class="btn btn-success btn-small" title="Visualizar"
                                               href=visualizarSolicitacao.php?id=<?= $registro2["codSolicitacao"] ?>><img src="imagens/lupa.png"></a>                                                                                     
                                            <a class="btn btn-warning btn-small"  href=editarSolicitacao.php?id=<?= $registro2["codSolicitacao"] ?>
                                               title="Editar"><img src="imagens/editar.png"></a>
                                            <a class="btn  btn-small  btn-primary "title="Imprimir" 
                                               href=pdfSolicitaListar.php?id=<?= $registro2["codSolicitacao"] ?>><img src="imagens/imprimir.png"></a>  

                                            <a class="btn btn-danger btn-small"  href=excluirSolicitacao.php?id=<?= $registro2["codSolicitacao"] ?>
                                               title="Excluir"><img src="imagens/excluir.png"></a>

                                        </td>

                                    </tr>     
                                </tbody>

                                <?php
                            }
                        }
                        ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
