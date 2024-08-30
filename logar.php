
<html xmlns="http://www.w3.org/1999/xhtml"><!--xml:lang="pt-br" lang="pt-br-->
    <head>
        <script type="text/javascript" src="../js/hash.js"></script>
    </head>
    <body>
<?php
include ('funcoes.php');
// recebe os dados do formuário index.php
$login = $_POST[usuario];
$pwd = $_POST[senha];

conecta();

// verifica se o usuario existe
$sql = "select * from solicitantes where siape='$login'";
$consulta = mysql_query($sql) or die("Houve um erro de banco de dados: " . mysql_error());
while ($registro = mysql_fetch_array($consulta)) {
    $loginAtivo = $registro['statusSolicitante'];
}
$campos = mysql_num_rows($consulta);

if ($campos != 0 && $loginAtivo == 1) {
// se o usuario existi verifica a senha dele
    $cripto = md5($pwd);
    if ($cripto != mysql_result($consulta, 0, "senha")) {
        conecta();
        $sql = "SELECT * FROM manutencao
                            WHERE codConfig = 1";
        $resultado = mysql_query($sql) or die("erro#03: " . mysql_error());
        while ($registro = mysql_fetch_array($resultado)) {
            $hostLdap = $registro['ldapHost'];
            $portLdap = $registro['ldapPort'];
            $baseDNldap = $registro['ldapBaseDN'];
            $campoLdap = $registro['ldapCampo'];
            $statusBase = $registro['statusBase'];
            $ldapuser = $registro['ldapuser'];
            $ldappass = $registro['ldappass'];
        }
        $ldapconfig['host'] = $hostLdap;
        $ldapconfig['port'] = $portLdap;
        $ldapconfig['basedn'] = $baseDNldap;


        if ($statusBase == 1) {
            $ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);
            $dn = "uid=" . $login . ",ou=$campoLdap," . $ldapconfig['basedn'];
            if ($bind = ldap_bind($ds, $dn, $pwd)) {
                echo("Dados corretos");
                conecta();                
                $cripto = md5($pwd);
                $sql = "UPDATE solicitantes SET senha='$cripto' WHERE siape='$login'";
                $sqlResul = mysql_query($sql) or die("erro#04: " . mysql_error());
            } else {
                ?>
                <script language=javascript>
                    alert('Não é possível o acesso ao sistema. Seus dados estão incorretos!');
                    location.href = "index.php";
                </script>
                <?php

                exit;
            }
        } elseif ($statusBase == 2) {
            $ldapconn = ldap_connect($hostLdap) or die("Could not connect to LDAP server.");
            $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass);
            $result = ldap_search($ldapconn, $campoLdap, "(samaccountname=$login)") or die("Error in search query: " . ldap_error($ldapconn));
            $data = ldap_get_entries($ldapconn, $result);
            for ($i = 0; $i < $data["count"]; $i++) {
                $cn = $data[$i]["cn"][0];
                $dn = "CN=" . $cn . "," . $campoLdap;

                //$ldapbind = ldap_bind($ldapconn, $dn, $ldappass) or die("Error trying to bind: " . $dn . $pwd . ldap_error($ldapconn));
		$ldapbind = ldap_bind($ldapconn, $dn, $pwd) or die("Erro na consulta a Base MS-AD: " . ldap_error($ldapconn));

                //echo $dn;
                if ($ldapbind) {
                    echo("Dados corretos");
                    conecta();
                    $cripto = md5($pwd);
                    $sql = "UPDATE solicitantes SET senha='$cripto' WHERE siape='$login'";
                    $sqlResul = mysql_query($sql) or die("erro#04: " . mysql_error());
                } else {
                    ?>
                    <script language=javascript>
                        alert('Não é possível o acesso ao sistema. Seus dados estão incorretos!');
                        location.href = "index.php";
                    </script>
                    <?php

                }
            }
        }
    }
} else {
    ?>
    <script language=javascript>
        alert('Não é possível o acesso ao sistema. Seu usuário não está cadastrado!');
        location.href = "index.php";
    </script>
    <?php

    exit;
}
conecta();
$sql1 = "select * from solicitantes where siape='$login'";
$resultado = mysql_query($sql1) or die("Houve um erro de banco de dados: " . mysql_error());
While ($registro = mysql_fetch_array($resultado)) {
    $admin = $registro["administrador"];
    $direcao = $registro["direcao"];
    $logado = $registro["nome"];
}
if ($admin == 2 || $admin == 3) {
    session_start();
    $_SESSION['login_usuario'] = $login;
    $_SESSION['senha_usuario'] = $pwd;
    $_SESSION['nivel'] = $admin;
    $_SESSION['direcao'] = $direcao;
    $_SESSION['logado'] = $logado;
    gravaLog("Logou no sistema");

    // redireciona o link para uma outra pagina
    header("Location: alertas.php");
} elseif($admin == 4){
    session_start();
    $_SESSION['login_usuario'] = $login;
    $_SESSION['senha_usuario'] = $pwd;
    $_SESSION['nivel'] = $admin;
    $_SESSION['direcao'] = $direcao;
    $_SESSION['logado'] = $logado;
    gravaLog("Logou no sistema");

    // redireciona o link para uma outra pagina
    header("Location: listarSolicitacaoPortaria.php");
}
else {
    session_start();
    $_SESSION['login_usuario'] = $login;
    $_SESSION['senha_usuario'] = $pwd;
    $_SESSION['nivel'] = $admin;
    $_SESSION['direcao'] = $direcao;
    $_SESSION['logado'] = $logado;
    gravaLog("Logou no sistema");

    // redireciona o link para uma outra pagina
    header("Location: listarSolicitacaoOutros.php");
}
?>
    </body>
</html>