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
        <title>Controlando Solicitação</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário controle.php
        $getCodSolicitacaoControle = $_POST[setCodControleSolicite];
        $getIdMotoristaControle = $_POST[setMotorista];
        $getDiaria = $_POST[setDiaria];
        $getIdVeiculoControle = $_POST[setVeiculo];
        $getKmSaida = $_POST[setKmSaida];
        $getDtSaida = $_POST[setDtSaida];
        $getHrSaida = $_POST[setHrSaida];
        $getPlantonistaSaida = $_POST[setPlantonistaSaida];
        $getKmRetorno = $_POST[setKmRetorno];
        $getDtRetorno = $_POST[setDtRetorno];
        $getHrRetorno = $_POST[setHrRetorno];
        $getHoraExtra = $_POST[setHoraExtra];
        $getPlantonistaRetorno = $_POST[setPlantonistaRetorno];
        $getCombustivel = $_POST[setCombus];
        $getKmForaRota1 = $_POST[setKmForaRota1];
        $getHrForaRota1 = $_POST[setHrForaRota1];
        $getDeslocForaRota1 = $_POST[setDeslocForaRota1];
        $getFinaleForaRota1 = $_POST[setFinaleForaRota1];
        $getSoliciForaRota1 = $_POST[setSoliciForaRota1];
        $getKmForaRota2 = $_POST[setKmForaRota2];
        $getHrForaRota2 = $_POST[setHrForaRota2];
        $getDeslocForaRota2 = $_POST[setDeslocForaRota2];
        $getFinaleForaRota2 = $_POST[setFinaleForaRota2];
        $getSoliciForaRota2 = $_POST[setSoliciForaRota2];
        $getKmForaRota3 = $_POST[setKmForaRota3];
        $getHrForaRota3 = $_POST[setHrForaRota3];
        $getDeslocForaRota3 = $_POST[setDeslocForaRota3];
        $getFinaleForaRota3 = $_POST[setFinaleForaRota3];
        $getSoliciForaRota3 = $_POST[setSoliciForaRota3];
        $getKmForaRota4 = $_POST[setKmForaRota4];
        $getHrForaRota4 = $_POST[setHrForaRota4];
        $getDeslocForaRota4 = $_POST[setDeslocForaRota4];
        $getFinaleForaRota4 = $_POST[setFinaleForaRota4];
        $getSoliciForaRota4 = $_POST[setSoliciForaRota4];
        $getKmForaRota5 = $_POST[setKmForaRota5];
        $getHrForaRota5 = $_POST[setHrForaRota5];
        $getDeslocForaRota5 = $_POST[setDeslocForaRota5];
        $getFinaleForaRota5 = $_POST[setFinaleForaRota5];
        $getSoliciForaRota5 = $_POST[setSoliciForaRota5];
        $getKmForaRota6 = $_POST[setKmForaRota6];
        $getHrForaRota6 = $_POST[setHrForaRota6];
        $getDeslocForaRota6 = $_POST[setDeslocForaRota6];
        $getFinaleForaRota6 = $_POST[setFinaleForaRota6];
        $getSoliciForaRota6 = $_POST[setSoliciForaRota6];
        $getOcorrencia = $_POST[setOcorrencia];

        $getDtSaida1 = converteData($getDtSaida);
        $getDtRetorno1 = converteData($getDtRetorno);

// Conexão com o banco de dados
        conecta();




// ATUALIZA O KM DO VEÍCULO
        $sqlKm1 = "UPDATE veiculos  set kmAtual='$getKmRetorno'
                    WHERE codVeiculo='$getIdVeiculoControle'";
        $sql = mysql_query($sqlKm1) or die("Houve um erro de banco de dados: " . mysql_error());


// Atualizar os campos da solicitação em andamento
        $sqlAtualizaReg = "UPDATE listarcontrole  SET diaria='$getDiaria',
                                kmSaidaControle='$getKmSaida', 
                                dtSaidaControle='$getDtSaida1', 
                                hrSaidaControle='$getHrSaida', 
                                plantonistaSaida='$getPlantonistaSaida', 
                                kmRetornoControle='$getKmRetorno', 
                                dtRetornoControle='$getDtRetorno1', 
                                hrRetornoControle='$getHrRetorno', 
                                plantonistaRetorno='$getPlantonistaRetorno',
                                combustivel='$getCombustivel',
                                kmForaRota1='$getKmForaRota1', 
                                hrForaRota1='$getHrForaRota1', 
                                deslocForaRota1='$getDeslocForaRota1', 
                                finalidadeForaRota1='$getFinaleForaRota1', 
                                solicitanteForaRota1='$getSoliciForaRota1',
                                kmForaRota2='$getKmForaRota2', 
                                hrForaRota2='$getHrForaRota2',  
                                deslocForaRota2='$getDeslocForaRota2',
                                finalidadeForaRota2='$getFinaleForaRota2', 
                                solicitanteForaRota2='$getSoliciForaRota2', 
                                kmForaRota3='$getKmForaRota3', 
                                hrForaRota3='$getHrForaRota3', 
                                deslocForaRota3='$getDeslocForaRota3', 
                                finalidadeForaRota3='$getFinaleForaRota3', 
                                solicitanteForaRota3='$getSoliciForaRota3',
                                kmForaRota4='$getKmForaRota4', 
                                hrForaRota4='$getHrForaRota4', 
                                deslocForaRota4='$getDeslocForaRota4', 
                                finalidadeForaRota4='$getFinaleForaRota4', 
                                solicitanteForaRota4='$getSoliciForaRota4', 
                                kmForaRota5='$getKmForaRota5', 
                                hrForaRota5='$getHrForaRota5', 
                                deslocForaRota5='$getDeslocForaRota5', 
                                finalidadeForaRota5='$getFinaleForaRota5', 
                                solicitanteForaRota5='$getSoliciForaRota5', 
                                kmForaRota6='$getKmForaRota6',
                                hrForaRota6='$getHrForaRota6', 
                                deslocForaRota6='$getDeslocForaRota6',
                                finalidadeForaRota6='$getFinaleForaRota6', 
                                solicitanteForaRota6='$getSoliciForaRota6',
                                ocorrencia='$getOcorrencia'
                      WHERE codSolicitacaoControle='$getCodSolicitacaoControle'";
// Atualiza o status da solicitação para status 3 (finalizada)
        $sqlAtualizaStatus = "UPDATE solicitacao SET statusSolicitacao=3
                      WHERE codSolicitacao = '$getCodSolicitacaoControle'";
        gravaLog("Finalizou a solicitação nº $getCodSolicitacaoControle");
// Consulta se o código da solicitação já existe na tabela controle
        $sqlConsultaReg = "SELECT codSolicitacaoControle FROM controle 
                    WHERE codSolicitacaoControle = '$getCodSolicitacaoControle'";
        $resultadoConsultaReg = mysql_query($sqlConsultaReg) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroConsultaReg = mysql_fetch_array($resultadoConsultaReg)) {
            $x = $registroConsultaReg["codSolicitacaoControle"];
        }
        /* Se o código da solicitação não existir na tabela controle, o código abaixo é executado,
         *  para primeiro criar o registro na tabela controle e após preencher os damais campos com o UPDATE
          declarado acima. */

        if ($x <> $getCodSolicitacaoControle) {
            $sqlCriaReg = "INSERT INTO controle (codSolicitacaoControle,
                                         idMotorista,
                                         diaria,
                                         idVeiculo)
                         VALUES ('$getCodSolicitacaoControle',
                                 '$getIdMotoristaControle',
                                 '$getDiaria',
                                 '$getIdVeiculoControle')";

            $sqlCriaReg1 = mysql_query($sqlCriaReg) or die("Houve um erro de banco de dados: " . mysql_error());
        }

        $sqlAtualizaReg1 = mysql_query($sqlAtualizaReg) or die("Houve um erro de banco de dados: " . mysql_error());
        $sqlAtualizaStatus1 = mysql_query($sqlAtualizaStatus) or die("Houve um erro de banco de dados: " . mysql_error());



        $sqlKm = "UPDATE veiculos  set kmAtual='$getKmRetorno'
                    WHERE codVeiculo='$getIdVeiculoControle'";
        $sql2 = mysql_query($sqlKm) or die("Houve um erro de banco de dados: " . mysql_error());

        $sqlBancoHoras = "INSERT INTO bancoHoras (idMotoristaBancoHoras,
                                         idSolicitacaoBancoHoras,
                                         horaExtra)
                                        
                         VALUES ('$getIdMotoristaControle',
                                 '$getCodSolicitacaoControle',
                                 '$getHoraExtra')";

        $sqlBancoHoraInsert = mysql_query($sqlBancoHoras) or die("Houve um erro de banco de dados: " . mysql_error());
      
        ?>


        <script language=javascript>alert('Solicitação finalizada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarSolicitacao.php";
        </script>
    </body>
</html>




