<?php include ('validar_session.php'); ?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Solicitação Efetuada</title>
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
        <?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
        $getCodSolicitante = $_POST[setEscolhaSolicitante];
        $PrevDtSaida = $_POST[prevDtSaida];
        $PrevHrSaida = $_POST[prevHrSaida];
        $PrevDtRetorno = $_POST[prevDtRetorno];
        $PrevHrRetorno = $_POST[prevHrRetorno];
        $Destino = $_POST[destino];
        $Finalidade = $_POST[finalidade];
        $getQtdPassagerios = $_POST[qtdPassageiros];
        $Ocupante1 = $_POST[ocupante1];
        $SiapeOcup1 = $_POST[siapeOcup1];
        $FoneOcup1 = $_POST[foneOcup1];
        $Ocupante2 = $_POST[ocupante2];
        $SiapeOcup2 = $_POST[siapeOcup2];
        $FoneOcup2 = $_POST[foneOcup2];
        $Ocupante3 = $_POST[ocupante3];
        $SiapeOcup3 = $_POST[siapeOcup3];
        $FoneOcup3 = $_POST[foneOcup3];
        $Ocupante4 = $_POST[ocupante4];
        $SiapeOcup4 = $_POST[siapeOcup4];
        $FoneOcup4 = $_POST[foneOcup4];
        $calcHora = calculaHoras($PrevDtSaida, $PrevHrSaida);
        $PrevDtSaida1 = converteData($PrevDtSaida);
        $PrevDtRetorno1 = converteData($PrevDtRetorno);
        $dataHoraSolicita = date("Y/m/d H:i:s ");

         $pesquisaSet1 = "SELECT * FROM listarsolicitacao WHERE idSolicitante=$getCodSolicitante";
                            $resultadoSet1 = mysql_query($pesquisaSet1) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registroSet1 = mysql_fetch_array($resultadoSet1)) {
                                $privilegioSet = $registroSet1["privilegioSetor"];
                            }
// Grava na tabela 'solicitacao' todo o conteúdo das variáveis acima
        $pesquisaManut1 = "SELECT * FROM manutencao";
                            $resultadoManut1 = mysql_query($pesquisaManut1) or die("Houve um erro de banco de dados: " . mysql_error());
                            While ($registroManut1 = mysql_fetch_array($resultadoManut1)) {
                                $horasVeiculoPeq1 = $registroManut1["veiculoPassageiro"];
                            $horasVeiculoGrande1 = $registroManut1["veiculoColetivo"];
                            }
             //aqui o status para veículos pequenos fica 5 porque a solicitação está fora do prazo               
        if( $getQtdPassagerios<=4 && $calcHora < $horasVeiculoPeq1 ){
        $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno, 
                                        hrRetorno, destino, finalidade, qtdPassageiros,
                                        ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3, 
                                        foneOcup3, ocupante4, foneOcup4, diferencaHoras,dataHoraSolicita,
                                        siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao) 
                                VALUES ('$getCodSolicitante', '$PrevDtSaida1', 
                                         '$PrevHrSaida', '$PrevDtRetorno1',
                                         '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
                                         '$Ocupante1', '$FoneOcup1', '$Ocupante2',
                                         '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
                                         '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
                . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', '5')";
        }
        //aqui o status para veículos pequenos fica 1 porque a solicitação está dentro do prazo   
        if( $getQtdPassagerios<=4 && $calcHora >= $horasVeiculoPeq1 ){
        $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno, 
                                        hrRetorno, destino, finalidade, qtdPassageiros,
                                        ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3, 
                                        foneOcup3, ocupante4, foneOcup4, diferencaHoras,dataHoraSolicita,
                                        siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao) 
                                VALUES ('$getCodSolicitante', '$PrevDtSaida1', 
                                         '$PrevHrSaida', '$PrevDtRetorno1',
                                         '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
                                         '$Ocupante1', '$FoneOcup1', '$Ocupante2',
                                         '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
                                         '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
                . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', '1')";
        }
        
         //aqui o status para veículos grandes fica 5 porque a solicitação está fora do prazo   
        if( $getQtdPassagerios>4 && $calcHora < $horasVeiculoGrande1 ){
        $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno, 
                                        hrRetorno, destino, finalidade, qtdPassageiros,
                                        ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3, 
                                        foneOcup3, ocupante4, foneOcup4,diferencaHoras,dataHoraSolicita,
                                        siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao) 
                                VALUES ('$getCodSolicitante', '$PrevDtSaida1', 
                                         '$PrevHrSaida', '$PrevDtRetorno1',
                                         '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
                                         '$Ocupante1', '$FoneOcup1', '$Ocupante2',
                                         '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
                                         '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
                . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', '5')";
        }
        
       
        if($privilegioSet == 1){
        $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno, 
                                        hrRetorno, destino, finalidade, qtdPassageiros,
                                        ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3, 
                                        foneOcup3, ocupante4, foneOcup4,diferencaHoras,dataHoraSolicita,
                                        siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao) 
                                VALUES ('$getCodSolicitante', '$PrevDtSaida1', 
                                         '$PrevHrSaida', '$PrevDtRetorno1',
                                         '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
                                         '$Ocupante1', '$FoneOcup1', '$Ocupante2',
                                         '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
                                         '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
                . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', '1')";
        }
        
        if( $getQtdPassagerios>4 && $calcHora >= $horasVeiculoGrande1 ){
        $sql = "INSERT INTO solicitacao (idSolicitante, dtSaida, hrSaida, dtRetorno, 
                                        hrRetorno, destino, finalidade, qtdPassageiros,
                                        ocupante1, foneOcup1, ocupante2, foneOcup2, ocupante3, 
                                        foneOcup3, ocupante4, foneOcup4,diferencaHoras,dataHoraSolicita,
                                        siapeOcupante1, siapeOcupante2, siapeOcupante3, siapeOcupante4, statusSolicitacao) 
                                VALUES ('$getCodSolicitante', '$PrevDtSaida1', 
                                         '$PrevHrSaida', '$PrevDtRetorno1',
                                         '$PrevHrRetorno', '$Destino', '$Finalidade', '$getQtdPassagerios',
                                         '$Ocupante1', '$FoneOcup1', '$Ocupante2',
                                         '$FoneOcup2', '$Ocupante3', '$FoneOcup3',
                                         '$Ocupante4', '$FoneOcup4','$calcHora','$dataHoraSolicita',"
                . "' $SiapeOcup1','$SiapeOcup2', '$SiapeOcup3','$SiapeOcup4', '1')";
        }
         if ($getQtdPassagerios > 48) {
            ?>
            <script>alert("                  ERRO\n\
                        Não foi possível realizar sua solicitação, pois não temos\n\
                        veículo que suporte mais do que 48 passageiros!")
                location.href = "listarSolicitacao.php";
            </script>
            <?php
            exit();
        }
        conecta();
        if (($getQtdPassagerios >= "5") && ($getQtdPassagerios <= "48")) {
            ?>
            <script>
                window.open('Lista_passageiros.pdf');
                window.open('pdfSolicita.php');
            </script>

        <?php } else {
            ?>
            <script>
                window.open('pdfSolicita.php');
            </script>
            <?php
        }
        $sql1 = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
        $sqlUltimoCod = "SELECT * FROM listarsolicitacao 
                        ORDER BY codSolicitacao DESC LIMIT 1";
        $resultadoUltimoCod = mysql_query($sqlUltimoCod) or die("Não foi possível realizar a consulta ao banco de dados");
        While ($registroUltimoCod = mysql_fetch_array($resultadoUltimoCod)) {
            $ultimaSolicitacao = $registroUltimoCod['codSolicitacao'];
            $privilegioSetor = $registroUltimoCod['privilegioSetor'];
        }

        emailSolicitacao($ultimaSolicitacao);
        gravaLog("Cadastrou solicitação");
        
       if ($QtdPassageiros <= 4 && $calcHora < $horasVeiculoPeq1 && $privilegioSetor == 2) {
            ?>
            <script language=javascript>alert('Sua solicitação está fora do prazo,ficará a cargo do CTMA liberá-la ou não!');</script>  
        <?php } elseif ($QtdPassageiros >= 5 && $calcHora < $horasVeiculoGrande1 && $privilegioSetor == 2) { ?>
            <script language=javascript>alert('Sua solicitação está fora do prazo,ficará a cargo do CTMA liberá-la ou não!');</script> 
        <?php } else { ?>
            <script language=javascript>alert('Solicitação cadastrada com sucesso!');</script> 
        <?php } ?>

        <script>
            location.href = "listarSolicitacao.php";
        </script>

    </body>
</html>


