<html>
    <?php include 'funcoes.php'; ?>


    <head>
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">
        <link rel="stylesheet" href="bootstrap-3.3.5-dist/css/bootstrap.css">

        <title></title>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
</head>
<body style="font-family: courier">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">Módulo de Formulário de Diárias</h2>
        </div>

        <div style="width: 20%; margin-top: 10%" class="container">    

            <div class="panel panel-success">

                <div class="panel-heading">
                    <h2 class="panel-title">Autenticação</h2>
                </div>
                <div class="panel-body"> 


                    <form action="logarDiaria.php" method="post" enctype="multipart/form-data" 
                          name="formlogin" id="formlogin" class="form-signin">
                        <fieldset>
                            <div class="form-group">
                                <label for="nome">Usuário</label>
                                <input type="text" class="form-control" id="nome" name="usuario" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                        </fieldset>  
                        <div class="btn-lg">
                            <div class="pull-right">    
                                <button type="reset" class="btn btn-danger" onClick="history.go(-1)">
                                    Voltar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-ok"></span>
                                    Entrar
                                </button>
                            </div>
                        </div>
                    </form>

                </div> 
            </div> 
        </div> 
    </div>
        <table style="margin-top:52%; margin-left: 48%; font-size: small; color: #B9BDB6; font-family: courier">
            <tr>
                <td align="right"><a href="manual/manual do usuario do SISTD.pdf">Manual de utiliza&ccedil;&atilde;o v2.0</a>
            </tr>

        </table>
</body>
</html>
