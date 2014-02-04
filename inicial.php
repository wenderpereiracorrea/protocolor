<?php
error_reporting(0);
	include "conexao.php";
    include "valida_user.php";
	connect();	
    $date = date("d/m/y");
	$hora= gmdate("H:i" ,time()-(3570*2));

?>
<?  //contador de vezes que o usuario acessou o sistema...

	$sql = 		"select * from historico";
	$sql = $sql." where usuario like '".$login."'";
	$sql = $sql." and acao like 'Entrou no sistema'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	if (mysql_num_rows($process) > 0) 
		{
		$num_registros = mysql_num_rows($process);
	}

// fim  ?>


<html>


<head>
<title>Protocolo - Funarte</title>
<script language="javascript">window.defaultStatus='Seja Bem Vindo(a) <? echo ucfirst($_SESSION["login"]); ?>. Você está logado desde as <? echo ($hora); ?> hrs. Acesso número <? echo ($num_registros); ?> .'</script>
</head>

<frameset framespacing="0" border="0" frameborder="0" rows="92,*">
  <frame name="faixa" scrolling="no" noresize target="conteúdo" src="superior.php">
  <frameset cols="220,*">
    <frame name="conteúdo" target="principal" src="menu.php" scrolling="auto">
    <frame name="principal" src="corpo_do_sistema.php" scrolling="auto">
  </frameset>
  <noframes>
  <body>

  <p>Esta página usa quadros mas seu navegador não aceita quadros.</p>

  </body>
  </noframes>
</frameset>

</html>
