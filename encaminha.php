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
	//$sql = $sql." and C.observacao = 'EM TRÂNSITO'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0) 
	{	
?>		<script>alert('Não há processos no <? echo $setor_usuario; ?> para encaminhamento!');history.back();</script><?
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
//*************************** BUSCA DA PESQUISA POR Nº COMPLETO **************************
//****************************************************************************************
//****************************************************************************************
if ($processocom!="") 
{
	$fase = "Pesquisa";
	$up = substr($processocom,0,5);
	$processo = substr($processocom,6,6);
	$ano = substr($processocom,13,4);
	$caracter1 = substr($processocom,0,1);
	if (strlen($processocom) < 17) // Verifica se o nº do processo está completo
	{ 
?>
		<script>
			alert('ERRO\nNão foram digitados todos os números.\nVerifique:\nUP (5 números).Ex.: 01530\nPROCESSO (6 números).Ex.: 000123\nANO(4 números).Ex.:2006\n\nVocê digitou: <? echo($up); ?><? echo($processo); ?><? echo($ano); ?>');
		</script>
<?	
		$processocom = "";
?>		<script>
			document.form.submit();
		</script>
<?
	} 
	if (strlen($processocom) == 17 && $caracter1!=0) // verifica nº da UP
	{ 
?>
		<script> 
			alert('ERRO\nO número da UP deve começar com 0.\nVocê digitou <? echo ($caracter1); ?>!'); 
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
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Não chegamos lá ainda!'); 
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
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Você não tinha nem nascido ainda!'); 
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
?>			alert('O processo de nº <? echo $up; ?>.<? echo $processo; ?>/<? echo $ano; ?> não está registrado em nosso banco de dados!')
<?		} else {
?>			alert('O processo de nº <? echo $up; ?>.<? echo $processo; ?>/<? echo $ano; ?>, do setor <? echo $setorsolicita; ?>, não está registrado em nosso banco de dados!')
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
//******************** FIM DE BUSCA DA PESQUISA POR Nº COMPLETO **************************
//****************************************************************************************
//****************************************************************************************


//****************************************************************************************
//****************************************************************************************
//*************************** BUSCA DA PESQUISA POR Nº PARCIAL ***************************
//****************************************************************************************
//****************************************************************************************
if ($processored!="") 
{
	if (strlen($processored) < 6)
	{
?>		<script language="javascript">
			alert('ERRO\nNão foram digitados todos os números.\nVerifique:\nPROCESSO (6 números).Ex.: 000123\nVocê digitou: <? echo($processored); ?>');
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
?>			alert(' Não há registros de processos com o nº <? echo $processored; ?> em nosso banco de dados!')
<?		} else {
?>			alert(' Não há registros de processos com o nº <? echo $processored; ?>, do setor <? echo $setorsolicita; ?>, em nosso banco de dados!')
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
//*************************** FIM DE BUSCA DA PESQUISA POR Nº PARCIAL ********************
//****************************************************************************************
//****************************************************************************************



 //******************** INÍCIO DE PREENCHIMENTO DE DADOS PARA PESQUISA ******************************
if (!isset($processocom) &&  !isset($processored) && !isset($pchave))
{
?>
	<table align="center" width="50%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" colspan="10" class="caixaazul"><center>Digite o nº completo do processo. Ex.: 01530.000439/2006 (15 números)</center></td>
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
			<td align="center" colspan="10" class="caixaazul"><center>Se não souber, digite ao menos o nº do processo. Ex.: 000439(6 números)</center></td>
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

<? // *****************  BOTÕES  *********************  ?>
<CENTER><BR>
<?
if ($processocom=="" && $processored=="" && $pchave=="" && $setorsolicita=="") 
{
?>	<input type="button" onClick="javascript: form.submit();" name="avancar" class="botao" id="avancar" value="AVANÇAR" alt="Avançar">
<?
}
?>
	<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">

	<? // *****************  FIM DE BOTÕES  *********************  ?>

<? if (!isset($processocom)) { ?>	
	<script>document.form.avancar.style.visibility='hidden'; </script>
<? } ?>	
</CENTER>
 </form>
</HEAD>
<? include "footer.php" ?>
</HTML>
