<meta http-equiv="refresh" content="1; url=index.php">
<?php
	include "valida_user.php";
    include "conexao.php";
	connect();
    $date = date("d/m/y");
    $hora= gmdate("H:i" ,time()-(3570*2));	
	$sql_ins = "insert into historico (usuario, data, hora, acao,ip) values ('" . ucwords($_SESSION["nome"]) . "','" . tdate($date,0) . "','" . $hora  . "','Saiu do Sistema','".get_ip()."')";
    	$process = mysql_query($sql_ins) or die("Query invalida: " . mysql_error());


    session_write_close();
    session_start(); // Inicializa a sessão
    $_SESSION["login"] = "";
    $_SESSION["senha"] = ""; 
?>

<script language="JavaScript">
	window.location.href = 'index.php';
</script>

