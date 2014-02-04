<? import_request_variables("gP"); ?>
<? 
@session_start();
include "conexao.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<br><br>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;PESQUISA DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form action="pesquisa.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >
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
	$processo = substr($processocom,5,6);
	$ano = substr($processocom,11,4);
	$caracter1 = substr($processocom,0,1);
	$processocomzzz = $up.".".$processo."/".$ano;
	/*if (strlen($processocom) < 17) // Verifica se o nº do processo está completo
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
	} */
	/*if (strlen($processocom) == 17 && $caracter1!=0) // verifica nº da UP
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
	if (strlen($processocom) == 17 && $ano > 2030) // verifica ano maior que 2030
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
	} */
	 /*if (strlen($processocom) == 17 && $ano < 1950) // verifica ano menor que 1950 
	{ 
?>		<script> 
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Você não tinha nem nascido ainda!'); 
		</script>
<?		$processocom = ""; 				
?>		<script>
			document.form.submit();
		</script>
<?
	} */
}
if ($processocom!="") 
{
	//$sqlquery="select * from processo where left(nprocesso,17) like '".$processocom."'";
	$sqlquery="select * from processo where nprocesso like '%".$processocomzzz."%'";
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
		$nprocesso = $line['nprocesso'];
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION["nome"]."','Pesquisou o processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);	
		?><script>window.location.href='mostra_processo.php?modo=comp&idprocesso=<? echo $idprocesso; ?>';</script><?	
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
if ($processored!="" and $processoano=="") 
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
		$nprocesso = $line['nprocesso'];
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou o processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);	
	
	
		?><script>window.location.href='mostra_processo.php?modo=parc&idprocesso=<? echo $idprocesso; ?>';</script><?	
	}
	if (mysql_num_rows($process) > 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=parc&idprocesso=<? echo $processored; ?>&ano=<? echo $processoano; ?>';</script><?	
	} 
}	  


//PESQUISA Nº PARCIAL COM ANO ************************
if ($processored=="" and $processoano !="") {
?>
<script>alert('Digite o número do processo, pois a pesquisa somente pelo ano geraria um resultado com muitos registros!');
window.location.href='pesquisa.php';</script>
<?
}

if ($processored!=""  and $processoano !="") 
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
	$sqlquery="select * from processo where nprocesso like '%".$processored."%' and nprocesso like '%".$processoano."%'";
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
		$nprocesso = $line['nprocesso'];
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou o processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);	
	
	
		?><script>window.location.href='mostra_processo.php?modo=parc&idprocesso=<? echo $idprocesso; ?>';</script><?	
	}
	if (mysql_num_rows($process) > 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=parc&idprocesso=<? echo $processored; ?>&ano=<? echo $processoano; ?>';</script><?	
	} 
}	  
//****************************************************************************************
//****************************************************************************************
//*************************** FIM DE BUSCA DA PESQUISA POR Nº PARCIAL ********************
//****************************************************************************************
//****************************************************************************************


//****************************************************************************************
//****************************************************************************************
//*************************** BUSCA DA PESQUISA POR PALAVRA CHAVE ************************
//****************************************************************************************
//****************************************************************************************
if ($pchave!="" and $processoano2 == "") 
{
 	$sql="select * from processo where";
	$sql=$sql." (assunto like '%$pchave%'";
	$sql=$sql." or favorecido like '%$pchave%')";
	if ($setorsolicita!="" && $setorsolicita!="TODOS") 
	{
		$sql = $sql."  and setorsolicitante = '".$setorsolicita."'";
	}
	$sql=$sql." order by ano desc";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)  
	{
?>
			<?
	}
	if (mysql_num_rows($process) == 1) 
	{ 
		$line = mysql_fetch_array($process);
		$idprocesso = $line['idprocesso'];
?>		<script>window.location.href='mostra_processo.php?modo=chave&idprocesso=<? echo $pchave; ?>';</script>
<?	}
	if (mysql_num_rows($process) > 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=chave&idprocesso=<? echo $pchave; ?>';</script><?	
	}		
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou processos com a palavra ".$pchave."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);			
}

// ************************* ANO DIGITADO
if ($pchave!="" and $processoano2 != "") 
{
 	$sql="select * from processo where";
	$sql=$sql." (assunto like '%$pchave%'";
	$sql=$sql." or favorecido like '%$pchave%') and nprocesso like '_____________".$processoano2."%'";
	if ($setorsolicita!="" && $setorsolicita!="TODOS") 
	{
		$sql = $sql."  and setorsolicitante = '".$setorsolicita."'";
	}
	$sql=$sql." order by ano desc";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)  
	{
?>
			<?
	}
	/*if (mysql_num_rows($process) >= 1) 
	{ 
		$line = mysql_fetch_array($process);
		$idprocesso = $line['idprocesso'];
?>		<script>window.location.href='mostra_processo.php?modo=chave&idprocesso=<? echo $pchave; ?>';</script>
<?	}*/
	if (mysql_num_rows($process) >= 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=chave&idprocesso=<? echo $pchave; ?>&ano=<? echo $processoano2; ?>';</script><?	
	}		
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou processos com a palavra ".$pchave."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);			
}

// ************************* PROCESSO EXTERNO
if ($_POST[processo_externo]!="") 
{
 	$sql="select * from processo where";
	$sql=$sql." nprocesso like '%".$_POST[processo_externo]."%'";
//	$sql=$sql." or favorecido like '%$pchave%') and nprocesso like '_____________".$processoano2."%'";
	$sql=$sql." order by ano desc";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)  
	{
?>
		<script>
<?			if ($setorsolicita=="") 
			{
?>				alert(' Não há registros de processos com este número em nosso banco de dados!')
<?			} else {
?>				alert(' Não há registros de processos com este número em nosso banco de dados!')
<?			}
?>			window.location.href='pesquisa.php';
		</script>
			<?
	}
	if (mysql_num_rows($process) >= 1) 
	{ 
		$line = mysql_fetch_array($process);
		$idprocesso = $line['idprocesso'];
	}
	
	if (mysql_num_rows($process) >= 1) 
	{ 
		?><script>window.location.href='lista_processo.php?modo=Externo&idprocesso=<? echo $_POST[processo_externo]; ?>&ano=<? echo $processoano2; ?>';</script><?	
	}		
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou processos com a palavra ".$pchave."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);			
}
//****************************************************************************************
//****************************************************************************************
//*************************** FIM DE BUSCA DA PESQUISA POR Nº PARCIAL ********************
//****************************************************************************************
//****************************************************************************************

//****************************************************************************************
//****************************************************************************************
//*************************** INÍCIO DE PESQUISA POR SETOR *******************************
//****************************************************************************************
//****************************************************************************************
if ($setorsolicita!=""  && $setorsolicita!="TODOS") 
{	if ($setorsolicita=='PROTOCOLO')
	{
		$sql="select * from processo P,";
	 	$sql = $sql." circulacao C";
 		$sql = $sql." where  P.nprocesso = C.nprocesso";
	 	//$sql = $sql." and C.origem = 'PROTOCOLO'";
		$sql = $sql." and P.localizacao = 'PROTOCOLO'";
	 	//$sql = $sql." and (isnull(C.destino) or C.destino = 'PROTOCOLO')";
	 	//$sql = $sql." and isnull(C.observacao)";
	 	$sql = $sql." order by ano desc, C.nprocesso desc";
	} else {
	 	$sql="select * from processo P,";
		$sql = $sql." circulacao C";
		$sql = $sql." where P.nprocesso = C.nprocesso";
		//$sql = $sql." and C.destino = '".$setorsolicita."'";
		$sql = $sql." and P.localizacao = '".$setorsolicita."'";
		//$sql = $sql." and C.observacao <> 'TRANSFERIDO'";
		$sql=$sql." order by ano desc, C.nprocesso desc";
	} 
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) == 0)  
	{
?>		<script>
			alert(' Não há registros de processos no setor <? echo $setorsolicita; ?> em nosso banco de dados!')
			window.location.href='pesquisa.php';
			//document.form.setorsolicita.focus();
		</script>
<?	}
	if (mysql_num_rows($process) == 1) 
	{ 
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou os processos do setor ".$setorsolicita."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);			

?>		<script>window.location.href='lista_processo.php?setorsolicita=<? echo $setorsolicita; ?>';</script>
<?	}
	if (mysql_num_rows($process) > 1) 
	{ 
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou os processos do setor ".$setorsolicita."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);		
?>		<script>window.location.href="lista_processo.php?modo='setor'&setorsolicita=<? echo $setorsolicita; ?>";</script>
<?	}
}
if ($setorsolicita!=""  && $setorsolicita=="TODOS") 
{
		$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou os processos em todos os setores','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);	
?>
	<script>window.location.href="lista_processo.php?setorsolicita=<? echo $setorsolicita; ?>&idprocesso=<? echo $idprocesso; ?>";</script>
<?
}
//****************************************************************************************
//****************************************************************************************
//*************************** FIM DE PESQUISA POR SETOR **********************************
//****************************************************************************************
//****************************************************************************************



 //******************** INÍCIO DE PREENCHIMENTO DE DADOS PARA PESQUISA ******************************
if (!isset($processocom) &&  !isset($processored) && !isset($pchave))
{
?>
	<table align="center" width="50%" cellpadding="0" cellspacing="0">


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
				<input name="processored" id="processored" type="text" class="cor-inativa" size="6" maxlength="6"  onFocus="Focus(this);"
                onKeyPress="if(this.value.length=6){document.form.pesquisar.style.visibility='visible'};SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};" onBlur="Blur(this);">
				
				&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano" id="processoano" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};" onFocus="Focus(this);" onBlur="Blur(this);">
				</div>
				
<?	} else {
				if ($_SESSION['setor_usuario']=='PROTOCOLO')
				{
?>		            <input name="processored" id="processored" type="text" class="cor-inativa" size="6" maxlength="6" 
            	    onKeyPress="if(this.value.length=6){document.form.pesquisar.style.visibility='visible'};SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};document.form.setorsolicita.value='';if (event.keyCode==13)document.form.setorsolicita.focus();"  onFocus="Focus(this);" onBlur="Blur(this);">

					&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano" id="processoano" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};" onFocus="Focus(this);" onBlur="Blur(this);">
					</div>

					</div>
<?				} else {
?>		            <input name="processored" id="processored" type="text" class="cor-inativa" size="6" maxlength="6" 
            	    onKeyPress="if(this.value.length=6){document.form.pesquisar.style.visibility='visible'};SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};"  onFocus="Focus(this);" onBlur="Blur(this);">

					&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano" id="processoano" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';if (document.form.pchave=true) {document.form.pchave.value=''};" onFocus="Focus(this);" onBlur="Blur(this);">
				</div>

					</div>                 
<? 				}
	}
?>

			</td>
		</tr>
		<tr>
        	<td>&nbsp;</td>
        </tr>
<?	if ($_SESSION['perfil'] < 4)
	{ 
?>		<tr><td align="center" colspan="10" class="caixaazul"><center>Se não tiver o nº do processo, digite uma palavra chave. Ex.: licitação (20 caracteres)</center></td></tr>	
		<tr><td>&nbsp;</td></tr>
		<tr align='center'><td><div align="center">Palavra chave:&nbsp;&nbsp;
<?		if ($_SESSION['perfil']!=1) 
		{
?>		<input name="pchave" id="pchave" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" type="text" size="18" maxlength="20" 
		onKeyPress="javascript:document.form.processocom.value='';document.form.processored.value='';document.form.pesquisar.style.visibility='visible';">
		
					&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano2" id="processoano2" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';" onFocus="Focus(this);" onBlur="Blur(this);">

<?		} else {
		if ($_SESSION['setor_usuario']=='PROTOCOLO')
			{
?>				<input name="pchave" id="pchave" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" 
				type="text" size="18" maxlength="20" 
    	        onKeyPress="if (event.keyCode==13)document.form.setorsolicita.focus();javascript:document.form.processocom.value='';document.form.processored.value='';document.form.setorsolicita.value='';document.form.pesquisar.style.visibility='visible';">

					&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano2" id="processoano2" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';" onFocus="Focus(this);" onBlur="Blur(this);">

<?			} else {
?> 				<input name="pchave"  id="pchave" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" type="text" size="18" maxlength="20" 
    	        onKeyPress="if (event.keyCode==13)document.form.setorsolicita.focus();javascript:document.form.processocom.value='';document.form.processored.value='';document.form.pesquisar.style.visibility='visible';">


					&nbsp;&nbsp;Ano:&nbsp;&nbsp;<input name="processoano2" id="processoano2" type="text" class="cor-inativa" size="4" maxlength="4" onKeyPress="SoNumero();javascript:document.form.processocom.value='';" onFocus="Focus(this);" onBlur="Blur(this);">
<?			}
		}
	} 
?> 		</div><br></td></tr>



		<tr>
			<td align="center" colspan="10" class="caixaazul"><center>Processo (Digite parte o número ou parte dele) <!--(15 números)--></center></td>
		</tr>
		<tr align='center'> 
			<td><br>
			<div align="center">Processo (parte do n&uacute;mero):&nbsp;&nbsp;
		      <input name="processo_externo" id="processo_externo" type="text" class="cor-inativa" size="10" maxlength="20"  onFocus="Focus(this);" onBlur="Blur(this);">
				
				</div><br>
</td></tr>

		<tr><td>&nbsp;</td></tr>
		<tr>
        	<td>&nbsp;</td>
        </tr>
<? 		if ($_SESSION['perfil']==1 && $_SESSION['setor_usuario']=='PROTOCOLO')
	    {
?>			<tr align='center'> 
				<td><div align="center">Setor:&nbsp;&nbsp;
                	<select name='setorsolicita' class='caixa' onChange="document.form.pesquisar.style.visibility='visible';document.form.pesquisar.focus();" >
<?					$sqlquery = "select * from setor";
					$sqlquery = $sqlquery." order by setor";
					$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if (mysql_num_rows($process) > 0) 
					{
						if ($setorsolicita=="") 
						{
							echo "<option value=''>Selecione o setor</option>\n";
							if ($perfil==1) 
							{
								echo "<option value='TODOS'>TODOS</option>\n";
							}
							while ($line = mysql_fetch_array($process)) 
							{
								$setor = $line['setor'];
								$descricao = $line['descricao'];
								$endereco = $line['endereco'];
								$telefone = $line['telefone'];
								echo "<option value='$setor'>$setor</option>\n";														
							}
						}
						/*if ($documento!="") 
						{
							echo "<option value='$setorsolicita'>$setorsolicitante</option>\n";
							while ($line = mysql_fetch_array($process)) 
							{
								$setor = $line['setor'];
								$descricao = $line['descricao'];
								$endereco = $line['endereco'];
								$telefone = $line['telefone'];
								echo "<option value='$setor'>$setor</option>\n";														
							}
						}mysql_free_result($process);					
					*/}
?>					</select></div>
				</td>
			</tr>
<?		} 
		if (($_SESSION['perfil']==1 && $_SESSION['setor_usuario']!='PROTOCOLO') || $_SESSION['perfil']==2 || $_SESSION['perfil']==3) 
		{
?>
			<td align="center"><center></center></td>
<?		}
?>
			<tr>
       			<td>&nbsp;</td>
       		</tr>
			<script>
				document.form.processored.focus();
			</script>
 			<script>
				function lista_setor() 
				{
					window.location.href='lista_processo.php?lista_setor=<? echo $setor_usuario; ?>&tipo=pesquisa';
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
?>	<input type="button" onClick="javascript: form.submit();" name="pesquisar" class="botao" id="pesquisar" value="PESQUISAR" alt="Pesquisar">
<?
}
?>

	<? // *****************  FIM DE BOTÕES  *********************  ?>

<? /*if (!isset($processocom)) { ?>	
	<script>document.form.pesquisar.style.visibility='hidden'; </script>
<? } */ ?>	
</CENTER>
 </form>
</HEAD>
</HTML>
