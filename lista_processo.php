<? import_request_variables("gP"); ?>
<? 
@session_start();
include "conexao.php";
connect();
// inclui a página com as funções da paginação
include_once('pagination.php');
?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<br>
<?
if ($lista_setor!="") 
{ 
	if ($tipo=='pesquisa') 
	{
		$sql="select * from processo P,circulacao C ";
		$sql=$sql." where P.nprocesso = C.nprocesso "; 
		$sql=$sql." and P.localizacao = '".$lista_setor."'";
		$sql=$sql." and C.observacao = 'EM USO' ";
	}
	if ($tipo=='confirma') 
	{
		$sql="select * from processo P,circulacao C ";
		$sql=$sql." where P.nprocesso = C.nprocesso "; 
		$sql=$sql." and (P.localizacao = '".$lista_setor."'";
		$sql=$sql." or C.destino = '".$lista_setor."')";
		$sql=$sql." and C.despacho <> 'ATUALIZAÇÃO DE LOCALIZAÇÃO' ";
		$sql=$sql." and C.observacao <> 'TRANSFERIDO' ";
		$sql=$sql." and C.observacao <> 'EM USO' ";
	}
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{ 
?>		<br><br><br><br>
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
			<tr><td class="caixadestaque" width="21%"><center><B>PROCESSO</B></center></td>
                <td class="caixadestaque" width="26%"><center><B>DATA</B></center></td>
                <td class="caixadestaque" width="16%"><center><B>ORIGEM</B></center></td>
                <td class="caixadestaque" width="37%"><center><B>FINALIDADE</B></center></td>
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
			$destino = $line['destino'];
			$despacho = $line['despacho'];
			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; }
?>				<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
					<tr> 
						<td class="<? echo $corcaixa; ?>"  width="24%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $nprocesso; ?></a></td>
						<td class="<? echo $corcaixa; ?>"  width="24%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo tdate($data,1); ?> - <? echo substr($hora, 0, 5); ?> hrs.</a></td>
						<td class="<? echo $corcaixa; ?>"  width="15%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $origem; ?></a></td>
                    	<td class="<? echo $corcaixa; ?>"  width="40%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo ucwords($despacho); ?></a></td>
					</tr>						
				</table>
<?				$mudacor=$mudacor * (-1);
			}
?>		<BR><BR>	
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixadestaque"><center>Clique na linha do processo para visualizá-lo.</center></td>
			</tr>
		</table>
<?	} else {
?>		<script>
			alert('Não existe registro de processos com este número!');
			window.location.href='corpo_do_sistema.php';
        </script>
<?	} 
} else {

// quando usamos a paginação a variável setorsolicita é zerada. Montei essa condição para incrementá=la na paginação
if ($page != "") {
	 $setorsolicita = 'TODOS'; }
// fim do incremento da variável setorsolicita


	if ($setorsolicita!="") 
	{	
// ENTRA NESSA CONDIÇÃO QUANDO ESCOLHEMOS TODOS OS SETORES ------------------
		if ($setorsolicita=='TODOS')
		{

// Linhas de dados por pagina

	 $entries_per_page=15;

     $page = (isset($_GET['page'])?$_GET['page']:1);


     $result     = mysql_query("SELECT COUNT(*) from processo ")

            or die (mysql_error());            

         $num_rows = mysql_fetch_row($result);



if($num_rows[0]!=0){

    $total_pages = ceil($num_rows[0]/$entries_per_page);    

    $pagination = pagination_six($total_pages,$page);

    $offset = (($page * $entries_per_page) - $entries_per_page);

    

 

    $result = mysql_query("SELECT * from processo LIMIT $offset,$entries_per_page")

              or die (mysql_error());

//			$sql = "select * from processo";

 ///////////// INICIA A TABELA DE EXEMPLO DE MOSTRA DOS DADOS   
		if ($setorsolicita=='TODOS')
		{

    echo '<br /><center><table width="80%" border="1">

              <tr align="center">

                <td class="caixadestaque"><b><center>PROCESSO</center></b></td>

                <td class="caixadestaque" align="center"><b><center>LOCALIZAÇÃO</center></b</td>
 
                <td class="caixadestaque" align="center"><b><center>ASSUNTO</center></b</td>

              </tr>';

    

        // Looping para os resultados
$mudacor=1;
    for($i=0;$row=mysql_fetch_assoc($result);$i++){

			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; }
        echo "<tr>

                <td class=$corcaixa><a href='mostra_processo.php?idprocesso=$row[idprocesso]'>{$row['nprocesso']}</a></td>

                <td class=$corcaixa><a href='mostra_processo.php?idprocesso=$row[idprocesso]'>{$row['localizacao']}</a></td>

                <td class=$corcaixa><a href='mostra_processo.php?idprocesso=$row[idprocesso]'>{$row['assunto']}</a></td>

              </tr>";
$mudacor=$mudacor * (-1);
    }

    echo '</tr>

        </table></center>';

////////// TERMINA A TABELA DE EXEMPLO DE MOSTRAGEM DE DADOS       

    
echo "<center>";
    echo $pagination; // Mostra a página na parte inferior
echo "</center>";
                   

}

		}} 
// FIM DA CONDIÇÃO TODOS OS SETORES -----------------------------------------


		if ($setorsolicita!='TODOS')
		 {
			$sql="select * from processo where";
			$sql = $sql." localizacao = '".$setorsolicita."' order by nprocesso";
		}
	}  else { 

	
if ($_GET[modo] == "chave") {
 	$sql="select * from processo where";
	$sql=$sql." (assunto like '%$pchave%'";
	$sql=$sql." or favorecido like '%$pchave%')";
	if ($setorsolicita!="" && $setorsolicita!="TODOS") 
	{
		$sql = $sql."  and setorsolicitante = '".$setorsolicita."'";
	}
	$sql=$sql." order by ano desc";
}

		if ($_GET[idprocesso] != "" and $_GET[modo] != "chave") {
		if ($_GET[modo] == "Externo") {
			$sql = "select * from processo";
			$sql = $sql." where nprocesso like '%".$_GET[idprocesso]."%' order by nprocesso";
		} else {
			$sql = "select * from processo";
			$sql = $sql." where nprocesso like '%".$idprocesso."%' and nprocesso like '_____________".$ano."%' order by nprocesso";
			}
		} else {
			$sql="select * from processo where";
			$sql=$sql." (assunto like '%$idprocesso%'";
			$sql=$sql." or favorecido like '%$idprocesso%')";
			if ($ano != "") { $sql=$sql." and nprocesso like '_____________".$ano."%'"; };
			$sql=$sql." order by idprocesso";
		} 
	}

		if ($setorsolicita!='TODOS')
		{
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{ 
?>		<br><br><br><br>


<?
		if ($setorsolicita!='TODOS')
		{
?>
		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
			<tr> 
				<td class="caixadestaque" width="25%"><center><B>PROCESSO</B></center></td>
                <td class="caixadestaque" width="15%"><center><B>LOCALIZAÇÃO</B></center></td>
                <td class="caixadestaque" width="60%"><center><B>ASSUNTO</B></center></td>
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
			$data = $line['data'];
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
			$localizacao = $line['localizacao'];			
			$datasaida = $line['datasaida'];
			$origem = $line['origem'];
			$destino = $line['destino'];

			// PEGAR LOCALIZAÇÃO ***********************************************************
			$sql1="select * from circulacao where nprocesso like '$nprocesso'";
			$process1 = mysql_query($sql1) or die("Erro: " . mysql_error());	
			while ($line1 = mysql_fetch_array($process1)) 
			{
			$destino = $line1['destino'];
			}
			// PEGAR LOCALIZAÇÃO ***********************************************************

			if ($mudacor > 0) { $corcaixa="caixalistaclaro"; } else { $corcaixa="caixalistaescuro"; }
?>			<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
				<tr> 
					<td class="<? echo $corcaixa; ?>" colspan="6" width="25%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? echo $nprocesso; ?></a></td>
					<td class="<? echo $corcaixa; ?>" colspan="6" width="25%" style="text-align:center;"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? if ($destino!="") { echo $destino; } else { echo $origem; } ?></a></td>
					<td class="<? echo $corcaixa; ?>" colspan="6" width="50%"><a href="mostra_processo.php?idprocesso=<? echo $idprocesso; ?>"><? if ($assunto!="") { echo $assunto; } else { echo "-"; } ?></a></td>
				</tr>						
			</table>
<?			$mudacor=$mudacor * (-1);
		}
?>		<BR><BR>	

		<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixadestaque"><center>Clique na linha do processo para visualizá-lo.</center></td>
			</tr>
		</table> <? } ?>
<?	} else {
?>
		<script>
			alert('Não existe registro de processos com este número!');
			window.location.href='pesquisa.php';
        </script>
<?	}
}}
?>

<? //******************** FIM DE BUSCA DA PESQUISA DE TODOS OS SETORES ****************************** ?>
<br><br>
<center>
<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOTÕES  *********************  ?>
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
