<?php 
session_start();

include "conexao.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));


// Qd clica no botão consultar
if ($_POST[consultar] == "Consultar") {

		$sql2 = "select nprocesso, favorecido, assunto, idprocesso
		 from processo where (assunto like '%".$_POST[cons_interessado]."%' or favorecido like '%".$_POST[cons_interessado]."%') and nprocesso like '%/".$_POST[cons_ano]."-%' and nprocesso like '".$_POST["up"]."%' order by nprocesso";
		$Resultado2 = mysql_query($sql2) or die("Erro: " . mysql_error());
		$total = mysql_num_rows($Resultado2);

 }

?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="buscaProcesso.js"></script>
<script type="text/javascript" src="buscaProcessonome.js"></script>

</HEAD>

<body>
<br><br>
<center>
<table width="95%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;PESQUISA DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form method="get" action="" id="frmBusca">
		<p>
			<label for="q" style="background:#96B4EB;"><b>Informe parte do n&uacute;mero ou assunto:&nbsp;</b></label>
			<input type="text" id="q" name="q" accesskey="p" tabindex="1" onKeyUp="buscaInstantanea();" size="20" />

	<div id="resultadoBusca" style="margin-left:30px;">&nbsp;</div>

		</p>
</form>

<br><br><hr style="width:95%;"><br>


<form name="form1" method="post" action="pesquisa.php">
<center>

<table width="95%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong>Consulta por Assunto ou Interessado</strong>
			</td>
          </tr>

       <tr> 
       <td colspan="6" class="caixaazul">
       Origem:&nbsp;
			<input name="up" value="01530" type="text" size="5" class="cor-inativa">
			&nbsp;

       Informe o assunto ou interessado:&nbsp;
			<input name="cons_interessado" id="assuntointeressado" name="assuntointeressado" onKeyUp="buscaInstantanea2()"; type="text" size="30" class="cor-inativa">
			&nbsp;

       Informe o ano:&nbsp;
			<input name="cons_ano" type="text" size="5" class="cor-inativa">
			&nbsp;
			<input type="submit" name="consultar" value="Consultar">
			</td>
       </tr>
</table>
<br />
<?php if ($total > 0) { echo "<span style='color:#990000; font-weight:bold;'>".$total." registros localizados</span><br /><br />"; } ?>
<table width="95%" style="border:solid 1px #333333;" cellpadding="4" cellspacing="4">
<tr>
<td style="background-color:#333; color:#FFFFFF; width:160px;">
<b>Processo</b>
</td>

<td style="background-color:#333; color:#FFFFFF;">
<b>Assunto</b>
</td>

<td style="background-color:#333; color:#FFFFFF;">
<b>Interessado</b>
</td>

</tr>
		
<?

if ($_POST[consultar] == "Consultar") {

		if (mysql_num_rows($Resultado2) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$codigo1 = $array_exibir['nprocesso'];
				$favorecido = $array_exibir['favorecido'];
				$assunto = $array_exibir['assunto'];
				$idprocesso = $array_exibir['idprocesso'];

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
echo "</tr>";


			}}
			
}
?>	  	
</table>
</form>


</center>

</body>
<? include "footer.php" ?>
</HTML>
