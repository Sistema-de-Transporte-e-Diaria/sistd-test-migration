<?php 
include "funcoes.php";
@session_start();

// verifica se a variavel existir
if(isset($_SESSION['login_usuario']) and isset($_SESSION['senha_usuario'])) {
	// se existie as sessões coloca os valores em uma variavel
	$login_usuario = $_SESSION['login_usuario'];
	$senha_usuario = $_SESSION['senha_usuario'];
} else {
	$erro = urlencode("Você não esta logado!");
	header("Location: index.php");
	exit;
}
conecta();
// verifica se as variaveis estão atribuidas
if(!(empty($login_usuario) or empty($senha_usuario))) {
	// se estiverem atribuidos vamos ver se existe o login
	$consulta = mysql_query("select * from solicitantes where siape='$login_usuario'");
	if(mysql_num_rows($consulta) == 1) {
		// se o usuario existir vamos verificar a senha
	
	} else {
		unset($_SESSION['login_usuario']);
		unset($_SESSION['senha_usuario']);
		
		$erro = urlencode("Você não esta logado!");
		header("Location: index.php");
		exit;
	}
} else {
	// caso as sessões estarem vazias
	$erro = urlencode("Você não esta logado!");
	header("Location: index.php");
	exit;
} ?>