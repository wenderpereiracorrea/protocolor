<?	@session_start();	
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
	if ($modolan==0) {
		$sql = "delete from temp_processo";
		$sql = $sql." where usuario = '".$login."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
	}
	if ($procedencia!="") { $modolan = 2; }
// *****************DISTRIBUIÇÃO DO NÚMERO DE PROCESSO *****************

if ($nprocesso!="" && $tipodoc!=1) 
{ 
	$up = substr($nprocesso,0,5);
	$processo = substr($nprocesso,6,6);
	$ano = substr($nprocesso,13,4);
	$caracter1 = substr($nprocesso,0,1);
	$criaproc = 1;
	
	// ************ CONFERÊNCIA DE NÚMERO DE PROCESSO ***************
	if (strlen($nprocesso) < 17 && $tipodoc!=1) // Verifica se o nº do processo está completo
	{ ?>
		<script language="javascript">
		var frase;
		frase="ERRO\nNão foram digitados todos os números.\n\nVerifique:\nUP (5 números).";
		frase=frase + "Ex.: 01530\nPROCESSO (6 números).Ex.: 000123\nANO(4 números).";
		frase=frase + "Ex.:2006\n\nVocê digitou: <? echo($up); ?><? echo($processo); ?><? echo($ano); ?>";
		alert(frase);
		</script><?
		$nprocesso = ""; //limpa o nº do processo
		$criaproc = 0; 
	} 
	if (strlen($nprocesso) == 17 && $caracter1!=0 && $tipodoc!=1) // verifica nº da UP
	{ ?> 
		<script language="javascript"> 
			alert('ERRO\nO número da UP deve começar com 0.\nVocê digitou <? echo ($caracter1); ?>!'); 
		</script><?
		$nprocesso = "";
		$criaproc = 0;
	} 
	if (strlen($nprocesso) == 17 && $ano > 2009 && $tipodoc!=1) // verifica ano maior que 2008
	{ ?> 
		<script language="javascript"> 
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Não chegamos lá ainda!'); 
		</script><?
		$nprocesso = "";
		$criaproc = 0;
	} 
	if (strlen($nprocesso) == 17 && $ano < 1950 && $tipodoc!=1) // verifica ano menor que 1950 
	{ ?> 
		<script language="javascript"> 
			alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Você não tinha nem nascido ainda!'); 
		</script><?
		$nprocesso = "";
		$criaproc = 0;
	}
	if ($criaproc==1) 
	{
		$sql = "select processo from processo where processo = ".$processo."";
		$sql = $sql." and up = ".$up."";
		$sql = $sql." and ano = '".$ano."'";
		$process = mysql_query($sql) or die("Erro1: " .$sql);
		if (mysql_num_rows($process) > 0) 
		{
			?><script>alert('O Processo nº <? echo $processo ?> já existe!');window.location.href='lanca_processo.php';</script><?
			$criaproc=0;	
		}
		$sql = "select processo from temp_processo where processo = ".$processo."";
		$sql = $sql." and up = ".$up."";
		$sql = $sql." and ano = '".$ano."'";
		$sql = $sql." and usuario <> '".$login."'";
		$process = mysql_query($sql) or die("Erro2: " .$sql);
		if (mysql_num_rows($process) > 0) 
		{
			?><script>alert('O Processo nº <? echo $processo ?> está sendo lançado por outro usuário!');</script><?	
				$nprocesso="";
				$criaproc=0;
				?><script>document.calform.nprocesso.focus();</script><?
		}
	}
	if ($criaproc==1 && $tipodoc!=1)
	{
		$sql = "select processo from temp_processo where processo = ".$processo."";
		$sql = $sql." and up = ".$up."";
		$sql = $sql." and ano = '".$ano."'";
		$process = mysql_query($sql) or die("Erro3: " .$sql);
		if (mysql_num_rows($process) == 0) 
		{
			$sqlIns="insert into temp_processo(nprocesso,up,processo,ano,usuario)";
			$sqlIns = $sqlIns." values ('".$nprocesso."','".$up."','".$processo."',".$ano.",'".$login."')";
			$processIns = mysql_query($sqlIns) or die("Erro4: " . $sqlIns);
			$criaproc=0;
		}
	}
}
if ($nprocesso!="" && $tipodoc==1) { $criaproc = 1; }
if ($criaproc==1 && $tipodoc==1 && $modolan==0)
{	
	$sql = "select nprocesso from temp_processo where nprocesso = '".$nprocesso."'";
	$process = mysql_query($sql) or die("Erro5: " .$sql);
	if (mysql_num_rows($process) == 0) 
	{
		$sqlIns="insert into temp_processo(nprocesso,usuario)";
		$sqlIns = $sqlIns." values ('".$nprocesso."','".$login."')";
		$processIns = mysql_query($sqlIns) or die("Erro6: " . $sqlIns);
		$criaproc=0;
		$modolan=1;
	} else { 
		?><script>alert('O Processo nº <? echo $nprocesso ?> está sendo lançado por outro usuário!');</script><?	
		//$nprocesso="";
		//$criaproc=0;
		?><script>document.calform.nprocesso.focus();</script><?
	}
} 
if ($modo=='GRAVAR') 
{

	$sql="insert into 	
		processo(idprocesso,dataent,nprocesso,up,processo,ano,dv,documento,datadoc,
		numero,procedencia,setorsolicitante,favorecido,cpfcnpj,assunto,anexos,volumes,
		folhas,observacoes)";
	$sql = $sql." values (".$nlancamento.",'".tdate($dataent,0)."','".$nprocesso."','".$up."',
		'".$processo."','".$ano."','".$dv."','".$documento."','".tdate($datadoc,0)."','".$numero."',
		'".$procedencia."','".$setorsolicitante."','".$favorecido."','".$cpf."',
		'".$assunto."','".$anexos."',".$volumes.",".$folhas.",'".$observacoes."')";
	$process = mysql_query($sql) or die("Erro: " . $sql);
	echo "<br>SQL = ".$sql;
	$sql="insert into historico (data,hora,usuario,acao,ip) 
			values ('".$dataenc."','".$horaenc."','".upper($login)."','Inseriu o processo n° ".$nprocesso."','".get_ip()."')";	
	$process = mysql_query($sql) or die("Erro: " . $sql);		
	echo "<br>SQL = ".$sql;
	unset ($nlancamento);unset ($dataent);unset ($nprocesso);unset ($documento);unset ($datadoc);
	unset ($numero);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpf);
	unset ($assunto);unset ($anexos);unset ($volumes);unset ($folhas);unset ($observacoes);
}
if ($folhas!="") 
{ 
	if ($tipodoc==0) {
		$up = substr($nprocesso,0,5);
		$processo = substr($nprocesso,6,6);
		$ano = substr($nprocesso,13,4);
		$dv = substr($nprocesso,18,2);
	}
	$sql="update temp_processo";
	$sql = $sql." set dataent = '".tdate($dataent,0)."'";
	$sql = $sql." ,nprocesso = '".$nprocesso."'";
	$sql = $sql." ,dv = '".$dv."'";
	$sql = $sql." ,documento = '".$documento."'";
	$sql = $sql." ,datadoc = '".tdate($datadoc,0)."'";
	$sql = $sql." ,numero = '".$numero."'";
	$sql = $sql." ,procedencia = '".$procedencia."'";
	$sql = $sql." ,setorsolicitante = '".$setorsolicitante."'";
	$sql = $sql." ,favorecido = '".$favorecido."'";
	$sql = $sql." ,cpfcnpj = '".$cpf."'";
	$sql = $sql." ,assunto = '".$assunto."'";
	$sql = $sql." ,anexos = '".$anexos."'";
	$sql = $sql." ,volumes = '".$volumes."'";
	$sql = $sql." ,folhas = '".$folhas."'";
	$sql = $sql." ,observacoes = '".$observacoes."'";
	$sql = $sql." ,localizacao = '".$localatual."'";
	if ($tipodoc==0) {
		$sql = $sql."  where up = '".$up."'";
		$sql = $sql."  and processo = '".$processo."'";
		$sql = $sql."  and ano = '".$ano."'";
	} else {
		$sql = $sql."  where nprocesso = '".$nprocesso."'";
	}
	$process = mysql_query($sql) or die("Erro8: " . $sql);
}
?>

<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<? if ($modolan==0) { ?>
<form action="lanca_processo.php" method="POST" name="calform" target="_self" onSubmit="javascript:return avaliaproc(this);">
<? } ?>
<? if ($modolan==1) { ?>
<form action="lanca_processo.php" method="POST" name="calform" target="_self" onSubmit="javascript:return avaliaori(this);">
<? } ?>
<? if ($modolan==2) { ?>
<form action="lanca_processo.php" method="POST" name="calform" target="_self" onSubmit="javascript:return avaliadet(this);">
<? } ?>

<p>
  <? //**************************  INÍCIO DA SESSÃO DOCUMENTO DE ORIGEM   *************************  ?>
<?

/*echo "<br>PROCEDENCIA = ".$procedencia;
echo "<br>MODOLAN = ".$modolan;
echo "<br>TIPODOC = ".$tipodoc;
echo "<br>CRIAPROC = ".$criaproc;*/
?>  
</p>
<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul"><center><input name="tipodoc" type="radio" value="0" onClick="submit();" <? if ($tipodoc!=1) { ?>checked<? } ?>>Documento Interno&nbsp;&nbsp;<input name="tipodoc" type="radio" value="1" onClick="calform.submit();" <? if ($tipodoc==1) { ?>checked<? } ?>>Documento Externo</center></td>
	</tr>
</table>
<input type="hidden" name="modolan" value="<? echo $modolan; ?>">    
<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr class="cabeçalho">
		<td colspan="9"><center>PROCESSO</center></td>
	</tr>
	<? 	// ************** Busca o último número de lançamento ******************
		$sql = "select max(idprocesso) as max from processo";
		$process = mysql_query($sql) or die("Erro10: " . mysql_error());
		if (mysql_num_rows($process) > 0) 
		{
			$line = mysql_fetch_array($process);
			$idprocesso = $line['max'] + 1;	
		} ?>

<? // ********* CAMPOS DE PROCESSO  ********** ?>
	<tr>
		<td class="caixaazul"><div align='right'>Lançamento nº:&nbsp;</div></td>
		<td ><input type="text" name="nlancamento" class="cor-inativa" value="<? echo $idprocesso; ?>" size="6" readonly title="Número de Lançamento"></td>
      	<td class="caixaazul"><div align='right'>Data:&nbsp;</div></td>
		<td><input type='text' name='dataent' size='10' maxlength="10" class="cor-inativa" title="Data de Lançamento" 
         
        value= '<? if ($dataent=="") { echo date("d/m/Y");  } else {  echo $dataent; } ?>'
        onBlur='Blur(this);javascript:verifica_dataent();' readonly>
        <a href="javascript:show_calendar('calform.dataent');" 
        onMouseOver="window.status='Calendário';return true;"
        onMouseOut="window.status='';return true;"
        onFocus="javascript:document.calform.nprocesso.focus();">        
		<img src="imagebox/show-calendar.gif" width=20 height=22 border=0 align="absmiddle"  title="Calendário" onClick="document.calform.aviso00.value='';document.calform.aviso0.value='Indique a data de lançamento!';">
        </a></td>

<? //**************************  CÁLCULO DÍGITO VERIFICADOR   ************************* ?>
  <? 	if ($nprocesso!=""  && $fase!='Gravado' && $tipodoc!=1)
		{ 
			$numprocesso = substr($nprocesso,0,5).substr($nprocesso,6,6).substr($nprocesso,13,4);
			$M=1;
			$NUM=$numprocesso;
			$TOTD1=0;
			for ($i=14; $i>=0;$i--) 
			{ 
				$M=$M+1;
				$TOTD1 = $TOTD1+(substr($NUM,$i,1)*$M); 
			}
			$D1=11-($TOTD1 % 11);
			if ($D1 > 9) 
			{ 
				$D1=$D1-10; 
			}
			$M=1;
			$NUM=$numprocesso.$D1;
			$TOTD2=0;
			for ($i=15; $i>=1;$i--) 
			{ 
				$M=$M+1;
				$TOTD2 = $TOTD2+(substr($NUM,$i,1)*$M); 
			}
			$D2=11-($TOTD2 % 11);
			if ($D2 > 9) 
			{ 
				$D2=$D2-10; 
			} 
			if (strlen($numprocesso) == 15) 
			{
				$nprocesso=substr($numprocesso,0,5).".".substr($numprocesso,5,6)."/".substr($numprocesso,11,4)."-".$D1.$D2;
			}
			$sqlquery="select * from processo where up = '".substr($numprocesso,0,5)."' and nprocesso = '".substr($numprocesso,5,6)."'";
			$sqlquery = $sqlquery."  and ano = ".substr($numprocesso,11,4)."";
			$process = mysql_query($sqlquery) or die("Erro11: " . mysql_error());	
			if (mysql_num_rows($process) > 0) 
			{ ?>
				<script>alert('O Processo nº <? echo $nprocesso ?> já existe!');</script><?
				$nprocesso="";	?>
				<script>document.calform.submit();</script><?
			} else {
				$modolan = 1;
			}mysql_free_result($process);
		 	$verif = substr($numprocesso,1,1);
			$veriff = substr($numprocesso,1,4);
			$sqlorig="select * from setor where codigo = ".substr($numprocesso,1,4)."";
			$processor = mysql_query($sqlorig) or die("Erro12: " . mysql_error());
			if (mysql_num_rows($processor) > 0)	
			{ 
				$line = mysql_fetch_array($processor);
				$procedencia = $line['setor'];
				   	if ($verif < 9 && $veriff!=1530) { 
						$procedencia = "FUNARTE - ".$procedencia; 
				}
			}
		}
		if ($nprocesso!=""  && $fase!='Gravado' && $tipodoc==1)
		{ 
			$sqlquery="select * from processo where nprocesso = '".$nprocesso."'";
			$process = mysql_query($sqlquery) or die("Erro11: " . mysql_error());	
			if (mysql_num_rows($process) > 0) 
			{ ?>
				<script>alert('O Processo nº <? echo $nprocesso ?> já existe!');</script><?
				$nprocesso="";	?>
				<script>document.calform.submit();</script><?
			} else {
				$modolan = 1;
			}mysql_free_result($process);
			
		} ?>
<? // ********************** INÍCIO DE LANÇAMENTO DE NÚMERO DE PROCESSO *********************** ?>
	<tr>
  		<td class="caixaazul"><div align='right'>Processo:&nbsp;</div></td>
      	<td colspan="9"><input type="text" name="nprocesso" id="nprocesso" size="21" maxlength="18" onChange="submit();" 
        onKeyPress='javascript:if (event.keyCode==13){ submit();};SoNumero();<? if ($tipodoc==0) { ?>formatar(this, "#####.######/####")<? } ?>;document.calform.lanca.style.visibility="visible";document.calform.Encerrar.style.visibility="hidden";' 
        value="<? echo $nprocesso; ?>" title="Número do Processo" onKeyUp="Mostra(this, 17)" 
        onFocus="Focus(this);<? if($tipodoc!=1) { ?> document.calform.aviso00.value='A Numeração de processo para documento interno obedece um padrão de formatação';document.calform.aviso0.value='Digite somente o nº do Processo, sem pontos, barras e DV. Ex:015300000012001';<? } ?><? if($tipodoc==1) { ?> document.calform.aviso00.value='A Numeração para documento externo não obedece nenhum padrão de formatação';document.calform.aviso0.value='Digite somente o nº do Processo.';<? } ?>
        if (document.calform.dataent.value=='') document.calform.dataent.focus();" class="cor-inativa" onBlur="Blur(this);"></td>
	</tr>
</table>
<? if ($modolan==0) { ?>
<center><input type="submit" name="lanca" id="lanca" value="Lançar"></center>
<? } ?>
<? if ($modolan<2) { ?>
<center><input name="aviso00" id="aviso00" style="text-align:center;" size="100" class="aviso" readonly></center>
<? } ?>
<? if ($modolan<1) { ?>
	<p><center><input name="aviso0" id="aviso0" style="text-align:center;" size="100" class="aviso" readonly></center></p>
<? } ?>
<? if ($tipodoc==0 && $nprocesso=="") { ?><script>document.calform.aviso00.value="A Numeração de processo para documento interno obedece um padrão de formatação";document.calform.aviso0.value="Digite o nº do documento";</script><? } ?>
<? // ********* CAMPOS DE ORIGEM  ********** ?>
<? if ($modolan>0) { ?>
<table width ="50%" align='center' border="1" cellpadding="1" cellspacing="2">  
	<tr class="cabeçalho">
    	<td colspan='9'  ><center>ORIGEM</center></td>
	</tr>
	<tr>      
    	<td class="caixaazul"><div align='right'>Espécie:&nbsp;</div></td>
		<td colspan="2" ><select name='documento' id="documento"
        onFocus="Focus(this);document.calform.aviso00.value = 'Indique o documento de origem do Processo';
        if(document.calform.nprocesso.value=='') {alert('É obrigatório o lançamento do nº do processo!');
        document.calform.nprocesso.focus();}" title="Tipo de documento de origem do processo" 
        onChange="javascript:document.calform.datadoc.focus();" class="cor-inativa" onBlur="Blur(this);">
        <?	$sqlquery = "select * from especie order by especie";
			$process = mysql_query($sqlquery) or die("Erro13: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($documento=="") 
				{ ?>
					<option value=''>Selecione o documento</option><?
						while ($line = mysql_fetch_array($process)) 
						{
							$id = $line['id'];
							$especie = $line['especie']; ?>
							<option value='<? echo $especie ;?>'><? echo $especie ;?></option><?
						}
					}
					if ($documento!="") 
					{ ?>
						<option value='<? echo $documento; ?>'><? echo $documento; ?></option><?
						while ($line = mysql_fetch_array($process)) 
						{
							$id = $line['id'];
							$especie = $line['especie']; ?>
							<option value='<? echo $especie ;?>'><? echo $especie ;?></option><?
						}
					}mysql_free_result($process);					
				} ?>
      </select>
		</td>
		<td class="caixaazul"><div align='right'>Data:&nbsp;</div></td>
    	<td><input type='text' name='datadoc' id='datadoc' size='10' maxlength="10" class="cor-inativa"
        	title="Data do documento de origem" 
        	onFocus='Focus(this);nextfield =numero;document.calform.aviso00.value="Digite a data de lançamento do documento de origem ou indique pelo calendário";if (document.calform.documento.value=="") document.calform.documento.focus();' 
        	onKeyPress='SoNumeroData();if (event.keyCode==13 && this.value!="") document.calform.numero.focus();' 
        	onKeyDown='FormataData(form, this.name, event);' 
        	onKeyUp='Mostra(this, 10)' value= '<? echo $datadoc; ?>'
        	onBlur="Blur(this);">
        	<a href="javascript:show_calendar('calform.datadoc');" 
        	onMouseOver="window.status='Calendário';return true;"
        	onMouseOut="window.status='';return true;"
        	onFocus="javascript:document.calform.datadoc.focus();nextfield ='numero';">        
	  <img src="imagebox/show-calendar.gif" width=20 height=22 border=0 align="absmiddle"  title="Calendário" ></a></td>
    </tr>
    <tr>
    	<td class="caixaazul"><div align='right'>Número:&nbsp;</div></td>
    	<td><input type='text' name='numero' id="numero" size='15'maxlength='15'  class="cor-inativa" 
        	title="Número do documento de origem do processo" value='<? echo $numero; ?>' 
        	onKeyPress='if (event.keyCode==13 && document.calform.procedencia.value=="FUNRRTE" && this.value!="") document.calform.setorsolicitante.focus();
            if (event.keyCode==13 && document.calform.procedencia.value!="FUNARTE" && this.value!="") document.calform.procedencia.focus();' 
        	onFocus='Focus(this);document.calform.aviso00.value="Digite o nº do documento de origem";if (document.calform.datadoc.value=="") document.calform.datadoc.focus();if (document.calform.procedencia.value!="FUNARTE" && this.value!="") { nextfield = procedencia; } else { nextfield =setorsolicitante; }' onBlur="Blur(this);"></td>
		<td class="caixaazul"><div align='right'>Procedência:&nbsp;</div></td>
    	<td width="350" colspan="6" > 
   	  <input type='text' name='procedencia' id="procedencia" size='60' 
        	maxlength='60' class="cor-inativa" title="Órgão gerador do documento de origem do processo" value='<? echo $procedencia; ?>' 
        	onFocus="Focus(this);if (document.calform.numero.value=='') document.calform.numero.focus();document.calform.aviso00.value='Digite a procedência do processo.';" 
        	onChange="javascript:this.value=this.value.toUpperCase();calform.submit();" 
			<? if ($up==01530) { ?>onKeyPress='javascript:if (event.keyCode==13 && this.value!="")document.calform.setorsolicitante.focus();' 
            <? } else { ?>onKeyPress='document.calform.lancaor.style.visibility="visible";document.calform.Encerrar.style.visibility="hidden";if (event.keyCode==13 && this.value!="") {this.value=this.value.toUpperCase();submit(); }' <? } ?> onBlur="Blur(this);"></td>
	</tr>
<? 	// ***************** Se Setor for FUNRRTE ****************** ?>
  <? if ($up==1530) { 
		if ($setorsolicitante!='' && $setorsolicitante!='OUTROS') 
		{ 
			$sqlquery="select * from setor where setor = '$setorsolicitante'";
			$process = mysql_query($sqlquery) or die("Erro14: " . mysql_error());	
			if (mysql_num_rows($process) == 0) 
			{ 
				$sql="insert into setor (setor,descricao)";
				$sql=$sql." values('$setorsolicitante','".ucwords($soldesc)."')";
				$process = mysql_query($sql) or die("Erro15: " . mysql_error());
				$sqlH="insert into historico (data,hora,usuario,acao,ip) 
			values ('" .tdate($date,0). "','" . $hora  . "','".ucwords($nome)."','Inseriu o setor ".strtoupper($setorsolicitante)."','".get_ip()."')";	
			$processH = mysql_query($sqlH) or die("Erro: " . $sql);
			 } 
		} ?> 
	<tr>
    	<td class="caixaazul"><div align='right'>Setor:&nbsp;</div></td>
		<td colspan="10" >
        
<? 	// ***************** Se o registro de Setor existir ****************** ?>
<? 	if ($setorsolicitante!='OUTROS') 
	{ ?>
		  <select name='setorsolicitante' id="setorsolicitante" 
            onFocus='document.calform.aviso00.value="Indique o setor solicitante do processo. Se não constar, indique OUTROS!";' 
        	class="cor-inativa" title='Setor de Origem do Processo (FUNRRTE)' onChange='calform.submit();' onBlur="Blur(this);"><? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($setorsolicitante=="") 
				{ ?>
			<option value=''>Selecione  o setor</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
					}
				}
				if ($setorsolicitante!="") 
				{ ?>
			<option value='<? echo $setorsolicitante; ?>'><? echo $setorsolicitante; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
			}mysql_free_result($process); ?>
		  </select><?
	} ?>
<? 	// ***************** Se o registro de Setor não existir ****************** ?>

<?	if ($setorsolicitante=='OUTROS') 
	{ 
?>	
		<input type='text' name='setorsolicitante' id="setorsolicitante" size='10'maxlength='10' 
        class="cor-inativa" onFocus="Focus(this);document.calform.aviso00.value='Digite a sigla do setor. Ex.: CEMUS';" onKeyPress="javascript:if (event.keyCode==13){ document.calform.soldesc.focus();}"
        value ='<? echo $setorsolicitante ?>' onChange="javascript:this.value=this.value.toUpperCase();" onBlur="Blur(this);document.calform.aviso00.value='';">&nbsp;&nbsp;
		<input type='text' name='soldesc' id="soldesc" size='60'maxlength='60' onKeyPress="javascript:if (event.keyCode==13){ calform.submit();}"
        class="cor-inativa" onFocus="Focus(this);document.calform.aviso00.value='Digite a descrição do setor. Ex.: Centro de Música!';" 
        value ='<? echo $soldesc ?>' onChange="javascript:this.value=this.value.toUpperCase();" onBlur="Blur(this);document.calform.aviso00.value='';">        
<?
	}
?>		        
        
        
        
<? 	// ***************** Se o registro de Setor existir ****************** ?>
<? /*	if ($setorsolicitante!='OUTROS') 
	{ ?>
		  <select name='setorsolicitante' id="setorsolicitante" 
            onFocus='Focus(this);if (document.calform.procedencia.value=="") document.calform.procedencia.focus();document.calform.aviso00.value="Indique o Setor solicitante do processo"' 
        	class="cor-inativa" title='Setor de Origem do Processo (FUNRRTE)' onChange='submit();' onBlur="Blur(this);"><? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($setorsolicitante=="") 
				{ ?>
			<option value=''>Selecione o setor</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
					} ?>
					<option value='OUTROS'>OUTROS</option><?
				}
				if ($setorsolicitante!="") 
				{ ?>
			<option value='<? echo $setorsolicitante; ?>'><? echo $setorsolicitante; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					} ?>
					<option value='OUTROS'>OUTROS</option><?
				}
			}mysql_free_result($process); ?>
		  </select><?
	} ?>
<? 	// ***************** Se o registro de Setor não existir ****************** ?>

<?	if ($setorsolicitante=='OUTROS') 
	{ ?>
		<input type='text' name='setorsolicitante' id="setorsolicitante" size='30'maxlength='30' 
        class="cor-inativa" onFocus="Focus(this);nextfield =favorecido;
        document.calform.aviso00.value='Digite o código e a descrição do setor. Ex.:CEMUS - Centro de Música';" 
        value ='' onChange="javascript:this.value=this.value.toUpperCase();submit();" 
        onKeyPress='javascript:if (event.keyCode==13) {document.calform.favorecido.focus(); }' onBlur="Blur(this);"><?
	}*/ ?></td>
  </tr><?
  } ?>
</table>
<? if($modolan<2) { ?>
<center><input type="submit" name="lancaor" id="lancaor" value="Lançar"></center>
<? } ?>
<script>document.calform.lancaor.style.visibility='hidden'; </script>
<center><input name="aviso1" id="aviso1" style="text-align:center;" size="130" class="aviso" readonly></center>
<? } //fim de if($modolan = 0) ?>
<? if (($tipodoc==1 &&$procedencia!="")||($tipodoc==0 &&$setorsolicitante!="")||($tipodoc==0 &&$procedencia!="")) { ?>
<? // ********* CAMPOS DE DETALHES  ********** ?>
<table width ="49%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr class="cabeçalho">
    	<td colspan='12'><center>DETALHES</center></td>
	</tr>  
	<tr>
    	<td class="caixaazul"><div align='right'>Interessado:&nbsp;</div></td>
    	<td colspan="5"><textarea name="favorecido" id="favorecido" cols="30" rows="2" wrap="hard" class="cor-inativa"  
            onChange="javascript:this.value=this.value.toUpperCase();" value ='<? if ($favorecido!='') { echo $favorecido; } ?>'
            onKeyPress="javascript:if (event.keyCode==13)document.calform.cpf.focus();" 
            onFocus="Focus(this);if (document.calform.procedencia.value=='') document.calform.procedencia.focus();nextfield =cpf;document.calform.aviso1.value='Digite o nome ou razão social do favorecido';" 
            onBlur="Blur(this);document.calform.aviso1.value='';"><? echo $favorecido; ?></textarea ></td>
	  <td  class="caixaazul" ><div align='right'>CPF/CNPJ:</div></td>
	    <td colspan="5" >
        	<input type='text' name='cpf' id="cpf" class="cor-inativa" maxlength='18' size='18' value='<? echo $cpf; ?>' 
        	onFocus="Focus(this);if (document.calform.favorecido.value=='') {document.calform.favorecido.focus() };document.calform.aviso1.value='Se souber,digite o nº do CPF ou CNPJ do favorecido (só números, sem pontos, traços ou barras).';" 
        	onKeyPress="SoNumero();if (event.keyCode==13)document.calform.assunto.focus();" 
        	onBlur="Blur(this);document.calform.aviso1.value='';if (this.value!='') {verificaCPFCNPJ();}"></td>
	</tr>
	<tr>
    	<td width="90" class="caixaazul" ><div align='right'>Assunto :&nbsp;</div></td>
    	<td colspan="12" >
        	<textarea name="assunto" id="assunto" cols="74" rows="3" wrap="hard" class="cor-inativa" 
            onChange="javascript:this.value=this.value.toUpperCase();" 
            value ='<? echo $assunto; ?>' onFocus="Focus(this);document.calform.aviso1.value='Digite o assunto referente ao processo';" onBlur="Blur(this);document.calform.aviso1.value='';"><? echo $assunto; ?></textarea ></td>
	</tr>
	<tr>
  	  <td width="78" class="caixaazul" ><div align='right'>Anexos :&nbsp;</div></td>
    	<td colspan="12" >
        	<textarea name="anexos" id="anexos" cols="74" rows="3" wrap="hard" class="cor-inativa"
            onChange="javascript:this.value=this.value.toUpperCase();"
            onKeyPress='javascript:if (event.keyCode==13)document.calform.volumes.focus();' 
            value ='<? echo $anexos; ?>' onFocus="Focus(this);if (document.calform.assunto.value=='') document.calform.assunto.focus();document.calform.aviso1.value='Digite os documentos anexos ao processo';" onBlur="Blur(this);document.calform.aviso1.value='';"><? if($anexos!="") { echo $anexos; } ?></textarea ></td>
	</tr>
	<tr>
    	<td class="caixaazul" ><div align='right'>Volumes :&nbsp;</div></td>
    	<td width="35" ><input type='text' name='volumes' id="volumes" size='5' class="cor-inativa" 
        value="<? if ($volumes!='') { echo $volumes; } else { ?>1<? } ?>"  onFocus="Focus(this);if (document.calform.assunto.value=='') document.calform.assunto.focus();nextfield=folhas;this.select();document.calform.aviso2.value='Digite o nº de volumes, se não for o indicado.';" 
        onKeyPress="javascript:if (event.keyCode==13)document.calform.folhas.focus();" 
        onBlur="Blur(this);document.calform.aviso2.value='';"></td>
		<td width="53" class="caixaazul" ><div align='right'>Folhas:&nbsp;</div></td>
		<td width="89" colspan="10" ><input type='text' name='folhas' id="folhas" size='5' class="cor-inativa" 
        onFocus="Focus(this);if (document.calform.assunto.value=='') document.calform.assunto.focus();nextfield=observacoes;document.calform.aviso2.value='Digite o nº de folhas existentes no processo';" 
        onKeyPress="javascript:if (event.keyCode==13)document.calform.observacoes.focus();SoNumero();" 
        value ='<? if ($folhas!='') { echo $folhas; } else { ?>0<? } ?>' onBlur="Blur(this);document.calform.aviso2.value='';calform.submit();"></td>
	</tr>
	<tr>
    	<td width="90" class="caixaazul" ><div align='right'>Observações :&nbsp;</div></td>
    	<td colspan="12">
        	<textarea name="observacoes" id="observacoes" cols="74" rows="2" wrap="hard" class="cor-inativa" 
            onFocus="Focus(this);if (document.calform.folhas.value=='') document.calform.folhas.focus();nextfield=localatual;document.calform.aviso2.value='Digite as observações importantes do processo, se houver!';" onChange="javascript:this.value=this.value.toUpperCase();" 
            onBlur="Blur(this);document.calform.aviso2.value='';"><? echo $observacoes; ?></textarea></td>
	</tr>
		<tr>
   		  <td class="caixaazul"><div align='right'>Localização:&nbsp;</div></td>
			<td colspan="10" >
<? 	// ***************** Se o registro de Setor existir ****************** ?>
<? 	if ($localatual!='OUTROS') 
	{ ?>
		  <select name='localatual' id="localatual" 
            onFocus='document.calform.aviso2.value="Indique a localização atual do processo. Se não constar, indique OUTROS!";' 
        	class="cor-inativa" title='Localização do Processo (FUNRRTE)' onChange='calform.submit();' onBlur="Blur(this);"><? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($localatual=="") 
				{ ?>
			<option value=''>Selecione  o local atual</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
					}
				}
				if ($localatual!="") 
				{ ?>
			<option value='<? echo $localatual; ?>'><? echo $localatual; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
			}mysql_free_result($process); ?>
		  </select><?
	} ?>
<? 	// ***************** Se o registro de Setor não existir ****************** ?>

<?	if ($localatual=='OUTROS') 
	{ 
?>	
		<input type='text' name='localatual' id="localatual" size='10'maxlength='10' 
        class="cor-inativa" onFocus="Focus(this);document.calform.aviso2.value='Digite a sigla do setor.';" onKeyPress="javascript:if (event.keyCode==13){ document.calform.localdesc.focus();}"
        value ='<? echo $localatual ?>' onChange="javascript:this.value=this.value.toUpperCase();" onBlur="Blur(this);document.calform.aviso2.value='';">&nbsp;&nbsp;
		<input type='text' name='localdesc' id="localdesc" size='60'maxlength='60' onKeyPress="javascript:if (event.keyCode==13){ calform.submit();}"
        class="cor-inativa" onFocus="Focus(this);document.calform.aviso2.value='Digite a descrição do setor. Ex.: Centro de Música!';" 
        value ='<? echo $localdesc ?>' onChange="javascript:this.value=this.value.toUpperCase();" onBlur="Blur(this);document.calform.aviso2.value='';">        
<?
	}
?>		</td>
  	</tr>
</table>
<BR><center><input name="aviso2" id="aviso2" style="text-align:center;" size="120" class="aviso" readonly></center><br>
<? } // fim de if($modolan>1) ?>
<? // *****************  BOTÕES  *********************  ?>
<table align="center" cellpadding="0" cellspacing="0"> 
<center>
<input name='Gravar' id="Gravar" type='button' value='GRAVAR' class='botao' onClick="GravaProcesso();"><input name='Encerrar' id="Encerrar" type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
</center>
</table>
</form>

<? // ************************************ FUNÇÕES JAVASCRIPT ********************************************* ?>
<script>
document.calform.Gravar.style.visibility="hidden";
function GravaProcesso() {
	<? if ($localatual=="") { $localatual = 'PROTOCOLO'; } ?>
	if (confirm('Os dados serão transferidos para o Banco de Dados.\nDeseja continuar?')) 
	{ 
	<? if ($tipodoc==0) { ?>
	window.location.href="grava_processo.php?up=<? echo $up; ?>&processo=<? echo $processo; ?>&ano=<? echo $ano; ?>&localatual=<? echo $localatual; ?>&localdesc=<? echo $localdesc; ?>";
	<? } else { ?>
	window.location.href="grava_processo.php?&nprocesso=<? echo $nprocesso; ?>&localatual=<? echo $localatual; ?>&localdesc=<? echo $localdesc; ?>";
	<? } ?>
	}
else { window.location.href="lanca_processo.php"; }
}
function FormataData(pForm, pCampo,pTeclaPres) { 
      var wTecla = pTeclaPres.keyCode; 
      wVr = pForm[pCampo].value; 
      wVr = wVr.replace( ".", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wTam = wVr.length + 1; 
      if ( wTecla != 9 && wTecla != 8 ){ 
            if ( wTam > 2 && wTam < 5 ) 
                  pForm[pCampo].value = wVr.substr( 0, wTam - 2  ) + '/' + wVr.substr( wTam - 2, wTam ); 
            if ( wTam >= 5 && wTam <= 10 ) 
                  pForm[pCampo].value = wVr.substr( 0, 2 ) + '/' + wVr.substr( 2, 2 ) + '/' + wVr.substr( 4, 4 );  
      }                   
}
function verifica_datadoc () { //************ Confere a data do processo **************
	dia = (document.calform.datadoc.value.substring(0,2)); 
	mes = (document.calform.datadoc.value.substring(3,5)); 
	ano = (document.calform.datadoc.value.substring(6,10)); 
	situacao = ""; 
	// verifica o dia valido para cada mes 
	if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { situacao = "falsa"; 	} 
	// verifica se o mes e valido 
	if (mes < 01 || mes > 12 ) { situacao = "falsa"; } 
	// verifica se e ano bissexto 
	if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { situacao = "falsa"; }
	// verifica o ano		
	if (ano < 1950 || ano > 2010) { situacao = "falsa"; }    
	if (situacao == "falsa") { 
		document.calform.datadoc.value=""; 
		document.calform.datadoc.focus(); 
		alert("Data do documento de origem inválida!"); 
	} 
}
function verifica_dataent () { //************ Confere a data do processo **************
	dia = (document.calform.dataent.value.substring(0,2)); 
	mes = (document.calform.dataent.value.substring(3,5)); 
	ano = (document.calform.dataent.value.substring(6,10)); 
	situacao = ""; 
	// verifica o dia valido para cada mes 
	if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { situacao = "falsa"; } 
	// verifica se o mes e valido 
	if (mes < 01 || mes > 12 ) { situacao = "falsa"; } 
	// verifica se e ano bissexto 
	if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { situacao = "falsa"; }
	// verifica o ano		
	if (ano < 1950 || ano > 2010) { situacao = "falsa"; }    
	if (document.calform.dataent.value == "") { situacao = "falsa"; } 
	if (situacao == "falsa") { 
		alert("Data de lançamento inválida!"); 
		document.calform.dataent.value=""; 
		document.calform.dataent.focus(); 

	} else {	 
		document.calform.nprocesso.focus();
	} 
}
function verificaCPFCNPJ() {
	if (document.calform.favorecido.value!="" && document.calform.cpf.value.length == 0) 
	{	alert('O CPF/CNPJ é um campo obrigatório !');
		document.calform.cpf.focus();
		return false;
	/*} else if (document.calform.cpf.value.length > 0 && (document.calform.cpf.value.length!= 11 || document.calform.cpf.value.length!= 14)) { alert('Preenchimento incorreto de CPF ou CNPJ!');
		document.calform.cpf.value="";
		document.calform.cpf.focus();
		return false;*/	
	} else if (document.calform.cpf.value.length < 11) {
	alert('Não foram digitados todos os números!\nSe não souber ou não tiver os dados corretos, deixe em branco!');
		document.calform.cpf.focus();document.calform.cpf.select();
		return false;			
	} else if (document.calform.cpf.value.length == 11) {
		var cpf;
		cpf=document.calform.cpf.value;
		document.calform.cpf.value=cpf.substr(0,3) + '.' + cpf.substr(3,3) + '.' + cpf.substr(6,3) + '-' + cpf.substr(9,3);
		validaCPF();
	} else if (document.calform.cpf.value.length == 14) {
		var cnpj;
		cnpj=document.calform.cpf.value;
		document.calform.cpf.value=cnpj.substr(0,2) + '.' + cnpj.substr(2,3) + '.' + cnpj.substr(5,3) + '/' + cnpj.substr(8,4) + '-' + cnpj.substr(12,2);
		validaCNPJ();
	}
}
function validaCPF(){
  var cpf = document.calform.cpf.value; // Recebe o valor digitado no campo
  var cpf = cpf.substr(0, 3)+cpf.substr(4, 3)+cpf.substr(8, 3)+cpf.substr(12, 2); 
  var posicao, i, soma, dv, dv_informado;
  var digito = new Array(10); //Cria uma array de 11 posições para armazenar o CPF
  dv_informado = cpf.substr(9, 2); // Armazena os dois últimos dígito do CPF
  for (i=0; i<=8; i++) { // Desmembra o número do CPF na array digito
    digito[i] = cpf.substr( i, 1);
  }
  // Calcula o valor do 10° dígito da verificação
  posicao = 10;
  soma = 0;
  for (i=0; i<=8; i++) {
	soma = soma + digito[i] * posicao;
	posicao = posicao - 1;
  }
  digito[9] = soma % 11;
  if (digito[9] < 2) {
	digito[9] = 0;
  }else{
	digito[9] = 11 - digito[9];
  }
  // Calcula o valor do 11° dígito da verificação
  posicao = 11;
  soma = 0;
  for (i=0; i<=9; i++) {
	soma = soma + digito[i] * posicao;
	posicao = posicao - 1;
  }
  digito[10] = soma % 11;
  if (digito[10] < 2) {
	digito[10] = 0;
  }else {
	digito[10] = 11 - digito[10];
  }
  //Verifica se os dígitos verificadores conferem
  dv = digito[9] * 10 + digito[10];
  if (dv != dv_informado || document.calform.cpf.value == 00000000000 ||
			    document.calform.cpf.value == 11111111111 || 
			    document.calform.cpf.value == 22222222222 || 
			    document.calform.cpf.value == 33333333333 || 
			    document.calform.cpf.value == 44444444444 || 
			    document.calform.cpf.value == 55555555555 || 
			    document.calform.cpf.value == 66666666666 || 
			    document.calform.cpf.value == 77777777777 || 
			    document.calform.cpf.value == 88888888888 || 
			    document.calform.cpf.value == 99999999999) {
    alert("CPF inválido");
    document.calform.cpf.value = "";
	document.calform.cpf.focus();
    return false;
  }else{
    //return true;
	    document.calform.assunto.focus();
  }
  return false;
}
function validaCNPJ() 
{
	CNPJ = document.calform.cpf.value;
	erro = new String;
	if (CNPJ.length < 18) erro += "E' necessarios preencher corretamente o numero do CNPJ! \n\n";
	if ((CNPJ.charAt(2) != ".") || (CNPJ.charAt(6) != ".") || (CNPJ.charAt(10) != "/") || (CNPJ.charAt(15) != "-")){
		if (erro.length == 0) erro += "E' necessário preencher corretamente o numero do CNPJ! \n\n";
	}
	//substituir os caracteres que nao sao numeros
	if(document.layers && parseInt(navigator.appVersion) == 4)
	{
		x = CNPJ.substring(0,2);
		x += CNPJ.substring(3,6);
		x += CNPJ.substring(7,10);
		x += CNPJ.substring(11,15);
		x += CNPJ.substring(16,18);
		CNPJ = x; 
	} else {
		CNPJ = CNPJ.replace(".","");
		CNPJ = CNPJ.replace(".","");
		CNPJ = CNPJ.replace("-","");
		CNPJ = CNPJ.replace("/","");
	}
	var nonNumbers = /\D/;
	if (nonNumbers.test(CNPJ)) erro += "A verificacao de CNPJ suporta apenas numeros! \n\n"; 
	var a = [];
	var b = new Number;
	var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
	for (i=0; i<12; i++)
	{
		a[i] = CNPJ.charAt(i);
		b += a[i] * c[i+1];
	}
	if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
	b = 0;
	for (y=0; y<13; y++) 
	{
		b += (a[y] * c[y]); 
	}
	if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
	if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13]))
	{
		erro +="CNPJ INVÁLIDO!";
		document.calform.cpf.value = "";
		document.calform.cpf.focus();
	}
	if (erro.length > 0)
	{
		alert(erro);
		return false;
	} else {
		document.calform.assunto.focus();
	}
	return true;
}
function SoNumeroData() { //************ Libera somente números no campo data **************
	if (event.keyCode<45 || event.keyCode>57) event.returnValue = false;
	if (event.keyCode==13)	event.returnValue = true;
}
function avaliaproc() {
  if ( calform.dataent.value == "") {

     alert("A data de lançamento está vazia!");
	 calform.dataent.focus();
     return false;
  }
  if ( calform.nprocesso.value == "") {
     alert("O nº do processo não pode estar em branco!");
	 calform.nprocesso.focus();
     return false;
  }
}
function avaliaori() {
  if ( calform.documento.value == "" || calform.documento.value == "Selecione o documento") {
     alert("O tipo de documento deve ser indicado!");
	 calform.documento.focus();
     return false;
  }
  if ( calform.datadoc.value == "") {
     alert("A data do documento deve ser indicado!");
	 calform.datadoc.focus();
     return false;
  }
	dia = (document.calform.datadoc.value.substring(0,2)); 
	mes = (document.calform.datadoc.value.substring(3,5)); 
	ano = (document.calform.datadoc.value.substring(6,10)); 
	situacao = ""; 
	// verifica o dia valido para cada mes 
	if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { situacao = "falsa"; 	} 
	// verifica se o mes e valido 
	if (mes < 01 || mes > 12 ) { situacao = "falsa"; } 
	// verifica se e ano bissexto 
	if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { situacao = "falsa"; }
	// verifica o ano		
	if (ano < 1950 || ano > 2010) { situacao = "falsa"; }    
		if (document.calform.datadoc.value == "") { situacao = "falsa"; } 
	if (situacao == "falsa") { 
		alert("Data do documento de origem inválida!"); 
		document.calform.datadoc.value=""; 
		document.calform.datadoc.focus(); 
	} 
  if ( calform.numero.value == "") {
     alert("O Nº documento deve ser indicado!");
	 calform.numero.focus();
     return false;
  }
  if ( calform.procedencia.value == "") {
     alert("O órgão gerador do processo deve ser indicado!");
	 calform.procedencia.focus();
     return false;
  }
  if ( calform.procedencia.value=="FUNRRTE" && calform.setorsolicitante.value == "") {
     alert("O setor que abriu o processo deve ser indicado!");
	 calform.setorsolicitante.focus();
     return false;
  }
}
function avaliadet() {
  if ( calform.favorecido.value == "") {
     alert("O favorecido do processo deve ser indicado!");
	 calform.favorecido.focus();
     return false;
  }
  if ( calform.cpf.value == "") {
     alert("O nº do CPF ou CNPJ deve ser indicado!");
	 calform.cpf.focus();
     return false;
  }
  if ( calform.assunto.value == "") {
     alert("O assunto deve ser digitado!");
	 calform.assunto.focus();
     return false;
  }
  if ( calform.volumes.value == "") {
     alert("O nº de volumes deve ser indicado!");
	 calform.volumes.focus();
     return false;
  }
  if ( calform.folhas.value == "") {
     alert("O nº de folhas deve ser indicado!");
	 calform.folhas.focus();
     return false;
  }
}
function avalia() {
  if ( calform.dataent.value == "") {
     alert("A data de lançamento está vazia!");
	 calform.dataent.focus();
     return false;
  }
  if ( calform.nprocesso.value == "") {
     alert("O nº do processo não pode estar em branco!");
	 calform.nprocesso.focus();
     return false;
  }
  if ( calform.documento.value == "" || calform.documento.value == "Selecione o documento") {
     alert("O tipo de documento deve ser indicado!");
	 calform.documento.focus();
     return false;
  } else { alert(calform.documento.value); return true; }
  if ( calform.datadoc.value == "") {
     alert("A data do documento deve ser indicado!");
	 calform.datadoc.focus();
     return false;
  }
  if ( calform.numero.value == "") {
     alert("O Nº documento deve ser indicado!");
	 calform.numero.focus();
     return false;
  }
  if ( calform.procedencia.value == "") {
     alert("O órgão gerador do processo deve ser indicado!");
	 calform.procedencia.focus();
     return false;
  }
  if ( calform.procedencia.value=="FUNRRTE" && calform.setorsolicitante.value == "") {
     alert("O setor que abriu o processo deve ser indicado!");
	 calform.setorsolicitante.focus();
     return false;
  }
  if ( calform.favorecido.value == "") {
     alert("O favorecido do processo deve ser indicado!");
	 calform.favorecido.focus();
     return false;
  }
  if ( calform.cpf.value == "") {
     alert("O nº do CPF ou CNPJ deve ser indicado!");
	 calform.cpf.focus();
     return false;
  }
  if ( calform.assunto.value == "") {
     alert("O assunto deve ser digitado!");
	 calform.assunto.focus();
     return false;
  }
  if ( calform.volumes.value == "") {
     alert("O nº de volumes deve ser indicado!");
	 calform.volumes.focus();
     return false;
  }
  if ( calform.folhas.value == "") {
     alert("O nº de folhas deve ser indicado!");
	 calform.folhas.focus();
     return false;
  }
 }
 <? if ($modolan==0) { ?>
document.calform.lanca.style.visibility='hidden'; 
<? } ?>
if (document.calform.nprocesso.value=="") {document.calform.aviso00.value = "Digite somente o nº do Processo, sem pontos, barras e DV. Ex:015300000012001";document.calform.nprocesso.focus(); }
if (document.calform.nprocesso.value!="" && document.calform.documento.value=="") {document.calform.documento.focus(); }
if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value=="") {document.calform.datadoc.focus(); }
if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value=="") {document.calform.numero.focus(); }
var str = document.calform.nprocesso.value;
if (str!='' && str.substr(1,5)==01530) {
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!=""&& document.calform.setorsolicitante.value=="") {document.calform.setorsolicitante.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.setorsolicitante.value!="" && document.calform.favorecido.value=="") {document.calform.favorecido.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.setorsolicitante.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value=="") {document.calform.assunto.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.setorsolicitante.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value=="") {document.calform.volumes.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.setorsolicitante.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value!="" && document.calform.folhas.value=="") {document.calform.folhas.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.setorsolicitante.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value!="" && document.calform.folhas.value!="" && document.calform.observacoes.value=="") {document.calform.observacoes.focus(); }
} else {
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value=="") {document.calform.procedencia.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value=="") {document.calform.favorecido.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value=="") {document.calform.assunto.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value=="") {document.calform.volumes.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value!="" && document.calform.cpf.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value!="" && document.calform.folhas.value=="") {document.calform.folhas.focus(); }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value!="" && document.calform.folhas.value!="" && document.calform.observacoes.value=="") {document.calform.observacoes.focus();document.calform.Gravar.style.visibility='visible'; }
	if (document.calform.nprocesso.value!="" && document.calform.documento.value!="" && document.calform.datadoc.value!="" && document.calform.numero.value!="" && document.calform.procedencia.value!="" && document.calform.favorecido.value!="" && document.calform.assunto.value!="" && document.calform.volumes.value!="" && document.calform.folhas.value!="" && document.calform.localatual.value!="" ) {document.calform.Gravar.style.visibility='visible';document.calform.Gravar.focus(); }	
}
</script>
<? if ($setorsolicitante=="OUTROS")
{ 
?>
<script>
	document.calform.aviso00.style.visibility='visible';
	document.calform.aviso00.value='Digite a sigla do novo setor. Ex.: CEMUS!';
	document.calform.setorsolicitante.focus();
	document.calform.setorsolicitante.select();
</script>
<? }
?>
<? if ($localatual=="OUTROS")
{ 
?>
<script>
	document.calform.aviso2.style.visibility='visible';
	document.calform.aviso2.value='Digite a sigla do novo setor. Ex.: CEMUS!';
	document.calform.localatual.focus();
	document.calform.localatual.select();
</script>
<? }
// ***************** VERIFICAÇÃO DE Nº DE FOLHAS POR VOLUME *****************
if ($folhas!="" && $folhas/($volumes * 200) > 1)
	{	?><script>document.calform.folhas.value="";document.calform.folhas.focus();alert('Volume incorreto!\nO máximo para cada volume é de 200 folhas\nCorrija o nº de volumes ou de folhas!');document.calform.folhas.focus();
        </script><?
	}
?>
</HEAD>
</HTML>



