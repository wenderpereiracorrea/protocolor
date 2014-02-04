<? import_request_variables("gP"); error_reporting(0); ?>
<? 
@session_start();
include "conexao.php";
connect();


?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="buscaProcesso.js"></script>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>

<script>
function avalia_gravar(form) {
 
 if (form1.cons_ano.value == "") {
     alert("Informe o ano.");
	 form1.cons_ano.focus();
     return false;
  }
}
</script>

</HEAD>

<body>
<br><br>
<center>

<form name="form1" method="post" action="listagem_setor.php">
<center>

<? if ($_POST[consultar] == "Consultar" and $_POST[cons_ano] != "") {

		$sql2 = "select count(distinct p.nprocesso) as total
		 from processo p, circulacao c
		  where p.idprocesso = c.idprocesso and p.localizacao like '%".$_POST[cons_localizacao]."%' and data >=  '".$_POST[cons_ano]."-01-01' and data <=  '".$_POST[cons_ano]."-12-31'";
		$Resultado2 = mysql_query($sql2) or die("Erro: " . mysql_error());

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$total = $array_exibir['total'];
			}
?>

<center><b>
<? echo $total; ?> Registros localizados.</b>
</center><br><br>
<? } ?>

<table width="95%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong><a href="listagem_setor.php">Consulta por Localiza&ccedil;&atilde;o</a></strong>
			</td>
          </tr>

       <tr> 
       <td colspan="6" class="caixaazul">
       Informe o Setor:&nbsp;
			<input name="cons_localizacao" type="text" size="30" class="cor-inativa" value="<? echo $_POST[cons_localizacao]; ?>">
			&nbsp;
			Informe o Ano:&nbsp;
			<input name="cons_ano" type="text" size="5" class="cor-inativa" value="<? echo $_POST[cons_ano]; ?>" onKeyPress="return txtBoxFormat(this, '9999', event);" maxlength="4">
			&nbsp;
			<input type="submit" name="consultar" value="Consultar" onClick="return avalia_gravar(this);">
			</td>
       </tr>
</table>

<table width="95%" style="border:solid 1px #333333;" cellpadding="4" cellspacing="4">
<tr>
<td style="background-color:#333; color:#FFFFFF; width:130px;">
<b>Processo</b>
</td>

<td style="background-color:#333; color:#FFFFFF;">
<b>Assunto</b>
</td>

<td style="background-color:#333; color:#FFFFFF;">
<b>Interessado</b>
</td>

<td style="background-color:#333; color:#FFFFFF;">
<b>Localiza&ccedil;&atilde;o</b>
</td>

</tr>
		
<?

if ($_POST[consultar] == "Consultar") {

/*		$sql = "select * from mensagens order by cod desc limit 5";
		$Resultado = mysql_query($sql) or die("Erro: "); */

$_pagi_sql = "select distinct p.nprocesso, p.favorecido, p.assunto, p.idprocesso, p.localizacao
		 from processo p, circulacao c
		  where p.idprocesso = c.idprocesso and p.localizacao like '%".$_POST[cons_localizacao]."%' and data >=  '".$_POST[cons_ano]."-01-01' and data <=  '".$_POST[cons_ano]."-12-31' order by p.nprocesso"; 

//quantidade de resultados por página (opcional, por padrão 20) 
$_pagi_cuantos = 1000; 

//Incluímos o script de paginação. Este já executa a consulta automaticamente 
include("paginacao/paginator.inc.php"); 

			while($row = mysql_fetch_array($_pagi_result)){ 
			
				$codigo1 = $row['nprocesso'];
				$favorecido = $row['favorecido'];
				$assunto = $row['assunto'];
				$idprocesso = $row['idprocesso'];
				$localizacao = $row['localizacao'];

				// Colorir linha sim, linha não ####################
				$cont = $cont + 1;
				if ($cont % 2) { $bg = "#FFF"; } else {
				$bg = "#E2E2E2"; }
				// Colorir linha sim, linha não ####################

								
echo "<tr><td style='background-color:$bg'>";
echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>";
echo $codigo1;
echo "</a>";
echo "</td>";

echo "<td style='background-color:$bg'>";
echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>";
echo $assunto;
echo "</a>";
echo "</td>";

echo "<td style='background-color:$bg'>";
echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>";
echo $favorecido;
echo "</a>";
echo "</td>";

echo "<td style='background-color:$bg'>";
echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>";
echo $localizacao;
echo "</a>";
echo "</td>";
echo "</tr>";


			}
			
}
echo "</table>";
echo "<br>";			
echo "<br>";			
echo "<br>";			
//echo"<p style='text-align:left; padding-left:30px;'>".$_pagi_navegacion."</p>";

?>	  	
</table>
</form>


</center>

</body>
</HTML>
