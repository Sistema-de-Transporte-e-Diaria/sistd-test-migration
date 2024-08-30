<?php

include('funcoes.php');
require_once ('dompdf/autoload.inc.php');
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


$sqlPdf = "SELECT * FROM listarsolicitacao 
                        ORDER BY codSolicitacao DESC LIMIT 1";
$resultadoPdf = mysql_query($sqlPdf) or die("Houve um erro de banco de dados: " . mysql_error());
While ($registroPdf = mysql_fetch_array($resultadoPdf)) {
    $numsolicitacao = $registroPdf['codSolicitacao'];
    $solicitante = $registroPdf['nome'];
    $setorsolicitante = $registroPdf['nomeSetor'];
    $fonesolicitante = $registroPdf['telefone'];
    $datasaida = $registroPdf['dtSaida'];
    $horasaida = $registroPdf['hrSaida'];
    $dataretorno = $registroPdf['dtRetorno'];
    $horaretorno = $registroPdf['hrRetorno'];
    $destino = $registroPdf['destino'];
    $finalidade = $registroPdf['finalidade'];
    $ocupante01 = $registroPdf['ocupante1'];
    $foneocupante01 = $registroPdf['foneOcup1'];
    $SiapeOcup1 = $registroPdf['siapeOcupante1'];
    $ocupante02 = $registroPdf['ocupante2'];
    $foneocupante02 = $registroPdf['foneOcup2'];
    $SiapeOcup2 = $registroPdf['siapeOcupante2'];
    $ocupante03 = $registroPdf['ocupante3'];
    $foneocupante03 = $registroPdf['foneOcup3'];
    $SiapeOcup3 = $registroPdf['siapeOcupante3'];
    $ocupante04 = $registroPdf['ocupante4'];
    $foneocupante04 = $registroPdf['foneOcup4'];
    $SiapeOcup4 = $registroPdf['siapeOcupante4'];
    $horaDataSolicitacao = $registroPdf['dataHoraSolicita'];
}
$datasaida = formatoData($datasaida);
$dataretorno = formatoData($dataretorno);
$data = date('d/m/Y H:i:s', strtotime($horaDataSolicitacao));

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
              <table border='0' width='100%'>
                 <tr>
                  <td width='50%'>
                     <table width='100%' border='0' align='center' cellspacing='0' cellpadding='0'> 
                       <tr align='center'>
                        <td>
                            <img src='imagens/imagem.jpg' width='100' heigth='90'></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 9.5><b>SERVIÇO PÚBLICO FEDERAL</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 9.5><b>INSTITUTO FEDERAL DE EDUCAÇÃO CI&Ecirc;NCIA E TECNOLOGIA DE PERNAMBUCO</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 9.5><b>CAMPUS $nomeCampus</b></td>
                        </tr>
                        <tr align='center'>
                           <td><FONT size = 9.5><b>$nomeSetorResp</b></td>
                        </tr>
			<tr>
                        <td align ='center'><FONT size = 8.0><p><u><b>SOLICITAÇÃO DE VEÍCULO Nº $numsolicitacao</b></u> Em: $data</p></td>
                        </tr>
                        
                        <table border = '0' width='100%' cellspacing='0'>
                        <table border = '1' width='100%' cellspacing='0'>
                                <tr>
                                   <td width='70%'><FONT size = 7.0>&nbsp;&nbsp;$solicitante</td>
                                   <td width='30%'><FONT size = 7.0>&nbsp;&nbsp;$setorsolicitante</td>
                                </tr>
                             </table>
                                <tr>
                                   <td width='70%'><FONT size = 7.0><b>Solicitante</b></td>
                                   <td width='30%'><FONT size = 7.0><b>Coordenação / Setor</b></td>
                                </tr>
                             </table>
                             
                           </td>
                        </tr> 
                        </table>
                         <table border = '0' width='100%' cellspacing='0'>
                        <tr>
                           <td>
                              <table border = '0' width='100%' >
                                <tr>
                                   <td width='25%' align='left'><FONT size = 7.0><b>&nbsp;&nbsp;Previsão Saída&nbsp;&nbsp;&nbsp;</b></td>
                                   <td width='15%' align='left'><FONT size = 7.0><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora</b></td>
                                   <td width='25%' align='left'><FONT size = 7.0><b>Previsão Retorno&nbsp;&nbsp;&nbsp;</b></td>
                                   <td width='15%' align='left'><FONT size = 7.0><b>Hora</b></td>
                                   <td width='20%' align='left'><FONT size = 7.0><b>Fone Solicitante</b></td>
                                 </tr>
                               </table>
                             <table border = '1' width='100%' cellspacing='0'>
                                 <tr>
                                   <td width='25%' align='left'><FONT size = 7.0>&nbsp;&nbsp;$datasaida</td>
                                   <td width='15%' align='left'><FONT size = 7.0>&nbsp;&nbsp;$horasaida</td>
                                   <td width='25%' align='left'><FONT size = 7.0>&nbsp;&nbsp;$dataretorno</td>
                                   <td width='15%' align='left'><FONT size = 7.0>&nbsp;&nbsp;$horaretorno</td>
                                   <td width='20%' align='left'><FONT size = 7.0>&nbsp;&nbsp;$fonesolicitante</td>
                                </tr>
                             </table>
                           </td>  
                        </tr> 
                         <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b>Destino Itinerário (Local de Saída e percurso a ser seguido)</b></td>
                                </tr>
                             </table>
                             <table border = '1' width='100%' cellspacing='0'>
                                 <tr>
                                   <td width='100%'><FONT size = 7.0>&nbsp;&nbsp;$destino</td>
                                </tr>
                             </table>
                           </td>
                        </tr> 
                         <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b>Finalidade:</b></td>
                                </tr>
                             </table>
                             <table border = '1' width='100%' cellspacing='0'>
                               <tr>
                                   <td width='100%'><FONT size = 7.0>&nbsp;&nbsp;$finalidade</td>
                                </tr>
                             </table>
                           </td>
                        </tr> 
                        <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='65%'><FONT size = 7.0><b>Ocupantes</b></td>
                                   <td width='28%'><FONT size = 7.0><b>SIAPE</b></td>
                                   <td width='25%'><FONT size = 7.0><b>Telefone</b></td>
                                </tr>
                             </table>
                             <table border = '1' width='100%' cellspacing='0' >
                                 <tr>
                                   <td width='05%'><FONT size = 7.0>1</td>
                                   <td width='50%'><FONT size = 7.0>&nbsp;&nbsp;$ocupante01</td>
                                   <td width='25%'><FONT size = 7.0>&nbsp;&nbsp;$SiapeOcup1</td>
                                   <td width='20%'><FONT size = 7.0>&nbsp;&nbsp;$foneocupante01</td>
                                </tr>
                                 <tr>
                                 <td width='05%'><FONT size = 7.0>2</td>
                                   <td width='50%'><FONT size = 7.0>&nbsp;&nbsp;$ocupante02</td>
                                   <td width='25%'><FONT size = 7.0>&nbsp;&nbsp;$SiapeOcup2</td>
                                   <td width='20%'><FONT size = 7.0>&nbsp;&nbsp;$foneocupante02</td>
                                </tr>
                                 <tr>
                                   <td width='05%'><FONT size = 7.0>3</td>
                                   <td width='50%'><FONT size = 7.0>&nbsp;&nbsp;$ocupante03</td>
                                   <td width='25%'><FONT size = 7.0>&nbsp;&nbsp;$SiapeOcup3</td>
                                   <td width='20%'><FONT size = 7.0>&nbsp;&nbsp;$foneocupante03</td>
                                </tr>
                                 <tr>
                                   <td width='05%'><FONT size = 7.0>4</td>
                                   <td width='50%'><FONT size = 7.0>&nbsp;&nbsp;$ocupante04</td>
                                   <td width='25%'><FONT size = 7.0>&nbsp;&nbsp;$SiapeOcup4</td>
                                   <td width='20%'><FONT size = 7.0>&nbsp;&nbsp;$foneocupante04</td>
                                </tr>
                             </table>
                           </td>
                        </tr> 
                        <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b>OBS.: Acima de 4 Passageiros deve ser anexado a lista com NOME, SIAPE/MATRICULA, Nº do RG ou CPF.</b></td>
                                </tr>
                             </table>
                           </td>
                        </tr> 
                        <tr>
                           <td>
                             <table border = '0' width='100%'>
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b>Autorizações:</b></td>
                                </tr>
                             </table>
                             <table border = '1' width='100%' cellspacing='0'>
                                 <tr align='center'>
                                   <td width='25%'><FONT size = 7.0>Solicitante<br><br><br><br></td>
                                   <td width='25%'><FONT size = 7.0>Direção/Gerência<br><br><br><br></td>
                                   <td width='25%'><FONT size = 7.0>Recebimento CTMA<br><br><br><br></td>
                                   <td width='25%'><FONT size = 7.0>Aut. de Saída<br><br><br><br></td>
                                 </tr>
                                 <tr>
                                   <td width='25%'><FONT size = 7.0>em,_______/_______/________</td>
                                   <td width='25%'><FONT size = 7.0>em,_______/_______/________</td>
                                   <td width='25%'><FONT size = 7.0>em,_______/_______/________</td>
                                   <td width='25%'><FONT size = 7.0>em,_______/_______/________</td>
                                </tr>
                             </table>
                           </td>
                        </tr>
                        <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b><u>Das Proibições:</u></b></td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>É proibida a utilização de veículos oficiais:</td>
                                </tr>
                                  <tr>
                                   <td width='100%'><FONT size = 5.3>Para transporte a casa de divers&otilde;es, supermercados, estabelecimentos comerciais e de ensino, exceto quando em objeto de serviço;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>Em excurs&otilde;es ou passeios;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>Aos sábados, domingos e feriados, salvo para desempenho de encargos inerentes ao serviço público;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>No transporte de familiares do servidor ou de pessoas estranhas ao serviçoo público e no translado internacional de funcionários, ressalvados os casos previstos na alíneas b e c do artigo 3º e no artigo 14, ambos do anexo do decreto nº 1.280 de 14 de outubro de 1994.</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>Para deslocamento e vice-versa, em viagem o objeto de serviço, ressalvados aqueles deslocamentos que n ão possam ser atendidos por meio regular de transporte, ou quando inexistir transporte regular de qualquer outro meio ou, ainda, quando não perceber a ajuda de transporte de que trata o artigo 9º do decreto nº 343 de 19 de novembro de 1991, devidamente autorizado pelo Coordenador Geral de serviços gerais ou autoridade equivalente no órgão/entidade.</td>
                                </tr>
                               <tr>
                                   <td width='100%'><FONT size = 5.3>É proibido o uso de placas não oficiais em veículos oficiais, bem como o de placas em veículos particulares,ressalvados os casosprevistos na Lei nº 8.052, de 20/06/90.</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>É vedada aos órgãos e entidades integrantes do SISG, a requisição de veíulos de empresas públicas e sociedades de economia mista.</td>
                                </tr>
                                  <tr>
                                   <td width='100%'><FONT size = 5.3>É proibida a guarda de veículo oficial em garagem residencial, ressalvada o caso em que a garagem oficial for situada a grande distância da residência de quem use o automóvel, condicionada à autorização do respectivo Diretor Geral do Campus.</td>
                                </tr>
                                  <tr>
                                   <td width='100%'><FONT size = 5.3>.</td>
                                </tr>
                             </table>
                          </td>
                      </tr>    
                 </td>
           </table>
	
     </td>
  
  
    
 <!----------------------- Segunda parte -------------------------->
    <td width='50%'>
       <table border='0' width='100%'>
          <tr>
            <td width='100%'>
               <table width='100%'>
                         <tr>
                           <td>
                             <table border = '0' width='100%' >
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b><u>Do Preenchimento da solicitação:</u></b></td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>O item 1 deverá ser preenchido pelo interessado no uso do serviço e encaminho à CTMA;</td>
                                </tr>
                                  <tr>
                                   <td width='100%'><FONT size = 5.3>O item 2 será preenchido designando o motorista e autorizado pela CTMA;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>O item 3 será repassado ao interessado no uso do serviço após o recebimento da solicitação de veículo;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>Não nos responsabilizamos por pedidos sem tempo hábil para execução, de 48 horas.</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 7.0><b><u>Do transporte dos passageiros:</u></b></td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>É obrigação do solicitante, manter a ordem no interior do transporte, zelando pelo patrimônio público e bem como não permitir o uso de <br>drogas, bebidas alcoólicas e/ou agentes prejudiciais à saúde dos passageiros;</td>
                                </tr>
                                  <tr>
                                   <td width='100%'><FONT size = 5.3>O motorista deverá comunicar à $siglaSetorResp sobre quaisquer infraç&otilde;es por parte dos passageiros;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>O motorista deverá comunicar à $siglaSetorResp sobre quaisquer danos, por dolo e/ou culpa, sofrido pelo veículo durante o uso;</td>
                                </tr>
                                <tr>
                                   <td width='100%'><FONT size = 5.3>Não responsabilidade do motorista por pertences deixados após o desembarque dos passageiros.</td>
                                </tr>
                             </table>
                           </td>
                        </tr>
<tr><td>&nbsp;</td></tr>

                       </table>
                       <table border ='1' width='100%' cellspacing='1'>
                          <tr align='center'>
                               <td><FONT size = 9.0><b>PREENCHIMENTO E AUTORIZAÇÃO $siglaSetorResp</b></td>
                          </tr>
                       </table>
                      <table border ='0' width='100%' cellspacing='0'>
			  <tr><td>&nbsp;</td></tr>
			  <tr>
                               <td><FONT size = 7.0><b>Motorista</b></td>
                          </tr>
                          <tr>
                            <td>
                                <table border ='1' width='60%' cellspacing='1'>
                                   <tr>
                                       <td><FONT size = 7.0><b>&nbsp;&nbsp;</b></td>
                                   </tr>
                                 </table>
                            </td>
                         </tr>   
                      </table>
                      <table  border ='0' width='100%' cellspacing='0'>
                          <tr align='center'>
                               <td width='60%'>
                               </td>
                               <td width ='40%'><FONT size = 7.0>Assinatura do motorista</td>
                          </tr>
                          <tr align='center'>
                               <td width='60%'></td>
                               <td width ='40%'><FONT size = 7.0><br>Em,______/_______/_______</td>
                          </tr>
                       </table>
                      
			 <table  border ='0' width='100%' cellspacing='0'>
                          <tr>
                               <td width ='40%'><FONT size = 7.0><b>Placa</b></td>
                               <td width ='60%'><FONT size = 7.0><b>Combustível</b></td>
                          </tr>
                          <tr>
                               <td width='60%'>
                                  <table border='1' cellspacing='1'>
                                      <tr>
                                         <td width='40%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
                                         <td width='60%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>	
                                      </tr>
                                  </table>	
                               </td>
                               <td width ='40%'><FONT size = 7.0><u>__0/0________1/4________1/2________3/4________1/1__</u></td>
			 </tr>
                        <table border='0' width='100%'>
                        <tr><td>&nbsp;</td></tr>
                        <tr align='right'><td><FONT size = 9.0><b>ATENÇÃO - VERIFICAR NA SAÍDA: Óleo  -  Água  -  Freios  -  Pneus  -  Sinalização(luzes)</b></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        </table>

                       </table>
		       <table border = '1' width='100%' cellspacing='1'>
                         <tr align='center'>
                            <td width='15%'>
                            </td>
                            <td width='15%'><FONT size = 7.0>KM</td>
                            <td width='15%'><FONT size = 7.0>Data</td>
                            <td width='15%'><FONT size = 7.0>Hora</td>
                            <td width='40%'><FONT size = 7.0>Plantonista (Assinatura)</td>
                         </tr>
                          <tr align='center' >
                            <td width='15%'><FONT size = 7.0>Saída</td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='40%'><FONT size = 7.0></td>
                         </tr>
                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0> Retorno</td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='40%'><FONT size = 7.0></td>
                         </tr>
                       </table>
                       <table border = '0' width='100%' cellspacing='0'>
			 <tr><td>&nbsp;</td></tr>
                         <tr>
                            <td valign='middle'><FONT size = 8.5 ><b>Todos deslocamentos fora da rota de percurso deverá ser informado de acordo com a planilha abaixo:</b></td>
                         </tr>
                       </table>
                       <table border = '1' width='100%' cellspacing='1'>
                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0>Km</td>
                            <td width='14%'><FONT size = 7.0>Hora</td>
                            <td width='15%'><FONT size = 7.0>Deslocamento</td>
                            <td width='28%'><FONT size = 7.0>Finalidade</td>
                            <td width='28%'><FONT size = 7.0>Solicitante (Rubrica)</td>
                         </tr>
                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0>&nbsp;</td>
                            <td width='14%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                         </tr>
                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0>&nbsp;</td>
                            <td width='14%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                         </tr>
                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0>&nbsp;</td>
                            <td width='14%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                         </tr>

                         <tr align='center'>
                            <td width='15%'><FONT size = 7.0>&nbsp;</td>
                            <td width='14%'><FONT size = 7.0></td>
                            <td width='15%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                            <td width='28%'><FONT size = 7.0></td>
                         </tr>
                                                                    

                      </table>
                       <table border ='0' width='100%' cellspacing='0'> 
                          <tr>
                               <td><FONT size = 7.0><br><b>Ocorrência</b><br></td>
                          </tr>
                       </table>
                       <table border ='1' width='100%' cellspacing='1'>
                          <tr>
                               <td ><FONT size = 7.0><b>&nbsp;</b></td>
                          </tr>
                          <tr>
                               <td><FONT size = 7.0><b>&nbsp;</b></td>
                          </tr>
                          <tr>
                               <td><FONT size = 7.0><b>&nbsp;</b></td>
                          </tr>
                          
                                                     
                       </td>
                 </table>
         </table>  
     </body>
</html>";
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("solicitacao número $numsolicitacao.pdf");
?>  

