<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.maskedinput-1.3.js"></script>
        <script type="text/javascript" src="js/jquery.maskMoney.js"></script>
   
            <script type="text/javascript">
                $(document).ready(function(){
                        $(".fone").mask("(99)9999-9999");
                        $(".data").mask("99/99/9999");
                        $(".hora").mask("99:99");
                        $(".placa").mask("aaa-9999");
                        $(".cpf").mask("999.999.999-99");
                        $(".real").maskMoney({precision:3});
                        $(".Total").maskMoney({precision:2});
                });
            </script>
      </body>
</html>
