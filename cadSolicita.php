<?php include ('validar_session.php'); ?>
<?php include ('uploadArquivo.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Solicitação Efetuada</title>
  <script language="JavaScript" type="text/javascript" src="script.js"></script>
</head>

<img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">

<body  style="font-family: courier">

  <?php
  // Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
  $getCodSolicitante = $_POST[setEscolhaSolicitante];
  $PrevDtSaida = $_POST[prevDtSaida];
  $PrevHrSaida = $_POST[prevHrSaida];
  $PrevDtRetorno = $_POST[prevDtRetorno];
  $PrevHrRetorno = $_POST[prevHrRetorno];
  $Destino = $_POST[destino];
  $Finalidade = $_POST[finalidade];
  $getQtdPassagerios = $_POST[qtdPassageiros];
  $Ocupante1 = $_POST[ocupante1];
  $SiapeOcup1 = $_POST[siapeOcup1];
  $FoneOcup1 = $_POST[foneOcup1];
  $Ocupante2 = $_POST[ocupante2];
  $SiapeOcup2 = $_POST[siapeOcup2];
  $FoneOcup2 = $_POST[foneOcup2];
  $Ocupante3 = $_POST[ocupante3];
  $SiapeOcup3 = $_POST[siapeOcup3];
  $FoneOcup3 = $_POST[foneOcup3];
  $Ocupante4 = $_POST[ocupante4];
  $SiapeOcup4 = $_POST[siapeOcup4];
  $FoneOcup4 = $_POST[foneOcup4];
  $calcHora = calculaHoras($PrevDtSaida, $PrevHrSaida);
  $PrevDtSaida1 = converteData($PrevDtSaida);
  $PrevDtRetorno1 = converteData($PrevDtRetorno);
  $dataHoraSolicita = date("Y/m/d H:i:s ");
  $statusSolicitacao = 1;
  $statusUpload = true;

  $queryPriv = "SELECT privilegioSetor FROM listarsolicitantes WHERE siape=$getCodSolicitante";
  $resultPriv = mysql_query($queryPriv) or die("Houve um erro de banco de dados: " . mysql_error());
  while ($registroPriv = mysql_fetch_array($resultPriv)) {
    $privilegioSet = $registroPriv["privilegioSetor"];
  }
  
  $queryManut = "SELECT veiculoPassageiro, veiculoColetivo FROM manutencao";
  $resultManut = mysql_query($queryManut) or die("Houve um erro de banco de dados: " . mysql_error());
  while ($registroManut = mysql_fetch_array($resultManut)) {
    $horasVeiculoPeq1 = $registroManut["veiculoPassageiro"];
    $horasVeiculoGrande1 = $registroManut["veiculoColetivo"];
  }
  
  if (($getQtdPassagerios <= 4 && $calcHora < $horasVeiculoPeq1) ||
    ($getQtdPassagerios > 4 && $calcHora < $horasVeiculoGrande1)) {
    $statusSolicitacao = 5;
  }
  if ($privilegioSet == 1) {
    $statusSolicitacao = 1;
  }
  
  $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno,
    hrRetorno, destino, finalidade, qtdPassageiros,
    ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3,
    foneOcup3, ocupante4, foneOcup4, diferencaHoras,dataHoraSolicita,
    siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao)
    VALUES ('$getCodSolicitante', '$PrevDtSaida1',
    '$PrevHrSaida', '$PrevDtRetorno1',
    '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
    '$Ocupante1', '$FoneOcup1', '$Ocupante2',
    '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
    '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
    . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', $statusSolicitacao)";
  
  conecta();
  $exec = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
  
  $sqlUltimoCod = "SELECT * FROM listarsolicitacao ORDER BY codSolicitacao DESC LIMIT 1";
  $resultadoUltimoCod = mysql_query($sqlUltimoCod) or die("Não foi possível realizar a consulta ao banco de dados");
  
  while ($registroUltimoCod = mysql_fetch_array($resultadoUltimoCod)) {
    $ultimaSolicitacao = $registroUltimoCod['codSolicitacao'];
    $privilegioSetor = $registroUltimoCod['privilegioSetor'];
  }
  
  if ($getQtdPassagerios > 4) {
    $statusUpload = processaUpload($ultimaSolicitacao);
  }

  if ($statusUpload) {
    emailSolicitacao($ultimaSolicitacao);
    gravaLog("Cadastrou solicitação");
    
    if ($statusSolicitacao == 5) {
      ?>
      <script language=javascript>
        alert('Sua solicitação está fora do prazo,ficará a cargo do CTMA liberá-la ou não!');
      </script>
      <?php
    } else {
      ?>
      <script language=javascript>
        alert('Solicitação cadastrada com sucesso!');
      </script>
      <?php
    }
  } else {
    $sqlDesfazSolicita = "DELETE FROM solicitacao WHERE codSolicitacao = $ultimaSolicitacao";
    $resultDesfazSolicita = mysql_query($sqlDesfazSolicita) or
      die("Não foi possível realizar a consulta ao banco de dados");
    ?>
    <script language=javascript>
      alert('Não foi possível salvar o arquivo, tente novamente ou contate o Setor de TI.');
      history.go(-1)
    </script>
    <?php
  }
  ?>

  <script>
    location.href = "listarSolicitacao.php";
  </script>
</body>
</html>
