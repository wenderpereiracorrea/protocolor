<? 
@session_start();
if ($nprocesso=="") { 
	$nprocesso = $up.".".$processo."/".$ano."-".$dv;
}
?>
<html>
<head>
<link href="auxiliar/styles.css" rel=stylesheet type=text/css>
<style type="text/css">
<!--
.style1 {color: #003300}
-->
</style>
</head>
<body><br><br><br><br><br><br><br><br><br>
<table align="center" cellpadding="0" cellspacing="0" width="50%">
	<tr>
		<td><center>
		  <h5 class="style1">Os dados do processo <? echo $nprocesso; ?> foram gravados com sucesso!</h5>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
	<tr>
		<td><center>
			<input name="imprimir" type="button" class="botao" value='Imprimir Etiqueta' alt="Imprimir Etiqueta" onclick='javascript:window.location.href="rel_capa_processo.php?nprocesso=<? echo $nprocesso; ?>"'>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
		<td><center>
			<input name="novo" type="button"  class="botao" value='Novo Lançamento' alt="Novo Lançamento" onclick='javascript:window.location.href="lanca_processo.php";'>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
	<tr>
		<td><center>
			<input name='fecha' type='button' class='botao' value='Encerrar Lançamentos' alt="Encerrar Lançamentos" onclick='javascript:window.location.href="corpo_do_sistema.php";'>
		</center></td>
	</tr>
</table>
</body>
</html>
