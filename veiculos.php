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
    <body style="font-family: courier">
    <body  style="font-family: courier">
        <div  class="container-fluid">    
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title" >Cadastro de Veículos</h3>
                </div>
                <div class="panel-body "> 

                    <form  method="post" action="cadVeiculo.php" name="veiculo" id="veliculo">                  
                        <table class="table">
                            <tr>
                                <td >
                                    <div>
                                        <label for="marca"> Marca</label>
                                    </div> 
                              
                                    <select name="setMarca" id="escolhaMarca" required="true">
                                        <?php
                                        //Capitura o usuário logado para preencher os campos setor.
                                        conecta();
                                        $pesquisa = "SELECT * FROM marcas 
                                         WHERE statusMarca <> 0 
                                         ORDER BY nomeMarca";
                                        $resultado = mysql_query($pesquisa) or die("Não foi possível realizar a consulta ao banco de dados");
                                        While ($registro = mysql_fetch_array($resultado)) {
                                            ?>       
                                            <option value="<?= $registro['idMarca'] ?>"><?= $registro["nomeMarca"] ?></option>
                                        <?php } ?>	
                                    </select>
                                </td> 

                                <td>
                                    <div >
                                        <label for="modelo">Modelo</label>
                                    </div>
                              
                                    <input type="text" name="setModelo" style="height: 30px" required="true" id="modelo"/>
                                </td>

                                <td>
                                    <div>
                                        <label for="placa"> Placa</label>
                                    </div>
                              
                                    <input type="text" name="setPlaca"  class="placa"placeholder="aaa-0000" 
                                           style="height: 30px" required="true" id="placa"maxlength="8"/>
                                </td>

                                <td >
                                    <div >
                                        <label for="ocupacao">Ocupação</label>
                                    </div>
                               
                                    <input type="text" name="setOcupacao" maxlength="3"
                                           style="height: 30px" required="true" id="ocup" >
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
                                    <div >
                                        <label for="valExt">Validade do Extintor</label>
                                    </div>
                              
                                    <input type="text" id="calendario" 
                                           name="setValiExtintor" style="height: 100%" required="true"/>                             
                                </td>

                                <td >
                                    <div >
                                        <label for="kmAtual">Km Atual</label>                                                        
                                    </div>
                           
                                    <input  type="text"  name="setKmAtual" id="kmAtual"
                                            style="height: 100%" required="true">
                                </td>

                                <td>
                                    <div  >
                                        <label for="proxTrocaOl"> Próxima Troca de Óleo</label>                                                        
                                    </div>                                               
                             
                                    <input  type="text" name="setTrocaOleo"id="proxTrocaOl"
                                            style="height: 100%" required="true">
                                </td>
                            </tr>

                            <tr>
                                <td >
                                    <div >
                                        <label for="proxTrocaFilOl">Próxima Troca do Filtro de Óleo</label>
                                    </div>                                                
                                
                                    <input  type="text" name="setTrocaFiltroOleo"id="proxTrocaFilOl"
                                            style="height: 100%" required="true" >
                                </td>

                                <td >
                                    <div>
                                        <label for="proxTrocaFilAr">Próxima Troca do Filtro de AR</label>
                                    </div>
                               
                                    <input  type="text" name="setTrocaFiltroAR"id="proxTrocaFilAr"
                                            style="height: 100%" required="true" >
                                </td>

                                <td >
                                    <div >
                                        <label for="proxTrocaFilComb">Próxima Troca do Filtro de Combustível</label>
                                    </div>
                              
                                    <input  type="text" name="setTrocaFiltroCombus" id="proxTrocaFilComb"
                                            style="height: 100%" required="true">
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
