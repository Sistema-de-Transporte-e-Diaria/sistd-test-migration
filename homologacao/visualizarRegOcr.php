<html>
    <?php
    include 'validar_session.php';
    conecta();
    $sql = "SELECT siape, administrador "
            . " FROM usuarios WHERE siape='$login_usuario'";
    $res1 = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res1)) {
        $nivel = $row['administrador'];
    }
    if ($nivel == 1) {
        header("Location: listarServidorParaUsuario.php");
    }
    ?>

    <head>       
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css">
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
    <img src="../imagens/banner_topo.png" class="img-rounded img-responsive">
</head>

<?php include 'menu.php'; ?>
<?php
$idVisualizar = $_GET['id'];
conecta();

$pesquisa = "SELECT * FROM registrosocorrencias
                         WHERE idRegistroOc='$idVisualizar' ";
$resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
While ($registro = mysql_fetch_array($resultado)) {
    ?>

    <body style="font-family: courier">

        <div  class=" container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h2 class="panel-title">Visualizar Registro de Ocorrência</h2>
                </div>
                <div class="panel-body "> 

                    <form >
                        <fieldset>                        
                            <table class="table" id="tabela1">
                                <tr>
                                    <td colspan="3" hidden="true">
                                        <input type="text" class="form-control " id="idHA" name="id" size="3 px"
                                               style="height: 100%" value="<?= $registro['idRegistroOc'] ?>"  disabled="true" />
                                    </td>  
                                </tr>
                                <tr>

                                    <td>
                                        <div>
                                            <label for="servidor">Servidor</label>
                                        </div>
                                        <select name="setIdServidor" id="servidor"  style="width:400px"  readonly="true" disabled="true">
                                            <option value="<?= $registro['idServidorOc_FK'] ?>"><?= $registro['nomeServidor'] ?></option>
                                           
                                        </select>
                                    </td>

                                    <td>
                                        <div>
                                            <label for="oc">Ocorrência</label>
                                        </div>
                                        <select name="ocorrencia" id="oc" required="true" style="width: 800px"disabled="true">
                                            <option value="<?= $registro['idOcorrencia_FK'] ?>"><?= $registro['descricaoOcorrencia'] ?></option>
                                            <?php
                                            conecta();
                                            $sql = "SELECT * FROM ocorrencia"
                                                    . " WHERE statusOcorrencia<>'0'";
                                            $res2 = mysql_query($sql);
                                            while ($row = mysql_fetch_assoc($res2)) {
                                                echo '<option  value="' . $row['idOcorrencia'] . '">' . $row['descricaoOcorrencia'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td>
                                        <div >
                                            <label for="data">Data de Ocorrência</label>
                                        </div>    

                                        <input type="text" id="calendario" value="<?=  formatoData($registro['dataOcorrencia'])?>"
                                               name="setOcor"  style="height: 100%" required="true"disabled="true"/>                             
                                    </td>

                                    <td>
                                        <div >
                                            <label for="data">Quantidade de Dias</label>
                                        </div>    

                                        <input type="text" id="dias" value="<?=$registro['quantidadeDias']?>"
                                               name="setQuantDias"  style="height: 100%" disabled="true"/>                         
                                    </td>
                                    <td>
                                        <div>
                                            <label for="anexo">Anexo</label>
                                        </div>
                                        <input type="text" style="height: 100%"value="<?=$registro['anexo']?>"
                                               name="anexo" id="ie" size="80px" disabled="true"/>
                                    </td>
                                </tr>
                            </table>                        
                        </fieldset>

                        <div class="btn-lg">
                            <div class="pull-right"> 
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-warning btn-xs" onClick="history.go(-1)">
                                        Voltar
                                    </button>
                            </div> 

                    </form> 
                </div> 
            </div> 
        </div>

    <?php } ?> 


    <script>
        $(function () {
            $("#calendario").datepicker({
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




