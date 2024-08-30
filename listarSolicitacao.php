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
<!DOCTYPE>
<html lang="pt-br">
<head>
<meta name="viewport" content="width=device-width">
<meta charset="utf-8">
<link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css">
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<title>Solicitações</title>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">
</head>
<body style="font-family: courier">

<div class="menu_listar">
  <?php
  $usuario = $_SESSION['login_usuario'];
  $admin = $_SESSION['nivel'];
  $direcao = $_SESSION['direcao'];
  include ('menu.php');
  ?>
  
  <div id="main" class="container-fluid">
    <div class="" style="display: flex;float: right;justify-content: flex-end;">
      <a href="solicita.php" class="btn btn-primary pull-right h2">Nova Solicitação</a>
    </div>
    
    <div id="top" class="row">
      <div style=" margin-left: 40%">
        <h2><b>Solicitações</b></h2>
      </div>
    </div>
    
    <div id="list" class="row">
      <div class="table-responsive col-md-12">
        
        <hr>
        <!-- ####################################################################################################### -->
        
        <div  style=" margin-left: 40%">
          <h4><b>Solicitações Pendentes</b></h4>
        </div>
        
        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
          <thead>
            <tr>
              
              <th style="width: 5%">ID
                <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 18%">Solicitante
                <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 3%">Setor</th>

              <th style="width: 10%">Data Saída
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 11%">Data Retorno
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
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
              $nomeCampo = $_GET['campo'];
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 5 ORDER BY $nomeCampo";
            } elseif ($_GET['ordem'] == "decrescente") {
              $nomeCampo = $_GET['campo'];
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 5 ORDER BY $nomeCampo desc";
            } elseif ($_GET['ordem'] == "") {
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 5 ORDER BY dtSaida ASC, hrSaida ASC";
            }
            
            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            
            while ($registro = mysql_fetch_array($resultado)) {
              ?>
              <tr>

                <td style="background: indianred">
                  <b><a href=controle.php?id=<?= $registro["codSolicitacao"] ?>>
                    <?= $registro["codSolicitacao"] ?>
                  </a></b>
                </td>
                
                <td style="background: indianred"><?= $registro["nome"] ?></td>
                
                <td style="background: indianred"><?= $registro["nomeSetor"] ?></td>
                
                <td style="background: indianred">
                <?= formatoData($registro["dtSaida"]) ?><br><?= $registro["hrSaida"] ?>
                </td>
                
                <td style="background: indianred">
                  <?= formatoData($registro["dtRetorno"]) ?> <br><?= $registro["hrRetorno"] ?>
                </td>
                
                <td style="background: indianred"><?= $registro["destino"] ?></td>
                
                <td style="background: indianred" class="actions">
                  <a class="btn btn-success btn-small" title="Visualizar" style="margin-bottom:4px"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <a class="btn btn-warning btn-small" style="margin-bottom:4px"
                    href=editarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Editar">
                    <img src="imagens/editar.png" alt="edit">
                  </a>
                  <a class="btn  btn-small  btn-primary "title="Imprimir" style="margin-bottom:4px"
                    href=pdfSolicitaListar.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/imprimir.png" alt="print">
                  </a>
                  <a class="btn btn-danger btn-small" style="margin-bottom:4px"
                    href=excluirSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Excluir">
                    <img src="imagens/excluir.png" alt="delete">
                  </a>
                  <?php if ($direcao == 1) { ?>
                  <a class="btn btn-info btn-small" title="Aprovar Solicitação" style="margin-bottom:4px"
                    href=autorizandoSolicitacao.php?auth=true&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/aprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <a class="btn btn-default btn-small" title="Negar Solicitação" style="margin-bottom:4px"
                    href=despachoSolicitacao.php?auth=false&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/desaprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <?php } ?>
                </td>

              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
        
        <hr>
        <!-- ####################################################################################################### -->

        <div style=" margin-left: 40%">
          <h4><b>Solicitações a Autorizar</b></h4>
        </div>
        
        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
          <thead>
            <tr>
              
              <th style="width: 5%">ID
                <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 15%">Solicitante
                <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 3%">Setor</th>
              
              <th style="width: 10%">Data Saída
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 11%">Data Retorno
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
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
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 1 ORDER BY $nomeCampo";
            } elseif ($_GET['ordem'] == "decrescente") {
              $nomeCampo = $_GET['campo'];
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 1 ORDER BY $nomeCampo desc";
            } elseif ($_GET['ordem'] == "") {
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
              statusSolicitacao = 1 ORDER BY dtSaida ASC, hrSaida ASC";
            }
            
            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            
            while ($registro = mysql_fetch_array($resultado)) {
              ?>
              <tr>

                <td style="background: #F7E741">
                  <a href=controle.php?id=<?= $registro["codSolicitacao"] ?>><?= $registro["codSolicitacao"] ?>
                </td>

                <td style="background: #F7E741"><?= $registro["nome"] ?></td>

                <td style="background: #F7E741"><?= $registro["nomeSetor"] ?></td>

                <td style="background: #F7E741">
                  <?= formatoData($registro["dtSaida"]) ?><br> <?= $registro["hrSaida"] ?>
                </td>

                <td style="background:  #F7E741">
                  <?= formatoData($registro["dtRetorno"]) ?><br><?= $registro["hrRetorno"] ?>
                </td>

                <td style="background: #F7E741"><?= $registro["destino"] ?></td>
                
                <td style="background:  #F7E741" class="actions">
                  <a class="btn btn-success btn-small" title="Visualizar" style="margin-bottom:4px"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <a class="btn btn-warning btn-small" style="margin-bottom:4px"
                    href=editarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Editar">
                    <img src="imagens/editar.png" alt="edit">
                  </a>
                  <a class="btn  btn-small  btn-primary "title="Imprimir" style="margin-bottom:4px"
                    href=pdfSolicitaListar.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/imprimir.png" alt="print">
                  </a>
                  <a class="btn btn-danger btn-small" style="margin-bottom:4px"
                    href=excluirSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Excluir">
                    <img src="imagens/excluir.png" alt="del">
                  </a>
                  <?php if ($direcao == 1) { ?>
                  <a class="btn btn-info btn-small" title="Aprovar Solicitação" style="margin-bottom:4px"
                    href=autorizandoSolicitacao.php?auth=true&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/aprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <a class="btn btn-default btn-small" title="Negar Solicitação" style="margin-bottom:4px"
                    href=despachoSolicitacao.php?auth=false&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/desaprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <?php } ?>
                </td>

              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
        
        <hr>
        <!-- ####################################################################################################### -->

        <div style=" margin-left: 40%">
          <h4><b>Solicitações Autorizadas</b></h4>
        </div>
        
        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
          <thead>
            <tr>
              
              <th style="width: 5%">ID
                <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 15%">Solicitante
                <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 3%">Setor</th>
                                  
              <th style="width: 10%">Data Saída
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 11%">Data Retorno
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
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
              $pesquisa = "SELECT * FROM listarsolicitacao
                WHERE statusSolicitacao = 6 ORDER BY $nomeCampo";
            } elseif ($_GET['ordem'] == "decrescente") {
              $nomeCampo = $_GET['campo'];
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 6 ORDER BY $nomeCampo desc";
            } elseif ($_GET['ordem'] == "") {
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 6 ORDER BY dtSaida ASC, hrSaida ASC";
            }
            
            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
              ?>
              <tr>
                
                <td style="background:  #85a2cd">
                  <a href=controle.php?id=<?= $registro["codSolicitacao"] ?>><?= $registro["codSolicitacao"] ?>
                </td>
                
                <td style="background:  #85a2cd"><?= $registro["nome"] ?></td>

                <td style="background:  #85a2cd"><?= $registro["nomeSetor"] ?></td>
                                        
                <td style="background:  #85a2cd">
                  <?= formatoData($registro["dtSaida"]) ?> <br> <?= $registro["hrSaida"] ?>
                </td>
                                        
                <td style="background:  #85a2cd">
                  <?= formatoData($registro["dtRetorno"]) ?> <br> <?= $registro["hrRetorno"] ?>
                </td>
                                        
                <td style="background:  #85a2cd"><?= $registro["destino"] ?></td>
                                        
                <td class="actions"style="background: #85a2cd">
                  <a class="btn btn-success btn-small" title="Visualizar"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <a class="btn btn-warning btn-small"
                    href=editarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Editar">
                    <img src="imagens/editar.png" alt="">
                  </a>
                  <a class="btn btn-small btn-primary" title="Imprimir"
                    href=pdfSolicitaListar.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/imprimir.png" alt="print">
                  </a>
                  <a class="btn btn-danger btn-small"
                    href=excluirSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>title="Excluir">
                    <img src="imagens/excluir.png" alt="delete">
                  </a>
                  <?php if ($direcao == 1) { ?>
                  <a class="btn btn-default btn-small" title="Negar Solicitação" style="margin-bottom:4px"
                    href=despachoSolicitacao.php?auth=false&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/desaprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <?php } ?>
                </td>

              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>

        <hr>
        <!-- ####################################################################################################### -->

        <div style=" margin-left: 40%">
          <h4><b>Solicitações Confirmadas</b></h4>
        </div>
        
        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
          <thead>
            <tr>
              
              <th style="width: 5%">ID
                <a href="listarSolicitacao.php?ordem=crescente&campo=codSolicitacao" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=codSolicitacao" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 15%">Solicitante
                <a href="listarSolicitacao.php?ordem=crescente&campo=nome" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=nome" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 3%">Setor</th>
                                  
              <th style="width: 10%">Data Saída
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtSaida" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtSaida" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
              </th>
              
              <th style="width: 11%">Data Retorno
                <a href="listarSolicitacao.php?ordem=crescente&campo=dtRetorno" title="crescente">
                  <img src="imagens/seta-cima.png" alt="up">
                </a>
                <a href="listarSolicitacao.php?ordem=decrescente&campo=dtRetorno" title="decrescente">
                  <img src="imagens/seta-baixo.png" alt="down"/>
                </a>
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
              $pesquisa = "SELECT * FROM listarsolicitacao
                WHERE statusSolicitacao = 2 ORDER BY $nomeCampo";
            } elseif ($_GET['ordem'] == "decrescente") {
              $nomeCampo = $_GET['campo'];
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 2 ORDER BY $nomeCampo desc";
            } elseif ($_GET['ordem'] == "") {
              $pesquisa = "SELECT * FROM listarsolicitacao WHERE
                statusSolicitacao = 2 ORDER BY dtSaida ASC, hrSaida ASC";
            }
            
            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
              ?>
              <tr>
                
                <td style="background:  #5eb95e">
                  <a href=controle.php?id=<?= $registro["codSolicitacao"] ?>><?= $registro["codSolicitacao"] ?>
                </td>
                
                <td style="background:  #5eb95e"><?= $registro["nome"] ?></td>

                <td style="background:  #5eb95e"><?= $registro["nomeSetor"] ?></td>
                                        
                <td style="background:  #5eb95e">
                  <?= formatoData($registro["dtSaida"]) ?> <br> <?= $registro["hrSaida"] ?>
                </td>
                                        
                <td style="background:  #5eb95e">
                  <?= formatoData($registro["dtRetorno"]) ?> <br> <?= $registro["hrRetorno"] ?>
                </td>
                                        
                <td style="background:  #5eb95e"><?= $registro["destino"] ?></td>
                                        
                <td class="actions"style="background: #5eb95e">
                  <a class="btn btn-success btn-small" title="Visualizar"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <a class="btn btn-warning btn-small"
                    href=editarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?> title="Editar">
                    <img src="imagens/editar.png" alt="">
                  </a>
                  <a class="btn btn-small btn-primary" title="Imprimir"
                    href=pdfSolicitaListar.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/imprimir.png" alt="print">
                  </a>
                  <a class="btn btn-danger btn-small"
                    href=excluirSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>title="Excluir">
                    <img src="imagens/excluir.png" alt="delete">
                  </a>
                </td>

              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
