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
<?php
include "menu.php";
$codVeiculoEditar = $_GET['id'];
conecta();
// Seleciona o registro do veículo a ser editado
$pesquisa = "SELECT * FROM veiculos
                             WHERE codVeiculo='$codVeiculoEditar'";
$resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
While ($registro = mysql_fetch_array($resultado)) {
    ?> 

    <body style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Visualizar Veículo</h3>
                </div>
                <div class="panel-body ">
                    <form name="veiculo"> 
                        <table class="table"> 
                            <tr>
                                <td > 
                                    <div>
                                         <label for="Codigo">Código</label>
                                    </div> 
                               
                                    <input style="color: brown;height: 20px; width: 50px" type="text" name="setCodVeiculo"
                                           readonly="true" value="<?= $codVeiculoEditar ?>">
                                </td>

                            </tr>

                            <tr>
                                <td >
                                    <div >
                                        <label for="marca"> Marca</label>
                                    </div> 
                                
                                    <select name="setMarca" id="escolhaMarca" disabled="true">
                                        <option style="color: #860000"><?= $registro["marca"] ?></option>                                       
                                    </select>
                                </td> 

                                <td>
                                    <div>
                                        <label for="modelo">Modelo</label>
                                    </div>
                             
                                    <input type="text" name="setModelo" disabled="true"
                                           style="height: 30px"value="<?= $registro["modelo"] ?>"
                                           required="true" id="modelo"/>
                                </td>

                                <td>
                                    <div >
                                        <label for="placa"> Placa</label>
                                    </div>
                             
                                    <input type="text" name="setPlaca" value="<?= $registro["placa"] ?>"
                                           class="placa" disabled="true"
                                           style="height: 30px" id="placa"/>
                                </td>

                                <td >
                                    <div >
                                        <label for="ocupacao">Ocupação</label>
                                    </div>
                              
                                    <input type="text" name="setOcupacao" disabled="true"
                                           value="<?= $registro["ocupacao"] ?>"
                                           style="height: 30px" id="ocup" >
                                </td>
                            </tr>
                        </table>


                        <table class="table">
                            <tr >
                                <td colspan="6">                                    
                                    <div> 
                                        <label for="Funcao" style="background-color: #d6e9c6"> Informações de Manutenção </label>        
                                    </div>
                                </td>
                            </tr>
                            <tr>                   
                                <td>
                                    <div  >
                                        <label for="valExt">Validade do Extintor</label>
                                    </div>
                              
                                    <input type="text"  id="calendario" disabled="true"
                                           value="<?= formatoData($registro["validadeExtintor"]) ?>"
                                           name="setValiExtintor" style="height: 100%" />                             
                                </td>

                                <td >
                                    <div >
                                        <label for="kmAtual">Km Atual</label>                                                        
                                    </div>
                             
                                    <input  type="text"  name="setKmAtual"disabled="true"
                                            id="kmAtual"value="<?= $registro["kmAtual"] ?>"
                                            style="height: 100%">
                                </td>

                                <td>
                                    <div >
                                        <label for="proxTrocaOl"> Próxima Troca de Óleo</label>                                                        
                                    </div>                                               
                            
                                    <input  type="text" name="setTrocaOleo"disabled="true"
                                            id="proxTrocaOl"value="<?= $registro["pxTrOleo"] ?>" 
                                            style="height: 100%" >
                                </td>
                            </tr>

                            <tr>
                                <td >
                                    <div >
                                        <label for="proxTrocaFilOl">Próxima Troca do Filtro de Óleo</label>
                                    </div>                                                
                             
                                    <input  type="text" name="setTrocaFiltroOleo"disabled="true"
                                            id="proxTrocaFilOl"value="<?= $registro["pxTrFiltroOleo"] ?>"
                                            style="height: 100%">
                                </td>

                                <td >
                                    <div>
                                        <label for="proxTrocaFilAr">Próxima Troca do Filtro de AR</label>
                                    </div>
                               
                                    <input  type="text" name="setTrocaFiltroAR"disabled="true"
                                            id="proxTrocaFilAr"value="<?= $registro["pxTrFiltroAR"] ?>"
                                            style="height: 100%" >
                                </td>

                                <td >
                                    <div >
                                        <label for="proxTrocaFilComb">Próxima Troca do Filtro de Combustível</label>
                                    </div>
                            
                                    <input  type="text" name="setTrocaFiltroCombus" disabled="true"
                                            id="proxTrocaFilComb"value="<?= $registro["pxTrFiltroCombus"] ?>"
                                            style="height: 100%" >
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
                </div>
            </div>
        </div>


    </body>
<?php } ?>  
</html>







