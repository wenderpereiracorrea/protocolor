<? 
@session_start();
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
$datanova = date("Y/m/d");
//$horanova = date("H:m");
$horanova= gmdate("H:i" ,time()-(3570*2));

// ******* PARA IGUALAR O IDPROCESSO ENTRE PROCESSO E CIRCULA플O ***********
/*
$sql="select distinct(nprocesso),idprocesso from processo";
echo "sql = ".$sql;
$process = mysql_query($sql) or die("Erro: " . mysql_error());	
if (mysql_num_rows($process) > 0) 
{
?>	<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0">
<?	while ($line = mysql_fetch_array($process)) 
		{	
			$nproc = $line['nprocesso'];
			$idproc = $line['idprocesso'];
			$sqlUp="update circulacao set idprocesso = ".$idproc."";
			$sqlUp=$sqlUp." where nprocesso = '".$nproc."'";
			echo "<br>sqlUP = ".$sqlUp;
			$processUp = mysql_query($sqlUp) or die("Erro: " . mysql_error());
			$sqlv="select nprocesso,idprocesso from circulacao";
			$sqlv=$sqlv." where nprocesso = '".$nproc."'";			
			echo "<br>sqlv = ".$sqlv;
			$processv = mysql_query($sqlv) or die("Erro: " . mysql_error());	
			if (mysql_num_rows($processv) > 0) 
			{
				$line = mysql_fetch_array($processv);
				$nprocesso = $line['nprocesso'];
				$idprocesso = $line['idprocesso'];
			}
?>		<tr><td><? echo $nproc; ?></td><td><? echo $idproc; ?></td><td><? echo $nprocesso; ?></td><td><? echo $idprocesso; ?></td></tr>
<?		} 
?>	</table>
<? // ***************** FIM DE PARA IGUALAR... **************** */?>
<? // ******* PARA CORRIGIR LOCALIZA플O NO PROCESSO ***********
$sql="select * from circulacao";
$sql=$sql." where (despacho <> 'ATUALIZA플O DE LOCALIZA플O'";
$sql=$sql." and despacho <> 'EM TR헞SITO')";
$sql=$sql." or isnull(despacho)";
$sql=$sql." order by idprocesso";
echo "sql = ".$sql;
$process = mysql_query($sql) or die("Erro: " . mysql_error());	
if (mysql_num_rows($process) > 0) 
{
?>	<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0">
<?	while ($line = mysql_fetch_array($process)) 
		{	
			$idprocesso = $line['idprocesso'];
			$nprocesso = $line['nprocesso'];
			$destino = $line['destino'];
			$despacho = $line['despacho'];
			$sqlUp="update processo set localizacao = '".$destino."'";
			$sqlUp=$sqlUp." where nprocesso = '".$nprocesso."'";
			echo "<br>sqlUP = ".$sqlUp;
			$processUp = mysql_query($sqlUp) or die("Erro: " . mysql_error());
?>		<tr><td><? echo $idprocesso; ?></td><td><? echo $nprocesso; ?></td><td><? echo $destino; ?></td><td><? echo $despacho; ?></td></tr>
<?		}
?>	</table>
<? // ***************** FIM DE CORRIGIR LOCALIZA플O... **************** ?>

<script>alert('FEITO!');</script><?
}
?>

