<? import_request_variables("gP"); ?>
<? 
@session_start();
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
if ($tipo=="confirma")
{ 	
	$sql="update circulacao set observacao = 'EM USO' where idprocesso = ".$idprocesso."";
	$sql=$sql." and observacao='EM TR�NSITO'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	$sql="update processo set localizacao = '".$setor_usuario."' where idprocesso = ".$idprocesso."";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','". $_SESSION["nome"]."','Confirmou recebimento do processo n� ".$nprocesso."','".get_ip()."')";	
	$process = mysql_query($sql) or die("Erro: " . $sql);
	$tipo="confirmado";			
	
}
//****************************************************************************************
//****************************************************************************************
//********************************* BUSCA PROCESSO ***************************************
//****************************************************************************************
//****************************************************************************************
if (is_numeric($idprocesso)) 
{
	$sqlquery="select * from processo where idprocesso = '".$idprocesso."'";
	if ($setorsolicita!="") 
	{
		$sqlquery = $sqlquery."  and setorsolicitante = '".$setorsolicita."'";
	}
} else {
	$sqlquery="select * from processo where";
	$sqlquery=$sqlquery." (assunto like '%".$idprocesso."%'";
	$sqlquery=$sqlquery." or favorecido like '%".$idprocesso."%')";
	$sqlquery=$sqlquery." order by ano desc";
}
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
//****************************************************************************************
//****************************************************************************************
//********************************* FIM DE BUSCA PROCESSO ********************************
//****************************************************************************************
//****************************************************************************************
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
	<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
		<tr align='center'> 
			<td align="center" colspan="2" class="titulo"></strong> 
				<div align="center">&nbsp;DETALHES DO PROCESSO&nbsp;</strong></div>
		</td>
		</tr>	
	</table>
	<BR><BR><BR>
<form action="transfer.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >

	<table align="center" border="0" width="51%" cellpadding="0" cellspacing="0"> 
		<tr> 
			<td  class="caixadestaque">Processo :</td>
			<td colspan="2" class="caixatitpesq"><? echo $nprocesso; ?></td>
		</tr>
        <tr>
  	    	<td class="caixadestaque">Registro :</td>
            <td class="caixatitpesq"><? echo tdate($dataent,1) ?></td>
		</tr>
		<tr> 
			<td width="24%" class="caixadestaque">Assunto :</td>
			<td colspan="4" class="caixatitpesq"><? echo $assunto; ?></td>
		</tr>
		<tr> 
			<td class="caixadestaque">Favorecido :</td>
            <td colspan="4" class="caixatitpesq"><? echo $favorecido; ?></td>
		</tr>									
		<tr> 
			<td class="caixadestaque">Doc. de Origem :</td><td width="24%" class="caixatitpesq"><? echo $documento; ?></td>
			<td width="18%" class="caixadestaque">Setor :</td>
			<td width="34%" class="caixatitpesq"><? echo $setorsolicitante; ?></td>
	    </tr>						
		<tr> 
			<td class="caixadestaque">N�mero :</td>
            <td class="caixatitpesq"><? echo $numero; ?></td>
			<td class="caixadestaque">Emiss�o :</td>
			<td class="caixatitpesq"><? echo tdate($datadoc,1) ?></td>
		</tr>						
		<tr> 
        	<td class="caixadestaque">Volumes :</td>
            <td class="caixatitpesq"><? echo $volumes; ?></td>
            <td class="caixadestaque">N� de Folhas :</td>
            <td class="caixatitpesq"><? echo $folhas; ?></td>
		</tr>																														
		<tr> 
        	<td class="caixadestaque">Anexos :</td>
            <td class="caixatitpesq" colspan="3"><? if ($anexos == "") { echo "&nbsp;"; } else { echo $anexos; } ?></td>
		</tr>																														
		</table>
<?
/*$sql="insert into historico (data,hora,usuario,acao,ip) 
	values ('" . tdate($date,0) . "','" . $hora  . "','".ucwords($nome)."','Pesquisou o processo ".$nprocesso."','".get_ip()."')";	
$process = mysql_query($sql) or die("Erro: " . $sql);	*/
} 
//****************************************************************************************
//****************************************************************************************
//********************************** BUSCA HIST�RICO *************************************
//****************************************************************************************
//****************************************************************************************	
$sql= "select * from circulacao where idprocesso = ".$idprocesso."" ;
$sql=$sql." order by data desc, hora desc";
$process = mysql_query($sql) or die ("Conex�o falhou!"); 
if (mysql_num_rows($process) > 0)  //  ****** SE EXISTIR HIST�RICO O USU�RIO  V� TODOS HIST�RICOS **********
{ 	$contloop = 1;
?>	<BR><BR><BR>
	<table align="center" border="1" width="77%" cellpadding="0" cellspacing="0">
		<tr> 
			<td colspan="3" class="titpretonew"><strong>HIST�RICO</font></strong></td>
		</tr>
		<tr>
			<td class="caixadestaque" width="15%"><b><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATA</center></b></td>
			<td class="caixadestaque" width="20%"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SETOR</b></center></td>
	        <td class="caixadestaque" width="65%"><center><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESPACHO</b></center></td>
		</tr>
<?
		$mudacor=1;
		$i = 0;
		while ($line = mysql_fetch_array($process)) 
		{
			if ($i == 0) { $_SESSION[setor] = $line['destino']; }
			$i = $i + 1;
			
			$idcircula= $line['idcircula'];
			$data = $line['data'];
			$hora = $line['hora'];
			$origem = $line['origem'];
			$destino = $line['destino'];
			$despacho = $line['despacho'];
			$observacao = $line['observacao'];
			if ($contloop==0) { $localatual=$contloop; }
			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; } 
?>		<tr> 
<? 	 //		if ($_SESSION['setor_usuario']=='PROTOCOLO') 
	//		{ 			
?>				<td name="landatahist" class="<? echo $corcaixa; ?>" readonly="readonly" bordercolor="#000000"><? echo tdate($data,1); ?></td>
					<td name='local' type='text' id='local' class="<? echo $corcaixa; ?>" readonly="readonly" ><?  echo($destino); ?></td>

					<td name="despacho" type="text" id="despacho" class="<? echo $corcaixa; ?>" readonly="readonly"><?  echo upper(($despacho)); ?><font color="#CC0000"><?  if ($observacao=='EM TR�NSITO') { echo " - OBS.: ".$observacao; $refobs=$destino; } ?></font></td>	

<?					}
?>		</tr> 
<?	/*		$contloop = $contloop + 1;
			$mudacor=$mudacor * (-1);	
		} */
?>	</table>
<?	}	mysql_free_result($process);   // ********** ENCERRA "SE EXISTIR HIST�RICO"  ************** ?>
<?	
//****************************************************************************************
//****************************************************************************************
//**************************** FIM DE BUSCA HIST�RICO ************************************
//****************************************************************************************
//****************************************************************************************	
?>
<center><br>
<br><br>
<? if ($modo==parc || $modo==comp) { ?>
	<input name='Voltar' type='button' value='VOLTAR' class='botao' onClick="javascript:window.location.href='pesquisa.php';">
	<? } else { ?>
	<input name='Voltar' type='button' value='VOLTAR' class='botao' onClick="javascript:history.back();">
	<? } ?>

<? if ($_SESSION[perfil] == "1") { ?>
	<input name='Etiqueta' type='button' value='IMPRIMIR ETIQUETA' class='botao' alt='Imprimir Etiqueta' onClick="javascript:window.location.href='rel_capa_processo.php?nprocesso=<? echo $nprocesso; ?>';">
<? } ?>

<?
if ($_SESSION[perfil] != "0")
{ ?>
	<input type="button" onClick="javascript:Encaminha();" name="Encaminhar" class="botao" id="Encaminhar" value="ENCAMINHAR" alt="Encaminhar Processo">
<? } ?>
	

</center>
 </form>
<script>
	function Encaminha(status) {
 window.location.href = 'transfer.php?idprocesso=<? echo ($idprocesso); ?>';
	}
	function Confirma(status) {
		if (confirm('O recebimento do processo em seu setor ser� confirmado.\n\nDeseja continuar?')) {
			window.location.href = 'mostra_processo.php?idprocesso=<? echo ($idprocesso); ?>&nprocesso=<? echo ($nprocesso); ?>&tipo=confirma';		
		}
	}
</script>	
</HEAD>
</HTML>
