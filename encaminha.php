<? 
error_reporting(0);
session_start();
import_request_variables("gP");
include "conexao.php";
include "valida_user.php";
connect();
/*if ($setor_usuario<>'PROTOCOLO') {
	$sql="select * from processo P,circulacao C where";
	$sql = $sql." P.nprocesso = C.nprocesso";
	$sql = $sql." and C.destino = '".$setor_usuario."'";
	//$sql = $sql." and C.observacao = 'EM TR�NSITO'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0) 
	{	
?>		<script>alert('N�o h� processos no <? echo $setor_usuario; ?> para encaminhamento!');history.back();</script><?
	}
}*/
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<br><br><br><br><br><br>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;ENCAMINHAMENTO DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form action="encaminha.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >
<?
//****************************************************************************************
//****************************************************************************************
//*************************** BUSCA DA PESQUISA POR N� COMPLETO **************************
//****************************************************************************************
//****************************************************************************************
if ($processocom!="") 
{
	$fase = "Pesquisa";
	$up = substr($processocom,0,5);
	$processo = substr($processocom,6,6);
	$ano = substr($processocom,13,4);
	$caracter1 = substr($processocom,0,1);
	if (strlen($processocom) < 17) // Verifica se o n� do processo est� completo
	{ 
?>
		<script>
			alert('ERRO\nN�o foram digitados todos os n�meros.\nVerifique:\nUP (5 n�meros).Ex.: 01530\nPROCESSO (6 n�meros).Ex.: 000123\nANO(4 n�meros).Ex.:2006\n\nVoc� digitou: <? echo($up); ?><? echo($processo); ?><? echo($ano); ?>');
		</script>
<?	
		$processocom = "";
?>		<script>
			document.form.submit();
		</script>
<?
	} 
	if (strlen($processocom) == 17 && $caracter1!=0) // verifica n� da UP
	{ 
?>
		<script> 
			alert('ERRO\nO n�mero da UP deve come�ar com 0.\nVoc� digitou <? echo ($caracter1); ?>!'); 
		</script>
<?
		$processocom = ""; 
?>		<script>
			document.form.submit();
		</script>
<?
	} 
	if (strlen($processocom) == 17 && $ano > 2020) // verifica ano maior que 2008
	{ 
?>
		<script> 
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n N�o chegamos l� ainda!'); 
		</script>
<?		$processocom = ""; 
?>		<script>
			document.form.submit();
		</script>
<?
	} 
	if (strlen($processocom) == 17 && $ano < 1950) // verifica ano menor que 1950 
	{ 
?>		<script> 
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Voc� n�o tinha nem nascido ainda!'); 
		</script>
<?		$processocom = ""; 				
?>		<script>
			document.form.submit();
		</script>
<?
	}
}
if ($processocom!="") 
{
	$sqlquery="select * from processo where left(nprocesso,17) = '".$processocom."'";
	if ($setorsolicita!="") 
	{
		$sqlquery = $sqlquery."  and setorsolicitante = '".$setorsolicita."'";
	}
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)
	{	
?>		<script>
<? 		if ($setorsolicita=="") 
		{ 
?>			alert('O processo de n� <? echo $up; ?>.<? echo $processo; ?>/<? echo $ano; ?> n�o est� registrado em nosso banco de dados!')
<?		} else {
?>			alert('O processo de n� <? echo $up; ?>.<? echo $processo; ?>/<? echo $ano; ?>, do setor <? echo $setorsolicita; ?>, n�o est� registrado em nosso banco de dados!')
<?		}
?>		window.location.href='pesquisa.php?$processocom=""';
		</script>
<?
	}        
	if (mysql_num_rows($process) > 0) 
	{ 
		$line = mysql_fetch_array($process);
		$idprocesso = $line['idprocesso'];
		?><script>window.location.href='mostra_processo.php?idprocesso=<? echo $idprocesso; ?>';</script><?	
	}
}
//****************************************************************************************
//****************************************************************************************
//******************** FIM DE BUSCA DA PESQUISA POR N� COMPLETO **************************
//****************************************************************************************
//****************************************************************************************


//****************************************************************************************
//****************************************************************************************
//*************************** BUSCA DA PESQUISA POR N� PARCIAL ***************************
//****************************************************************************************
//****************************************************************************************
if ($processored!="") 
{
	if (strlen($processored) < 6)
	{
?>		<script language="javascript">
			alert('ERRO\nN�o foram digitados todos os n�meros.\nVerifique:\nPROCESSO (6 n�meros).Ex.: 000123\nVoc� digitou: <? echo($processored); ?>');
		</script><?
		$processored = "";
	} 
}
if ($processored!="") 
{
	$sqlquery="select * from processo where  processo = '".$processored."'";
	if ($setorsolicita!="" && $setorsolicita!="TODOS") 
	{
		$sqlquery = $sqlquery."  and setorsolicitante = '".$setorsolicita."'";
	}
	$sqlquery=$sqlquery." order by ano desc";
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)  
	{
?>		<script>
<?		if ($setorsolicita=="") 
		{
?>			alert(' N�o h� registros de processos com o n� <? echo $processored; ?> em nosso banco de dados!')
<?		} else {
?>			alert(' N�o h� registros de processos com o n� <? echo $processored; ?>, do setor <? echo $setorsolicita; ?>, em nosso banco de dados!')
<?		}
?>		window.location.href='pesquisa.php';
		</script>
<?	}
	if (mysql_num_rows($process) == 1) 
	{ 
		$line = mysql_fetch_array($process);
		$idprocesso = $line['idprocesso'];
		?><script>window.location.href='mostra_processo.php?modo=parc&idprocesso=<? echo $idprocesso; ?>&tipo=encaminha';</script><?	
	}
	if (mysql_num_rows($process) > 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=parc&idprocesso=<? echo $processored; ?>&tipo=encaminha';</script><?	
	} 
}	  
//****************************************************************************************
//****************************************************************************************
//*************************** FIM DE BUSCA DA PESQUISA POR N� PARCIAL ********************
//****************************************************************************************
//****************************************************************************************



 //******************** IN�CIO DE PREENCHIMENTO DE DADOS PARA PESQUISA ******************************
if (!isset($processocom) &&  !isset($processored) && !isset($pchave))
{
?>
	<table align="center" width="50%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" colspan="10" class="caixaazul"><center>Digite o n� completo do processo. Ex.: 01530.000439/2006 (15 n�meros)</center></td>
		</tr>
		<tr>
        	<td>&nbsp;</td>
        </tr>
		<tr align='center'> 
			<td><div align="center">Processo:&nbsp;&nbsp;
<? 	if ($_SESSION['perfil']!=1) 
	{ 
?>            
				<input name="processocom"  id="processocom" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" type="text"  size="18" maxlength="17" 
				 onChange="document.form.avancar.style.visibility='visible';document.form.avancar.focus();" 
                 onKeyPress="javascript:formatar(this,'#####.######/####');SoNumero();document.form.processored.value='';" 
				onkeyup='Mostra(this, 17)'></div>
<? 	} else { 

				if ($_SESSION['setor_usuario']=='SETOR DE PROTOCOLO')
				{
?>					<input name="processocom" type="text" id="processocom" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="18" maxlength="17" 
					 onChange="document.form.avancar.style.visibility='visible';document.form.avancar.focus();" 
    	             onKeyPress="javascript:formatar(this,'#####.######/####');SoNumero();document.form.processored.value='';" 
					onkeyup='Mostra(this, 17)'></div>
<?				} else {                    
?>					<input name="processocom" type="text" id="processocom" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="18" maxlength="17" 
					 onChange="document.form.avancar.style.visibility='visible';document.form.avancar.focus();" 
    	             onKeyPress="javascript:formatar(this,'#####.######/####');SoNumero();document.form.processored.value='';" 
					onkeyup='Mostra(this, 17)'></div>
<?				}
	} 
?>
			</td>
		</tr>
		<tr>
        	<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center" colspan="10" class="caixaazul"><center>Se n�o souber, digite ao menos o n� do processo. Ex.: 000439(6 n�meros)</center></td>
		</tr>
		<tr>
        	<td>&nbsp;</td>
        </tr>
		<tr align='center'> 
			<td><div align="center">Processo:&nbsp;&nbsp;
<?	if ($_SESSION['perfil']!=1) 
	{
?>
				<input name="processored" type="text" id="processored" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="6" maxlength="6" 
                onChange="document.form.avancar.focus();" 
                onKeyPress="document.form.avancar.style.visibility='visible';javascript:document.form.processocom.value='';"  
                onkeyup='Mostra(this, 6)' ></div>
<?	} else {
				if ($_SESSION['setor_usuario']=='SETOR DE PROTOCOLO')
				{
?>		            <input name="processored" type="text" id="processored" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="6" maxlength="6" 
        	        onChange="document.form.avancar.focus();" 
            	    onKeyPress="document.form.avancar.style.visibility='visible';javascript:document.form.processocom.value='';"  
                	onkeyup='Mostra(this, 6)' ></div>
<?				} else {
?>		            <input name="processored" type="text" id="processored" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="6" maxlength="6" 
        	        onChange="document.form.avancar.focus();" 
            	    onKeyPress="document.form.avancar.style.visibility='visible';javascript:document.form.processocom.value='';"  
                	onkeyup='Mostra(this, 6)' ></div>                 
<? 				}
	}
?>

			</td>
		</tr>
			<script>
				document.form.processocom.focus();
			</script>
 			<script>
				function lista_setor() 
				{
					window.location.href='lista_processo.php?lista_setor=<? echo $setor_usuario; ?>';
            	}
            </script>
<?
}
?>
	</table>
<? //******************** FIM DE PREENCHIMENTO DE DADOS PARA PESQUISA ****************************** ?>

<? // *****************  BOT�ES  *********************  ?>
<CENTER><BR>
<?
if ($processocom=="" && $processored=="" && $pchave=="" && $setorsolicita=="") 
{
?>	<input type="button" onClick="javascript: form.submit();" name="avancar" class="botao" id="avancar" value="AVAN�AR" alt="Avan�ar">
<?
}
?>
	<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">

	<? // *****************  FIM DE BOT�ES  *********************  ?>

<? if (!isset($processocom)) { ?>	
	<script>document.form.avancar.style.visibility='hidden'; </script>
<? } ?>	
</CENTER>
 </form>
</HEAD>
</HTML>
