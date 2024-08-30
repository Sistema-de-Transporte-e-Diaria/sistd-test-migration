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
<html> 
    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen"
              href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">       
        <script type="text/javascript"
                src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
        </script> 
        <script type="text/javascript"
        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
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
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <?php include "menu.php"; ?>      
    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Cadastro de Usuários</h3>
                </div>
                <div class="panel-body "> 
                    <form method="post" action="cadUsuario.php" name="usuario" id="formUs">               
                        <table class="table">
                            <tr >
                                <td>
                                    <div >
                                        <label for="Siape/Login" >Siape/Login</label>
                                    </div>
                              
                                    <input type="text" name="setSiape"  id="siape/login"
                                           style="height: 100%" required="true"/>
                                </td>

                                <td>
                                    <div>
                                        <label for="nome"> Nome</label>
                                    </div>                                   
                             
                                    <input type="text" name="setNomeUsuario" id="nome"
                                           style="height: 100%; width: 500px" required="true"/>
                                </td>

                                <td>
                                    <div>
                                        <label for="CPF">CPF</label>
                                    </div>
                             
                                    <input type="text" name="setCPF"  class="cpf"id="cpf" maxlength="14"
                                           style="height: 100%;width: 300px" />
                                </td>
                                <td>
                                        <div > 
                                            <label for="dtnasc">Data de Nascimento</label>        
                                        </div>

                                        <input type="text"  id="calendario2" class="form-control"value="<?= formatoData($registro['dtNasc']) ?>"
                                               name="setDtNasc"  style="height: 100%; width: 200px"/>      
                                </td>
                            </tr>  

                            <tr>
                                <td>
                                    <div>
                                        <label for="setor">Setor</label>
                                    </div>                                    
                             
                                    <select type="text" name="setSetorUsuario" id="setor" required="true">
                                        <?php
                                        //Capitura o usuário logado para preencher os campos setor.
                                        conecta();
                                        $pesquisa = "SELECT * FROM setor 
                          WHERE statusSetor <> 0 
                          ORDER BY nomeSetor";
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['codSetor'] ?>"><?= $registro["nomeSetor"] ?></option>
                                        <?php } ?>	
                                    </select>
                                </td>


                                <td >
                                    <div>
                                        <label for="email"> Email</label>
                                    </div>                                    
                              
                                    <input type="email" name="setEmailUsuario" id="email"placeholder="email@exemplo.com" 
                                           style="height: 100%;width: 500px" />
                                </td>

                                <td>
                                    <div>
                                        <label for="fone">  Fone</label>
                                    </div>                                  
                               
                                    <input type="tel" name="setFoneUsuario"class="fone"id="tel" maxlength="15"
                                           style="height: 100%" />
                                </td>
                                 <td >
                                    <div>
                                        <label for=" Senha"> Senha</label>
                                    </div>
                                
                                    <input type="password" name="setSenhaUsuario"id="senha"
                                           style="height: 100%" required="true" />
                                </td>
                            </tr>

                           

                        </table>


                        <table class="table">
                            <tr >
                                <td colspan="8">                                    
                                    <div> 
                                        <label for="NivelAc" style="background-color: #d6e9c6">Nível de Acesso </label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <input type="radio" name="setNivelUsuario" value="1"class="form-group pull-right"> 
                                </td>
                                <td>
                                    <div >
                                        <label for="Solicitante">Solicitante</label>
                                    </div>
                                </td>

                                <td>
                                    <input type="radio" name="setNivelUsuario" value="2"class="form-group pull-right">
                                </td>
                                <td>
                                    <div >
                                        <label for="Admin ">Admin </label>
                                    </div>
                                </td>

                                <td>
                                    <input type="radio" name="setNivelUsuario" value="3"class="form-group pull-right">
                                </td>
                                <td>
                                    <div >
                                        <label for="TI">TI</label>
                                    </div>                                
                                </td>
                                
                                <td>
                                    <input type="radio" name="setNivelUsuario" value="4"class="form-group pull-right">
                                </td>
                                <td>
                                    <div >
                                        <label for="Portaria">Portaria</label>
                                    </div>                                
                                </td>
                            </tr>
                        </table>


                        <table class="table">   
                            <tr>
                                <td colspan="6">                                    
                                    <div > 
                                        <label for="DadosBanc" style="background-color: #d6e9c6">Dados Bancário </label>        
                                    </div>
                                </td>
                            </tr>

                            <tr>                                
                                <td>
                                    <div >
                                        <label for="Banco">Banco</label>
                                    </div>
                               
                                    <input type="text" name="setBanco" id="banco"
                                           style="height: 100%">
                                </td>

                                <td >
                                    <div >
                                        <label for="ag">  Agência</label>
                                    </div>                                  
                               
                                    <input type="text" name="setAgencia" id="ag"
                                           style="height: 100%">
                                </td>

                                <td >
                                    <div >
                                        <label for="c/c"> C/C</label>
                                    </div>                                   
                             
                                    <input type="text" name="setConta" id="cc"
                                           style="height: 100%" >
                                </td>
                            </tr>
                        </table> 

                        <div class="btn-lg">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                    Voltar
                                </button>
                                <button type="submit" class="btn btn-danger" onclick="location.href = 'sair.php'">                                    
                                    Cancelar
                                </button>   
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    Cadastrar
                                </button>                
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>

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
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']


                });
            });
        </script>
    </body>

</html>
