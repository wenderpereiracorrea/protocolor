<? 
session_start();
import_request_variables("gP");
include("conexao.php");
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
?>
<HTML>
<HEAD>
<TITLE>Relatório</TITLE>


<link href='styles_print.css' rel='stylesheet' type='text/css'>
<SCRIPT LANGUAGE=JAVASCRIPT>
// Identificação de browser
var isNav4, isNav, isIE;
if (parseInt(navigator.appVersion.charAt(0)) >= 4) {
	isNav = (navigator.appName=="Netscape") ? true : false;
	isIE = (navigator.appName.indexOf("Microsoft") != -1) ? true : false;
}
if (navigator.appName=="Netscape") {
	isNav4 = (parseInt(navigator.appVersion.charAt(0))==4);
}
//funcao de correcao do IE 5.5
function onClickHandler(e){
var el = null;
var flag = true;
el = (isNav) ? e.target.parentNode : event.srcElement;
while (flag && el){
	if ((el.tagName.toUpperCase()=="A")||(el.tagName.toUpperCase()=="AREA")){
		flag = false;
		if (el.protocol.toUpperCase() == "JAVASCRIPT:"){
			eval(unescape(el.href));
		} else return true;
	return false;
	} else {
		el = (isNav) ? el.parentNode : el.parentElement;
	       }
	}
}
document.onclick = onClickHandler;
	
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
<style>
TD { font-family: Verdana;	font-size : 10px; }
PRE { page-break-after: always; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></HEAD>
<BODY leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<TABLE NOWRAP BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%" VALIGN=TOP>
<TR> 
<TD ALIGN="RIGHT" VALIGN="MIDDLE" WIDTH="100%" HEIGHT=21><A HREF="JavaScript:imprimir();"><img src="imagebox/tit_imprimir.gif" width=50 height=20 border=0 Id=cmdImprimir LANGUAGE=javascript onMouseOver="cmdImprimir.src = 'imagebox/tit_imprimir_off.gif';" onMouseOut="cmdImprimir.src = 'imagebox/tit_imprimir.gif';"></A><img src="imagebox/xa.gif" ID=XIS width=15 height=21 border="0" LANGUAGE=javascript></A><A HREF="javascript:Voltar();"><img src="imagebox/tit_fechar.gif" width=50 height=20 border=0 Id=cmdfechar LANGUAGE=javascript onMouseOver="cmdfechar.src = 'imagebox/tit_fechar_off.gif';" onMouseOut="cmdfechar.src = 'imagebox/tit_fechar.gif';"></A>
</TD>
</TR>
</TABLE>
<FONT face="Verdana, Arial, Helvetica, sans-serif" size=1><? echo $date ?><BR><? echo $hora ?><BR></FONT>
<p><br><br>
<?
$sql="select * from setor where setor = '".$_GET[setor_usuario]."'";
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
$process = mysql_query($sql) or die("Erro: " . mysql_error());
$line = mysql_fetch_array($process);
$genero = $line['genero'];
$setorimp = $line['setor'];
$descimp = $line['descricao'];
$sql="select * from setor where setor = '".$_GET[destino]."'";
$process = mysql_query($sql) or die("Erro: " . mysql_error());
$line = mysql_fetch_array($process);
$destinoimp = $line['setor'];
$destinodescimp = $line['descricao'];
$sql="select MAX(despacho) as despacho from circulacao where nprocesso = '".$nprocesso."'";
$process = mysql_query($sql) or die("Erro: " . mysql_error());
$line = mysql_fetch_array($process);
$despachoimp = $line['despacho'];
?>	
<TABLE border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#000000" width="611">
<TR>
<TD width="425">
<TABLE align="center"><TD width="94%" height="30"><IMG height="44" src="imagebox/funarte.gif" align="middle" />
</TD>
</TABLE>
</TD>
<TD width="171" colspan="2" align="center"><font size="2"><STRONG><? echo $setorimp;?></STRONG>  <br />
    </font>
</TD>
</TABLE><br><br><br><br>
<TABLE border="0" cellspacing="0" cellpadding="0" align="center" bordercolor="#000000" width="611">
<TR><TD colspan="6"><font size="3"><b>Ref Processo: <? echo $nprocesso; ?></b></font>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>

<? if ($genero == "f") { ?>
<TR><TD><font size="3">À</font></TD></TR>
<? } ?>

<? if ($genero == "m") { ?>
<TR><TD><font size="3">Ao</font></TD></TR>
<? } ?>

<TR><TD><font size="3"><b><? echo $destinodescimp; ?></b></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><font size="3">Prezados Senhores:</font></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><font size="3">Encaminhamos o processo acima referenciado a este setor para as seguintes providências:</font></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><font size="3"><center><font size="3"><b><? echo ucwords($despachoimp); ?></b></font></center></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><font size="3">Atenciosamente,</font></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><center>__________________________________________________________________</center></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<TR><TD><font size="3"><center><? echo $setorimp; ?></center></font></TD></TR>

<TR><TD>&nbsp;</TD></TR>
<TR><TD>&nbsp;</TD></TR>
</TABLE>
<BR />
</BODY>
<SCRIPT LANGUAGE="JavaScript">
	window.onload = Tamanho;
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
	function Voltar() {
		window.location.href = 'corpo_do_sistema.php';
		
	}	
</SCRIPT>
</HTML>
