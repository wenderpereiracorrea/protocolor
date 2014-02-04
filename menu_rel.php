<? 
session_start();
	include "conexao.php";
	//include "layout.php";
	connect();
?>
<html>
<head>
<link href="styles.css" rel=stylesheet type=text/css>
<style type="text/css">
<!--
.style1 {color: #003300}
-->
</style>
</head>
<body><br><br><br><br><br><br><br><br><br>
<table align="center" width="50%" cellpadding="0" cellspacing="0">

<TR align='center'> 
		<td align="center" colspan="2" class="titulo">
			<div align="center"><strong>RELATÓRIOS&nbsp;</strong></div>
		</td>
  </tr>
	
</table><BR><BR>

<center>
<a href="rel_movimentacao.php">Encaminhamentos do Processo</a></center>

<form method="POST" name="form">
<center><input name="aviso" id="aviso" style="text-align:center;" size="100" class="aviso" readonly></center><BR><BR> 
<table align="center" cellpadding="0" cellspacing="0" width="40%">
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
	<tr>
		<td><center>
			<input name="bt_historico" type="button" class="botao" value='Histórico'  onclick='javascript:window.location.href="rel_movimento.php";' onMouseMove='document.form.aviso.value="Histórico de movimentação de usuários"' onMouseOut='document.form.aviso.value=""'>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
		<td><center>
			<input name="bt_lancamento" type="button"  class="botao" value='Lançamentos' onclick='javascript:window.location.href="rel_lancamento.php";' onMouseMove='document.form.aviso.value="Relatório de lançamentos de processos"' onMouseOut='document.form.aviso.value=""'>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
	<tr>
		<td><center>
			<input name='bt_transito' type='button' class='botao' value='Em Trânsito' onclick='javascript:window.location.href="rel_transito.php";' onMouseMove='document.form.aviso.value="Relatório de processos em trânsito"' onMouseOut='document.form.aviso.value=""'>
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>	
	<tr>
		<td><center>
			<input name='bt_setor' type='button' class='botao' value='Distribuição' onclick='javascript:window.location.href="listagem_setor.php";' onMouseMove='document.form.aviso.value="Relatório de distribuição de processos nos setores"' onMouseOut='document.form.aviso.value=""'>
		</center></td>
	</tr>
	<!--tr>
		<td>&nbsp;</td></tr>
	<tr>	
	<tr>
		<td><center>
			<input name="Sair" value="Sair" class="botao" onclick='javascript: window.location.href = "corpo_do_sistema.php"' type="button">
		</center></td>
	</tr-->	
	</form>
</table>
</body>
</html>
