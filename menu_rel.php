<? 
session_start();
	include "conexao.php";
	include "layout.php";
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
			<a  target="_Blank" name="bt_historico" class="botao" href="rel_movimento.php" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Histórico</a>
			
		</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
		<td><center>
			<a  target="_Blank" name="bt_historico" class="botao" href="rel_lancamento.php" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Lançamento  </a>
			</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>
	<tr>
		<td><center>
			<a  target="_Blank" name="bt_historico" class="botao" href="rel_transito.php" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Em Trânsito  </a>
			</center></td>
	</tr>
	<tr>
		<td>&nbsp;</td></tr>
	<tr>	
	<tr>
		<td><center>
			<a  target="_Blank" name="bt_historico" class="botao" href="listagem_setor.php" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Distribuição </a>
			</center></td>
	</tr>
	</form>
</table>
</body>

</html>
