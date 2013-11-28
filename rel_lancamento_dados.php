<? import_request_variables("gP"); ?>
<? 
session_start();
include "conexao.php";
connect();
	// ******************* TRANSFORMA A APRESENTAÇÃO DA DATA ****** INÍCIO *********************// ******************* TRANSFORMA A APRESENTAÇÃO DA DATA ****** FIM *********************	

?>
<html>
<head>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

</head>
<body>
<TABLE width="80%" BORDER=0 align="center" cellpadding="1" cellspacing="1">
<a href="#" onclick="window.print(); return false;">Imprimir</a>
	<tr>
	  <td width="3%" style="visibility:hidden;"><center>ID</center></td>
	  
	  <td width="10%" class="caixadestaque"><center><a href="rel_lancamento_dados.php?ordem=data&datainipesq=<? echo $datainipesq; ?>&datafimpesq=<? echo $datafimpesq; ?>">DATA DO CADASTRO</a></center></td>
	  
	  <td width="20%" class="caixadestaque"><center><a href="rel_lancamento_dados.php?ordem=processo&datainipesq=<? echo $datainipesq; ?>&datafimpesq=<? echo $datafimpesq; ?>">PROCESSO</a></center></td>
	  
	  <td width="10%" class="caixadestaque"><center><a href="rel_lancamento_dados.php?ordem=setor&datainipesq=<? echo $datainipesq; ?>&datafimpesq=<? echo $datafimpesq; ?>">SETOR</a></center></td>
	  
	  <td width="15%" class="caixadestaque"><center><a href="rel_lancamento_dados.php?ordem=documento&datainipesq=<? echo $datainipesq; ?>&datafimpesq=<? echo $datafimpesq; ?>">DOCUMENTO</a></center></td>
	  
	  <td width="47%" class="caixadestaque"><center><a href="rel_lancamento_dados.php?ordem=assunto&datainipesq=<? echo $datainipesq; ?>&datafimpesq=<? echo $datafimpesq; ?>">ASSUNTO</a></center></td>
	</tr>
<? 
		if ($datainipesq != "" or $datafimpesq != "") {

		$sqlquery = "select * from processo ";
		//if ($pesqnome<>"") {
		//$sqlquery = $sqlquery." where usuario = '".$pesqnome."'";
		//}
		if ($datainipesq != "" && $datafimpesq != "") { 
			$sqlquery = $sqlquery." where data_cadastro >= '".tdate($datainipesq,0)."'";
			$sqlquery = $sqlquery." and data_cadastro <= '".tdate($datafimpesq,0)."'";
		}			
		if ($ordem=="" || $ordem=="data") {
			$sqlquery = $sqlquery." order by data_cadastro desc";
		}
		if ($ordem=="processo") {
			$sqlquery = $sqlquery." order by nprocesso";
		}
		if ($ordem=="setor") {
			$sqlquery = $sqlquery." order by setorsolicitante";
		}
		if ($ordem=="documento") {
			$sqlquery = $sqlquery." order by numero";
		}
		if ($ordem=="assunto") {
			$sqlquery = $sqlquery." order by assunto";
		}
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($process) > 0) {
					while ($line = mysql_fetch_array($process)) {
						$id = $line['idprocesso'];
						$data = $line['dataent'];
						$processo = $line['nprocesso'];
						$setor = $line['setorsolicitante'];
						$numero = $line['numero'];
						$documento = $line['documento'];
						$assunto = $line['assunto'];
						$data_cadastro = $line['data_cadastro'];
						?>
						<tr>
							<td style="visibility:hidden"><? echo ($id); ?></td>
							<td class="caixa"><? echo tdate($data_cadastro,1); ?></td>
							<td class="caixa"><? echo ($processo); ?></td>
							<td class="caixa"><? echo ($setor); ?></td>
							<td class="caixa"><? echo ($documento); ?> - <? echo ($numero); ?></td>
							<td class="caixa"><? echo ($assunto); ?></td>
						</tr>
						<?
					}
echo "<center>"."<b>";
echo mysql_num_rows($process);
echo " ocorrências"."</center>"."</b>"."<br>";
		}
				mysql_free_result($process);					

} // fim do if (nprocesso != "")
?>		
</TABLE>
</body>
<? include "footer.php" ?>
</html>