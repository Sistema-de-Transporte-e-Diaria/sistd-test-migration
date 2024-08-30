<?php include ('validar_session_diaria.php');

?>
<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editando Diária</title>
        <script language="JavaScript" type="text/javascript" src="script.js"></script>
     </head>
     <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
  <body  style="font-family: courier">
<?php
// Atribuição de valores as variáveis com o recebimento dos dados dos campos do formulário solicita.php
$getCodDiaria = $_POST[codDiaria];
$getTipoSolicitante = $_POST[setTipoSolicitante];
$getTipoSolicitanteOutros = $_POST[setTipoSolicitanteOutros];
$getFuncao = $_POST[setFuncao];
$getEscolaridade = $_POST[setEscolaridade];
$getTransporte = $_POST[setTransporte];
$getCod_cidadeOrigem = $_POST[cod_cidades];
$getCod_cidadesDestino = $_POST[cod_cidades1];
$getMotivo = $_POST[setMotivo];
$getMotivoOutros = $_POST[setMotivoOutros];
$getLocalEvento = $_POST[setLocalEvento];
$getDescricaoMotivo = $_POST[setDesc];
$getDtInicio1 = $_POST[setDtInicio];
$getHrInicio = $_POST[setHrInicio];
$getDtFim1 = $_POST[setDtFim];
$getHrFim = $_POST[setHrFim];
$getJustificativa = $_POST[setJustificativa];
$getSiape = $_POST[setSiape];
$getSolicitante = $_POST[setSolicitante];
$getCpf = $_POST[setCpf];
$getCelular = $_POST[setCelular];
$getBanco = $_POST[setBanco];
$getAgencia = $_POST[setAgencia];
$getConta = $_POST[setConta];
$getEmail = $_POST[setEmail];
$getNomeSolicitante = $_SESSION['logado'];
$getSetor = $_POST['setSetor'];

$getCargoFunOrigServMunEst = $_POST[setCargoFunOrigServMunEst];
$getValeTranspServMunEst = $_POST[setValeTranspServMunEst];
$getValeAlimentServMunEst = $_POST[setValeAlimentServMunEst];
$getDtNasc1 = $_POST[setDtNasc];
$getDtNasc = converteData($getDtNasc1);
$getFuncaoOutros = $_POST[setFuncaoOutros];

$getMeioTranspVolta = $_POST[setTransporteVolta];        
$getTipoDiaria = $_POST[setTipoDiaria];
$getDtEmbarqueIDA1 = $_POST[setDtEmbarqueIDA];
$getDtEmbarqueIDA = converteData($getDtEmbarqueIDA1);
$getDtEmbarqueVOLTA1 = $_POST[setDtEmbarqueVOLTA];
$getDtEmbarqueVOLTA = converteData($getDtEmbarqueVOLTA1);
$getJustificativaDiariaEmbarque = $_POST[setJustificativaDiariaEmbarque];
        
 $pesquisaCidade = "SELECT * FROM cidades
                            WHERE cod_cidades = '$getCod_cidadeOrigem'";
             $resultadoCidades = mysql_query($pesquisaCidade) or die ("Houve um erro de banco de dados: ".mysql_error());
              While($registroCidades=mysql_fetch_array($resultadoCidades))
                  {
                    $nomeCidOrigem = $registroCidades['nome'];
                    $codUForigem = $registroCidades['estados_cod_estados'];
                  }
                  
 $pesquisaEstado = "SELECT * FROM estados
                            WHERE cod_estados = '$codUForigem'";
              $resultadoEstado = mysql_query($pesquisaEstado) or die ("Houve um erro de banco de dados: ".mysql_error());
               While($registroEstado=mysql_fetch_array($resultadoEstado))
                   {
                     $nomeUForigem = $registroEstado['sigla'];
                    }                 

             

$getDtInicio = converteData($getDtInicio1);
$getDtFim = converteData($getDtFim1);

// Grava na tabela 'solicitacao' todo o conteúdo das variáveis acima
$sql = "UPDATE diarias set   tipoSolicitante='$getTipoSolicitante', 
                             tipoSolicitanteOutro='$getTipoSolicitanteOutros', 
                             funcaoSolicitante='$getFuncao',
                             tipoFuncaoOutro='$getFuncaoOutros',    
                             escolaridade='$getEscolaridade',
                             meioTransporte='$getTransporte', 
                             cidOrigem='$getCod_cidadeOrigem',
			     cidDestino='$getCod_cidadesDestino', 
                             motivoViagem='$getMotivo', 
                             motivoViagemOutro='$getMotivoOutros',
                             localEvento='$getLocalEvento', 
                             descMotivoViagem='$getDescricaoMotivo', 
			     dtInicio='$getDtInicio',
                             hrInicio='$getHrInicio', 
                             dtFim='$getDtFim',
                             hrFim='$getHrFim',
                             justificativa='$getJustificativa',
                             siape='$getSiape',
                             beneficiado='$getSolicitante',
                             cpf='$getCpf',
                             celular='$getCelular', 
                             banco='$getBanco',
                             agencia='$getAgencia',
                             conta='$getConta',
                             email='$getEmail',
                             solicitante='$getNomeSolicitante',
                             nomeCidOrigem='$nomeCidOrigem',
                             siglaUForigem='$nomeUForigem',    
                             setor='$getSetor',
                             cargoFunOrigServMunEst = '$getCargoFunOrigServMunEst',
                             valeTranspServMunEst = '$getValeTranspServMunEst',
                             valeAlimentServMunEst = '$getValeAlimentServMunEst',
                             dtNasc = '$getDtNasc', "
                        . "  tipoDiaria='$getTipoDiaria', "
                        . "  dtEmbarqueIDA='$getDtEmbarqueIDA', "
                        . "  dtEmbarqueVOLTA='$getDtEmbarqueVOLTA', "
                        . "  justificativaDiariaEmbarque='$getJustificativaDiariaEmbarque', "
                        . "  meioTransporteVolta='$getMeioTranspVolta'"
                        . " WHERE codDiaria='$getCodDiaria'";               
                  
  
conecta();
$sql1 = mysql_query($sql) or die ("Houve um erro de banco de dados: ".mysql_error());
gravaLog("Editou diária nº $getCodDiaria");
?>
      
      <script language=javascript>alert('Diária editada com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarDiariasSolicitante.php";
        </script>
     </body>
</html>


