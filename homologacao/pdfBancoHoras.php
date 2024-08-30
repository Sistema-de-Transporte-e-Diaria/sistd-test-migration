<?php

require_once ('dompdf/autoload.inc.php');
include 'funcoes.php';
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
<?php

conecta();

$sqlManut = "SELECT * FROM manutencao";
$resManut = mysql_query($sqlManut);
while ($rowManut = mysql_fetch_assoc($resManut)) {
    $nomeCampus = $rowManut['nomeCampus'];
    $endCampus = $rowManut['enderecoCampus'];
    $telCampus = $rowManut['telCampus'];
    $nomeSetorResp = $rowManut['nomeSetorCampus'];
    $siglaSetorResp = $rowManut['siglaSetorCampus'];
}

$sqlPdf = "SELECT * FROM listarfolga
                        ORDER BY idFolga DESC LIMIT 1";
$resultadoPdf = mysql_query($sqlPdf) or die("Houve um erro de banco de dados: " . mysql_error());
While ($registro = mysql_fetch_array($resultadoPdf)) {
    $codFolga = $registro['idFolga'];
    $motorista = $registro['motorista'];
    $horas = $registro['quantHoraFolga'];
    $dataFolga = formatoData($registro['dataFolga']);
    $justificativa = $registro['justificativaFolga'];
}
$hoje = date('d/m/Y');
$html = "<html>
         <body>
            <center>
               <table border='0' width='100%'>
                 <tr>
                   <td width='100%'>
                     <table width='100%' border='0' align='center' cellspacing='0' cellpadding='0'> 
                       <tr align='center'>
                        <td>
                            <img src='imagens/imagem.jpg' width='110' heigth='110'></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0><b>SERVIÇO PÚBLICO FEDERAL</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0><b>INSTITUTO FEDERAL DE EDUCAÇÃO CIÊNCIA E TECNOLOGIA DE PERNAMBUCO</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0><b>CAMPUS $nomeCampus</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0>&nbsp;</td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0><b>REGISTRO DE FOLGA DE MOTORISTA Nº $codFolga</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0>&nbsp;</td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0>&nbsp;</td>
                        </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                       <tr>
                         <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='left'>INFORMAÇÕES DO BENEFICIADO</p></b></font></th>
                       </tr>
                       <tr>
                          <td><FONT size = '9.5'>&nbsp;&nbsp;<br>
                             <table width='100%' cellspacing='0' cellpadding='0'>
                               <tr>
                                  <td width='50%'>
                                      <b>NOME:&nbsp;&nbsp;</b><FONT size = '10.0'>$motorista<br>
                                  </td>
                                  <td>
                                      <b>ABATIMENTO DO BANCO DE HORAS:&nbsp;&nbsp;</b><FONT size = '10.0'>$horas Horas/Minutos<br><br>
                                   </td>
                                   </tr> 
                               <tr>
                                  <td>
                                    <b>DATA DA FOLGA:&nbsp;&nbsp;</b><FONT size = '9.5'> $dataFolga<br><br>
                                  </td>
                              </tr>
                       </table>   
                       <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                              <tr>
                                <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='left'>JUSTIFICATIVA</p></b></font></th>
                              </tr>
                              <tr>
                                  <td> <b>JUSTIFICATIVA:&nbsp;&nbsp;</b><FONT size = '10.0'>$justificativa</td>
                             </tr>
                      </table>
                      <br><br><br><br>
                      <table width='100%'>
                          <tr align='center'>
                             <td width='100%' align='center'>Garanhuns, $hoje</td>
                         </tr> 
                      </table>
                      <br><br><br><br><br>
                      <table border='0' width='100%' cellspacing='0' cellpadding='0'>
                          <tr align='center'>
                                  <td width='33%' align='center'>________________________________________</td>
                                  <td width='33%'></td>
                                  <td width='33%' align='center'>________________________________________</td>
                         </tr> 
                         <tr align='center'>
                                  <td width='33%' align='center'>MOTORISTA</td>
                                  <td width='33%'></td>
                                  <td width='33%' align='center'>COORDENAÇÃO $siglaSetorResp</td>
                         </tr> 
                            <br><br><br><br><br><br><br>

                     </table>
                 </center>
           </body>
       </html>";

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Folga motorista $codFolga.pdf");
?>  

