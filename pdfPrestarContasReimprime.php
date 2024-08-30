<?php
require_once ('dompdf/autoload.inc.php');
include 'funcoes.php';

if (!empty($_POST[setEscolhaDiaria])) {
    $parametro = $_POST[setEscolhaDiaria];
} else {
    $parametro = $_POST[setCodDiaria];
}

conecta();
$pesquisa = "SELECT * FROM listardiarias
                       WHERE codDiaria = '$parametro'";

$resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
While ($registro = mysql_fetch_array($resultado)) {
    $codSolicitacaodiaria = $registro['codDiaria'];
    $tiposolicitante = $registro['tipoSolicitante'];
    $tipooutros = $registro['tipoSolicitanteOutro'];
    $funcao = $registro['funcaoSolicitante'];
    $siape = $registro['siape'];
    $beneficiado = $registro['beneficiado'];
    $solicitante = $registro['solicitante'];
    $orgaosetor = $registro['setor'];
    $cOrigem = $registro['nomeCidOrigem'];
    $cDestino = $registro['nome'];
    $descrmotivoViagem = $registro['descPrestarConta'];
    $dtinicioevento = formatoData($registro['dtInicio']);
    $dtfimevento = formatoData($registro['dtFim']);
    $UFOrigem = $registro['siglaUForigem'];
    $UFDestino = $registro['sigla'];
}
$sqlManut = "SELECT * FROM manutencao";
$resManut = mysql_query($sqlManut);
while ($rowManut = mysql_fetch_assoc($resManut)) {
    $nomeCampus = $rowManut['nomeCampus'];
    $endCampus = $rowManut['enderecoCampus'];
    $telCampus = $rowManut['telCampus'];
    $nomeSetorResp = $rowManut['nomeSetorCampus'];
    $siglaSetorResp = $rowManut['siglaSetorCampus'];
}
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
                           <td><FONT size = 10.0><b>RELATÓRIO DE VIAGENS NACIONAIS Nº $parametro</b></td>
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
                         <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='left'>IDENTIFICAÇÃO DO PROPOSTO</p></b></font></th>
                       </tr>
                       <tr>
                          <td><FONT size = '9.5'>&nbsp;&nbsp;<br>
                             <table width='100%' cellspacing='0' cellpadding='0'>
                                <tr>
                                   <td>
                                     ( X ) $tiposolicitante &nbsp;&nbsp; $tipooutros<br><br>
                                   </td>
                               </tr> 
                               <tr>
                                   <td width='50%'>
                                      <b>NOME:&nbsp;&nbsp;</b><FONT size = '10.0'>$beneficiado<br>
                                   </td>
                                   <td width='50%'>
                                      <b>SIAPE:&nbsp;&nbsp;</b><FONT size = '10.0'>$siape<br><br>
                                   </td>
                               </tr> 
                               <tr>
                                   <td>
                                     <b>CARGO:&nbsp;&nbsp;</b><FONT size = '9.5'> $funcao<br><br>
                                   </td>
                               </tr>
                               <tr>
                                   <td>
                                     <b>ÓRGÃO DE EXERCÍCIO:&nbsp;&nbsp;</b><FONT size = '9.5'>$orgaosetor<br><br>
                                   </td>
                               </tr>      
                             </table>
                          </td>
                      </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                        <tr>
                          <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='left'>IDENTIFICAÇÃO DO AFASTAMENTO</p></b></font></th>
                        </tr>
                        <tr>
                          <td><FONT size = '9.5'>&nbsp;&nbsp;<br>
                            <table width='100%' cellspacing='0' cellpadding='0'>
                              <tr>
                                 <td width='50%'><b>CIDADE DE ORIGEM:&nbsp;&nbsp;</b><FONT size = '10.0'>$cOrigem / $UFOrigem</td>
                                 <td width='50%'><b>CIDADE DE DESTINO:&nbsp;&nbsp;</b><FONT size = '10.0'>$cDestino / $UFDestino</td>
                              </tr>
                              <tr>
                                 <td>&nbsp;</td>
                              </tr>
                              <tr>
                                 <td width='50%'><b>DATA DA SAÍDA:&nbsp;&nbsp;</b><FONT size = '10.0'>$dtinicioevento<br><br></td>
                                 <td width='50%'><b>DATA DA CHEGADA:&nbsp;&nbsp;</b><FONT size = '10.0'>$dtfimevento<br><br></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                        <tr>
                          <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='center'>DESCRIÇÃO SUCINTA DA VIAGEM</p></b></font></th>
                        </tr>
                        <tr>
                          <td><FONT size = '9.5'><br><br>&nbsp;&nbsp;$descrmotivoViagem&nbsp;<br><br>
                          </td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;
                          </td>
                        </tr>
                        <tr>
                            <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                              <tr>
                                 <td width='49%' align='center'><b><br><br><br><br><br><br><FONT size = '10.0'>$beneficiado</b><br>Mat. SIAPE: $siape<br><br><FONT size = '8.5'>Assinatura e Carimbo do proposto<br>Data:_______/________/_________<br><br></td>
                                 <td width='2%'><b>&nbsp;&nbsp;</b></td>
                                 <td width='49%' align='center'><b><br><br><br><br><br><br><br><br><br></b><FONT size = '8.5'>Assinatura e Carimbo do Proponente (chefe imediato)<br>Data:_______/________/_________<br><br></td>
                              </tr>
                              <tr>
                                 <td colspan='3'><b>Obs.: No caso de utilização de transporte aéreo, anexar comprovantes originais de embarque.</b></td>
                                 
                              </tr>
                            </table>
                        </tr>
                        
                     </table>   
                     
                       
                       
                   </td>
                 </tr>
               </table>
             </center>
           </body>
       </html>";
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Prestação de Contas da Diária número $codSolicitacaodiaria.pdf");
?>  

