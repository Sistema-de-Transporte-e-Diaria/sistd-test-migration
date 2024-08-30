<?php include '../funcoes.php';

$sqlManut = "SELECT * FROM manutencao";
$resManut = mysql_query($sqlManut);
while ($rowManut = mysql_fetch_assoc($resManut)) {
	$nomeCampus = $rowManut['nomeCampus'];
        $endCampus = $rowManut['enderecoCampus'];
        $telCampus = $rowManut['telCampus'];
        $nomeSetorResp = $rowManut['nomeSetorCampus'];
        $siglaSetorResp = $rowManut['siglaSetorCampus'];
}



$status2 = $_POST["status2"];
$status3 = $_POST["status3"];
$getEscolhaVeiculo = $_POST[setEscolhaVeiculo];
$getDtInicio1 = $_POST[setDtInicio];
$getDtFinal1 = $_POST[setDtFinal];

$getDtInicio = converteData($getDtInicio1);
$getDtFinal = converteData($getDtFinal1); 

$agora = date("d/m/Y H:i:s ");
    
    ?>                  
  <html>
  <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../estilo.css"/>
  </head>
  <body>
   <font face='arial'>
   <br>
     <table style="width: 100%" border="0">
      <head>
       <tr>
       <hr></hr>   
        </tr>
         <tr>
             <td style="width: 43.5%">
                <img src='../imagens/logo_ifpe_rel.png'>
            </td>
            <td align=center>
         <u><h3>RELATÓRIO</h3></u>
            </td>
             <td align=right>
                 <h2 style="font-family: Comic Sans MS; font-style: italic "><?=$siglaSetorResp?></h2><br>
                 <font face=" Comic Sans MS" color=""> Sistema de Solicitação de Transporte e Diárias. </font>
            </td>   
   </table>
   <table style="width: 100%" border="0">
       <tr><hr></hr>
       </tr>
         <tr>
             <td style="width: 33%" align="left">
                <u><i><b>Campus <?= $nomeCampus?></b></i></u>
             </td>
            <td style="width: 33%" align="center">
            <u><i><b>Solicitações por Veículo</b></i></u>
            </td>
            <td style="width: 33%" align="right">
              <u><i><b>Emitido em: <?=$agora?></b></i></u>
          </td>
      </tr>
      <tr>
    <td colspan="3" align="right">
        <button onclick="imprimir();">Imprimir</button>
    </td>
</tr>
    </table>
  </font>
</head>
<body>
 <br>
  <table align='left' border='1' style='width: 100%;' >
          <tr style="background-color: #CCC">
                <td style='font-size: small; width: 5%; text-align: center'>ID</td>
                <td style='font-size: small; width: 20%; text-align: center'>Solicitante</td>
                <td style='font-size: small; width: 4%; text-align: center'>Data Saída</td>
                <td style='font-size: small; width: 4.5%; text-align: center'>Data Retorno</td>
                <td style='font-size: small; width: 25%; text-align: center'>Destino</td>
                <td style='font-size: small; width: 4.5%; text-align: center'>Km Saída</td>
                <td style='font-size: small; width: 4.5%; text-align: center'>Km Retorno</td>
                <td style='font-size: small; width: 4.5%; text-align: center'>Total Km</td>
                <td style='font-size: small; width: 13%; text-align: center'>Veículo</td>
                 <td style='font-size: small; width: 15%; text-align: center'>Situação da Solicitação</td>
           </tr>
       </table>
 
 <?php 
  conecta();
      // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
      $pesquisa = "SELECT * FROM listarsolicitacaocontrole  WHERE
                         modelo LIKE '%$getEscolhaVeiculo%' 
                        AND dtSaida BETWEEN '$getDtInicio' AND '$getDtFinal'
                        AND statusSolicitacao REGEXP '^[$status2,$status3]'
                        ORDER BY dtSaida";
      
                       $resultado = mysql_query($pesquisa) or die ("Houve um erro de banco de dados: ".mysql_error());
      
              While($registro=mysql_fetch_array($resultado))
                   { 
                    $kmSaida = $registro['kmSaidaControle'];
                    $kmRetorno = $registro['kmRetornoControle'];
                    $kmTotal = ($kmRetorno - $kmSaida);
                    $kmTotalPeriodo += $kmTotal;
                    $contTotal++;
                    $kmSaidaTotal[] = $registro['kmSaidaControle'];
                    $kmRetornoTotal[] = $registro['kmRetornoControle'];
  ?>                
       <table align='left' border='1' style='width: 100%'>    
  <?php
         $cont++;
       if(($cont % 2) == 1)
          {  ?> 
             <tr align='left' style="background-color: #C1FFC1"> 
    <?php }
        else 
          { ?>
             <tr align='left'> 
   <?php  } ?>
              <br>
                 <td style='font-size: small; width: 5%; text-align: center'><?=$registro['codSolicitacao']?></td>
                 <td style='font-size: small; width: 20%; text-align: left'><?=$registro['nome']?></td>
                 <td style='font-size: small; width: 4%; text-align: center'><?=formatoData($registro["dtSaidaControle"])?></td> 
                 <td style='font-size: small; width: 4.5%; text-align: center'><?=formatoData($registro["dtRetornoControle"])?></td> 
                 <td style='font-size: small; width: 25%; text-align: left'><?=$registro['destino']?></td> 
                 <td style='font-size: small; width: 4.5%; text-align: center'><?=$registro['kmSaidaControle']?></td>
                 <td style='font-size: small; width: 4.5%; text-align: center'><?=$registro['kmRetornoControle']?></td>
                 <td style='font-size: small; width: 4.5%; text-align: center'><?=$kmTotal." Km"?></td>          
                 <td style='font-size: small; width: 13%; text-align: center'><?=$registro['modelo']?></td> 
                 <td style='font-size: small; width: 15%; text-align: center'>
                <?php                
                if ($registro['statusSolicitacao'] == '2') {
                    echo 'Autorizada';
                }
                if ($registro['statusSolicitacao'] == '3') {
                    echo 'Finalizada';
                }
                ?>
            </td> 
          </tr>     
      </table>
    <?php } ?>
    <table style="margin-left: 58.5%" border="1">
     <tr>
          <td style="color: #000000" align="right">Km Total das Viagens:</td>
         <td><b><input style="color: #800000; font-size: medium; text-align: center;" size="8" type="text" value='<?=$kmTotalPeriodo." Km"?>'></b></td>
     </tr>
     <tr>
          <td style="color: #000000" align="right">Km Total do Período:</td>
         <td><b><input style="color: #800000; font-size: medium; text-align: center;" size="8" type="text" value='<?=$kmRetornoTotal[($contTotal-1)]-$kmSaidaTotal[0]." Km"?>'></b></td>
     </tr>
 </table>
 <script>
    function imprimir() {
        window.print();
    }
</script>
    </body>
</html>


   
   
           


