<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Teste de Upload</title>
</head>

<?php
$nomeArquivo = $_FILES['userfile']['name'];
$tipoArquivo = $_FILES['userfile']['type'];
$tamanhoArquivo = $_FILES['userfile']['size'];
$nomeTemp = $_FILES['userfile']['tmp_name'];
$erro = $_FILES['userfile']['error'];
$fullPath = $_FILES['userfile']['full_path']
?>

<body>
  <span>Nome do Arquivo: <?= $nomeArquivo ?></span><br />
  <span>Tipo do Arquivo: <?= $tipoArquivo ?></span><br />
  <span>Tamanho do Arquivo: <?= $tamanhoArquivo ?></span><br />
  <span>Nome temporário: <?= $nomeTemp ?></span><br />
  <span>Erro: <?= $erro ?></span><br />
  <span>Full Path: <?= $fullPath ?></span><br />

  <?php
  $uploaddir = "./uploads/";
  $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

  echo '<pre>';
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Arquivo válido e enviado com sucesso.\n";
  } else {
    echo "Possível ataque de upload de arquivo!\n";
  }
  echo 'Aqui está mais informações de debug:';
  print_r($_FILES);

  print "</pre>";
  ?>

</body>

</html>
