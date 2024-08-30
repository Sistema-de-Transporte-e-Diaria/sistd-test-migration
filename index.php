<?php
include "funcoes.php";
conecta();
?>
<html> 
    <title>Transporte e Diárias</title>
    <head>       
        <link rel="shortcut icon" href="imagens/favicon.ico">
        <link rel="icon" type="img/x-icon" href="animated_favicon1.gif">
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
              rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <title></title>

    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive"/>

    <body style="font-family: courier">  
        <div  class="container"  >    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <?php
                    $pesquisa1 = "SELECT * FROM manutencao";
                    $resultado1 = mysql_query($pesquisa1) or die("Houve um erro de banco de dados: " . mysql_error());
                    While ($registro1 = mysql_fetch_array($resultado1)) {
                        $nomeCampus = $registro1['nomeCampus'];
                    }
                    ?> 
                    <h2 class="panel-title">Sistema Solicitação de Transporte e Diárias - IFPE CAMPUS <?=$nomeCampus ?></h2>

                </div>
                <div class="panel-body "> 

                    <div class="table-responsive">
                        <table class="table" >

                            <tr>   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="width: 20%">
                                    <a href="login.php"> <img src="imagens/transporte.png" class="img-rounded img-responsive img-thumbnail"> </a> </center>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="width: 20%">
                                    <a href="loginDiaria.php"> <img src="imagens/dinheiro.png" class="img-rounded img-responsive img-thumbnail"> </a> 
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-group" style="margin-left: -10%"> 
                                        <label for="transporte">Solicitar Veículo</label>
                                    </div>   
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-group" style="margin-left: -20%"> 
                                        <label for="transporte"  >Formulário de Diárias</label>
                                    </div>   
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <?php
                        $pesquisa = "SELECT * FROM manutencao";
                        $resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
                        While ($registro = mysql_fetch_array($resultado)) {
                            ?> 
                            <table class="table">

                                <tr>
                                    <td>

                                        <label style="font-size: 25px; color: #3e8f3e; font-family: Comic Sans MS;">
                                            CAMPUS <?= $registro['nomeCampus'] ?></label>

                                        <label style="font-size: 12px; color: #3e8f3e;">Desenvolvido por: Coordenação de Gestão de Tecnologia da Informação (CGTI) - Campus Garanhuns</label></td>


                                    <td style="width: 40%">
                                        <label></label>
                                        <label></label>
                                        <label></label>
                                        <label style="color: #3e8f3e; font-size: 12px;" >
                                            Sistema Versão: <?= $registro['versaoSistema'] ?> - Atualizado em: <?= formatoData($registro["dtUpdateSistema"]) ?></label>
                                        <br>
                                        <label></label>
                                        <label></label>
                                        <label  style="color: #3e8f3e; font-size: 12px">
                                            BD Versão: <?= $registro['versaoBD'] ?> - Atualizado em: <?= formatoData($registro["dtUpdateBD"]) ?></label>

                                    </td>
                                </tr>

<?php } ?>
                        </table>
                    </div> 
                </div> 
            </div>
    </body>
</html>


