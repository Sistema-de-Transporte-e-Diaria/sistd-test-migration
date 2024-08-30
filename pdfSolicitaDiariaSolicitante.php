<?php
require_once ('dompdf/autoload.inc.php');
include 'funcoes.php';

$idDiaria = $_GET['id'];
conecta();

$pesquisa = "SELECT * FROM listardiarias
                       WHERE codDiaria='$idDiaria'";

$resultado = mysql_query($pesquisa) or die("Houve um erro de banco de dados: " . mysql_error());
While ($registro = mysql_fetch_array($resultado)) {


    //tipo servidor
    $tiposolicitante = $registro['tipoSolicitante'];
    $tipooutros = $registro['tipoSolicitanteOutros'];
    //nivel solicitante
    $funcao = $registro['funcaoSolicitante'];
    //escolaridade
    $escolaridade = $registro['escolaridade'];
    //dados do solicitante
    $beneficiado = $registro['beneficiado']; //mudado a variavel e o campo da tabela de solicitante para beneficiado
    $solicitante = $registro['solicitante']; //mudado a variavel e o campo da tabela de nomesolicitante para solicitante
    $cpf = $registro['cpf'];
    $celular = $registro['celular'];
    $banco = $registro['banco'];
    $agencia = $registro['agencia'];
    $CC = $registro['conta'];
    $orgaosetor = $registro['setor'];
    $email = $registro['email'];
    //meio de transporte
    $meiotransporte = $registro['meioTransporte'];
    //cidade origem destino
    $cOrigem = $registro['nomeCidOrigem'];
   
    $cDestino = $registro['nome'];
    //motivo viagem / local evento
    $motivoviagem = $registro['motivoViagem'];
    $Outrosmotivostxt = $registro['motivoViagemOutro'];
    $localevento = $registro['localEvento'];
    //descricao motivo da viagem/data-hora inicio e fim do evento
    $descrmotivoViagem = $registro['descMotivoViagem'];
    $dtinicioevento = formatoData($registro['dtInicio']);
    $dtfimevento = formatoData($registro['dtFim']);
    $hrinicioevento = $registro['hrInicio'];
    $hrfimevento = $registro['hrFim'];
    $justificativa = $registro['justificativa'];
    $dtNasc1 = $registro['dtNasc'];
    $dtNasc = formatoData($dtNasc1);
    $meiotransportevolta = $registro['meioTransporteVolta'];
    
    $cargfunc = $registro['cargoFunOrigServMunEst'];
    $valetrans = $registro['valeTranspServMunEst'];
    $valealim = $registro['valeAlimentServMunEst'];
    $tipoDiaria = $registro['tipoDiaria'];
    $dtEmbarqueIDA1 = $registro['dtEmbarqueIDA'];
    $dtEmbarqueIDA = formatoData($dtEmbarqueIDA1);
    $dtEmbarqueVOLTA1 = $registro['dtEmbarqueVOLTA'];
    $dtEmbarqueVOLTA = formatoData($dtEmbarqueVOLTA1);
    $justDiariaEmbarque = $registro['justificativaDiariaEmbarque'];
    
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
if($tiposolicitante == "Servidor Estadual" || $tiposolicitante == "Servidor Municipal" || $tiposolicitante == "Empregado Público"){
     $re = " <b>Cargo/Função no órgão de origem:</b> $cargfunc<br> 
            <b>Vale Transporte:</b> R$ $valetrans<br>
            <b>Vale Alimentação:</b> R$ $valealim";
}
if($tipoDiaria == "Diária e Passagem" || $tipoDiaria == "Diária"){
    $diariaembarque = "<b>Data de Viagem/Embarque (IDA):</b> $dtEmbarqueIDA <br>"
                    . "<b>Data de Viagem/Embarque (VOLTA):</b> $dtEmbarqueVOLTA";
}
if($tipoDiaria == "Diária e Passagem" || $tipoDiaria == "Diária"){
    $just = "<tr>
                <td align='left' colspan=3><FONT size = '9.5'><b>&nbsp;&nbsp;Justificativa para data de Viagem/Embarque:(antes da data de início do evento)</b><FONT size = '9.5'>&nbsp;&nbsp;<br>
                    $justDiariaEmbarque &nbsp;&nbsp;&nbsp;
                 </td>
            </tr>";
}
if($tiposolicitante == "Servidor Estadual" || $tiposolicitante == "Servidor Municipal"){
  $func="";
}else if($tiposolicitante == "Empregado Público"){
  $func="";
}else{
    $func = "( X ) $funcao";
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
                            <img src='imagens/imagem.jpg' width='110' heigth='100'></td>
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
                           <td><FONT size = 10.0><b>PROPOSTA DE CONCESSÃO DE DIÁRIAS E PASSAGENS Nº $idDiaria</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 10.0>&nbsp;</td>
                        </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                       <tr>
                         <th bgcolor='#CCCCCC' colspan='0'><font size='2'type='Times New Roman'><b><p align='left'>Dados do proposto</p></b></font></th>
                       </tr>
                       <tr>
                          <td><FONT size = '9.5'>&nbsp;&nbsp;
                            ( X ) $tiposolicitante &nbsp;&nbsp; $tipooutros<br>
                            $re
                          </td>
                       
                       </tr>
                       <tr>
                          <td>
                            <FONT size = '9.5'><b>&nbsp;&nbsp;Função:</b>&nbsp;&nbsp;<FONT size = '9.5'>
                            $func <br>
                            <FONT size = '9.5'><b>&nbsp;&nbsp;Escolaridade da função:</b><FONT size = '9.5'>&nbsp;&nbsp;
                            ( X ) $escolaridade 
                          </td>
                       </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                       <tr>
                          <td  align='left' width='50%'>
                            <b>Nome:</b><FONT size = '10.0'><br>&nbsp;&nbsp;$beneficiado  <!-- mudada a variavel de solicitante para beneficiado -->
                          </td>
                          <td align='left'><FONT size = '9.5'><b>CPF:&nbsp;&nbsp;&nbsp;</b><FONT size = '9.5'>$cpf<br>
                              <FONT size = '9.5'><b>Data de Nasc.:&nbsp;&nbsp;&nbsp;</b><FONT size = '9.5'>$dtNasc<br>
                             <FONT size = '9.5'><b>Contato:&nbsp;&nbsp;&nbsp;</b><FONT size = '9.5'>&nbsp;&nbsp;&nbsp;$celular
                          </td>
                          <td align='left'><FONT size = '9.5'><b>&nbsp;&nbsp;Dados bancários:</b><br>
                             <FONT size = '9.5'><b>&nbsp;&nbsp;Banco:</b><FONT size = '9.5'>&nbsp;$banco<br>
                             <FONT size = '9.5'><b>&nbsp;&nbsp;Agência:</b><FONT size = '9.5'>&nbsp;$agencia<br>
                             <FONT size = '9.5'><b>&nbsp;&nbsp;C/C:</b><FONT size = '9.5'>&nbsp;$CC
                          </td>
                       </tr>
                       <tr>
                          <td align='left'>
                             <FONT size = '9.5'><b>&nbsp;&nbsp;Órgão ou setor de exercício:</b><FONT size = '9.5'>&nbsp;&nbsp;&nbsp;$orgaosetor
                          </td>
                          <td align='left' colspan=2>
                             <FONT size = '9.5'><b>&nbsp;&nbsp;E-mail:</b><FONT size = '9.5'>&nbsp;&nbsp;&nbsp;$email
                          </td>
                       </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                       <tr width='100%'>
                         <th bgcolor='#CCCCCC' colspan='1'><font size='2'type='Times New Roman'><b><p align='left'>&nbsp;&nbsp;Dados da Viagem</p></b></font></th>
                       </tr>
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td width='50%'><FONT size = '9.5'><b>&nbsp;&nbsp;Meio de Transporte:</b><br><FONT size = '9.5'>&nbsp;&nbsp;
                          <b>IDA:</b> ( X ) $meiotransporte  <br> &nbsp;&nbsp; 
                          <b>VOLTA:</b> ( X )$meiotransportevolta
                          </td>                          
                          <td align='center'><FONT size = '9.5'><b>Cidade de Origem (Campus):</b><br><FONT size = '9.5'>
                             $cOrigem / $UFOrigem &nbsp;&nbsp;&nbsp; 
                          </td>
                           <td align='center'><FONT size = '9.5'><b>Cidade de destino:</b><br><FONT size = '9.5'>
                             $cDestino / $UFDestino &nbsp;&nbsp;&nbsp; 
                          </td>
                       </tr>
                       <tr>
                          <td width='50%'><FONT size = '9.5'><b>&nbsp;&nbsp;Tipo de Diária:</b></FONT>
                            ( X ) <FONT size = '9.5'>$tipoDiaria</FONT> <br>
                             <FONT size = '9.5'>$diariaembarque</FONT>
                          </td>
                          <td width='50%'colspan=2><FONT size = '9.5'><b>&nbsp;&nbsp;Motivo da Viagem:</b><FONT size = '9.5'>&nbsp;&nbsp;<br>
                            ( X ) $motivoviagem &nbsp;&nbsp; $Outrosmotivostxt 
                          </td>
                      </tr>
                      $just
                     </table>
                     <table border='1' width='100%' cellspacing='0' cellpadding='0'>                       
                        <tr>
                            <th colspan='3'bgcolor='#CCCCCC'><font size='2'type='Times New Roman'><b><p align='left'>&nbsp;&nbsp;Dados do Evento</p></b></font></th>
                        </tr> 
                        <tr>
                          <td align='left' colspan=3><FONT size = '9.5'><b>&nbsp;&nbsp;Local do Evento:</b><FONT size = '9.5'>&nbsp;&nbsp;<br>
                                     $localevento &nbsp;&nbsp;&nbsp;
                          </td>
                       </tr>
                         <tr>                         
                            <td rowspan='3' width='50%'><FONT size = '9.5'><b>&nbsp;&nbsp;Justificativa da Viagem</b>(Objetivo/Assunto/Evento):<br>
                             <FONT size = '9.5'>&nbsp;&nbsp;&nbsp;$descrmotivoViagem&nbsp;
                             </td>
                             <td align='center'><FONT size = '9.5'><b>Data Inicio do Evento:</b><br><FONT size = '9.5'>
                               $dtinicioevento&nbsp;
                             </td>   
                             <td align='center'><FONT size = '9.5'><b>Hora de inicio do Evento:</b><br><FONT size = '9.5'>
                               $hrinicioevento&nbsp;
                           </td>
                             
                        </tr>           
                        <tr>
                           <td align='center'><FONT size = '9.5'><b>Data Fim do Evento:</b><br><FONT size = '9.5'>
                               $dtfimevento&nbsp;
                           </td>
                           <td align='center'><FONT size = '9.5'><b>Hora de Fim do Evento:</b><br><FONT size = '9.5'>
                               $hrfimevento&nbsp;
                           </td>
                        </tr>    
                        <tr>
                            <td colspan='2'><FONT size = '7.0'><b>&nbsp;&nbsp;Justificativa para o caso da solicitação ter sido feita com menos de 05 DIAS da data do afastamento (evento):</b><br><FONT size = '9.5'>
                              &nbsp;&nbsp;&nbsp;&nbsp;<br>$justificativa
                            </td>
                        </tr> 
                        <tr>
                            <td colspan='3'> 
                               <table border='1' width='100%' cellspacing='0' cellpadding='0'>
                                 <tr>                                                                <!-- mudada a variavel de nomesolicitante para solicitante -->
                                   <td align = 'center'><FONT size = '10.0'><b>Proposto<br><br><br><FONT size = '7.0'>$solicitante<br>Assinatura e Carimbo do Proposto<br><br>DATA:_______/________/_________<br>Obs.: Preenchimento obrigatório para abertura do processo.</b>
                                   </td>
                                   <td align = 'center'><FONT size = '10.0'><b>PROPONENTE(CHEFE IMEDIATO)<br><br><br><FONT size = '7.0'><br>Assinatura e Carimbo do Proponente<br><br>DATA:_______/________/_________<br>Obs.: Preenchimento obrigatório para abertura do processo.</b>
                                   </td>
                                 </tr>
                               </table>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan='3'> 
                               <table border='0' width='100%' cellspacing='0' cellpadding='0'>                                
                                 <tr>
                                   <td align = 'center'><FONT size = '9.5'><b>Anexar a esta solicitação memorando, e-mail ou qualquer outro documento com a motivação a viagem.</b><br>
                                   </td>
                                 </tr>
                                 <tr>
                                   <td align = 'center'><FONT size = '9.5'><b>Em caso de viagens aéreas, devolver os bilhetes originais.</b><br><br>
                                   </td>
                                 </tr>   
                            </table>
                            <table width='40%'>
                                <tr>
                                   <td ><FONT size = '9.5'><b>REGISTRO NO SCDP (Obs.: Não Preencher).</b><br>
                                   </td>
                                </tr>                                
                            </table>
                            <table border='1' width='40%' >
                                <tr>
                                     <td width='30%'>PCDP:
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Valor:
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Solicitante:
                                    </td>
                                    <td>
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
$dompdf->stream('solicitacao de Diária '.$idDiaria.'.pdf');
?>  

