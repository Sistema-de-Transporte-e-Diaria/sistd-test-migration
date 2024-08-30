<?php
include ('validar_session.php');
include ('jquery.php');
$solicitante = $_SESSION['login_usuario'];
$admin = $_SESSION['nivel'];
$codUsuarioEditar = $_GET['id'];
if($admin == 1 && $codUsuarioEditar != $solicitante) {
  header("Location: listarSolicitacaoOutros.php");
  exit();
}
?>
<!DOCTYPE>
<html lang="pt-br">
<head>
  <title>Editar Usuário</title>
  <meta name="viewport" content="width=device-width">
  <meta charset="utf-8">
  <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
  <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="screen"
    href="https://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
  </script>
  <script type="text/javascript"
    src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
  </script>
  <script type="text/javascript"
    src="https://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
  </script>
  <script type="text/javascript"
    src="https://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
  </script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
  <script src="https://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="https://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
</head>
<img src="imagens/banner_topo.png" class="img-rounded img-responsive" alt="banner">
<?php include "menu.php"; ?>

<body style="font-family: courier">

<?php
conecta();
$sqlUsuario = "SELECT * FROM listarsolicitantes WHERE siape = $codUsuarioEditar";
$resultado = mysql_query($sqlUsuario) or die("Não foi possível realizar a consulta ao banco de dados");

while ($registro = mysql_fetch_array($resultado)) { ?>
  <div  class="container-fluid">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title" >Editar Usuários</h3>
      </div>
      <div class="panel-body">
        <form method="post" action="editandoUsuario.php" name="usuario">
          
          <table class="table">
            <tr>
              <td>
                <div><label for="Siape/Login" >Siape/Login</label></div>
                <input type="text" name="setSiape"  id="siape/login"value="<?= $registro['siape'] ?>"
                  style="height: 100%;width: 200px" required="true"readonly="true"/>
              </td>
              <td>
                <div><label for="nome"> Nome</label></div>
                <input type="text" name="setNomeUsuario" id="nome"value="<?= $registro['nome'] ?>"
                  style="height: 100%; width: 500px" required="true"/>
              </td>
              <td>
                <div><label for="CPF">CPF</label></div>
                <input type="text" name="setCPF"  class="cpf"id="cpf" maxlength="14"
                  value="<?= $registro['cpf'] ?>" style="height: 100%;width: 300px" />
              </td>
              <td>
                <div><label for="dtnasc">Data de Nascimento</label></div>
                <input type="text"  id="calendario2" class="form-control"value="<?= formatoData($registro['dtNasc']) ?>"
                  name="setDtNasc"  style="height: 100%; width: 200px"/>
              </td>
            </tr>
            <tr>
              <td>
                <div><label for="setor">Setor</label></div>
                <select type="text" name="setSetorUsuario" id="setor" required="true" style="width: 200px">
                  <option value="<?= $registro['codSetor'] ?>" style=" color:#800">
                    <?= $registro["nomeSetor"] ?>
                  </option>
                  
                  <?php
                  //Capitura o usuário logado para preencher os campos setor.
                  conecta();
                  $pesquisa1 = "SELECT * FROM setor WHERE statusSetor <> 0 ORDER BY nomeSetor";
                  $resultado1 = mysql_query($pesquisa1) or
                    die("Não foi possível realizar a consulta ao banco de dados");
                  while ($registro1 = mysql_fetch_array($resultado1)) {
                    ?>
                    <option value="<?= $registro1['codSetor'] ?>"><?= $registro1["nomeSetor"] ?></option>
                    <?php
                  } ?>
                </select>
              </td>
              <td>
                <div><label for="email"> Email</label></div>
                <input type="email" name="setEmailUsuario" value="<?= $registro['email'] ?>"
                  id="email"placeholder="email@exemplo.com" style="height: 100%;width: 500px" />
              </td>
              <td>
                <div><label for="fone">  Fone</label></div>
                <input type="tel" name="setFoneUsuario"class="fone"id="tel" placeholder="(00)0000-0000"
                  maxlength="15"value="<?= $registro['telefone'] ?>" style="height: 100%;width: 200px" />
              </td>
              <td>
                <div><label for=" Senha"> Senha</label></div>
                <input type="password" name="setSenhaUsuario"
                  id="senha" value="<?= $registro['senha'] ?>" style="height: 100%" />
              </td>
            </tr>
          </table>
          
          <?php
          if ($admin == 1) {
            ?>
            <table class="table" hidden="true">
              <tr>
                <td colspan="6">
                  <div><label for="NivelAc" style="background-color: #d6e9c6">Nível de Acesso</label></div>
                </td>
              </tr>
              <?php
              
              if ($registro['administrador'] == "1") {
                ?>
                <tr>
                  <td>
                    <input type="radio" name="setNivelUsuario" value="1"class="form-group pull-right"
                      id="tipoNivel1" checked="checked" hidden="true"/>
                  </td>
                  <td>
                    <div><label for="Solicitante">Solicitante</label></div>
                  </td>
                  <?php
              } else {
                ?>
                <td>
                  <input type="radio" name="setNivelUsuario" value="1"class="form-group pull-right"
                      id="tipoNivel1"  hidden="true"/>
                </td>
                <td>
                  <div><label for="Solicitante">Solicitante</label></div>
                </td>
                <?php
              }
              
              if ($registro['administrador'] == "2") {
                ?>
                <td>
                  <input type="radio" id="tipoNivel2" class=" form-group pull-right"
                    name="setNivelUsuario" value="2" checked="checked" hidden="true"/>
                </td>
                <td>
                  <div><label for=" Admin"> Admin </label></div>
                </td>
                <?php
              } else {
              ?>
                <td>
                  <input type="radio" id="tipoNivel2" class=" form-group pull-right"
                    name="setNivelUsuario" value="2" hidden="true"/>
                </td>
                <td>
                  <div><label for="Admin ">Admin </label></div>
                </td>
                <?php
              }
              
              if ($registro['administrador'] == "3") {
                ?>
                <td>
                  <input type="radio" id="tipoNivel3 class=" form-group pull-right" hidden="true"
                    type="radio" name="setNivelUsuario" value="3" checked="checked"/>
                </td>
                <td>
                  <div><label for="TI">TI</label></div>
                </td>
                <?php
              } else {
                ?>
                <td>
                  <input ttype="radio" id="tipoNivel3" class=" form-group pull-right" hidden="true"
                    type="radio" name="setNivelUsuario" value="3" >
                </td>
                <td>
                  <div><label for="TI">TI</label></div>
                </td>
                <?php
              }
                
              if ($registro['administrador'] == "4") { ?>
                <td>
                  <input type="radio" name="setNivelUsuario" value="4"class="form-group pull-right" checked="true">
                </td>
                <td>
                  <div ><label for="Portaria">Portaria</label></div>
                </td>
              <?php } else {
                ?>
                <td>
                  <input type="radio" name="setNivelUsuario" value="4"class="form-group pull-right">
                </td>
                <td>
                  <div><label for="Portaria">Portaria</label></div>
                </td>
                <?php
              }
              ?>
            </table>
            
          <?php
          } elseif ($admin == 2 || $admin == 3) {
          ?>
            <table class="table">
              <tr>
                <td colspan="8">
                  <div><label for="NivelAc" style="background-color: #d6e9c6">Nível de Acesso </label></div>
                </td>
              </tr>
              <tr>
                <?php
                if ($registro['administrador'] == "1") {
                  ?>
                  <td>
                    <input type="radio" name="setNivelUsuario" value="1"class="form-group pull-right"
                      id="tipoNivel1" checked="checked"/>
                  </td>
                  <td>
                    <div><label for="Solicitante">Solicitante</label></div>
                  </td>
                  <?php
                } else {
                  ?>
                  <td>
                    <input type="radio" name="setNivelUsuario" value="1"class="form-group pull-right"
                      id="tipoNivel1">
                  </td>
                  <td>
                    <div><label for="Solicitante">Solicitante</label></div>
                  </td>
                  <?php
                }
                if ($registro['administrador'] == "2") {
                  ?>
                  <td>
                    <input type="radio" id="tipoNivel2" class=" form-group pull-right"
                      name="setNivelUsuario" value="2" checked="checked"/>
                  </td>
                  <td>
                    <div><label for=" Admin"> Admin </label></div>
                  </td>
                  <?php
                } else {
                  ?>
                  <td>
                    <input type="radio" id="tipoNivel2" class=" form-group pull-right"
                      name="setNivelUsuario" value="2"/>
                  </td>
                  <td>
                    <div><label for="Admin ">Admin </label></div>
                  </td>
                  <?php
                }
                
                if ($registro['administrador'] == "3") {
                  ?>
                  <td>
                    <input type="radio" id="tipoNivel3" class=" form-group pull-right"
                      type="radio" name="setNivelUsuario" value="3"class="form-group pull-right"
                      checked="checked"/>
                  </td>
                  <td>
                    <div><label for="TI">TI</label></div>
                  </td>
                  <?php
                } else {
                  ?>
                  <td>
                    <input ttype="radio" id="tipoNivel3" class=" form-group pull-right"
                      type="radio" name="setNivelUsuario" value="3"class="form-group pull-right"/>
                  </td>
                  <td>
                    <div><label for="TI">TI</label></div>
                  </td>
                  <?php
                }
                if ($registro['administrador'] == "4") { ?>
                  <td>
                    <input type="radio" name="setNivelUsuario" value="4"class="form-group pull-right" checked="true">
                  </td>
                  <td>
                    <div ><label for="Portaria">Portaria</label></div>
                  </td>
                <?php } else {
                  ?>
                  <td>
                    <input type="radio" name="setNivelUsuario" value="4"class="form-group pull-right">
                  </td>
                  <td>
                    <div ><label for="Portaria">Portaria</label></div>
                  </td>
                  <?php
                }
                ?>
              </tr>
            </table>
            <table class="table">
              <tr>
                <td colspan="8">
                  <div><label for="NivelAc" style="background-color: #d6e9c6">Permissão de Direção</label></div>
                </td>
              </tr>
              <tr>
              <?php
              if ($registro['direcao'] == 1) { ?>
                <td>
                  <input type="checkbox" id="diretor" name="setDirecao"
                    value="1" checked>
                </td>
                <td>
                  <label for="diretor"> Permitir autorizar saídas</label>
                </td>
              <?php
              } else { ?>
                <td>
                  <input type="checkbox" id="ndiretor" name="setDirecao" value="1">
                </td>
                <td>
                  <label for="ndiretor"> Permitir autorizar saídas</label>
                </td>
              <?php
              } ?>
              </tr>
            </table>
          <?php } ?>
 
          <div class="btn-lg">
            <div class="pull-right">
              <button type="reset" class="btn btn-danger" onClick="history.go(-1)">
                Cancelar
              </button>
              <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-ok"></span>
                Editar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<script type="text/javascript">
  /* Máscaras ER */
  function mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1);
  }
  function execmascara() {
    v_obj.value = v_fun(v_obj.value);
  }
  function mtel(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    //de novo (para o segundo bloco de números)
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
    return v;
  }
  function id(el) {
    return document.getElementById(el);
  }
  window.onload = function () {
    id('cpf').onkeypress = function () {
      mascara(this, mtel);
    }
  }
</script>
<script>
  $(function () {
    $("#calendario2").datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
      dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
      dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
      monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
    });
  });
</script>

</body>
</html>
