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
            <u><i><b>Matriz de Solicitações Anexadas</b></i></u>
            </td>
            <td style="width: 33%" align="right">
              <u><i><b>Emitido em: <?=$agora?></b></i></u>
          </td>
      </tr>
    </table>
  </font>
</head>
<body>
 <br>
  <table align='center' border='1' style='width: 50%'>
       <tr style="background-color: #CCC">
          <td style='font-size: small; width: 12%; text-align: center'>Solicitação Primária</td>
          <td style='font-size: small; width: 30%; text-align: center'>Solicitações Anexadas</td>
          
       </tr>
  </table>
 
 <?php 
  conecta();
      // Seleciona todos dos dados da view listarsolicitacao ordenando pelo campo statusSolicitacao em ordem crescente
      $pesquisa = "SELECT idPrimaria, idSecundaria FROM anexadas
                           WHERE statusAnexo = 1 group by idPrimaria";
                    $resultado = mysql_query($pesquisa) or die ("Houve um erro de banco de dados: ".mysql_error());
      
              While($registro=mysql_fetch_array($resultado))
                   { 
                   $primaria = $registro['idPrimaria'];
                  
  ?>              
 
       <table align='center' border='1' style='width: 50%'>    
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
            
            
              
                
                 <td style='font-size: small; width: 12%; text-align: center'><?=$primaria?></td>
                 <td style='font-size: small; width: 30%; text-align: center'> 
                     <?php 
                               conecta();
                               $sqlAnexadas = "SELECT idPrimaria, idSecundaria FROM anexadas
                                                  WHERE idPrimaria = $primaria"; 
                               $resultadoAnexadas = mysql_query($sqlAnexadas) or die ("Não foi possível realizar a consulta ao banco de dados");
                                    While($registroAnexadas=mysql_fetch_array($resultadoAnexadas))
                                             {
                                              echo $registroAnexadas['idSecundaria'];
                                              echo " - ";
                                    }




                        ?>
                 </td>
                
                
               </tr>     
      </table>
    <?php } ?>

 
   </body>
</html>


   
   
           


