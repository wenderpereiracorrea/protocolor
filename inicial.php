<?php
error_reporting(0);
include "conexao.php";
include "valida_user.php";
connect();	
?>
<html>
<head>
<title>SIGE</title>
</head>
<frameset framespacing="0" border="0" frameborder="0" rows="52,*">
  <frame name="faixa" scrolling="no" noresize target="conteÃƒÂºdo" src="superior.php">
  <frameset cols="220,*">
    <frame name="conteÃƒÂºdo" target="principal" src="menu.php" scrolling="auto">
    <frame name="principal" src="corpo_do_sistema.php" scrolling="auto">
  </frameset>
  <noframes>
  <body>
  <p>Esta pÃƒÂ¡gina usa quadros mas seu navegador nÃƒÂ£o aceita quadros.</p>
  </body>
  </noframes>
</frameset>
</html>
