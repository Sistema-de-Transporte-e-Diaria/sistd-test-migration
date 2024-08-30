<?php
  function processaUpload($codSolicitacao) {

    $nomeArquivo = $_FILES['userfile']['name'];
    $nomeTemp = $_FILES['userfile']['tmp_name'];
    $erro = $_FILES['userfile']['error'];
    $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);

    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O tamanho máximo para o arquivo é de 5 MB - PHP';
    $_UP['erros'][2] = 'O tamanho máximo para o arquivo é de 5 MB - HTML';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
 
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($erro != 0) {
      ?>
      <script>
        alert ("Não foi possível fazer o upload, erro: \n <?= $_UP['erros'][$erro] ?>");
      </script>
      <?php
      return false;
    }

    $uploaddir = "./uploads/";
    $uploadfile = $uploaddir . $codSolicitacao . '.' . $extensao;

    echo '<pre>';
    if (move_uploaded_file($nomeTemp, $uploadfile)) {
      echo "Arquivo válido e enviado com sucesso.\n";
    } else {
      ?>
      <script>
        alert ("Falha ao salvar o arquivo");
      </script>
      <?php
      return false;
    }

    print "</pre>";

    return true;
  }
