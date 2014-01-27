<?php header("Content-type: text/html; charset=UTF-8");?> 
 <?
 error_reporting(0); ?>
<? 
session_start();
include "conexao.php";
include "valida_user.php";
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
connect();
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<script>
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
</script>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="date-picker.js"></script>
<body>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;ALTERAÇÃO DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form action="altera_processo.php" method="POST" name="form" target="_self" >
		<script language="javascript">
		function confirma() {
			if (confirm("Deseja realmente alterar os dados deste processo?") == true) {
			document.form.submit();
			}
		}
		</script>
	

<? if (isset($_POST['gravando'])) 
	{ 	

		// *****************DISTRIBUIÇÃO DO NÚMERO DE PROCESSO *****************
		if ($nprocesso!="" && $up!=""  && $processo!="" && $ano!="") 
		{ 
		$caracter1 = substr($processo,0,1);
		$criaproc = 1;
		
		// ************ CONFERÊNCIA DE NÚMERO DE PROCESSO ***************
		if (strlen($nprocesso) < 17 && $tipodoc!=1) // Verifica se o nº do processo está completo
		{ ?>
			<script language="javascript">
			var frase;
			frase="ERRO\nNão foram digitados todos os números.\n\nVerifique:\nUP (5 números).";
			frase=frase + "Ex.: 01550\nPROCESSO (6 números).Ex.: 000123\nANO(4 números).";
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
				?><script>alert('O Processo nº <? echo $processo ?> já existe!');window.location.href='altera_processo.php';</script><?
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
					?><script>window.location.href='altera_processo.php';</script><?
			}
		}
	}
	if ($nprocesso!="") { $criaproc = 1; }
	if ($criaproc==1)
	{	
		$sql = "select nprocesso from temp_processo where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro5: " .$sql);
		if (mysql_num_rows($process) > 0) 
		{
			?><script>alert('O Processo nº <? echo $nprocesso ?> está sendo lançado por outro usuário!');</script><?	
			?><script>window.location.href='altera_processo.php';</script><?
		}
	} 
	if ($criaproc==0)
	{
		unset ($up,$processo,$ano,$nprocesso);	?>
		<script>window.location.href='altera_processo.php'</script><?
	}	
//**************************  CÁLCULO DÍGITO VERIFICADOR   *************************
  		if ($up!=""  && $processo!="" && $ano!="")
		{ 
			$numprocesso = $up.$processo.$ano;
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
				if ($verif < 9 && $veriff!=1530) { $procedencia = "FUNARTE - ".$procedencia; }
			}
		}
		if ($up!=""  && $processo!="" && $ano!="" && $nprocesso!="")
		{ 
			$sqlquery="select * from processo where nprocesso = '".$nprocesso."'";
			$process = mysql_query($sqlquery) or die("Erro11: " . mysql_error());	
			if (mysql_num_rows($process) > 0) 
			{ ?>
				<script>alert('O Processo nº <? echo $nprocesso ?> já existe!\n\nA alteração não será realizada!');</script><?
				$nprocesso="";	?>
				<script>window.location.href='altera_processo.php'</script><?
			}mysql_free_result($process);
			
		} 
		
		$sql = "update processo set ";
/*		if ($up!=""  && $processo!="" && $ano!=""  && $nprocesso!="")
		{
		$sql.= "up = '". $up."', ";
		$sql.= "processo = '". $processo."', ";
		$sql.= "ano = '". $ano."', ";
		$sql.= "nprocesso = '". $nprocesso."', "; 
		} */
		$sql.= "assunto = '". $assunto."', ";
		$sql.= "favorecido = '". $favorecido."', ";
		$sql.= "cpfcnpj = '". $cpfcnpj."', ";
		$sql.= "documento = '". $documento."', ";
		$sql.= "procedencia = '". $procedencia."', ";
		$sql.= "numero = '". $numero."', ";
		$sql.= "datadoc = '". tdate($datadoc,0)."', ";
		$sql.= "dataent = '". tdate($dataent,0)."', ";
		$sql.= "setorsolicitante = '". $setorsolicitante."', ";
		$sql.= "localizacao = '". $localizacao."', ";
		$sql.= "volumes = '". $volumes."', ";
		$sql.= "anexos = '". $anexos."', ";
		$sql.= "folhas = '". $folhas."' ";
		$sql.= "where idprocesso = ". $idprocesso."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		$sql="select nprocesso from processo where idprocesso = '".$idprocesso."'";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());	
		if (mysql_num_rows($process) > 0) 
			{ 
				$line = mysql_fetch_array($process);
				$nprocesso = $line['nprocesso'];
			}		 
		$sql="insert into historico (data,hora,usuario,acao,ip) 
			values ('" .tdate($date,0). "','" . $hora  . "','".ucwords($nome)."','Alterou o processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);
		$sql = "update circulacao set ";
		$sql.= "nprocesso = '". $nprocesso."' ";
		$sql.= "where nprocesso = '". $processo_old."'";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		 ?>		
		<script language="javascript">
			alert('Suas alterações foram realizadas com sucesso!');
			window.location.href = 'altera_processo.php';
		</script>	
 <? } ?>		



<? // ************ Conferência de nº de processo completo *************** ?>
<? /* if ($processocom!="") 
	{
		$fase = "Pesquisa";
		$up = substr($processocom,0,5);
		$processo = substr($processocom,6,6);
		$ano = substr($processocom,13,4);
		$caracter1 = substr($processocom,0,1);

		if (strlen($processocom) < 17) // Verifica se o nº do processo está completo
			{ ?>
				<script language="javascript">
					alert('ERRO\nNão foram digitados todos os números.\nVerifique:\nUP (5 números).Ex.: 01550\nPROCESSO (6 números).Ex.: 000123\nANO(4 números).Ex.:2006\n\nVocê digitou: <? echo($up); ?><? echo($processo); ?><? echo($ano); ?>');
				</script><?
				$processocom = "";
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
				<?
			} 
		if (strlen($processocom) == 17 && $caracter1!=0) // verifica nº da UP
			{ ?> 
				<script language="javascript"> 
					alert('ERRO\nO número da UP deve começar com 0.\nVocê digitou <? echo ($caracter1); ?>!'); 
				</script><?
				$processocom = ""; 
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
				<?
			} 
		if (strlen($processocom) == 17 && $ano > 2009) // verifica ano maior que 2008
			{ ?> 
				<script language="javascript"> 
					alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Não chegamos lá ainda!'); 
				</script><?
				$processocom = ""; 
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
				<?
			} 
		if (strlen($processocom) == 17 && $ano < 1950) // verifica ano menor que 1950 
			{ ?> 
				<script language="javascript"> 
					alert('ERRO\nFoi digitado o ano de <? echo ($ano); ?>!\n Você não tinha nem nascido ainda!'); 
				</script><?
				$processocom = ""; 				
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
		<?	} 
	} */ ?>
<? // ************ Fim da Conferência de nº de processo completo *************** ?>



<? // ************ Conferência de nº de processo parcial *************** ?>
<? if ($processored!="") 
	{
		$fase = "Pesquisa";
		$caracter1 = substr($processored,0,1);
	 
		if (strlen($processored) < 6) // Verifica se o nº do processo está completo
			{ ?>
				<script language="javascript">
					alert('ERRO\nNão foram digitados todos os números.\nVerifique:\nPROCESSO (6 números).Ex.: 000123\nVocê digitou: <? echo($processored); ?>');
				</script><?
				$processored = "";
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
				<?
			} 
		if (strlen($processored) == 6 && $caracter1!=0) // verifica nº da UP
			{ ?> 
				<script language="javascript"> 
					alert('ERRO\nO número do processo deve ter 6 números e começar com 0.\nVocê digitou <? echo ($processored); ?>!'); 
				</script><?
				$processored = ""; 
				$fase = "Digitacao";
				?>
				<script language="javascript">
					document.form.submit();
				</script>
				<?
			} 
	} ?>

<? // ************ Fim da Conferência de nº de processo parcial *************** ?>

<? // ******************** Busca pelo nº do processo completo *********************** ?>
<? 	if ($processocom!="") 
		{
			$sql="select * from processo where nprocesso like '".$processocom."%'";
//			$sql = $sql."  and ano = ".substr($processocom,13,4)."";	
			$process = mysql_query($sql) or die("Erro: " . mysql_error());	
		}
	if ($processored!="") 
		{
			$sql="select * from processo where nprocesso like '______".$processored."%'";
			$sql=$sql." order by ano desc";
			$process = mysql_query($sql) or die("Erro: " . mysql_error());		
		}

 // ******************** Fim de Busca pelo nº do processo completo ********************** ?>
 
<? // ***************INÍCIO DE MOSTRA RESULTADO ***************** ?> 
<? 	if ($processocom!="" || $processored!="") 
		{ ?>
		<?	if (mysql_num_rows($process) > 0 && mysql_num_rows($process) == 1) 
				{ $listaproc=1;
					$line = mysql_fetch_array($process);
					$idprocesso = $line['idprocesso'];
					$processo = $line['processo'];
					$nprocesso = $line['nprocesso'];
					$documento = $line['documento'];
					$datadoc = $line['datadoc'];
					$numero = $line['numero'];
					$dataent = $line['dataent'];
					$up = $line['up'];
					$nprocesso = $line['nprocesso'];
					$ano = $line['ano'];
					$dv = $line['dv'];
					$procedencia = $line['procedencia'];
					$setorsolicitante = $line['setorsolicitante'];
					$favorecido = $line['favorecido'];
					$cpfcnpj = $line['cpfcnpj'];
					$assunto = $line['assunto'];
					$anexos = $line['anexos'];
					$volumes = $line['volumes'];
					$folhas = $line['folhas'];
					$observacoes = $line['observacoes'];
					$localizacao = $line['localizacao'];
					$datasaida = $line['datasaida']; 
					?>

					<table align="center" border="0" cellpadding="0" cellspacing="0">
					<tr style="visibility:hidden"><td><input type="text" name="up" id="up"></td></tr><tr style="visibility:hidden"><td><input type="text" name="processo" id="processo"></td></tr><tr style="visibility:hidden"><td><input type="text" name="ano" id="ano"></td></tr><tr style="visibility:hidden"><td><input type="text" name="processo_old" id="processo_old" value="<? echo $nprocesso; ?>"></td></tr>
						<tr> 
							<td class="caixadestaque">Processo :</td><td><input name="nprocesso" class="caixa" value="<? echo $up; ?>.<? echo substr($nprocesso,6,11); ?>" onChange="javascript:var stringer = document.form.nprocesso.value;document.form.up.value = stringer.substr(0,5);document.form.processo.value = stringer.substr(6,6);document.form.ano.value = stringer.substr(13,4);" readonly="true"></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Assunto :</td><td><textarea name="assunto" cols="80%" rows="1" wrap="hard" class="caixa"><? echo ucwords(strtoupper($assunto)); ?></textarea ></td>
						</tr>
						<tr> 
						<tr> 
							<td class="caixadestaque">Favorecido :</td><td><textarea name="favorecido" cols="50%" rows="1" wrap="hard" class="caixa"><? echo ucwords(strtoupper($favorecido)); ?></textarea ></td>
						</tr>
						<tr> 
							<td class="caixadestaque">CPF/CNPJ :</td><td class="caixatitpesq"><input name="cpfcnpj" type="text" value="<? echo $cpfcnpj; ?>" width="350" ></td>
						</tr>						
						<tr> 
							<td class="caixadestaque">Origem :</td><td class="caixatitpesq"><input name="documento" type="text" value="<? echo ucwords(strtoupper($documento)); ; ?>" size="40%" ></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Procedência :</td><td class="caixatitpesq"><input name="procedencia" type="text" value="<? echo ucwords(strtoupper($procedencia)); ?>" size="80%" ></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Número :</td><td class="caixatitpesq" colspan="2"><input name="numero" type="text" value="<? echo $numero; ?>"></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Data :</td><td class="caixatitpesq"><input type='text' name='datadoc' size='10' OnKeyDown='FormataData(form, this.name, event)' onFocus="javascript:form.datadoc.select();" onkeyup='Mostra(this, 10)' value="<? echo tdate($datadoc,1); ?>" onChange="javascript:verifica_datadoc()"></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Registro :</td><td class="caixatitpesq"><input name="dataent" type="text"  size='10' OnKeyDown='FormataData(form, this.name, event)' onFocus="javascript:form.dataent.select();" onkeyup='Mostra(this, 10)' value="<? echo tdate($dataent,1); ?>" onChange="javascript:verifica_dataent()"></td>
						</tr>
						<tr> 
							<td class="caixadestaque">Setor :</td><td class="caixatitpesq" width="80%"><select name='setorsolicitante' class='caixa' >
<? if ($setorsolicitante!="") {
		$sqlquery = "select * from setor order by descricao";
		$processA = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($processA) > 0) {
					echo "<option value='$setorsolicitante'>".$setorsolicitante."</option>\n";
					while ($line = mysql_fetch_array($processA)) {
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone'];
					echo "<option value='$setor'>".$setor."</option>\n";
					}
				}
				mysql_free_result($processA);					
		}

?>		
</select></td>
						</tr>						
						<tr> 
							<td class="caixadestaque">Localização :</td><td class="caixatitpesq"><select name='localizacao' class='caixa'>
<? if ($localizacao!="") {
		$sqlquery = "select * from setor order by descricao";
		$processB = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($processB) > 0) {
					echo "<option value='$localizacao'>".$localizacao."</option>\n";
					while ($line = mysql_fetch_array($processB)) {
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone'];
					echo "<option value='$setor'>".$setor."</option>\n";
					}
				}
				mysql_free_result($processA);					
		}

?>		
</select></td>
						</tr>						
						<tr> 
							<td class="caixadestaque">Volumes :</td><td class="caixatitpesq"><input name="volumes" type="text" value="<? echo $volumes; ?>" size="2" ></td>
						</tr>						
						<tr> 
							<td class="caixadestaque">Folhas :</td><td class="caixatitpesq"><input name="folhas" type="text" value="<? echo $folhas; ?>" size="5" ></td>
						</tr>						
						<tr> 
							<td class="caixadestaque">Anexos :</td><td class="caixatitpesq"><input name="anexos" type="text" value="<? echo $anexos; ?>" size="80%" ></td>
						</tr>						
					</table>
					<br><br>				
					<table align="center" cellpadding="0" cellspacing="0"> 
				<tr><td align="center" colspan="2" class="caixaazul"><center>Faça as alterações necessárias e clique em Gravar.</center></td></tr>
				</table>
				<input type="hidden" name="idprocesso" value="<? echo ($idprocesso); ?>">


<?				} // fim de if (mysql_num_rows($process) > 0 && mysql_num_rows($process) == 1) 

		if (mysql_num_rows($process) > 1) 
			{ $listaproc="";
				?>								
				<table align="center" width="70%" cellpadding="0" cellspacing="0"> 
					<tr align='center'>
					<? if ($processored!='') { ?> 
						<td align="center" colspan="2" class="titpreto"></strong> 
						<div align="center">&nbsp;<font size="-2">PROCESSOS EXISTENTES COM O Nº: <? echo $processored; ?>&nbsp;</font></strong></div>
						</td>
					<? } ?>
				</table>
				<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
					<tr> 
						<td class="caixadestaque" width="42%"><center><B>PROCESSO</B></center></td><td class="caixadestaque" width="58%"><center><B>ASSUNTO</B></center></td></td>
					</tr>						
				</table>

				<?				
				while ($line = mysql_fetch_array($process)) 
					{
						$idprocesso = $line['idprocesso'];
						$nprocesso = $line['nprocesso'];
						$documento = $line['documento'];
						$datadoc = $line['datadoc'];
						$numero = $line['numero'];
						$dataent = $line['dataent'];
						$up = $line['up'];
						$nprocesso = $line['nprocesso'];
						$ano = $line['ano'];
						$dv = $line['dv'];
						$procedencia = $line['procedencia'];
						$setorsolicitante = $line['setorsolicitante'];
						$favorecido = $line['favorecido'];
						$cpfcnpj = $line['cpfcnpj'];
						$assunto = $line['assunto'];
						$anexos = $line['anexos'];
						$volumes = $line['volumes'];
						$folhas = $line['folhas'];
						$observacoes = $line['observacoes'];
						$setordestino = $line['setordestino'];
						$datasaida = $line['datasaida']; 
						?>
						<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
							<tr> 
								<td class="caixatitpesq" colspan="6" width="40%"><a href="altera_processo.php?processocom=<? echo $nprocesso; ?>&listaproc=1&setorsolicitante=<? echo($setorsolicitante); ?>"><? echo $nprocesso; ?></a></td><td class="caixatitpesq" colspan="6" width="60%"><a href="altera_processo.php?processocom=<? echo $nprocesso; ?>&listaproc=1"><? echo $assunto; ?></a></td>
							</tr>						
						</table>
				<?	} ?>
			<BR><BR>	
			<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixaverde"><center>Clique na linha do processo para visualizá-lo.</center></td>
			</tr>
			</table>
			<?	}	?>
<?		} //Fim de if ($processocom!="" || $processored!="") ?>


<? // ***************FIM DE MOSTRA RESULTADO ***************** ?>
 

<script language="javascript">
		function confirma_exc() {
			if (confirm("Todos os dados referentes ao processo <? echo $up; ?>.<? echo $nprocesso; ?>/<? echo $ano; ?>-<? echo $dv; ?> serão excluidos, inclusive o caminho do processo.\n\nTem certeza que deseja fazer isto?") == true) {
			window.location.href = 'excluir_processo.php?idprocesso=<? echo($idprocesso); ?>';
			}
		}
</script>



<? //******************** INÍCIO DE PREENCHIMENTO DE DADOS PARA PESQUISA ****************************** ?>
<? if (!isset($processocom) &&  !isset($processored))
	{
		$fase = "Digitacao"; 
		?>
		<table align="center" width="80%" cellpadding="0" cellspacing="0">
		<? if ($processored=="") 
			{ ?>
			<? if ($processocom=="") 
				{ ?>
				 <tr>
					<td align="center" colspan="10" class="caixaazul"><center>Digite o nº completo do processo. Ex.: 01550.000439/2006 (15 números)</center></td>
				</tr>
			<? 	} ?>
			<tr><td>&nbsp;</td></tr>
			<tr align='center'> 
				<td><div align="center">Processo:&nbsp;&nbsp;
					<input name="processocom" type="text" class="caixa" size="18" maxlength="17" 
					value="<? echo $processocom ?>" onChange="form.submit();" onKeyPress="javascript:formatar(this,'#####.######/####');SoNumero();
					document.form.processored.value='';if (event.keyCode==13)form.submit();" 
					onkeyup='Mostra(this, 17)'></div>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
		<? 	} ?>
		<? if ($processocom=="") { ?>
		<tr>
			<td align="center" colspan="10" class="caixaazul"><center>
			    Ou digite ao menos o nº do processo. Ex.: 000439(6 números)
			</center></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr align='center'> 
			<td><div align="center">Processo:&nbsp;&nbsp;
				
				<input name="processored" type="text" class="caixa" size="6" maxlength="6" value="<? echo $processored ?>" onChange="form.submit();" onKeyPress="SoNumero();javascript:document.form.processocom.value='';if (event.keyCode==13)form.submit();"  onkeyup='Mostra(this, 6)' ></div>
			</td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<? } ?>
		<script language="JavaScript">
		function avalia(form) {
		 if (form.login.value == "") {
		     alert("O campo Login deve estar preenchido");
			 form.login.focus();
		     return false;
		  }
		  if (form.senha.value == "") {
		     alert("O campo Senha deve estar preenchido");
			 form.senha.focus();
		    return false;
		  }
		} 
		</script>
			<script language="javascript">
				document.form.processored.focus();
				document.form.processocom.focus();
			</script>
		
<? 	} ?>
		
		<input type="hidden" name="fase">

		<? //******************** FIM DE PREENCHIMENTO DE DADOS PARA PESQUISA ****************************** ?>
<br><br>

<TR align="center"><TD align="center"><center>
<? if ($listaproc==1 && ($processocom!="" || $processored!="")) { ?>
		<input type="button" onClick="javascript:confirma();" name="Gravar" class="botao" id="Gravar" value="GRAVAR" alt="Gravar">&nbsp;&nbsp;<input type="hidden" name="gravando" value="gravando"><? } ?>
<? // *****************  BOTÕES  *********************  ?>
<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;</center>
<? // *****************  FIM DE BOTÕES  *********************  ?>
</center>
</table>
<script language="javascript">
	//document.form.Pesquisar.style.visibility = "hidden";
</script>
  </form>
</HEAD>
</HTML>
