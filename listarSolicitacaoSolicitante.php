<?php
include ('validar_session.php');
$solicitante = $_SESSION['login_usuario'];
$admin = $_SESSION['nivel'];

?>
<!DOCTYPE>
<html lang="pt-br">
<head>
  <title>Solicitações</title>
  <meta name="viewport" content="width=device-width">
  <meta charset="utf-8">
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
  <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css"
    rel="stylesheet" />
  <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script.js"></script>

  <img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner" />
</head>

<?php
// Caso o usuário seja administrador será exibido o menu */
include "menu.php";
?>

<body style="font-family: courier">

<div id="main" class="container-fluid">
  
  <div id="top" class="row">
    <div class="col-md-3"style=" margin-left: 35%">
      <h2>Suas Solicitações</h2>
    </div>
  </div>

  <div id="list" class="row">
    <div class="table-responsive col-md-12">
      <div style=" margin-left: 37%">
        <h4>Solicitações Pendentes</h4>
      </div>
      
      <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
        <thead>
          <tr>
            <th style="width: 6%">ID</th>
            <th style="width: 35%">Solicitante</th>
            <th style="width: 12%">Data Saída</th>
            <th style="width: 13%">Data Retorno</th>
            <th style="width: 5%">Setor</th>
            <th style="width: 8%">Destino</th>
            <th class="actions">Operações</th>
          </tr>
          
          <tr>
            <th><input style="height: 25px;width: 80%" type="text" id="txtColuna1"/></th>
            <th><input style="height: 25px;width: 90%" type="text" id="txtColuna2"/></th>
            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna4"/></th>
            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna5"/></th>
            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna3"/></th>
            <th><input style="height: 25px;width: 100%" type="text" id="txtColuna6"/></th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          $dataHoje1 = date("Y-m-d");
          conecta();
          // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo
          // statusSolicitacao em ordem crescente
          // Captura o usuário logado para saber se é administrador
          $usuario = $_SESSION['login_usuario'];
          $pesquisa = "SELECT * FROM listarsolicitacao
            WHERE siape='$usuario' AND dtSaida >= '$dataHoje1'
            AND (statusSolicitacao = 1 OR statusSolicitacao = 5)
            ORDER BY dtSaida ASC, hrSaida ASC";
          gravaLog("Listou suas solicitações");
          $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
          while ($registro = mysql_fetch_array($resultado)) {
            ?>
            <tr>
              <td style="background: indianred;"><?= $registro["codSolicitacao"] ?></td>
              <td style="background: indianred;"><?= $registro["nome"] ?></td>
              <td style="background: indianred;"><?= formatoData($registro["dtSaida"]) ?></td>
              <td style="background: indianred;"><?= formatoData($registro["dtRetorno"]) ?></td>
              <td style="background: indianred;"><?= $registro["nomeSetor"] ?></td>
              <td style="background: indianred;"><?= $registro["destino"] ?></td>
              <td style="background: indianred;" class="actions">
                <a class="btn btn-success btn-small" title="Visualizar"
                  href="visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>" >
                  <img src="imagens/lupa.png" alt="visualizar">
                </a>
                <a class="btn btn-warning btn-small"  href=editarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>
                  title="Editar">
                  <img src="imagens/editar.png" alt="edit">
                </a>
                <a class="btn  btn-small  btn-primary "title="Imprimir"
                  href=pdfSolicitaListar.php?id=<?= $registro["codSolicitacao"] ?>>
                  <img src="imagens/imprimir.png" alt="print">
                </a>
                <a class="btn btn-danger btn-small" title="Excluir"
                  href="excluirSuaSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>" >
                  <img src="imagens/excluir.png" alt="del">
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <hr>

      <div  style=" margin-left: 37%">
        <h4>Solicitações Autorizadas</h4>
      </div>
      <h6 style="margin-left: 20%"> As solicitações de transporte autorizadas pela Diretoria.
        Porém ainda precisam ser confirmadas as disponibilidades dos veículos e/ou motoristas pelo setor de transportes.
      </h6>
      
      <table  class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
        <thead>
          <tr>
            <th style="width: 6%">ID</th>
            <th style="width: 35%">Solicitante</th>
            <th style="width: 12%">Data Saída</th>
            <th style="width: 13%">Data Retorno</th>
            <th style="width: 5%">Setor</th>
            <th style="width: 8%">Destino</th>
            <th class="actions">Operações</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          conecta();
          $dataHoje1 = date("Y-m-d");
          // Seleciona todos dos dados da view listarsolicitacao ordenando
          // pelo campo statusSolicitacao em ordem crescente
          // Captura o usuário logado para saber se é administrador
          $usuario1 = $_SESSION['login_usuario'];
          $pesquisa1 = "SELECT * FROM listarsolicitacao
            WHERE siape='$usuario1' AND statusSolicitacao = 2 AND dtSaida >= '$dataHoje1'
            ORDER BY dtSaida ASC, hrSaida ASC";
          gravaLog("Listou suas solicitações");
          $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
          while ($registro1 = mysql_fetch_array($resultado1)) {
            ?>
            <tr>
              <td  style="background: #85a2cd;">
                <a href=visualizarControle.php?id=<?= $registro1["codSolicitacao"] ?>>
                <?= $registro1["codSolicitacao"] ?>
              </td>
              <td style="background: #85a2cd;"><?= $registro1["nome"] ?></td>
              <td style="background: #85a2cd;"><?= formatoData($registro1["dtSaida"]) ?></td>
              <td style="background: #85a2cd;"><?= formatoData($registro1["dtRetorno"]) ?></td>
              <td style="background: #85a2cd;"><?= $registro1["nomeSetor"] ?></td>
              <td style="background: #85a2cd;"><?= $registro1["destino"] ?></td>
              <td  class="actions" style="background: #85a2cd;">
                <a class="btn btn-success btn-small" title="Visualizar"
                  href=visualizarSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>>
                  <img src="imagens/lupa.png" alt="visu">
                </a>
                <a class="btn  btn-small  btn-primary "title="Imprimir"
                  href=pdfSolicitaListar.php?id=<?= $registro1["codSolicitacao"] ?>>
                  <img src="imagens/imprimir.png" alt="print">
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <hr>

      <div  style=" margin-left: 37%">
        <h4>Solicitações Confirmadas</h4>
      </div>
      <h6 style="margin-left: 20%"> As solicitações de transporte <b>confirmadas</b> pelo Setor de Transportes.
        Já possui motorista e veículo alocado para a saída.
      </h6>
      
      <table  class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
        <thead>
          <tr>
            <th style="width: 6%">ID</th>
            <th style="width: 35%">Solicitante</th>
            <th style="width: 12%">Data Saída</th>
            <th style="width: 13%">Data Retorno</th>
            <th style="width: 5%">Setor</th>
            <th style="width: 8%">Destino</th>
            <th class="actions">Operações</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
          conecta();
          $dataHoje1 = date("Y-m-d");
          // Seleciona todos dos dados da view listarsolicitacao ordenando
          // pelo campo statusSolicitacao em ordem crescente
          // Captura o usuário logado para saber se é administrador
          $usuario1 = $_SESSION['login_usuario'];
          $pesquisa1 = "SELECT * FROM listarsolicitacao
            WHERE siape='$usuario1' AND (statusSolicitacao = 6) AND dtSaida >= '$dataHoje1'
            ORDER BY dtSaida ASC, hrSaida ASC";
          gravaLog("Listou suas solicitações");
          $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
          while ($registro1 = mysql_fetch_array($resultado1)) {
            ?>
            <tr>
              <td  style="background: #5eb95e;">
                <a href=visualizarControle.php?id=<?= $registro1["codSolicitacao"] ?>>
                <?= $registro1["codSolicitacao"] ?>
              </td>
              <td style="background: #5eb95e;"><?= $registro1["nome"] ?></td>
              <td style="background: #5eb95e;"><?= formatoData($registro1["dtSaida"]) ?></td>
              <td style="background: #5eb95e;"><?= formatoData($registro1["dtRetorno"]) ?></td>
              <td style="background: #5eb95e;"><?= $registro1["nomeSetor"] ?></td>
              <td style="background: #5eb95e;"><?= $registro1["destino"] ?></td>
              <td  class="actions" style="background: #5eb95e;">
                <a class="btn btn-success btn-small" title="Visualizar"
                  href=visualizarSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>>
                  <img src="imagens/lupa.png" alt="visu">
                </a>
                <a class="btn  btn-small  btn-primary "title="Imprimir"
                  href=pdfSolicitaListar.php?id=<?= $registro1["codSolicitacao"] ?>>
                  <img src="imagens/imprimir.png" alt="print">
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
