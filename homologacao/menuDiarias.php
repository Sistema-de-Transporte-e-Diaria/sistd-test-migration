<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
        <style type="text/css">
            /*<![CDATA[*/

            #cssmenu{ height:37px; display:block; padding:0; margin:20px auto;  border:1px solid; border-radius:5px; } 
            #cssmenu > ul {list-style:inside none; padding:0; margin:0;} 
            #cssmenu > ul > li {list-style:inside none; padding:0; margin:0; float:left; display:block; position:relative;} 
            #cssmenu > ul > li > a{ outline:none; display:block; position:relative; padding:12px 20px; font:bold 13px/100% Arial, Helvetica, sans-serif; text-align:center; text-decoration:none; text-shadow:1px 1px 0 rgba(0,0,0, 0.4); } 
            #cssmenu > ul > li:first-child > a{border-radius:5px 0 0 5px;} 
            #cssmenu > ul > li > a:after{ content:''; position:absolute; border-right:1px solid; top:-1px; bottom:-1px; right:-2px; z-index:99; } 
            #cssmenu ul li.has-sub:hover > a:after{top:0; bottom:0;} 
            #cssmenu > ul > li.has-sub > a:before{ content:''; position:absolute; top:18px; right:6px; border:5px solid transparent; border-top:5px solid #fff; } 
            #cssmenu > ul > li.has-sub:hover > a:before{top:19px;} 
            #cssmenu ul li.has-sub:hover > a{ background:#3f3f3f; border-color:#3f3f3f; padding-bottom:13px; padding-top:13px; top:-1px; z-index:999; } 
            #cssmenu ul li.has-sub:hover > ul, #cssmenu ul li.has-sub:hover > div{display:block;} 
            #cssmenu ul li.has-sub > a:hover{background:#3f3f3f; border-color:#3f3f3f;} 
            #cssmenu ul li > ul, #cssmenu ul li > div{ display:none; width:auto; position:absolute; top:38px; padding:10px 0; background:#3f3f3f; border-radius:0 0 5px 5px; z-index:999; } 
            #cssmenu ul li > ul{width:200px;} 
            #cssmenu ul li > ul li{display:block; list-style:inside none; padding:0; margin:0; position:relative;} 
            #cssmenu ul li > ul li a{ outline:none; display:block; position:relative; margin:0; padding:8px 20px; font:10pt Arial, Helvetica, sans-serif; color:#fff; text-decoration:none; text-shadow:1px 1px 0 rgba(0,0,0, 0.5); } 


            #cssmenu, #cssmenu > ul > li > ul > li a:hover{ background:#60a318; background:-moz-linear-gradient(top,  #60a318 0%, #588514 100%); background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#60a318), color-stop(100%,#588514)); background:-webkit-linear-gradient(top,  #60a318 0%,#588514 100%); background:-o-linear-gradient(top,  #60a318 0%,#588514 100%); background:-ms-linear-gradient(top,  #60a318 0%,#588514 100%); background:linear-gradient(top,  #60a318 0%,#588514 100%); filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#60a318', endColorstr='#588514',GradientType=0 ); } 
            #cssmenu{border-color:#39540d;} 
            #cssmenu > ul > li > a{border-right:1px solid #39540d; color:#fff;} 
            #cssmenu > ul > li > a:after{border-color:#87d435;} 
            #cssmenu > ul > li > a:hover{background:#6aa613;} 

            /*]]>*/
        </style>
        <title></title>
    </head>
    <body style="font-family: courier">
        <div id='cssmenu'>

            <ul>  
                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                    ?>    
                    <li class='has-sub'>
                        <a href='#'><span>Solicitar</span></a>
                        <ul>                           
                            <li >
                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                                    ?>
                                    <a href='diaria.php'><span>Diárias</span></a>
                                <?php } ?>   
                            </li>
                        </ul>
                    </li>
                <?php } ?>           

                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                    ?>  
                    <li class='has-sub'>
                        <a href='#'><span>Listar</span></a>
                        <ul>
                            <li >

                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                                    ?> 
                                    <a href='listarDiariasSolicitante.php'><span>Diárias</span></a>
                                <?php } ?> 
                            </li>                           
                            <li>
                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                                    ?>  
                                    <a href='listarUsuariosSolicitanteDiaria.php'><span>Seu Usuário</span></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </li>             
                <?php } ?>
                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                    ?>  

                    <li class='has-sub'>
                        <a href='#'><span>Relatórios</span></a>
                        <ul>
                            <li class='last'>
                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2 || $_SESSION['nivel'] == 3) {
                                    ?>  
                                    <a href='selecionaDiaria.php'><span>Reimprimir Prestação de Contas</span></a>
                                <?php } ?>
                            </li>

                        </ul>
                    </li>
                <?php } ?>  

                <?php if ($_SESSION['nivel'] == 3) {
                    ?>
                    <li class='has-sub'>
                        <a href='#'><span>Gerenciar</span></a>
                        <ul>
                            <li class='last'>
                                <?php if ($_SESSION['nivel'] == 3) {
                                    ?>
                                    <a href='configGeraisDiaria.php'><span>Configurações gerais</span></a>
                                <?php } ?>
                            </li>                                    
                        </ul>
                    </li>
                <?php } ?> 


                <li class='last'>
                    <a href='sair.php'><span>Sair</span></a>
                </li>
            </ul>
        </div>
    </body>
</html>
