<? 
@session_start();
include "conexao.php";
connect();
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<br>
<?
if ($lista_setor!="") 
{ ?><script>alert('Lista Setor =<? echo $lista_setor; ?>');</script><?
	$sql="select * from processo P,circulacao C where";
	$sql = $sql." P.nprocesso = C.nprocesso";
	$sql = $sql." and C.destino = '".$lista_setor."'";
	$sql = $sql." and C.observacao <> 'TRANSFERIDO'";
	$sql=$sql." order by idcircula desc";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{
?>		<br><br><br><br>
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="caixadestaque" width="20%"><center><B>PROCESSO</B></center></td>
                <td class="caixadestaque" width="25%"><center><B>DATA</B></center></td>
                <td class="caixadestaque" width="15%"><center><B>ORIGEM</B></center></td>
                <td class="caixadestaque" width="40%"><center><B>FINALIDADE</B></center></td>
			</tr>					
		</table><br>
<?		$mudacor=1;			
		while ($line = mysql_fetch_array($process)) 
		{
			$idprocesso = $line['idprocesso'];
			$nprocesso = $line['nprocesso'];
			$data = $line['data'];
			$hora= $line['hora'];
			$origem = $line['origem'];
			$despacho = $line['despacho'];
			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; }
?>			<table align="center" border="0" width="70%" cellpadding="0" cellspacing="0"> 
				<tr> 
					<td class="<? echo $corcaixa; ?>"  width="21%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $nprocesso; ?></a></td>
					<td class="<? echo $corcaixa; ?>"  width="24%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $data; ?> - <? echo $hora; ?> hrs.</a></td>
					<td class="<? echo $corcaixa; ?>"  width="15%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $origem; ?></a></td>
                    <td class="<? echo $corcaixa; ?>"  width="40%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo ucwords($despacho); ?></a></td>
				</tr>						
			</table>
<?			$mudacor=$mudacor * (-1);
		}
?>		<BR><BR>	
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixadestaque"><center>Clique na linha do processo para visualiz�-lo.</center></td>
			</tr>
		</table>
<?        
} else {
	if ($setor_usuario!="") 
	{ ?><script>alert('Setor Usu�rio =<? echo $setor_usuario; ?>');</script><?
		$sql="select * from processo P,circulacao C where";
		$sql = $sql." P.processo = C.nprocesso";
		$sql = $sql." and C.destino = '".$setor_usuario."'";
	} else {
		if (is_numeric($idprocesso)) {
			$sql = "select * from processo";
			$sql = $sql." where processo = '".$idprocesso."'";
		} else {
			$sql="select * from processo where";
			$sql=$sql." (assunto like '%$idprocesso%'";
			$sql=$sql." or favorecido like '%$idprocesso%')";
			$sql=$sql." order by ano desc";
		}
	}
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{ 
?>		<br><br><br><br>
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="caixadestaque" width="20%"><center><B>PROCESSO</B></center></td>
                <td class="caixadestaque" width="20%"><center><B>ORIGEM</B></center></td>
                <td class="caixadestaque" width="60%"><center><B>FINALIDADE</B></center></td>
			</tr>					
		</table><br>
<?		$mudacor=1;			
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
			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; }
?>			<li><table align="center" border="0" width="70%" cellpadding="0" cellspacing="0"> 
				<tr> 
					<td class="<? echo $corcaixa; ?>" colspan="6" width="25%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $nprocesso; ?></a></td>
					<td class="<? echo $corcaixa; ?>" colspan="6" width="15%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? if ($setorsolicitante!="") { echo $setorsolicitante; } else { echo "-"; } ?></a></td>
					<td class="<? echo $corcaixa; ?>" colspan="6" width="60%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? if ($assunto!="") { echo $assunto; } else { echo "-"; } ?></a></td>
				</tr>						
			</table>
<?			$mudacor=$mudacor * (-1);
		}
?>		<BR><BR>	
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixadestaque"><center>Clique na linha do processo para visualiz�-lo.</center></td>
			</tr>
		</table>
<?	} else {
?> <script>alert('N�o � Maior que zero!');</script>
		<script>
			alert('Não existe registro de processos no <? echo $setor_usuario; ?>!');
			//window.location.href='corpo_do_sistema.php';
        </script>
<?	}
}
}
?>

<? //******************** FIM DE BUSCA DA PESQUISA DE TODOS OS SETORES ****************************** ?>
<br><br>
<center>
<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOT�ES  *********************  ?>
</center>
  </form>
<script language="javascript">
	function Encaminha(status) {
			window.location.href = 'encaminha.php?idprocesso=<? echo ($idprocesso); ?>';		
	}

</script>	
</div>
</HEAD>
</HTML>
