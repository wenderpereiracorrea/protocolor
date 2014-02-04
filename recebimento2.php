<?	
error_reporting(0);
session_start();	
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
if (confirm("O processo <? echo $nprocesso; ?> está em trânsito!\nDeseja fazer o acolhimento?") == true) {
window.location.href='recebimento.php?recebe=SIM&num=<? echo $nprocesso; ?>';
} else {
window.location.href='recebimento.php?excluir=';
}
</script>
<? } else { ?>
<script language="javascript">
alert('O processo <? echo $nprocesso; ?> não está em trânsito!');
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
if (confirm("O processo <? echo $nprocesso; ?> está em trânsito!\nDeseja fazer o acolhimento?") == true) {
window.location.href='recebimento.php?recebe2=SIM&num=<? echo $nprocesso2; ?>';
} else {
window.location.href='recebimento.php?excluir=';
}
</script>
<? } else { ?>
<script language="javascript">
alert('O processo <? echo $nprocesso; ?> não está em trânsito!');
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



<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>

<script type="text/javascript">
function antigo() {

	document.getElementById('ant').style.visibility = 'visible';
	document.getElementById('at').style.visibility = 'hidden';

}

function atual() {

	document.getElementById('at').style.visibility = 'visible';
	document.getElementById('ant').style.visibility = 'hidden';

}

</script>

</HEAD>

<BODY>
<center>
<br>
<a href="#" onClick="antigo()"><b>Processo com 2 dígitos para representar o ano</b></a><br><br>
<a href="#" onClick="atual()"><b>Processo com 4 dígitos para representar o ano</b></a><br><br>
<br>

<form action="recebimento.php" method="POST" name="calform" target="_self">

<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o número do processo:</b>
		</td>
	</tr>
	<tr id="at">
		<td class="caixaazul">
		<br><b>Ano com quatro dígitos</b><br><br>
		<input type="text" name="nprocesso" onKeyPress="return txtBoxFormat(this, '99999.999999/9999-99', event);" maxlength="20">&nbsp;
		<input name='gerar' type='submit' value='OK' class='botao'>
		</td>
	</tr>

	<tr id="ant" style="visibility:hidden">
		<td class="caixaazul">
		<br><b>Ano com dois dígitos</b><br><br>
		<input type="text" name="nprocesso2" onKeyPress="return txtBoxFormat(this, '99999.999999/99-99', event);" maxlength="18">&nbsp;
		<input name='gerar2' type='submit' value='OK' class='botao'>
		</td>
	</tr>

</table>

<br><br><br><br>
Informe o <b>número completo</b> do processo.<br>
O sistema irá emitir uma mensagem, caso o processo esteja em trânsito, para que o usuário possa confirmar o acolhimento.
</center>


</form>
</center>

</BODY>
</HTML>



