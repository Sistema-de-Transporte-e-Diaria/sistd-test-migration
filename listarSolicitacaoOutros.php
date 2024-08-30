<?php
include ('validar_session.php');

//É PRÓXIMAS VIAGENS
?>
<!DOCTYPE>
<html lang="pt-br">
<head>
  <meta name="viewport" content="width=device-width">
  <meta charset="utf-8">
  <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css">
  <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <title></title>
  <img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">
</head>

<?php include ('menu.php'); ?>
<body style="font-family: courier">
  <div id="main" class="container-fluid">
    <div id="top" class="row">
      <div class="col-md-3"style=" margin-left: 40%">
        <h2><b>Solicitações</b></h2>
      </div>
    </div>
    <div id="list" class="row">
      <div class="table-responsive col-md-12">
        <h6 style=" margin-left: 20%" >Solicitações de transporte efetuadas. Caso alguma
          destas solicitações atenda a sua necessidade procure o setor CTMA.
        </h6>
        <div  style=" margin-left: 40%">
          <h4><b>Solicitações Pendentes</b></h4>
        </div>

        <table class="table table-striped" id="tabela">
          <thead>
            <tr>
              <th style="width: 5%" >ID</th>
              <th style=" width: 25%">Solicitante</th>
              <th style=" width: 10%">Data Saída</th>
              <th style=" width: 5%">Hora Saída</th>
              <th style=" width: 10%">Data Retorno</th>
              <th style=" width: 5%">Hora Retorno</th>
              <th style="font-size: medium;" style=" width: 35%">Destino</th>
              <th style=" width: 10%">Operações</th>
            </tr>
            <tr>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna1"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna2"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna3"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna4"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna5"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna6"/></th>
              <th><input style="height: 25px;width: 100%" type="text" id="txtColuna7"/></th>
            </tr>
          </thead>
          <tbody>
            <?php
            conecta();
            $dataHoje = date("Y-m-d");
            $usuario = $_SESSION['login_usuario'];
            $direcao = $_SESSION['direcao'];
            // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo
            // statusSolicitacao em ordem crescente
            $pesquisa = "SELECT * FROM listarsolicitacao
		          WHERE dtSaida >= '$dataHoje' AND (statusSolicitacao = '1' OR statusSolicitacao = '5')
		          ORDER BY dtSaida ASC, hrSaida ASC";

            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
            ?>
              <tr>
                <td style="background: #F7E741;"><?= $registro["codSolicitacao"] ?></td>
                <td style="background: #F7E741;"><?= $registro["nome"] ?></td>
                <td style="background: #F7E741;font-size: medium;">
                  <b><?= formatoData($registro["dtSaida"]) ?></b>
                </td>
                <td style="background: #F7E741;"><?= $registro["hrSaida"] ?></td>
                <td style="background: #F7E741;"><?= formatoData($registro["dtRetorno"]) ?></td>
                <td style="background: #F7E741;"><?= $registro["hrRetorno"] ?></td>
                <td style="font-size: medium;background: #F7E741"><?= $registro["destino"] ?></td>
                <td style="background: #F7E741" class="actions">
                  <a class="btn btn-success btn-small" title="Visualizar"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <?php if ($direcao == 1) { ?>
                  <a class="btn btn-info btn-small" title="Aprovar Solicitação"
                    href=autorizandoSolicitacao.php?auth=true&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/aprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <a class="btn btn-default btn-small" title="Negar Solicitação"
                    href=despachoSolicitacao.php?auth=false&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/desaprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <hr>

        <div  style=" margin-left: 40%">
          <h4><b>Solicitações Autorizadas</b></h4>
        </div>
        <h6 style="margin-left: 20%"> As solicitações de transporte autorizadas pela Diretoria.
          Porém ainda precisam ser confirmadas a disponibilidades de veículos e/ou motoristas pelo setor de transportes.
        </h6>

        <table class="table table-striped" id="tabela">
          <thead>
            <tr>
              <th style="width: 5%" >ID</th>
              <th style=" width: 25%">Solicitante</th>
              <th style=" width: 10%">Data Saída</th>
              <th style=" width: 5%">Hora Saída</th>
              <th style=" width: 10%">Data Retorno</th>
              <th style=" width: 5%">Hora Retorno</th>
              <th style="font-size: medium;" style=" width: 35%">Destino</th>
              <th style=" width: 10%">Operações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            conecta();
            $dataHoje = date("Y-m-d");
            $usuario = $_SESSION['login_usuario'];
            // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo
            // statusSolicitacao em ordem crescente
            $pesquisa = "SELECT * FROM listarsolicitacao
		          WHERE dtSaida >= '$dataHoje' AND (statusSolicitacao = '6')
		          ORDER BY dtSaida ASC, hrSaida ASC";

            $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
            ?>
              <tr>
                <td style="background: #85a2cd;"><?= $registro["codSolicitacao"] ?></td>
                <td style="background: #85a2cd;"><?= $registro["nome"] ?></td>
                <td style="background: #85a2cd;font-size: medium;">
                  <b><?= formatoData($registro["dtSaida"]) ?></b>
                </td>
                <td style="background: #85a2cd;"><?= $registro["hrSaida"] ?></td>
                <td style="background: #85a2cd;"><?= formatoData($registro["dtRetorno"]) ?></td>
                <td style="background: #85a2cd;"><?= $registro["hrRetorno"] ?></td>
                <td style="font-size: medium;background: #85a2cd"><?= $registro["destino"] ?></td>
                <td style="background: #85a2cd" class="actions">
                  <a class="btn btn-success btn-small" title="Visualizar"
                    href=visualizarSolicitacao.php?id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
                  </a>
                  <?php if ($direcao == 1) { ?>
                  <a class="btn btn-default btn-small" title="Negar Solicitação"
                    href=despachoSolicitacao.php?auth=false&id=<?= $registro["codSolicitacao"] ?>>
                    <img src="imagens/desaprovar.png" alt="lupa" style="width: 18px">
                  </a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        
        <hr>

        <div style=" margin-left: 40%">
          <h4><b>Solicitações Confirmadas</b></h4>
        </div>
        <h6 style="margin-left: 20%"> As solicitações de transporte confirmadas pelo Setor de Transportes.
          Já possui motorista e veículo alocado para a saída.
        </h6>

        <table class="table table-striped" cellspacing="0" cellpadding="0" id="tabela">
          <thead>
            <tr>
              <th style=" width: 5%" >ID</th>
              <th style=" width: 25%">Solicitante</th>
              <th style=" width: 10%">Data Saída</th>
              <th style=" width: 5%">Hora Saída</th>
              <th style=" width: 10%">Data Retorno</th>
              <th style=" width: 5%">Hora Retorno</th>
              <th style="font-size: medium;" style=" width: 35%">Destino</th>
              <th style=" width: 10%">Operações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            conecta();
            $dataHoje1 = date("Y-m-d");
            $usuario1 = $_SESSION['login_usuario'];
            // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo
            // statusSolicitacao em ordem crescente
            $pesquisa1 = "SELECT * FROM listarsolicitacao
		          WHERE  dtSaida >= '$dataHoje1' AND statusSolicitacao = '2'
		          ORDER BY  dtSaida ASC, hrSaida ASC";
            $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
            while ($registro1 = mysql_fetch_array($resultado1)) {
            ?>
              <tr>
                <td style="background: darkseagreen;" >
                  <a href=visualizarControle.php?id=<?= $registro1["codSolicitacao"] ?>>
                  <?= $registro1["codSolicitacao"] ?>
                </td>
                <td style="background: darkseagreen;"><?= $registro1["nome"] ?></td>
                <td style="background: darkseagreen;font-size: medium;">
                  <b><?= formatoData($registro1["dtSaida"]) ?></b>
                </td>
                <td style="background: darkseagreen;"><?= $registro1["hrSaida"] ?></td>
                <td style="background: darkseagreen;"><?= formatoData($registro1["dtRetorno"]) ?></td>
                <td style="background: darkseagreen;"><?= $registro1["hrRetorno"] ?></td>
                <td style="background: darkseagreen;font-size: medium; "><?= $registro1["destino"] ?></td>
                <td style="background: darkseagreen;" class="actions">
                  <a class="btn btn-success btn-small" title="Visualizar"
                    href=visualizarSolicitacao.php?id=<?= $registro1["codSolicitacao"] ?>>
                    <img src="imagens/lupa.png" alt="lupa">
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