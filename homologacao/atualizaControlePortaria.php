<?php include ('validar_session.php');
conecta();
$sql1 = "SELECT siape, administrador "
        . " FROM solicitantes WHERE siape='$login_usuario'";
$res = mysql_query($sql1);
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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Atualizando Solicitação</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário controle.php
        $getCodSolicitacaoControle = $_POST[setCodControleSolicite];          
        $getKmSaida = $_POST[setKmSaida];
        $getDtSaida = $_POST[setDtSaida];
        $getHrSaida = $_POST[setHrSaida];
        $getPlantonistaSaida = $_POST[setPlantonistaSaida];
        $getKmRetorno = $_POST[setKmRetorno];
        $getDtRetorno = $_POST[setDtRetorno];
        $getHrRetorno = $_POST[setHrRetorno];       
        $getPlantonistaRetorno = $_POST[setPlantonistaRetorno];
        $getCombustivel = $_POST[setCombus];
        
        $getDtSaida1 = converteData($getDtSaida);
        $getDtRetorno1 = converteData($getDtRetorno);

        echo $getCodSolicitacaoControle . '<br>';
        echo $getKmSaida . '<br>';
        echo $getDtSaida . '<br>';
        echo $getHrSaida . '<br>';
        echo $getPlantonistaSaida . '<br>';
        echo $getKmRetorno . '<br>';
        echo $getDtRetorno . '<br>';
        echo $getHrRetorno . '<br>';
        echo $getPlantonistaRetorno . '<br>';
        echo $getCombustivel . '<br>';
// Conexão com o banco de dados
        conecta();


// Atualizar os campos da solicitação em andamento
        $sqlAtualizaReg = "UPDATE listarcontrole  SET 
                                kmSaidaControle='$getKmSaida', 
                                dtSaidaControle='$getDtSaida1', 
                                hrSaidaControle='$getHrSaida', 
                                plantonistaSaida='$getPlantonistaSaida', 
                                kmRetornoControle='$getKmRetorno', 
                                dtRetornoControle='$getDtRetorno1', 
                                hrRetornoControle='$getHrRetorno', 
                                plantonistaRetorno='$getPlantonistaRetorno',
                                combustivel='$getCombustivel'                               
                                WHERE codSolicitacaoControle='$getCodSolicitacaoControle'";
         $sql1 = mysql_query($sqlAtualizaReg) or die("Houve um erro de banco de dados: " . mysql_error());         
         if($getKmRetorno != ""){
             emailEncerrarSolic($getCodSolicitacaoControle);
         }
        ?>


        <script language=javascript>alert('Solicitação atualizada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarSolicitacaoPortaria.php";
        </script>
    </body>
</html>




