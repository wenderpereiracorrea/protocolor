<?	@session_start();	
import_request_variables("gP");
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/Y");
$datas = date("Y/m/d");
$hora= gmdate("H:i" ,time()-(3570*2));

?>


  <? if ($_POST[gerar] != "") {

		$sql = "select * from circulacao where nprocesso = '".$nprocesso."' and observacao like '%".transito."%'";
		$process = mysql_query($sql) or die("Erro: " . $sql);

		if (mysql_num_rows($process) > 0) { ?>

<script language="javascript">
if (confirm("O processo <? echo $nprocesso; ?> est� em tr�nsito!\nDeseja fazer o acolhimento?") == true) {
window.location.href='recebimento.php?recebe=SIM&num=<? echo $nprocesso; ?>';
} else {
window.location.href='recebimento.php?excluir=';
}
</script>
<? } else { ?>
<script language="javascript">
alert('O processo <? echo $nprocesso; ?> n�o est� em tr�nsito!');
</script>
<? } } ?>

<?
if ($_GET[recebe] == "SIM") {

$sqlquery = "UPDATE circulacao SET observacao = 'TRANSFERIDO' WHERE nprocesso = '".$_GET[num]."'"; 
$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

$sql_ins = "insert into historico (usuario, data, hora, acao,ip) values ('".$_SESSION["nome"]."','" .tdate($date,0). "','" . $hora  . "','Recebeu o Processo $_GET[num]','".get_ip()."')";
    mysql_query($sql_ins);

?><script language="javascript1.2">alert('Processo Recebido!!!');</script><? 
 }

?>


  <? if ($_POST[gerar2] != "") {

		$sql = "select * from circulacao where nprocesso = '".$nprocesso2."' and observacao like '%".transito."%'";
		$process = mysql_query($sql) or die("Erro: " . $sql);

		if (mysql_num_rows($process) > 0) { ?>

<script language="javascript">
if (confirm("O processo <? echo $nprocesso; ?> est� em tr�nsito!\nDeseja fazer o acolhimento?") == true) {
window.location.href='recebimento.php?recebe2=SIM&num=<? echo $nprocesso2; ?>';
} else {
window.location.href='recebimento.php?excluir=';
}
</script>
<? } else { ?>
<script language="javascript">
alert('O processo <? echo $nprocesso; ?> n�o est� em tr�nsito!');
</script>
<? } } ?>

<?
if ($_GET[recebe2] == "SIM") {

$sqlquery = "UPDATE circulacao SET observacao = 'TRANSFERIDO' WHERE nprocesso = '".$_GET[num]."'"; 
$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

$sql_ins = "insert into historico (usuario, data, hora, acao,ip) values ('".$_SESSION["nome"]."','" .tdate($date,0). "','" . $hora  . "','Recebeu o Processo $_GET[num]','".get_ip()."')";
    mysql_query($sql_ins);

?><script language="javascript1.2">alert('Processo Recebido!!!');</script><? 
 }

?>



<? // ******************** IN�CIO DA P�GINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
</HEAD>

<BODY>
<center>
<form action="recebimento.php" method="POST" name="calform" target="_self">

<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o n�mero do processo:</b>
		</td>
	</tr>
	<tr>
		<td class="caixaazul">
		<input type="text" name="nprocesso" onKeyPress="return txtBoxFormat(this, '99999.999999/9999-99', event);" maxlength="20">&nbsp;
		<input name='gerar' type='submit' value='OK' class='botao'>
		</td>
	</tr>
</table>

<br><br><br><br>
Informe o <b>n�mero completo</b> do processo. Ex: <b>(01530.000000/0000-00)</b>.<br>
O sistema ir� emitir uma mensagem, caso o processo esteja em tr�nsito, para que o usu�rio possa confirmar o acolhimento.
</center>

<br><br><br><hr><br>
<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o n�mero do processo (processos antigos com 2 d�gitos para representar o ano):</b>
		</td>
	</tr>
	<tr>
		<td class="caixaazul">
		<input type="text" name="nprocesso2" onKeyPress="return txtBoxFormat(this, '99999.999999/99-99', event);" maxlength="18">&nbsp;
		<input name='gerar2' type='submit' value='OK' class='botao'>
		</td>
	</tr>
</table>

</form>
<br><br><br><br>
Informe o <b>n�mero completo</b> do processo. Ex: <b>(01530.000000/00-00)</b>.<br>
O sistema ir� emitir uma mensagem, caso o processo esteja em tr�nsito, para que o usu�rio possa confirmar o acolhimento.
</center>

</BODY>
<? include "footer.php" ?>
</HTML>



