<?php
include ('validar_session.php');
include ('jquery.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Visualizar Solicitação</title>
  <meta name="viewport" content="width=device-width">
  <meta charset="utf-8">
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
  <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="screen"
    href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
  </script>
  <script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
  </script>
  <script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
  </script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
</head>

<img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">

<?php
include "menu.php";
?>

<body  style="font-family: courier">

  <div  class="container-fluid">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title" >Visualizar Solicitação</h3>
      </div>
      
      <div class="panel-body ">
        <?php
        $codSolicitadoVisualizar = $_GET['id'];
        conecta();
        // Seleciona todos os campos da tabela solicitação
        //  onde o código esteja igual o da variável $codSolicitadoVisualizar
        $pesquisa = "SELECT * FROM listarsolicitacao WHERE codSolicitacao='$codSolicitadoVisualizar'";
        gravaLog("Visualizou a solicitação nº $codSolicitadoVisualizar");
        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
        
        while ($registro = mysql_fetch_array($resultado)) {
          $horaDataSolicitacao = $registro['dataHoraSolicita'];
          $data = date('d/m/Y H:i:s', strtotime($horaDataSolicitacao))
          ?>
          <form method="post" action="editandoSolicitacao.php" name="solicita"onsubmit="return validaCampos();">
            
            <table class="table">
              <tr>
                <td >
                  <div >
                    <label for="nSolicitacao">Solicitação Nº</label>
                  </div>
                  <input style="color: brown;height: 30px"class="input-large" type="text" name="idSolicitacao"
                    size="3" readonly="true" value="<?= $registro["codSolicitacao"] ?>"/>
                </td>
                <td>
                  <div>
                    <label > Data/Hora da Solicitação</label>
                  </div>
                  <?php
                  if ($data == "31/12/1969 21:00:00") {
                    ?>
                    <input  type="text" name="idDataHoraSol"style="height: 100%"class="input-large"
                      readonly="true" value=""/>
                    <?php
                  } else {
                    ?>
                    <input  type="text" name="idDataHoraSol"style="height: 100%"class="input-large"
                      readonly="true" value="<?= $data ?>"/>
                    <?php
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td >
                  <div >
                    <label for="Solicitante">Solicitante</label>
                  </div>
                  <input type="text" style="height: 100%;width: 70%"
                    name="Solicitante" value="<?= $registro["nome"] ?>"readonly="true"/>
                </td>
                <td>
                  <div>
                    <label for="Setor">Setor</label>
                  </div>
                  <input type="text" name="setorSolicitante" style="height: 100%"
                    class="input-medium"
                    value="<?= $registro["nomeSetor"] ?>"readonly="true"/>
                </td>
                <td>
                  <div >
                    <label for="Fone">Fone</label>
                  </div>
                  <input type="text" style="height: 100%"  class="input-medium"
                    name="foneSolicitante" value="<?= $registro["telefone"] ?>"readonly="true"/>
                </td>
              </tr>
            </table>
            
            <legend id="legendDadosViagem" class="panel panel-success"
              style="background-color:#C1FFC1">Dados Previstos da Viagem</legend>
              
            <table class="table">
              <tr>
                <td>
                  <div >
                    <label for="saida" style="background-color:#d6e9c6 "class="input-xxxlarge"> Saída</label>
                  </div>
                </td>
                <td >
                  <div >
                    <label for="retorno" style="background-color:#d6e9c6 "class="input-xxxlarge">Retorno</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div >
                    <label for="DtS">Data</label>
                  </div>
                  <input type="text" id="calendario" readonly="true"
                    class="input-medium" value="<?= formatoData($registro["dtSaida"]) ?>"
                    name="prevDtSaida" style="height: 100%" required="true"/>
                </td>
                <td>
                  <div >
                    <label for="DtR">Data</label>
                  </div>
                  <input type="text" id="calendario1" readonly="true"
                    class="input-medium"value="<?= formatoData($registro["dtRetorno"]) ?>"
                    name="prevDtRetorno"  style="height: 100%" required="true"/>
                </td>
              </tr>
              <tr>
                <td>
                  <div >
                    <label for="HrS">Hora </label>
                  </div>
                  <select name="prevHrSaida"style="height: 100%" readonly="true" class="input-medium">
                    <option style="background-color: #761c19"
                      value="<?= formatoData($registro["hrSaida"]) ?>">
                      <?= formatoData($registro["hrSaida"]) ?>
                    </option>
                  </select>
                </td>
                <td>
                  <div >
                    <label for="HrFim">Hora </label>
                  </div>
                  <select name="prevHrRetorno"style="height: 100%" readonly="true"class="input-medium">
                    <option style="background-color: #761c19"
                      value="<?= formatoData($registro["hrRetorno"]) ?>">
                      <?= formatoData($registro["hrRetorno"]) ?>
                    </option>
                  </select>
                </td>
              </tr>
            </table>
            
            <table class="table">
              <tr>
                <td >
                  <div >
                    <label style="background-color:#d6e9c6 " for="DestinoItinerario"class="input-xxxlarge">
                      Destino / Itinerário
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea name="destino" type="text" maxlength="200"  class="input-xxlarge"
                    id="destino" readonly="true" required="true" ><?= $registro["destino"] ?>
                  </textarea>
                </td>
              </tr>
              <tr>
                <td >
                  <div >
                    <label style="background-color:#d6e9c6
                      "for="Finalidade"class="input-xxxlarge">
                      Finalidade
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <textarea name="finalidade" type="text" maxlength="200"
                    id="finalidade" readonly="true"class="input-xxlarge"
                    required="true" ><?= $registro["finalidade"] ?></textarea>
                </td>
              </tr>
            </table>
            
            <table class="table">
              <tr>
                <td colspan="6">
                  <div>
                    <label for="OcVeiculo"style="background-color:#d6e9c6 "class="input-xxxlarge">
                      Ocupantes do Veículo
                    </label>
                  </div>
                </td>
              </tr>
              <tr>
                <td >
                  <div>
                    <label for="QuantPassageiros">Quantidade de Passageiros(as)</label>
                  </div>
                  
                  <input type="text" name="qtdPassageiros" class="input-min"readonly="true"
                    value="<?= $registro["qtdPassageiros"] ?>" style="height: 100%;width: 50px" >
                </td>
              </tr>
              <tr>
                <td >
                  <div>
                    <label for="Ocupantes"class="input-large">Ocupantes</label>
                  </div>
                </td>
                <td >
                  <div>
                    <label for="Siape"class="input-large"> SIAPE/CPF</label>
                  </div>
                </td>
                <td >
                  <div>
                    <label for=" Fone"class="input-medium"> Fone</label>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1º
                  <input type="text" name="ocupante1" value="<?= $registro["ocupante1"] ?>"
                    style="height:30px"class="input-large"readonly="true"/>
                </td>
                <td>
                  <input type="text"  name="siapeOcup1" style="height:30px" class="input-medium"
                    value="<?= $registro["siapeOcupante1"] ?>"readonly="true"/>
                </td>
                <td>
                  <input type="text"  name="foneOcup1" value="<?= $registro["foneOcup1"] ?>"
                    style="height:30px" class="input-medium"readonly="true"/>
                </td>
              </tr>
              <tr>
                <td >2º
                  <input type="text" name="ocupante2"value="<?= $registro["ocupante2"] ?>"
                    style="height:30px"class="input-large"readonly="true"/>
                </td>
                <td>
                  <input type="text"  name="siapeOcup2" style="height:30px" class="input-medium"
                    value="<?= $registro["siapeOcupante2"] ?>"readonly="true"/>
                </td>
                <td>
                  <input type="text" name="foneOcup2"value="<?= $registro["foneOcup2"] ?>"
                    class="input-medium" style="height:30px"readonly="true"/>
                </td>
              </tr>
              <tr>
                <td >
                  3º <input type="text" name="ocupante3" value="<?= $registro["ocupante3"] ?>"
                    style="height:30px"class="input-large"readonly="true"/>
                </td>
                <td>
                  <input type="text"  name="siapeOcup3" style="height:30px"class="input-medium"
                    value="<?= $registro["siapeOcupante3"] ?>"readonly="true"/>
                </td>
                <td>
                  <input type="text" name="foneOcup3" value="<?= $registro["foneOcup3"] ?>"
                    class="input-medium"style="height:30px"readonly="true"/>
                </td>
              </tr>
              <tr>
                <td >
                  4º <input type="text" name="ocupante4"value="<?= $registro["ocupante4"] ?>"
                    style="height:30px" class="input-large"readonly="true"/>
                </td>
                <td>
                  <input type="text"  name="siapeOcup4" style="height:30px" class="input-medium"
                    value="<?= $registro["siapeOcupante4"] ?>"readonly="true"/>
                </td>
                <td>
                  <input type="text" name="foneOcup4" value="<?= $registro["foneOcup4"] ?>"
                    style="height:30px" class="input-medium"readonly="true"/>
                </td>
              </tr>
              <tr>
                <td >
                  <div >
                    <label>Solicitações Anexas</label>
                  </div>
                  <?php
                  conecta();
                  $sqlAnexadas = "SELECT idSecundaria FROM anexadas
                    WHERE idPrimaria =  '$codSolicitadoVisualizar'";
                  $resultadoAnexadas = mysql_query($sqlAnexadas) or
                    die("Não foi possível realizar a consulta ao banco de dados");
                  while ($registroAnexadas = mysql_fetch_array($resultadoAnexadas)) {
                    echo $registroAnexadas['idSecundaria'];
                    echo " - ";
                  }
                  ?>
                </td>
                <td>
                  <?php
                  if ($registro["qtdPassageiros"] > 4) {
                    ?>
                    <div >
                      <label>Lista de Passsageiros Anexas</label>
                    </div>
                    <a href="<?= './uploads/' . $codSolicitadoVisualizar . '.pdf' ?>" target="_blank">
                      <?=$codSolicitadoVisualizar?>.pdf
                    </a>
                    <?php
                  }
                  ?>
                </td>
              </tr>
            </table>
            
            <div class="btn-lg">
              <div class="pull-right">
                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                  Voltar
                </button>
              </div>
            </div>
          </form>
        <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>
