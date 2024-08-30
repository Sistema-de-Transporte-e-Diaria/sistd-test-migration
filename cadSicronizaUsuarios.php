<?php
include ('validar_session.php');
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
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sicronizando Usuários</title>
    </head>
    <img src="imagens/banner_topo.png" class="img-rounded img-responsive">
    <body  style="font-family: courier">
         <?php
        $sql2 = "SELECT * FROM manutencao
                            WHERE codConfig = 1";
        $resultado = mysql_query($sql2) or die("erro#03: " . mysql_error());
        while ($registro = mysql_fetch_array($resultado)) {
            $statusBase = $registro['statusBase'];
        }

        $camposMarcados = $_POST['marcado'];

        for ($i = 0; $i < count($camposMarcados); $i++) {

            if ($statusBase == 1) {
                importarUsuariosLDAP($camposMarcados[$i]);
            }
            if ($statusBase == 2) {
                importarUsuariosMSAD($camposMarcados[$i]);
            }
        }

        function importarUsuariosLDAP($siape) {
            conecta();
            $sql1 = "SELECT * FROM manutencao
                            WHERE codConfig = 1";
            $resultado = mysql_query($sql1) or die("erro#03: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
                $hostLdap = $registro['ldapHost'];
                $portLdap = $registro['ldapPort'];
                $baseDNldap = $registro['ldapBaseDN'];
                $campoLdap = $registro['ldapCampo'];
                $telCampus = $registro['telCampus'];
            }
            $ldapconfig['host'] = $hostLdap;
            $ldapconfig['port'] = $portLdap;
            $ldapconfig['basedn'] = $baseDNldap;

            $ds = ldap_connect($hostLdap);  // must be a valid LDAP server!
            if ($ds) {
                $r = ldap_bind($ds);    // this is an "anonymous" bind, typically
                $sr = ldap_list($ds, "ou=$campoLdap,$baseDNldap", "uid=$siape");
                $info = ldap_get_entries($ds, $sr);

                for ($i = 0; $i < $info["count"]; $i++) {
                    echo "SIAPE: " . $info[$i]["uid"][0] . "<br/>";
                    echo "NOME: " . $info[$i]["displayname"][0] . "<br/>";
                    echo "E-MAIL: " . $info[$i]["mail"][0] . "<br/><hr/>";
                    $siape = $info[$i]["uid"][0];
                    $nome = $info[$i]["displayname"][0];
                    $email = $info[$i]["mail"][0];

                    conecta();
                    $sql1 = "insert into solicitantes (nome, siape, email,idsetor,administrador,telefone)
                                                VALUES ('$nome','$siape','$email','36','1','$telCampus')";
                    $sql = mysql_query($sql1) or die("erro#06: " . mysql_error());
                }
            }
            ldap_close($ds);
        }

        function importarUsuariosMSAD($siape) {
            conecta();
            $sql1 = "SELECT * FROM manutencao
                            WHERE codConfig = 1";
            $resultado = mysql_query($sql1) or die("erro#03: " . mysql_error());
            while ($registro = mysql_fetch_array($resultado)) {
                $hostLdap = $registro['ldapHost'];
                $portLdap = $registro['ldapPort'];
                $baseDNldap = $registro['ldapBaseDN'];
                $campoLdap = $registro['ldapCampo'];
                $user = $registro['ldapuser'];
                $pass = $registro['ldappass'];
                $telCampus = $registro['telCampus'];
            }

            //  $ldapserver = $hostLdap;
            //   $ldapuser = $user;
            //   $ldappass = $pass;
            //   $ldaptree = $campoLdap;
            // connect PDC 2008
            $ldapconn = ldap_connect($hostLdap) or die("Could not connect to LDAP server.");

            if ($ldapconn) {

                //  if (valida_ldap($ldapserver, $siape, $senha,$ldapconn)) {
                // binding to ldap server

                $ldapbind = ldap_bind($ldapconn, $user, $pass);
                //$ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
                // verify binding
                //  if ($ldapbind) {
                //   echo "Usuario Logado<br><br>";
                //$servidor2008 = true;
                //  } else {
                //    echo "Erro de login do usuario<br><br>";
                //  }
            }
            // echo "Lista de servidores<br>";
            $result = ldap_search($ldapconn, $campoLdap, "(samaccountname=$siape)") or die("Error in search query: " . ldap_error($ldapconn));
            $data = ldap_get_entries($ldapconn, $result);




            // $ldapconfig['host'] = $hostLdap;
            //$ldapconfig['port'] = $portLdap;
            //$ldapconfig['basedn'] = $baseDNldap;
            //  $ds = ldap_connect($hostLdap);  // must be a valid LDAP server!
            //   if ($ds) {
            //$r = ldap_bind($ds);    // this is an "anonymous" bind, typically
            //       $sr = ldap_list($ds, "ou=$campoLdap,$baseDNldap", "uid=$siape");
            //       $info = ldap_get_entries($ds, $sr);
//
            for ($i = 0; $i < $data["count"]; $i++) {
                echo "SIAPE: " . $data[$i]["samaccountname"][0] . "<br/>";
                echo "NOME: " . $data[$i]["displayname"][0] . "<br/>";
                echo "E-MAIL: " . $data[$i]["mail"][0] . "<br/><hr/>";
                $siape = $data[$i]["samaccountname"][0];
                $nome = $data[$i]["displayname"][0];
                $email = $data[$i]["mail"][0];

                conecta();
                $sql1 = "insert into solicitantes (nome, siape, email,idsetor,administrador,telefone)
                                                VALUES ('$nome','$siape','$email','36','1','$telCampus')";
                $sql = mysql_query($sql1) or die("erro#06: " . mysql_error());
            }
        }

        ldap_close($ldapconn);
        
        gravaLog("Sicronizou usuários");
        ?>

        <script language=javascript>alert('Usuário importados com sucesso!');</script>   
        <script language= "JavaScript">
            location.href = "listarSicronizaUsuarios.php";
        </script>
    </body>
</html>