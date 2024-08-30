<?php
include ('validar_session.php');
include ('jquery.php');
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

    <body  style="font-family: courier;">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Notificação de Email</h3>
                </div>
                <div class="panel-body "> 
                    <form  method="post" action="cadConfigEmail" name="config">
                        <?php
                        conecta();
                        $pesquisa = "SELECT * FROM manutencao";
                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?> 
                            <table class="table">
                                <tr>
                                    <td colspan="10">
                                        <div > 
                                            <label for="Origem" style="background-color:#d6e9c6 ">Configuração de envio de email</label>        
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div >
                                            <label for=" TipoEnvio"> Tipo de envio</label>
                                        </div>
                                   
                                        <input  style="height: 30px;width: 100px" type="text" name="setTipoEmail" required="true"
                                                value="<?= $registro['mailTipo'] ?>"/>
                                    </td>

                                    <td>
                                        <div >
                                            <label for="Host">Host</label>
                                        </div>                                
                                 
                                        <input  style="height: 30px" type="text" name="setHostEmail" required="true"
                                                value="<?= $registro['mailHost'] ?>"/>
                                    </td>

                                    <td>
                                        <div>
                                            <label for="SmtpSeguro">Smtp Seguro</label>
                                        </div>                                 
                                  
                                        <input style="height: 30px;width: 100px" type="text" name="setSmtpSeguro" required="true"
                                               value="<?= $registro['mailSmtpSeguro'] ?>"/>
                                    </td>

                                    <td >
                                        <div >
                                            <label for="Porta">Porta</label>
                                        </div>                                
                                   
                                        <input  style="height: 30px;width: 100px" type="text" name="setPortEmail" required="true"
                                                value="<?= $registro['mailPort'] ?>"/>
                                    </td>

                                    <td>
                                        <div >
                                            <label for="DebugEmail">Debug Email</label>
                                        </div>                               
                                    
                                        <input  style="height: 30px;width: 100px" type="text" name="setDebugEmail" required="true"
                                                value="<?= $registro['mailDebug'] ?>"/>
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>
                                        <div>
                                            <label for=" ContaEmail"> Conta do email</label>
                                        </div>                                
                                  
                                        <input  style="height: 30px;width: 300px" type="text" name="setUsuarioEmail" required="true"
                                                value="<?= $registro['mailUsuario'] ?>"/>
                                    </td>

                                    <td>
                                        <div >
                                            <label for="SenhaEmail">Senha do email</label>
                                        </div>                                 
                                
                                        <input style="height: 30px;width: 300px" type="password" name="setSenhaEmail" required="true"
                                               value="<?= $registro['mailSenha'] ?>"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div >
                                            <label for="NomeRemetente">Nome do remetente</label>
                                        </div>                                 
                                  
                                        <input  style="height: 30px;width: 300px" type="text" name="setRemetenteNomeEmail" required="true"
                                                value="<?= $registro['mailRemetenteNome'] ?>"/>
                                    </td>

                                    <td colspan="2">
                                        <div >
                                            <label for="EmailRemetente">Email remetente</label>
                                        </div>                                 
                                   
                                        <input  style="height: 30px;width: 300px" type="text" name="setRemetenteEmail" required="true"
                                                value="<?= $registro['mailRemetente'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div >
                                            <label for="EnviarCopia">Enviar cópia</label>
                                        </div>                                 
                                    
                                        <input  style="height: 30px;width: 300px" type="text" name="setDestinatarioCopiaEmail" required="true" 
                                                value="<?= $registro['mailDestinatarioCopia'] ?>"/>
                                    </td>


                                    <td>
                                        <div>
                                            <label for=" EmailAdministrador"> Email do administrador</label>
                                        </div>                                
                                    
                                        <input  style="height: 30px;width: 300px" type="text" name="setEmailAdmin" required="true"
                                                value="<?= $registro['mailEmailAdmin'] ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div >
                                            <label for=" AssuntoAutorizacaoViagem"> Assunto - Autorização da Viagem</label>
                                        </div>                                
                                    
                                        <input  style="height: 30px;width: 300px" type="text" name="setAssuntoAutorizacaoEmail" required="true"
                                                value="<?= $registro['mailAssuntoAutorizacao'] ?>"/>
                                    </td>

                                    <td>
                                        <div >
                                            <label for=" AssuntoSolicitacaoViagem"> Assunto - Solicitação da Viagem</label>
                                        </div>                                
                                    
                                        <input  style="height: 30px;width: 300px" type="text" name="setAssuntoSolicitacaoEmail" required="true"
                                                value="<?= $registro['mailAssuntoSolicitacao'] ?>"/>
                                    </td>
                                </tr>

                            </table>
                        <?php } ?>
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
                                    Alterar
                                </button>                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>                
</html>
