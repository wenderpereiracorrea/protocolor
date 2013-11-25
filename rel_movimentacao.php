<?	@session_start();	
include "conexao.php";
include "valida_user.php";
connect();
//$date = date("d/m/Y");
//$datas = date("Y/m/d");
//$hora= gmdate("H:i" ,time()-(3570*2));

?>


<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
</HEAD>

<BODY>
<center>
<form action="rel_movimentacao.php" method="POST" name="calform" target="_self">

<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o número do processo:</b>
		</td>
	</tr>
	<tr>
		<td class="caixaazul">
		<input type="text" name="nprocesso">&nbsp;
		<input name='consultar' type='submit' value='OK' class='botao'>
		</td>
	</tr>
</table>
<br><br>
<table width="100%" style="border:#333333 solid 1px;">
<tr>
<td style="background:#6699CC; border-bottom:#333333 1px solid;">Data</td>
<td style="background:#6699CC; border-bottom:#333333 1px solid;">Hora</td>
<td style="background:#6699CC; border-bottom:#333333 1px solid;">Usuário</td>
<td style="background:#6699CC; border-bottom:#333333 1px solid;">Ação</td>
</tr>

  <? if ($consultar != "" and $nprocesso != "") {

		$sql = "select * from historico where acao like '%".$nprocesso."%'";
		$process = mysql_query($sql) or die("Erro: " . $sql);

		if (mysql_num_rows($process) > 0) { 

		while ($line = mysql_fetch_array($process)) 
		{
//			$nprocesso= $line['nprocesso'];
			$data = $line['data'];
			$hora = $line['hora'];
			$usuario = $line['usuario'];
			$acao = $line['acao'];
//			$observacao = $line['observacao'];

?>
<tr>
<td style="border-bottom:#999999 1px solid;"><? echo $data; ?></td>
<td style="border-bottom:#999999 1px solid;"><? echo $hora; ?></td>
<td style="border-bottom:#999999 1px solid;"><? if ($usuario == "") { echo "&nbsp;"; } else { echo $usuario; } ?></td>
<td style="border-bottom:#999999 1px solid;"><? if ($acao == "") { echo "&nbsp;"; } else { echo $acao; } ?></td>
</tr>
<?
		}

 }
}
?>
</table>
</form>
</center>
<? include "footer.php" ?>
</BODY>
</HTML>



