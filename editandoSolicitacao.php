<?php
include ('validar_session.php');
include ('uploadArquivo.php');
conecta();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Editando Solicitação</title>
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">
<body  style="font-family: courier">

<?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário editar.php
$codAlterarSolicitacao = $_POST[idSolicitacao];
$PrevDtSaida = $_POST[prevDtSaida];
$PrevHrSaida = $_POST[prevHrSaida];
$PrevDtRetorno = $_POST[prevDtRetorno];
$PrevHrRetorno = $_POST[prevHrRetorno];
$Destino = $_POST[destino];
$Finalidade = $_POST[finalidade];
$QtdPassageiros = $_POST[qtdPassageiros];
$SolicitacaoAnexa = $_POST[setEscolhaSolicitacao];
$Ocupante1 = $_POST[ocupante1];
$FoneOcup1 = $_POST[foneOcup1];
$SiapeOcup1 = $_POST[siapeOcup1];
$Ocupante2 = $_POST[ocupante2];
$FoneOcup2 = $_POST[foneOcup2];
$SiapeOcup2 = $_POST[siapeOcup2];
$Ocupante3 = $_POST[ocupante3];
$FoneOcup3 = $_POST[foneOcup3];
$SiapeOcup3 = $_POST[siapeOcup3];
$Ocupante4 = $_POST[ocupante4];
$FoneOcup4 = $_POST[foneOcup4];
$SiapeOcup4 = $_POST[siapeOcup4];

$PrevDtSaida1 = converteData($PrevDtSaida);
$PrevDtRetorno1 = converteData($PrevDtRetorno);
$calcHora = calculaHoras($PrevDtSaida, $PrevHrSaida);

$statusSolicitacao = 1;
$statusUpload = true;

if (!empty($SolicitacaoAnexa)) {
  $sqlAnexa = "insert into anexadas (idPrimaria, idSecundaria)
    values ('$codAlterarSolicitacao','$SolicitacaoAnexa')";
  conecta();
  $sqlAnexaResultado = mysql_query($sqlAnexa) or die("Houve um erro de banco de dados: " . mysql_error());
  
  $sqlFinaliza = "UPDATE solicitacao set statusSolicitacao= 3,
    anexada=$codAlterarSolicitacao WHERE codSolicitacao='$SolicitacaoAnexa'";
  $sqlFinaliza1 = mysql_query($sqlFinaliza) or die("Houve um erro de banco de dados: " . mysql_error());
  gravaLog("Anexou a solicitação nº $SolicitacaoAnexa a solicitação $codAlterarSolicitacao");
}

$pesquisaManut1 = "SELECT veiculoPassageiro, veiculoColetivo FROM manutencao";
$resultadoManut1 = mysql_query($pesquisaManut1) or die("Houve um erro de banco de dados: " . mysql_error());
while ($registroManut1 = mysql_fetch_array($resultadoManut1)) {
  $horasVeiculoPeq1 = $registroManut1["veiculoPassageiro"];
  $horasVeiculoGrande1 = $registroManut1["veiculoColetivo"];
}

$pesquisaSet1 = "SELECT * FROM listarsolicitacao WHERE codSolicitacao = $codAlterarSolicitacao";
$resultadoSet1 = mysql_query($pesquisaSet1) or die("Houve um erro de banco de dados: " . mysql_error());
while ($registroSet1 = mysql_fetch_array($resultadoSet1)) {
  $privilegioSet = $registroSet1["privilegioSetor"];
}

if (($QtdPassageiros <= 4 && $calcHora < $horasVeiculoPeq1) ||
  ($QtdPassageiros > 4 && $calcHora < $horasVeiculoGrande1)) {
  $statusSolicitacao = 5;
}
if ($privilegioSet == 1) {
  $statusSolicitacao = 1;
}

$sql = "UPDATE solicitacao set
  dtSaida='$PrevDtSaida1',
  hrSaida='$PrevHrSaida',
  dtRetorno= '$PrevDtRetorno1',
  hrRetorno= '$PrevHrRetorno',
  destino= '$Destino',
  finalidade='$Finalidade',
  qtdPassageiros='$QtdPassageiros',
  ocupante1='$Ocupante1',
  foneOcup1='$FoneOcup1',
  ocupante2='$Ocupante2',
  foneOcup2='$FoneOcup2',
  ocupante3='$Ocupante3',
  foneOcup3='$FoneOcup3',
  ocupante4='$Ocupante4',
  foneOcup4='$FoneOcup4',
  diferencaHoras='$calcHora',
  siapeOcupante1='$SiapeOcup1',
  siapeOcupante2='$SiapeOcup2',
  siapeOcupante3='$SiapeOcup3',
  siapeOcupante4='$SiapeOcup4',
  statusSolicitacao='$statusSolicitacao'
  WHERE codSolicitacao='$codAlterarSolicitacao'";

conecta();

if ($QtdPassageiros > 4) {
  if($_FILES['userfile']['error'] != 4){
    $statusUpload = processaUpload($codAlterarSolicitacao);
  }
} else {
  $path = './uploads/' . $codAlterarSolicitacao . '.pdf';
  unlink($path);
}

if($statusUpload) {
  $exec = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
  gravaLog("Editou solicitação nº  $codAlterarSolicitacao");
  if ($statusSolicitacao == 5) {
    ?>
    <script language=javascript>
      alert('Sua solicitação está fora do prazo, ficará a cargo do CTMA liberá-la ou não!');
    </script>
    <?php
  } else {
    ?>
    <script language=javascript>
      alert('Solicitação alterada com sucesso!');
    </script>
    <?php
  }
} else {
  ?>
  <script language=javascript>
    alert('Não foi possível salvar o arquivo, tente novamente ou contate o Setor de TI.');
    history.go(-1)
  </script>
  <?php
}
?>

<script language= "JavaScript">
  location.href = "listarSolicitacao.php";
</script>

</body>
</html>









