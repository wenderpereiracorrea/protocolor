<? 
import_request_variables("gP");
session_start();
include "conexao.php";
connect();
if ($nprocesso!="") 
	{ 	
	 	$sql="select * from processo where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro1: " . mysql_error());	
		$sql2="select date_format(dataent, '%d/%m/%Y') from processo where nprocesso = '".$nprocesso."'";
		$data = mysql_query($sql2) or die("Erro1: " . mysql_error());
		$data =  mysql_fetch_row($data);
		if (mysql_num_rows($process) > 0) 
			{ 
				$line = mysql_fetch_array($process);
				$numero = $line['numero'];
				$up = $line['up'];
				$nprocesso = $line['nprocesso'];
				$ano = $line['ano'];
				$dv = $line['dv'];
				$favorecido = $line['favorecido'];
				$assunto = $line['assunto'];
				$anexos = $line['anexos'];
				$volumes = $line['volumes'];
				$refprocesso = $up.".".$nprocesso."/".$ano."-".$dv;
							 
			} 
 	} 
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="date-picker.js"></script>
<SCRIPT LANGUAGE=JAVASCRIPT>
function imprimir()
	{
		window.print();
	}
function Tamanho()
	{
		top.moveTo(0,0);
		top.resizeTo(screen.width,screen.height);
	}
</SCRIPT>
<body>
<style>
TD { font-family: Verdana;	font-size : 10px; }
PRE { page-break-after: always; }
</style>

<style type="text/css" media="print">
#nao_imprimir {
	display:none;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></HEAD>
<TABLE NOWRAP BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="60%" VALIGN=TOP>
<!--TR> 
<td>&nbsp;</td><TD ALIGN="RIGHT" VALIGN="MIDDLE" WIDTH="100%" HEIGHT=21><a href="sucesso.php" onclick="w = window.open(this.href);w.print();w.close();return false;"><img src="imagebox/tit_imprimir.gif" width=50 height=20 border=0 Id=cmdImprimir LANGUAGE=javascript onMouseOver="cmdImprimir.src = 'imagebox/tit_imprimir_off.gif';" onMouseOut="cmdImprimir.src = 'imagebox/tit_imprimir.gif';"></A><img src="imagebox/xa.gif" ID=XIS width=15 height=21 border="0" LANGUAGE=javascript></A><A HREF="javascript:window.location.href='sucesso.php';"><img src="imagebox/tit_fechar.gif" width=50 height=20 border=0 Id=cmdfechar LANGUAGE=javascript onMouseOver="cmdfechar.src = 'imagebox/tit_fechar_off.gif';" onMouseOut="cmdfechar.src = 'imagebox/tit_fechar.gif';"></A>
</TD>
</TR-->
</TABLE>
<!-- Etiqueta 1-->
<table border="0" cellspacing="0" cellpadding="0" bordercolor="#000000" width="97%">
  
  <tr>
    <td width="10">&nbsp;</td>
    <td width="690"><b><font size="3">PROC. Nº.: <? echo($nprocesso); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo($data[0]); ?></font></b></td>
  </tr>
  <td>&nbsp;</td>
  
  <tr>
    <td>&nbsp;</td>
    <td><b><font size="2">INTERESSADO: </b> &nbsp <? echo($favorecido); ?> </font> </td>
  </tr>
  <td>&nbsp;</td>
  <tr>
    <td>&nbsp;</td>
    <td><b><font size="2">ASSUNTO: </font></b> &nbsp <? echo($assunto); ?>   </td>
  </tr>
  <td>&nbsp;</td>
  <tr>
    <td>&nbsp;</td>
    <td><b><font size="2">ANEXO: &nbsp </font></b> <? echo($anexos); ?>   </td>
  </tr>
    <td>&nbsp;</td>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<center><input type="button" onClick="window.print();" value="Imprimir" id="nao_imprimir" /> </center>
</BODY>
<SCRIPT LANGUAGE="JavaScript">
//	window.onload = Tamanho;
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	function Voltar() {
		window.location.href = 'pesquisa_capa_processo.php?modo=capa';
	}	
window.print();
</SCRIPT>
</HEAD>
</HTML>
