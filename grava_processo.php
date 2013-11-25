<? 
@session_start();
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
// *******   GRAVAÇÃO DOS DADOS INSERIDOS DO PROCESSO   ************
if ($nprocesso=="") {
		$sqlquery="select * from temp_processo where processo = '".$processo."'";
		$sqlquery = $sqlquery." and up = ".$up."";
		$sqlquery = $sqlquery." and ano = '".$ano."'";
} else {
		$sqlquery="select * from temp_processo where nprocesso = '".$nprocesso."'";
}
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());	
		if (mysql_num_rows($process) > 0) 
			{ 
				$line = mysql_fetch_array($process);
				$idprocesso = $line['idprocesso'];
				$nprocesso = $line['nprocesso'];
				$up = $line['up'];
				$processo = $line['processo'];
				$ano = $line['ano'];
				$documento = $line['documento'];
				$datadoc = $line['datadoc'];
				$numero = $line['numero'];
				$dataent = $line['dataent'];
				$dv = $line['dv'];
				$procedencia = $line['procedencia'];
				if ($line['setorsolicitante']!="") {
					$setorsolicitante = $line['setorsolicitante'];
				} else {
					$setorsolicitante = $line['procedencia'];
				}
				$favorecido = $line['favorecido'];
				$cpfcnpj = $line['cpfcnpj'];
				$assunto = $line['assunto'];
				$anexos = $line['anexos'];
				$volumes = $line['volumes'];
				$folhas = $line['folhas'];
				$observacoes = $line['observacoes'];
				$localizacao = $line['localizacao'];
				$setordestino = $line['setordestino'];
				$datasaida = $line['datasaida'];
			} 
		$sql="insert into processo (documento,datadoc,numero,dataent,nprocesso,up,processo,ano,dv,procedencia,setorsolicitante,favorecido,";
		$sql=$sql."cpfcnpj,assunto,anexos,volumes,folhas,observacoes,setordestino,localizacao,datasaida,situacao,datasit)";
		$sql=$sql." values('$documento','$datadoc','$numero','$dataent','$nprocesso','$up','$processo',";
		$sql=$sql." '$ano','$dv','$procedencia','$setorsolicitante',";
		$sql=$sql." '$favorecido','$cpfcnpj','$assunto','$anexos','$volumes','$folhas','$observacoes','$setordestino','$localizacao',";
		$sql=$sql." '$datasaida','$situacao','$datasit')";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		$sql="select idprocesso from processo order by idprocesso desc";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		if (mysql_num_rows($process) > 0) 
			{ 
				$line = mysql_fetch_array($process);
				$idprocesso = $line['idprocesso'];
			}
		$sql="insert into circulacao (idprocesso,nprocesso,data,hora,origem)";
		$sql=$sql." values('$idprocesso','$nprocesso','".tdate($date,0)."','$hora','PROTOCOLO')";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		$refprocesso = $nprocesso;
		$sql = "delete from temp_processo";
		$sql = $sql." where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
		$sql="insert into historico (data,hora,usuario,acao,ip) 
			values ('" .tdate($date,0). "','" . $hora  . "','".ucwords($nome)."','Inseriu o processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);		
		?>
		<script language="javascript">
<?
		// ***************** LANÇA NOVO SETOR *****************
if ($localatual!="" && $localdesc!="")
{	
	$sql = "select * from setor where setor = '".$localatual."'";
	$sql = $sql." or descricao = '".$localdesc."'";
	$process = mysql_query($sql) or die("Erro: " .$sql);
	if (mysql_num_rows($process) > 0) 
	{
?>		<script>alert('O código "<? echo strtoupper($localatual); ?>" ou a descrição "<? echo ucwords(lower($localdesc)); ?>" já estão cadastrados!');</script>
<?
	} else {
			$sqlIns="insert into setor(setor,descricao)";
			$sqlIns = $sqlIns." values ('".strtoupper($localatual)."','".ucwords(lower($localdesc))."')";
			$processIns = mysql_query($sqlIns) or die("Erro: " . $sqlIns);
			$sqlH="insert into historico (data,hora,usuario,acao,ip) 
			values ('" .tdate($date,0). "','" . $hora  . "','".ucwords($nome)."','Inseriu o setor ".strtoupper($localatual)."','".get_ip()."')";	
			$processH = mysql_query($sqlH) or die("Erro: " . $sql);			
	}
}
		// *********** ATUALIZA LOCALIZAÇÃO DO PROCESSO *******************
if ($localatual!="" && $localatual!="PROTOCOLO" ) 
{
	$sql="update circulacao";
	$sql = $sql." set despacho = 'ATUALIZAÇÃO DE LOCALIZAÇÃO'";
	$sql = $sql." where nprocesso = '".$nprocesso."'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	$sql="insert into circulacao (idprocesso,nprocesso,data,hora,origem,destino)";
	$sql=$sql." values('$idprocesso','$nprocesso','".tdate($date,0)."','$hora','PROTOCOLO','$localatual')";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" .tdate($date,0). "','" . $hora  . "','".ucwords($nome)."','Atualizou a localização do processo n° ".$nprocesso."','".get_ip()."')";	
		$process = mysql_query($sql) or die("Erro: " . $sql);			
?>
<script>alert('Localização Atualizada!');</script>
<?
}
		if ($nprocesso=="") 
		{ 
?>			<script>window.location.href = 'sucesso.php?up=<? echo $up?>&processo=<? echo $processo?>&ano=<? echo $ano?>&dv=<? echo $dv?>';</script>
<?		} else { 
?>			<script>window.location.href = 'sucesso.php?nprocesso=<? echo $nprocesso?>';</script>
<?
		}

?>			
</script>		
<?
// ***********FIM DA GRAVAÇÃO *******************	
 		unset ($documento);unset ($datadoc);unset ($numero);unset ($dataent);unset ($up);unset ($nprocesso);unset ($ano);
		unset ($dv);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpfcnpj);unset ($assunto);unset ($anexos); 
		unset ($volumes);unset ($folhas);unset ($observacoes);unset ($setordestino);unset ($datasaida);unset ($situacao);unset ($datasit); 

?>

