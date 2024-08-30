<html>
    <?php
    include 'validar_session.php';
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


    <head>       
        <meta name="viewport" content="width=device-width">
        <meta charset="utf-8">        
        <link rel="stylesheet" href="../bootstrap-3.3.5-dist/css/bootstrap.css">
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>   

        <title></title>
    <img src="../imagens/banner_topo.png" class="img-rounded img-responsive">
</head>

<?php include 'menu.php'; ?>
<body style="font-family: courier">


    <div id="main" class="container-fluid">
        <div id="top" class="row">
            <div class="col-md-3">
                <h2>Incluir Servidores/Estagiários</h2>
            </div>
        </div> 
        <div id="list" class="row">
            <div class="table-responsive col-md-12">

                <form class="form-inline" method="post" action="cadSicronizaUsuarios.php" name="solicita">

                    <table class="table table-striped" cellspacing="0" cellpadding="0" >
                        <thead>
                            <tr>                            
                                <th>Siape</th>                            
                                <th >Nome</th>
                                <th >Email</th>
                                <th style="width: 5%">Incluir</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            conecta();

                            $sql2 = "SELECT * FROM manutencao
                            WHERE codConfig = 1";
                            $resultado2 = mysql_query($sql2) or die("erro#03: " . mysql_error());
                            while ($registro = mysql_fetch_array($resultado2)) {
                                $statusBase = $registro['statusBase'];
                                $hostLdap = $registro['ldapHost'];
                                $portLdap = $registro['ldapPort'];
                                $baseDNldap = $registro['ldapBaseDN'];
                                $campoLdap = $registro['ldapCampo'];
                                $user = $registro['ldapuser'];
                                $pass = $registro['ldappass'];


                                if ($statusBase == '1') {
                                    $ldapconfig['host'] = $hostLdap;
                                    $ldapconfig['port'] = $portLdap;
                                    $ldapconfig['basedn'] = $baseDNldap;

                                    $ds = ldap_connect($hostLdap);  // must be a valid LDAP server!
                                    if ($ds) {
                                        $r = ldap_bind($ds);    // this is an "anonymous" bind, typically
                                        $sr = ldap_list($ds, "ou=$campoLdap,$baseDNldap", "uid=*");
                                        $info = ldap_get_entries($ds, $sr);



                                        for ($i = 0; $i < $info["count"]; $i++) {
                                            $siapeLdap = $info[$i]["uid"][0];
                                            $retorno = verificaCadastro($siapeLdap);
                                            if ($retorno == 0) {
                                                ?>


                                                <tr align="left">
                                                    <td ><?= $info[$i]["uid"][0] ?></td>
                                                    <td ><?= $info[$i]["givenname"][0] . ' ' . $info[$i]["cn"][0] ?></td>
                                                    <td><?= $info[$i]["mail"][0] ?></td>
                                                    <td><input type="checkbox" name="marcado[]" value="<?= $info[$i]["uid"][0] ?>"></td>        
                                                </tr>

                                                <?php
                                            }
                                        }
                                        ldap_close($ds);
                                    }
                                }


                                if ($statusBase == '2') {
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
                                    $result = ldap_search($ldapconn, $campoLdap, "(cn=*)") or die("Error in search query: " . ldap_error($ldapconn));
                                    $data = ldap_get_entries($ldapconn, $result);


                                    for ($i = 0; $i < $data["count"]; $i++) {
                                        $siapeLdap = $data[$i]["samaccountname"][0];
                                        $retorno = verificaCadastro($siapeLdap);
                                        if ($retorno == 0) {
                                            ?>


                                            <tr align="left">
                                                <td ><?= $data[$i]["samaccountname"][0] ?></td>
                                                <td ><?= $data[$i]["displayname"][0] ?></td>
                                                <td><?= $data[$i]["mail"][0] ?></td>
                                                <td><input type="checkbox" name="marcado[]" value="<?= $data[$i]["samaccountname"][0] ?>"></td>        
                                            </tr>

                                            <?php
                                        }
                                    }
                                    ldap_close($ldapconn);
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="btn-lg">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger btn-xs">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                Importar
                            </button>                
                        </div> 
                    </div>
                </form>
            </div>  
        </div> 
    </div>
</body>
</html>
