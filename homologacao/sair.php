<?php include 'funcoes.php';


session_start();
gravaLog("Logoff no sistema");
unset($_SESSION['login_usuario']);
unset($_SESSION['senha_usuario']);
unset($_SESSION['nivel']);
header("Location: index.php");

?>
