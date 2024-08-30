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
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="script.js"></script>  

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


                    <div style=" margin-left: 40%">
                        <h4>Solicitações Autorizadas</h4>
                    </div>
                    <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
                        <thead>  
                            <tr>                           
                                <th style="width: 6%">ID 
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th> 
                                <th style="width: 25%">Solicitante
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>                                    
                                </th>                                
                                <th style="width: 12%">Data Saída
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                                        <img src="imagens/seta-cima.png"></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                               <!-- <th style="width: 7%">Hora Saída</th>-->
                                <th style="width: 13%">Data Retorno
                                    <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                                        <img src="imagens/seta-cima.png" ></a>
                                    <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                                        <img src="imagens/seta-baixo.png" /></a>
                                </th>
                             <!--   <th style="width: 7%">Hora Retorno</th>-->
                                <th style="width: 5%">Setor</th>
                                <th style="width: 20%">Destino</th>                              
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
                                        <td style="background:  #5eb95e"><a href=controlePortaria.php?id=<?= $registro2["codSolicitacao"] ?>><?= $registro2["codSolicitacao"] ?></td>
                                        <td style="background:  #5eb95e"><?= $registro2["nome"] ?></td>                                       
                                        <td style="background:  #5eb95e"><?= formatoData($registro2["dtSaida"]) ?></td> 
                                     <!--   <td style="background: darkseagreen"><?= $registro2["hrSaida"] ?></td> -->
                                        <td style="background:  #5eb95e"><?= formatoData($registro2["dtRetorno"]) ?></td> 
                                     <!--   <td style="background: darkseagreen"><?= $registro2["hrRetorno"] ?></td>--> 
                                        <td style="background:  #5eb95e"><?= $registro2["nomeSetor"] ?></td> 
                                        <td style="background:  #5eb95e"><?= $registro2["destino"] ?></td>   
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
