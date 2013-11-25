<!DOCTYPE html>
<html class="no-js">
    <title>Sistema de Gerenciamento de Documentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="bootstrap/css/docs.css" rel="stylesheet">
    <link href="bootstrap/js/google-code-prettify/prettify.css"
          rel="stylesheet">
	<script>
	    jQuery(document).ready(function () {
	        // binds form submission and fields to the validation engine
	        jQuery("#form1").validationEngine();
	    });
	</script>
    <link href="css/index.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->
    <!-- jQUERY PARA VALIDAÇÃO-->
    <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
    <link rel="stylesheet" href="css/template.css" type="text/css" />
    <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/languages/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jsValidate.js" type="text/javascript"></script>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
          href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
</head>
<body>
    <br />
    <br />
    <br />
    <form id="form1" name="form1" class="form-signin" method="post" action="login.php">
        <a href="http://www.casaruibarbosa.gov.br/"> <img src="imagens/logo.jpg" alt="" width="720" height="120"
                                                          style="display: block; margin-left: auto; margin-right: auto" /> </a>

        <H4 align="center">SISTEMA DE PROTOCOLO</h4>

        <div class="form-actions">

            <label class="control-label" for="inputEmail"><i class="icon-user"></i>Usuário</label>
            <div class="controls">
                <input type="text"
                       class=""
                       placeholder="Usuário" name="login" id="login" size="20"
                       tabindex="1">
            </div>
            <label class="control-label" for="inputPassword"><i
                    class="icon-asterisk"></i>Senha</label>
            <div class="controls">
                <input type="password" class="validate[required,minSize[3]]"
                       placeholder="Senha" value="***" name="senha" size="20" tabindex="2">
            </div>
            <div class="control-label">
                <input type="submit" class="btn btn-success" value="Entrar"
                       name="B1" tabindex="3"> <input type="reset" class="btn"
                       value="Limpar" name="B2" tabindex="4" /> <br />
                <div id="alert1" class="alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    Caso não possua senha clique em entrar.
                </div>
                <label id="erromsg" class="label-success" style="color: #FFFFFF; font-style: normal; font-weight: bold"></label>
                <label id="erro" style="color: #FFFFFF; font-style: normal; font-weight: bold"
                       class="label-success"> </label>
            </div>

        </div>

        <footer class="footer-inverse ">
            <p align="center">Copyright Central IT 2013. All rights reserved.</p>
        </footer>
    </form>

    <script>
jQuery(document).ready(function() {
    // binds form submission and fields to the validation engine
    jQuery("#form1").validationEngine();
});
    </script>
    <!-- <script src="bootstrap/js/holder/holder.js"></script> -->
</body>
</html>



