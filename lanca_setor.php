<? 
session_start();
include "conexao.php";
include "valida_user.php";
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
connect();
if ($sigset!="" && $descset!="")
{
	$sql = "select * from setor where setor = '".$sigset."'";
	$sql = $sql." or descricao = '".$descset."'";
	$process = mysql_query($sql);
	include "validaerrobanco.php";    
	if (mysql_num_rows($process) > 0) 
	{
?>		<script>
			alert('O código "<? echo $sigset; ?>" ou a descrição "<? echo $descset; ?>" já estão cadastrados!');window.close();
		</script>
<?
	} else {
			$sqlIns="insert into setor(codigo,setor,descricao)";
			$sqlIns = $sqlIns." values ('".$codigo."','".$sigset."','".ucwords(lower($descset))."')";
			$processIns = mysql_query($sqlIns);
			include "validaerrobanco.php";    
			
?>			<script>send(<? echo $sigset; ?>);
			window.opener.document.calform.novolocal.value=codigo;//window.close();
			</script>
<?
	}
}
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="date-picker.js"></script>
<body>
<BR><BR><BR>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;CADASTRO DE SETOR&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form action="lanca_setor.php" name="form" method="post" target="_self">
<table align="center" width="50%" cellpadding="0" cellspacing="0">
	<tr>
    	<td>&nbsp;</td>
	</tr>
	<tr align='center'> 
		<td><div align="center">Código:&nbsp;&nbsp;
				<input name="codset"  id="codset" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" type="text"  size="5" maxlength="5" 
				 onChange="document.form.sigset.focus();" 
                 onKeyPress="SoNumero();javascript:if (event.keyCode==13) {document.form.sigset.focus(); }" 
				onkeyup='Mostra(this, 5)'></div>
		</td>
	</tr>
	<tr>
    	<td>&nbsp;</td>
	</tr>
	<tr align='center'> 
		<td><div align="center">Sigla:&nbsp;&nbsp;
				<input name="sigset" type="text" id="sigset" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="12" maxlength="12" 
                onChange="document.form.descset.focus();javascript:this.value=this.value.toUpperCase();" 
                onKeyPress="SoTexto();javascript:if (event.keyCode==13) {document.form.descset.focus(); }" 
                onkeyup='' ></div>
		</td>
	</tr>
	<tr>
    	<td>&nbsp;</td>
	</tr>
	<tr align='center'> 
		<td><div align="center">Descrição:&nbsp;&nbsp;
				<input name="descset" type="text" id="descset" class="cor-inativa" 
                onKeyPress="document.form.Gravar.style.visibility='visible';if (event.keyCode==13) {document.form.Gravar.focus(); }"
                onFocus="Focus(this);if (document.form.sigset.value=='') { document.form.sigset.focus();alert('O PREENCHIMENTO DA SIGLA É OBRIGATÓRIO!'); }"
                onChange="javascript:this.value=this.value.toUpperCase();" 
                onBlur="Blur(this);document.form.descset.value = document.form.descset.ucwords();" size="60" maxlength="60"></div>
		</td>
	</tr>    
<script>
	document.form.codset.focus();
</script>
</table>
<br>
<table align="center" cellpadding="0" cellspacing="0"> 
<center>
<input name='Gravar' id="Gravar" type='button' value='GRAVAR' class='botao' onClick="GravaSetor();">&nbsp;&nbsp;<input name='Encerrar' id="Encerrar" type="button" value="ENCERRAR" class="botao" onClick="javascript:window.close();">
</center>
</table>
</form>
<script>
document.form.Gravar.style.visibility="hidden";
document.form.codset.focus();
function lista_setor() 
{
	window.location.href='lista_processo.php?lista_setor=<? echo $setor_usuario; ?>';
}
function GravaSetor() {
	if (confirm('Os dados do novo setor serão gravados.\nTem certeza que deseja continuar?')) 
	{
		form.submit();
	} else {
		window.close();
	}
}
function send(codigo){
	window.opener.document.calform.localatual.value=codigo;
	self.close();
}
</script>