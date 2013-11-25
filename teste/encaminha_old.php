<? 
@session_start();
include "conexao.php";
include "valida_user.php";
connect();
$datanova = date("Y/m/d");
//$horanova = date("H:m"); 
$horanova= gmdate("H:i" ,time()-(3570*2));
if ($fase=='GRAVAR') 
{ 
	$sql="insert into circulacao (idprocesso,nprocesso,data,hora,destino,observacao) 
			values ($idprocesso,'$nprocesso','$novadata;','$novahora','$novolocal','EM TRÂNSITO')";
	echo "<br>SQL = ".$sql;
	$process = mysql_query($sql) or die("Erro de insert: " . mysql_error());
	if( isset($_POST['mais'])) 
	{
		if ($mais!="") { $nfolhas = $mais; }
	}
	if ($nfolhas!="") 
	{
		if ($nfolhas>200) 
		{
			$sqlvol="select up, ano,dv,volumes from processo where idprocesso = $idprocesso";
			$processvol = mysql_query($sqlvol) or die("Erro: " . mysql_error());	
			if (mysql_num_rows($processvol) > 0) 
			{
				$line = mysql_fetch_array($processvol);
				$up = $line['up'];
				$ano = $line['ano'];
				$dv = $line['dv'];
				$volumes = $line['volumes']; 
			}mysql_free_result($processvol);
		}
		$sql= "update processo set folhas = $nfolhas where idprocesso = $idprocesso";
		$process = mysql_query($sql) or die("Erro de update: " . mysql_error());
	}
?>
	<script language="javascript">
		window.location.href='pesquisa.php?processocom=<? echo $up; ?>.<? echo $nprocesso; ?>/<? echo $ano; ?>&idprocesso=<? echo $idprocesso; ?>&novolocal=<? echo $novolocal; ?>&novadata=<? echo $novadata; ?>&novahora=<? echo $novahora; ?>';
		function avalia(form) 
		{
  			if (form.mais.value > 200 ) 
			{
     			alert("É isso!");
	 			form.Gravar.focus();
     			return false;
  			}
 		}
	</script>
<?
}
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<script>
	var ie = /msie/i.test(navigator.userAgent);      
	var ieBox = ie && (document.compatMode == null || document.compatMode == "BackCompat");      	
	function checkSize() {
		var canvasEl = ieBox ? document.body : document.documentElement;        
		var w = window.innerWidth || canvasEl.clientWidth;        
		var h = window.innerHeight || canvasEl.clientHeight;        
		document.getElementById("DIV#teste").style.width = Math.max(0, w) + "px";
		document.getElementById("DIV#teste").style.height = Math.max(0, h) + "px";
      
		}
		window.onload = checkSize;
		window.onresize = checkSize;
</script>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<? echo "<BR>LOGIN = ".$login; ?>
<? echo "<BR>SETOR = ".$setor_usuario; ?>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;ENCAMINHAMENTO DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>
<form action="encaminha.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >


<? //******************** INÍCIO PREENCHIMENTO DOS DADOS DO PROCESSO ****************************** ?>
<? if ($idprocesso=="") { 
$sql = "select * from processo P, circulacao C";
$sql = $sql." where P.processo = C.nprocesso";
$sql = $sql." and C.origem = '".$setor_usuario."'"; 
//$sql = $sql." and C.observacao = 'EM TRÂNSITO'"; 
$process = mysql_query($sql) or die("Erro: " . mysql_error());	
?>
<table align="center" width="20%" cellpadding="0" cellspacing="0">
	<tr> 
		<td class="titpretonew" colspan="2"><strong>VALIDAÇÕES PENDENTES</font></strong></td>
	</tr>
	<tr>
		<td class="destaquecentro"><b><center>PROCESSO</center></b></td>
	</tr>
<?
while ($line = mysql_fetch_array($process)) 
	{
		$up= $line['up'];
		$nprocesso = $line['nprocesso'];
		$ano = $line['ano'];
		$dv = $line['dv'];
?>
	<tr>
		<td class="caixa"><CENTER><? echo $up; ?>.<? echo $nprocesso; ?>/<? echo $ano; ?>-<? echo $dv; ?></CENTER></td>
							
						<?	} // ******* ENCERRA TIPO DE USUÁRIO  ********** ?>
	<tr><td>&nbsp;</td></tr>
									<tr>
									<? if ($idprocesso=="") { ?>
									<? if ($nprocesso!="") { ?>
										<td class="caixaazul" colspan="2"><strong><center>Clique no processo à ser validado</center></strong></td>
										<input type="hidden" name="valproc" value="valido">
									<? } else { ?>
									<td class="caixaazul" colspan="2"><strong><center>Não há processos à serem validados!</center></strong></td>
									<? } ?>
									<? } else { ?>
									<? if ($momento!=1) { ?> 
										<td class="caixaazul" colspan="2"><strong><center>* Localização atual</center></strong></td>
									<? } else { ?>
										<td class="caixaazul" colspan="2"><strong><center>* EM TRÂNSITO</center></strong></td>
									<? } ?>
									<? } ?>
									</tr>
									<tr>
						
  </table>
<? } ?>
<? if ($idprocesso!="") 
	{ // Busca pelo processo?>
		<?
		$sqlquery="select * from processo where idprocesso = '".$idprocesso."'";
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());	
		if (mysql_num_rows($process) > 0) 
			{ 
				$line = mysql_fetch_array($process);
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
				
				<table align="center" width="80%" cellpadding="0" cellspacing="0"> 
					<tr align='center'> 
						<td align="center" colspan="2" class="titpretonew"></strong> 
						&nbsp;PROCESSO Nº : <? echo $up; ?>.<? echo $nprocesso; ?>/<? echo $ano; ?>-<? echo $dv; ?>&nbsp;</strong>
						</td>
				</table>
				<table align="center" border="1" width="80%" cellpadding="0" cellspacing="0"> 
					<tr> 
						<td width="34%" class="caixadestaque">Assunto :</td>
						<td colspan="6" class="caixatitpesq"><? echo $assunto; ?></td>
					</tr>
					<tr> 
						<td class="caixadestaque">Favorecido :</td><td colspan="6" class="caixatitpesq"><? echo $favorecido; ?></td>
					</tr>									
					<tr> 
						<td class="caixadestaque">Doc. de Origem :</td><td width="8%" class="caixatitpesq"><? echo $documento; ?></td>
						<td width="14%" class="caixadestaque">Número :</td>
						<td width="11%" class="caixatitpesq"><? echo $numero; ?></td>
						<td width="21%" class="caixadestaque">Data de Emissão :</td>
						<td width="12%" class="caixatitpesq"><? echo tdate($datadoc,1) ?></td>
					</tr>						
					</tr>
					<tr> 
						<td class="caixadestaque">Data de Registro :</td><td class="caixatitpesq"><? echo tdate($dataent,1) ?></td><td class="caixadestaque">Setor :</td><td colspan="4" class="caixatitpesq"><? echo $setorsolicitante; ?></td>
					</tr>						

					<tr> 
						<td class="caixadestaque">Destino Inicial :</td><td class="caixatitpesq"><? echo $setordestino; ?></td><td class="caixadestaque">Volumes :</td><td class="caixatitpesq"><? echo $volumes; ?></td><td class="caixadestaque">Nº de Folhas :</td><td class="caixatitpesq"><? echo $folhas; ?></td>
					</tr>																														
				</table>
	<? 		} ?>


<? //******************** FIM DO PREENCHIMENTO DOS DADOS DO PROCESSO ****************************** ?>


					<?	//******************* BUSCA HISTÓRICO DO PROCESSO  ********************* 	
						$sql= "select * from circulacao where idprocesso = ".$idprocesso."" ;
						$sql=$sql." order by idcircula desc";
						$process = mysql_query($sql) or die ("Conexão falhou!"); 
						
						if (mysql_num_rows($process) > 0)  //  ****** SE EXISTIR HISTÓRICO **********
							{ 
								$line = mysql_fetch_array($process);
								$data = $line['data'];
								$setor = $line['setor']; ?>
								<BR><BR><BR>
								<table align="center" width="60" cellpadding="0" cellspacing="0">
									<tr> 
										<td class="titpretonew" colspan="2"><strong>LOCALIZAÇÃO</font></strong></td>
									</tr>
									<tr>
										<td class="destaquecentro" width="60"><b><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA</center></b></td>
										<td class="destaquecentro" width="50"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SETOR</b></center></td>
									</tr>
									<tr>
										<td  width="10"><input type="text" name="landatahist" class="caixaverde" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo tdate($data,1); ?>" readonly="readonly"></td>
										<td  width="60">
											<? if ($setor=='') { ?>
												<input name="local" type="text" id="local" class="caixaverde" value="PROTOCOLO" readonly="readonly" >
											<? } else { ?>
												<input name="local" type="text" id="local" class="caixaverde" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?  echo($setor); ?>" readonly="readonly" >
											<? } ?>
										</td>
									</tr> 
							</table>
					<? 	}	mysql_free_result($process);   // ********** ENCERRA "SE EXISTIR HISTÓRICO"  ************** ?>
								<br><br>
<form action="encaminha.php" method="POST" name="form" target="_self" id="form">								
								<table align="center" width="458" cellpadding="0" cellspacing="0">
									<tr> 
										<td class="titpretonew" colspan="2"><strong>DESTINO</font></strong></td>
									</tr>
									<tr>
										<td class="destaquecentro" width="144"><b>
									  <center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA</center></b></td>
										<td class="destaquecentro" width="312"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SETOR</b></center></td>
									</tr>
									<tr>
									  <td  width="144"><input type="text" name="novadata"  value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo tdate($datanova,0)." - ".$horanova; ?>"></td>
										<td  width="312"><select name='novolocal' class="caixa" onChange="javascript:form.submit();">
<? 		
		$sqlquery = "select * from setor";
		//$sqlquery = $sqlquery." where grupo ='".$_SESSION['grupo']."'";
		$sqlquery = $sqlquery." order by descricao";
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($process) > 0) {
			if ($novolocal=="") {
				echo "<option value=''>Selecione o setor de destino</option>\n";
			} else {
				echo "<option value='$novolocal'>$novolocal</option>\n";
			}
			if ($_SESSION['setor_usuario']=='PROTOCOLO') { ?>
				<option value='ARQUIVO MORTO'>ARQUIVO MORTO</option>
			<? }
			while ($line = mysql_fetch_array($process)) {
				$setor = $line['setor'];
				$descricao = $line['descricao'];
				//$endereco = $line['endereco'];
				//$telefone = $line['telefone'];
				echo "<option value='$setor'>$setor - $descricao</option>\n";														
			}
				mysql_free_result($process);					
		}
?>		
</select></td>
	<? if ($novolocal=="") { ?>									
									</tr>
										<tr>
										<tr><td>&nbsp;</td></tr>
										<td class="caixaazul" colspan="4"><center><strong>Informe o setor que este processo está sendo encaminhado!</strong>
										</center></td>
									</tr>						
												
	<? } else { ?>									
									<tr><td>&nbsp;</td></tr>
									<tr><td class="destaquecentro" width="144"><b>Nº DE FOLHAS:</b></td>
										<td width="312">
										<? if ($nfolhas=="") { ($nfolhas = $folhas); } else { ($folhas = $nfolhas); } ?>
											<select name='nfolhas' class="caixa" onChange="javascript:MostraMais();">
												<option value='<? $folhas ?>'><? echo ($folhas); ?></option>
												<? 	$i = 1;	while($i < 11)  { ?>
													<option value='<? echo ($folhas + $i); ?>'><? echo ($folhas + $i); ?></option>
												<? $i++; }?>
												<option value='mais'>mais..</option>
									  </select><input type="text" name="mais" width="3" size="3" ></td>
								  </tr>
										<tr>
										<tr><td>&nbsp;</td></tr>
											<td class="caixaazul" colspan="4"><center><strong>Informe o total de folhas (nº na última página) deste processo!</strong></center></td>
									</tr>
<? } ?>																		
<?		} // fim de if ($processo!="") ?>
	</table>
<input name="idprocesso" type="hidden" value="<? echo $idprocesso; ?>">
<input name="folhas" type="hidden" value="<? echo $folhas; ?>">
							<br><br>
<center>
<? 
if ($novolocal!='') { ?>
<input name="up" type="hidden" value="<? echo $up; ?>">
<input name="nprocesso" type="hidden" value="<? echo $nprocesso; ?>">
<input name="ano" type="hidden" value="<? echo $ano; ?>">
<input name="novadata" type="hidden" value="<? echo $datanova; ?>">
<input name="novahora" type="hidden" value="<? echo $horanova; ?>">
<input name="fase" type="hidden" value="GRAVAR">
<input type="button" onClick="javascript: if (document.form.nfolhas.value < (200*<? echo $volumes; ?>)) {form.submit(); } else { ExcedeFolhas(); } " name="btgravar" class="botao" id="btgravar" value="GRAVAR" alt="Gravar">
<script language="javascript">document.form.nfolhas.focus();</script>
<? } ?>
<? //if ($novolocal=='') { ($_POST[idprocesso]!=''); ?>
	<? // *****************  BOTÕES  *********************  ?>
	<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOTÕES  *********************  ?>
	</center>
<? // ***************FIM DE MOSTRA RESULTADO ***************** ?>

<? //} ?>

</center>
<script language="javascript">
<? if ($novolocal!="") { ?>
	document.form.mais.style.visibility = "hidden";
	document.form.txtfolhas.style.visibility="hidden";
<? } ?>

function ExcedeFolhas() {
	alert('Este processo não pode ser encaminhado com este nº de folhas!\n Entregue-o ao Protocolo e solicite a abertura de novo tomo(<? echo $volumes + 1; ?>)');
	window.location.href='corpo_do_sistema.php';
}

function MostraMais() {
var n=new Number()
n = document.form.nfolhas.value;
if (n=='mais') {
<? if ($novolocal!="") { ?>
	document.form.mais.style.visibility = "visible";
<? } ?>
	document.form.nfolhas.style.visibility='hidden';
<? if ($novolocal!="") { ?>	
	document.form.mais.focus();
<? } ?>	
	}
}
<? if ($novolocal!="") { ?>
	document.form.txtfolhas.style.visibility='visible';
<? } ?>	
</script>
</form>

</div>
</HEAD>
</HTML>
