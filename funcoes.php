<?php

function conecta() {
    // faz conexão com o servidor MySQL
    $local_serve = "localhost";             // local do servidor
    $usuario_serve = "root";  // nome do usuario
    $senha_serve = "@cabo";   // senha
    $banco_de_dados = "transporte_v2";         // nome do banco de dados
    mysql_query("SET CHARACTER SET utf8");  //faz as consultas setando o charset como UTF-8

    $conn = @mysql_connect($local_serve, $usuario_serve, $senha_serve) or die("O servidor não responde!");

// conecta-se ao banco de dados
    $db = @mysql_select_db($banco_de_dados, $conn)
            or die("Não foi possivel conectar-se ao banco de dados!");
}

#function conectaGlpi() { 
#$local_serve = "172.28.1.11";             // local do servidor
#$usuario_serve = "root";		// nome do usuario
#$senha_serve = "@dmin#ifpe";			// senha
#$banco_de_dados = "glpi80";         // nome do banco de dados
#mysql_query("SET CHARACTER SET utf8");
#$conn = @mysql_connect($local_serve,$usuario_serve,$senha_serve) or die ("O servidor não responde!");
// conecta-se ao banco de dados
#$db = @mysql_select_db($banco_de_dados,$conn) or die ("Não foi possivel conectar-se ao banco de dados!");
#}

function verificaCadastro($siapeGlpi) {
    conecta();
    $sql = "SELECT * FROM solicitantes
            WHERE siape = '$siapeGlpi'";
    $consulta = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());

    $campos = mysql_num_rows($consulta);
    if ($campos == 0) {
        $retorno = 0;
    } else {
        $retorno = 1;
    }
    return $retorno;
}

conecta();
$sql = "SELECT * FROM manutencao
            WHERE codConfig = 1";
$resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
while ($registro = mysql_fetch_array($resultado)) {
    $GLOBALS = $getMailTipo = $registro['mailTipo'];
    $GLOBALS = $getMailHost = $registro['mailHost'];
    $GLOBALS = $getMailSmtpSeguro = $registro['mailSmtpSeguro'];
    $GLOBALS = $getMailPort = $registro['mailPort'];
    $GLOBALS = $getMailDebug = $registro['mailDebug'];
    $GLOBALS = $getMailUsuario = $registro['mailUsuario'];
    $GLOBALS = $getMailSenha = $registro['mailSenha'];
    $GLOBALS = $getMailRemetente = $registro['mailRemetente'];
    $GLOBALS = $getMailRemetenteNome = $registro['mailRemetenteNome'];
    $GLOBALS = $getMailDestinatarioCopia = $registro['mailDestinatarioCopia'];
    $GLOBALS = $getMailEmailAdmin = $registro['mailEmailAdmin'];
    $GLOBALS = $getMailAssuntoAutorizacao = $registro['mailAssuntoAutorizacao'];
    $GLOBALS = $getMailAssuntoSolicitacao = $registro['mailAssuntoSolicitacao'];
}

// Converte a data para ano-mes-dia
function converteData($data) {
    if (strstr($data, "/")) {//verifica se tem a barra /
        $d = explode("/", $data); //tira a barra
        $rstData = "$d[2]-$d[1]-$d[0]"; //separa as datas $d[2] = ano $d[1] = mes etc...
        return $rstData;
    } else if (strstr($data, "-")) {
        $data = substr($data, 0, 10);
        $d = explode("-", $data);
        $rstData = "$d[2]/$d[1]/$d[0]";
        return $rstData;
    } else {
        return '';
    }
}

//Exibe a data em dia/mes/ano
function formatoData($data) {
    $dataFormatada = implode(preg_match("~\/~", $data) == 0 ? "/" : "-", array_reverse(explode(preg_match("~\/~", $data) == 0 ? "-" : "/", $data)));
    return $dataFormatada;
}


// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
function geraTimestamp($data) {
    $partes = explode('/', $data);
    return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
}

function calculaDias($data_inicial, $data_final) {

    // Usa a função criada e pega o timestamp das duas datas:
    $time_inicial = geraTimestamp($data_inicial);
    $time_final = geraTimestamp($data_final);

    // Calcula a diferença de segundos entre as duas datas:
    $diferenca = $time_final - $time_inicial; // 19522800 segundos
    // Calcula a diferença de dias
    $dias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias
    return $dias;
}

function gravaLog($tipoModificacao) {
    $usuario = $_SESSION['logado'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $hoje = date('Y-m-d');
    $agora = date('H:i:s');

    conecta();
    $sql = "INSERT INTO log (usuario, tipoModificacao, data, hora, ip)
                        VALUES ('$usuario', '$tipoModificacao', '$hoje', '$agora', '$ip')";
    $resultado = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
}

function consumoCombus($veiculo) {
    $pesquisaVeiculo = "SELECT * FROM veiculos
                          WHERE codVeiculo='$veiculo' AND statusVeiculo<>0";
    $resultadoVeiculo = mysql_query($pesquisaVeiculo) or die("Houve um erro de banco de dados: " . mysql_error());
    While ($registroVeiculo = mysql_fetch_array($resultadoVeiculo)) {
        $idVeiculo = $registroVeiculo['codVeiculo'];
        $kmAtual = $registroVeiculo['kmAtual'];

        $pesquisaCombus = "SELECT * FROM abastecimentos
                                            WHERE idVeiculo='$idVeiculo' AND statusAbast<>0";
        $resultadocombus = mysql_query($pesquisaCombus) or die("Houve um erro de banco de dados: " . mysql_error());
        While ($registroCombus = mysql_fetch_array($resultadocombus)) {
            $qtdLitros += $registroCombus['qtd'];
            $km[] = $registroCombus['kmAtual'];
        }

        $kmTotal = $kmAtual - $km[0];
        $consumo = $kmTotal / $qtdLitros;
    }

    return $consumo;
}

function calculaHoras($PrevDtSaida, $PrevHrSaida) {

    $PrevDtSaida = converteData($PrevDtSaida);
    $PrevDtSaida = date_create($PrevDtSaida);
    $PrevDtSaida = date_format($PrevDtSaida, "m/d/Y");

    $dataAtual = strtotime(date('m/d/Y H:i'));
    $dataViagem = strtotime($PrevDtSaida . '' . $PrevHrSaida);
    $horas = $dataViagem - $dataAtual;
    $totalHoras = $horas / 60 /60 ;
    return $totalHoras;
}

function saldoHoras($saldoAntigo, $saldoAtual) {
$horaatual = $saldoAntigo;
$horaextra = $saldoAtual;
$times = array(
$horaatual,
$horaextra,
);

$seconds = 0;

foreach ( $times as $time )
{
list( $h, $m, $s ) = explode( ':', $time );
$seconds += $h * 3600;
$seconds += $m * 60;
$seconds += $s;
}

$hours = floor( $seconds / 3600 );
$seconds -= $hours * 3600;
$minutes = floor( $seconds / 60 );
$seconds -= $minutes * 60;

$saldo ="{$hours}:{$minutes}:{$seconds}";
    return $saldo;
}

function retiraSaldoHoras($saldoMot, $quantHoraFolga) {
$horaatual = $quantHoraFolga;
$horaextra = $saldoMot;

//converte horas + em horas -
list( $gf, $if, $sf ) = explode(':', $horaatual);

$hfolga -= $gf;
$mfolga -= $if;
$sfolga -= $sf;
$horafolga = "{$hfolga}:{$mfolga}:{$sfolga}";

$times = array(
$horafolga,
$horaextra,
);

$seconds = 0;

foreach ( $times as $time )
{
list( $g, $i, $s ) = explode( ':', $time );
$seconds += $g * 3600;
$seconds += $i * 60;
$seconds += $s;
}

$hours = floor( $seconds / 3600 );
$seconds -= $hours * 3600;
$minutes = floor( $seconds / 60 );
$seconds -= $minutes * 60;

$saldoNovo = "{$hours}:{$minutes}:{$seconds}";
return $saldoNovo;
}



function excluirHorasExtra($saldoMot, $horaExtra) {
$horaatual = $horaExtra;
$horaextra = $saldoMot;

//converte horas + em horas -
list( $gf, $if, $sf ) = explode(':', $horaatual);

$hfolga -= $gf;
$mfolga -= $if;
$sfolga -= $sf;
$horafolga = "{$hfolga}:{$mfolga}:{$sfolga}";

$times = array(
$horafolga,
$horaextra,
);

$seconds = 0;

foreach ( $times as $time )
{
list( $g, $i, $s ) = explode( ':', $time );
$seconds += $g * 3600;
$seconds += $i * 60;
$seconds += $s;
}

$hours = floor( $seconds / 3600 );
$seconds -= $hours * 3600;
$minutes = floor( $seconds / 60 );
$seconds -= $minutes * 60;

$saldoNovo = "{$hours}:{$minutes}:{$seconds}";
return $saldoNovo;
}


function somarHorasFolga($saldoMot, $saldoFolga) {
$horaatual = $saldoMot;
$horaextra = $saldoFolga;
$times = array(
$horaatual,
$horaextra,
);

$seconds = 0;

foreach ( $times as $time )
{
list( $h, $m, $s ) = explode( ':', $time );
$seconds += $h * 3600;
$seconds += $m * 60;
$seconds += $s;
}

$hours = floor( $seconds / 3600 );
$seconds -= $hours * 3600;
$minutes = floor( $seconds / 60 );
$seconds -= $minutes * 60;

$saldo ="{$hours}:{$minutes}:{$seconds}";
    return $saldo;
}


function email($getCodSolicitacaoControle) {

    $sqlemail = "SELECT * FROM listarsolicitacaocontrole
                         WHERE codSolicitacao = '$getCodSolicitacaoControle'";
    $resultadoEmail = mysql_query($sqlemail) or die("Houve um erro na gravação dos dados");
    while ($registroEmail = mysql_fetch_array($resultadoEmail)) {
        $destinatario = $registroEmail['email'];
        $codigo = $registroEmail['codSolicitacaoControle'];
        $motorista = $registroEmail['motorista'];
        $veiculo = $registroEmail['modelo'];
    }

    global $getMailTipo;
    global $getMailHost;
    global $getMailSmtpSeguro;
    global $getMailPort;
    global $getMailDebug;
    global $getMailUsuario;
    global $getMailSenha;
    global $getMailRemetente;
    global $getMailRemetenteNome;
    global $getMailDestinatarioCopia;
    global $getMailAssuntoAutorizacao;

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
    $mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Mailer = $getMailTipo;
    $mail->Host = $getMailHost;
    $mail->SMTPSecure = $getMailSmtpSeguro;
    $mail->Port = $getMailPort;
    $mail->SMTPDebug = $getMailDebug;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = $getMailUsuario; // SMTP username - Seu e-mail
    $mail->Password = $getMailSenha; // SMTP password
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $getMailRemetente; // Seu e-mail
    $mail->FromName = $getMailRemetenteNome; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($destinatario, 'Solicitante');
// $mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');

    $mail->AddCC($getMailDestinatarioCopia, 'Administrador'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = $getMailAssuntoAutorizacao . $codigo; // Assunto da mensagem
    $mail->Body = "Solicitação de transporte confirmada pelo setor de Transporte.<br /><br />
                   ------------------------------------------------- <br />
                   Nº da solicitação: $codigo.<br /><br />
                   Motorista: $motorista.<br /><br />
                   Veículo: $veiculo.<br />
                   ------------------------------------------------- 
                   <br/><br/>                      
            <font color='red'> <b>OBS.: Este email foi enviado automaticamente pelo sistema, não é necessário responder. </b></font>";



// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
    $enviado = $mail->Send();

// Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

// Exibe uma mensagem de resultado
    if ($enviado) {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i");
        fputs($arquivo, $log);
        fclose($arquivo);
    } else {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail não enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i") . "\n";
        $log = + "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
        fputs($arquivo, $log);
        fclose($arquivo);
    }
}

function emailSolicitacao($idSolicitacao) {

    $sqlmail = "SELECT * FROM listarsolicitacao
                      WHERE codSolicitacao = $idSolicitacao";
    $resultado = mysql_query($sqlmail) or die("Não foi possível realizar a consulta ao banco de dados");
    while ($registro = mysql_fetch_array($resultado)) {
        $solicitante = $registro['nome'];
        $foneSolicitante = $registro['telefone'];
        $setor = $registro['nomeSetor'];
        $dtSaida = $registro['dtSaida'];
        $hrSaida = $registro['hrSaida'];
        $dtRetorno = $registro['dtRetorno'];
        $hrRetorno = $registro['hrRetorno'];
        $destino = $registro['destino'];
        $finalidade = $registro['finalidade'];
        $ocupante1 = $registro['ocupante1'];
        $foneOcup1 = $registro['foneOcup1'];
        $ocupante2 = $registro['ocupante2'];
        $foneOcup2 = $registro['foneOcup2'];
        $ocupante3 = $registro['ocupante3'];
        $foneOcup3 = $registro['foneOcup3'];
        $ocupante4 = $registro['ocupante4'];
        $foneOcup4 = $registro['foneOcup4'];
        $destinatario = $registro['email'];
    }
    $dtSaida = formatoData($dtSaida);
    $dtRetorno = formatoData($dtRetorno);

    global $getMailTipo;
    global $getMailHost;
    global $getMailSmtpSeguro;
    global $getMailPort;
    global $getMailDebug;
    global $getMailUsuario;
    global $getMailSenha;
    global $getMailRemetente;
    global $getMailRemetenteNome;
    global $getMailDestinatarioCopia;
    global $getMailEmailAdmin;
    global $getMailAssuntoSolicitacao;


// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
    $mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Mailer = $getMailTipo;
    $mail->Host = $getMailHost;
    $mail->SMTPSecure = $getMailSmtpSeguro;
    $mail->Port = $getMailPort;
    $mail->SMTPDebug = $getMailDebug;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = $getMailUsuario; // SMTP username - Seu e-mail
    $mail->Password = $getMailSenha; // SMTP password
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $getMailRemetente; // Seu e-mail
    $mail->FromName = $getMailRemetenteNome; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($getMailEmailAdmin, 'Administrador');
// $mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');

    $mail->AddCC($destinatario, 'Solicitante'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = $getMailAssuntoSolicitacao . $idSolicitacao; // Assunto da mensagem
    $mail->Body = "Solicitação de transporte efetuada.<br /><br />
                   ------------------------------------------------------------------------------------- <br />
                   Nº da solicitação: $idSolicitacao.<br /><br />
                   Solicitante: $solicitante - Setor: $setor - Telefone: $foneSolicitante.<br /><br />
                   Data/Hora - Saída: $dtSaida - $hrSaida.<br /><br />
                   Data/Hora - Retorno: $dtRetorno - $hrRetorno.<br /><br />
                   Destino: $destino.<br /><br />
                   Finalidade: $finalidade.<br /><br />
                   Ocupante: $ocupante1 - $foneOcup1.<br /><br />
                   Ocupante: $ocupante2 - $foneOcup2.<br /><br />
                   Ocupante: $ocupante3 - $foneOcup3.<br /><br />
                   Ocupante: $ocupante4 - $foneOcup4.<br /><br />
                   ------------------------------------------------------------------------------------------ 
                   <br/><br/>                      
            <font color='red'> <b>OBS.: Este email foi enviado automaticamente pelo sistema, não é necessário responder. </b></font>";



// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
    $enviado = $mail->Send();

// Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

// Exibe uma mensagem de resultado
    if ($enviado) {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i");
        fputs($arquivo, $log);
        fclose($arquivo);
    } else {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail não enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i") . "\n";
        $log = + "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
        fputs($arquivo, $log);
        fclose($arquivo);
    }
}


function emailDespacho($idDespacho) {

    $sqlmail = "SELECT * FROM listardespachos
                      WHERE idDespacho = $idDespacho";
    $resultado = mysql_query($sqlmail) or die("Não foi possível realizar a consulta ao banco de dados");
    while ($registro = mysql_fetch_array($resultado)) {
        $destinatario = $registro['email'];
        $solicitante = $registro['nome'];
        $solicitacao = $registro['idSolicitacao_FK'];
        $descricao = $registro['descricaoDespacho'];
    }


   global $getMailTipo;
    global $getMailHost;
    global $getMailSmtpSeguro;
    global $getMailPort;
    global $getMailDebug;
    global $getMailUsuario;
    global $getMailSenha;
    global $getMailRemetente;
    global $getMailRemetenteNome;
    global $getMailDestinatarioCopia;
    global $getMailAssuntoSolicitacao;

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
    $mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Mailer = $getMailTipo;
    $mail->Host = $getMailHost;
    $mail->SMTPSecure = $getMailSmtpSeguro;
    $mail->Port = $getMailPort;
    $mail->SMTPDebug = $getMailDebug;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = $getMailUsuario; // SMTP username - Seu e-mail
    $mail->Password = $getMailSenha; // SMTP password
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $getMailRemetente; // Seu e-mail
    $mail->FromName = $getMailRemetenteNome; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($destinatario, 'Solicitante');
// $mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');

    $mail->AddCC($getMailDestinatarioCopia, 'Administrador'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = $getMailAssuntoSolicitacao . $solicitacao; // Assunto da mensagem
    $mail->Body = "Solicitação de transporte negada.<br /><br />
                   ------------------------------------------------------------------------------------- <br />
                   Nº da solicitação: $solicitacao.<br /><br />
                   Solicitante: $solicitante.<br /><br />
                   Justificativa: $descricao.<br /><br />
                   
                   ------------------------------------------------------------------------------------------ 
                   <br/><br/>                      
            <font color='red'> <b>OBS.: Este email foi enviado automaticamente pelo sistema, não é necessário responder. </b></font>";



// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
    $enviado = $mail->Send();

// Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

// Exibe uma mensagem de resultado
    if ($enviado) {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i");
        fputs($arquivo, $log);
        fclose($arquivo);
    } else {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail não enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i") . "\n";
        $log = + "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
        fputs($arquivo, $log);
        fclose($arquivo);
    }
}

function emailEncerrarSolic($getCodSolicitacaoControle) {

    $sqlemail = "SELECT * FROM listarsolicitacaocontrole
                         WHERE codSolicitacao = '$getCodSolicitacaoControle'";
    $resultadoEmail = mysql_query($sqlemail) or die("Houve um erro na gravação dos dados");
    while ($registroEmail = mysql_fetch_array($resultadoEmail)) {       
        $codigo = $registroEmail['codSolicitacaoControle'];
        $solicitante = $registroEmail['nome'];
    }
    
    
    global $getMailTipo;
    global $getMailHost;
    global $getMailSmtpSeguro;
    global $getMailPort;
    global $getMailDebug;
    global $getMailUsuario;
    global $getMailSenha;
    global $getMailRemetente;
    global $getMailRemetenteNome;
    global $getMailDestinatarioCopia;
    global $getMailAssuntoAutorizacao;

    $destinatario = $getMailDestinatarioCopia;
    
// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("phpmailer/class.phpmailer.php");

// Inicia a classe PHPMailer
    $mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Mailer = $getMailTipo;
    $mail->Host = $getMailHost;
    $mail->SMTPSecure = $getMailSmtpSeguro;
    $mail->Port = $getMailPort;
    $mail->SMTPDebug = $getMailDebug;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = $getMailUsuario; // SMTP username - Seu e-mail
    $mail->Password = $getMailSenha; // SMTP password
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $getMailRemetente; // Seu e-mail
    $mail->FromName = $getMailRemetenteNome; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($destinatario, 'Administrador');
// $mail->AddAddress('fulano_forum@ugabuga.com.br','Fulano');

   // $mail->AddCC($getMailDestinatarioCopia, 'Administrador'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = "Finalizar Solicitação " . $codigo; // Assunto da mensagem
    $mail->Body = "A solicitação de transporte a seguir, já pode ser finalizada:<br /><br />
                   ------------------------------------------------- <br />
                   Nº da solicitação: $codigo.<br /><br />
                   Solicitante: $solicitante.<br /><br />                  
                   ------------------------------------------------- 
                   <br/><br/>                      
            <font color='red'> <b>OBS.: Este email foi enviado automaticamente pelo sistema, não é necessário responder. </b></font>";



// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
    $enviado = $mail->Send();

// Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

// Exibe uma mensagem de resultado
    if ($enviado) {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i");
        fputs($arquivo, $log);
        fclose($arquivo);
    } else {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail não enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i") . "\n";
        $log = + "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
        fputs($arquivo, $log);
        fclose($arquivo);
    }
}

// Email enviado apos diretoria aprovar a solicitacao
function emailAprovouSolicitacao($getCodSolicitacao)
{
    $diretor = $_SESSION['logado'];
    $sqlemail = "SELECT * FROM solicitacao, solicitantes
        WHERE codSolicitacao = '$getCodSolicitacao' AND solicitacao.idSolicitante = solicitantes.siape";
    $resultadoEmail = mysql_query($sqlemail) or die("Houve um erro na gravação dos dados");
    while ($registroEmail = mysql_fetch_array($resultadoEmail)) {
        $destinatario = $registroEmail['email'];
        $codigo = $registroEmail['codSolicitacao'];
        $dtSaida = $registroEmail['dtSaida'];
        $hrSaida = $registroEmail['hrSaida'];
    }

    global $getMailTipo;
    global $getMailHost;
    global $getMailSmtpSeguro;
    global $getMailPort;
    global $getMailDebug;
    global $getMailUsuario;
    global $getMailSenha;
    global $getMailRemetente;
    global $getMailRemetenteNome;
    global $getMailDestinatarioCopia;
    global $getMailAssuntoAutorizacao;

    // Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
    require("phpmailer/class.phpmailer.php");

    // Inicia a classe PHPMailer
    $mail = new PHPMailer();

    // Define os dados do servidor e tipo de conexão
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Mailer = $getMailTipo;
    $mail->Host = $getMailHost;
    $mail->SMTPSecure = $getMailSmtpSeguro;
    $mail->Port = $getMailPort;
    $mail->SMTPDebug = $getMailDebug;
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->Username = $getMailUsuario; // SMTP username - Seu e-mail
    $mail->Password = $getMailSenha; // SMTP password
    
    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = $getMailRemetente; // Seu e-mail
    $mail->FromName = $getMailRemetenteNome; // Seu nome
    
    // Define os destinatário(s)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->AddAddress($destinatario, 'Solicitante');

    $mail->AddCC($getMailDestinatarioCopia, 'Administrador'); // Copia
    
    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
    $mail->CharSet = 'utf8'; // Charset da mensagem (opcional)
    
    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject = $getMailAssuntoAutorizacao . $codigo; // Assunto da mensagem
    $mail->Body = " Sua solicitação de transporte foi autorizada pela Direção.<br /><br />
                    ------------------------------------------------- <br />
                    Nº da solicitação: $codigo.<br /><br />
                    Data de Saída: $dtSaida.<br /><br />
                    Hora de Saída: $hrSaida.<br /><br />
                    Autorizado por: $diretor.<br /><br />
                    <b>Aguarde a confirmação do setor de Transporte
                    da disponibilidade de veículo e motorista.</b><br />
                    -------------------------------------------------
                    <br/><br/>
                    <font color='red'> <b>OBS.: Este email foi enviado automaticamente pelo sistema,
                    não é necessário responder. </b></font>";

    // Define os anexos (opcional)
    //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

    // Envia o e-mail
    $enviado = $mail->Send();

    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();

    // Exibe uma mensagem de resultado
    if ($enviado) {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i");
        fputs($arquivo, $log);
        fclose($arquivo);
    } else {
        $arquivo = fopen("log.txt", "a+");
        $log = "\nEmail não enviado para - " . $destinatario . " - " . date("d/m/y") . " - " . date("H:i") . "\n";
        $log += "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
        fputs($arquivo, $log);
        fclose($arquivo);
    }
}
