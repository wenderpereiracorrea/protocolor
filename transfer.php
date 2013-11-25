<? 
session_start();
import_request_variables("gP");
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
$datanova = date("Y/m/d");
//$horanova = date("H:m");
$horanova= gmdate("H:i" ,time()-(3570*2));

if ($_SESSION[setor_usuario] == $_SESSION[setor] or $_SESSION[setor_usuario] == "Setor de Protocolo") {

// VERIFICA SE ESTÁ EM TRÂNSITO ******************************************
		$sql = "select * from circulacao where idprocesso = '".$_GET[idprocesso]."' and observacao like '%".transito."%'";
		$process = mysql_query($sql) or die("Erro: " . $sql);

// RETIRADO A PEDIDO DO JORGE EM 15/09/2009 - ULTIMA LINHA TEM CHAVE COMENTADA
		if (mysql_num_rows($process) > 0) {
		echo "<font color='#FF0000'>Este processo está em trânsito!<br><br>Para fazer o encaminhamento, favor alterar esse status através da opção recebimento no menu.</font>";
		} else { 

if ($btgravar=="GRAVAR")
{ 
	$sql="update circulacao set observacao = 'TRANSFERIDO' where idprocesso = ".$idprocesso."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
	$sql="update processo set localizacao = '".$novolocal."' where idprocesso = ".$idprocesso."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
	if ($novolocal != 'ARQUIVO') 
	{
		$sql="insert into circulacao (idprocesso,nprocesso,data,hora,origem,destino,despacho,observacao) values ('$idprocesso','$nprocesso','$novadata','$novahora','$setor_usuario','$novolocal','$despacho','EM TRÂNSITO')";
	} else {
		$sql="insert into circulacao (idprocesso,nprocesso,data,hora,origem,destino,despacho,observacao) values ('$idprocesso','$nprocesso','$novadata','$novahora','$setor_usuario','$novolocal','$despacho','TRANSFERIDO')";
	}
	$process = mysql_query($sql) or die("Erro: " . mysql_error());
	if ($nfolhas !="" && $nfolhas > 0)
	{
		// CÁLCULO DO NÚMERO DE FOLHAS ***********************************************************************
		
		$sql="select folhas from processo where idprocesso = ".$idprocesso."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		
		if (mysql_num_rows($process) > 0) 
		{
		$line = mysql_fetch_array($process);
		$folhas = $line['folhas'];
		}
		$folhas = $folhas + $nfolhas;
		
		
		$sql="update processo set folhas = ".$folhas." where idprocesso = ".$idprocesso."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());


		// CÁLCULO DO NÚMERO DE FOLHAS ***********************************************************************
	}
	$sql="insert into historico (data,hora,usuario,acao,ip) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Encaminhou o processo n° ".$nprocesso." para ".$novolocal."','".get_ip()."')";	
	$process = mysql_query($sql) or die("Erro: " . $sql);			
?><script>//alert('Encaminhamento gravado com sucesso!');window.location.href='mostra_processo.php?idprocesso=<? echo $idprocesso; ?>';</script><?	
?><script>//window.location.href="imp_despacho.php?setor_usuario='<? echo $setor_usuario; ?>&destino="& document.form.novolocal.value;</script><?
?><script>    var answer = confirm('Encaminhamento gravado com sucesso!\nDeseja imprimir o despacho?')
    		if (answer){
			window.location.href="imp_despacho.php?setor_usuario=<? echo $_SESSION[setor_usuario]; ?>&&destino=<? echo $novolocal; ?>&&nprocesso=<? echo $nprocesso; ?>"
    		} else {
			window.location.href='mostra_processo.php?idprocesso=<? echo $idprocesso; ?>';
			}
</script><?
	} 
			
if ($novolocal!="" && $despacho!="" && $nfolhas!="") { $fase="Gravar"; } 
?>
<style>
<!--

#ie5menu{
position:absolute;
width:140px;
border:1px solid #5983AC;
background-color:#EDEFF2;
font-family:Verdana;
line-height:12px;
cursor:default;
visibility:hidden;
}

.menuitems{
padding-left:3px;
padding-right:3px;
}
-->
</style>
<script language="JavaScript1.2">

var display_url=0


function showmenuie5(){
ie5menu.style.left=document.body.scrollLeft+event.clientX
ie5menu.style.top=document.body.scrollTop+event.clientY
ie5menu.style.visibility="visible"
return false
}

function hidemenuie5(){
ie5menu.style.visibility="hidden"
}

function highlightie5(){
if (event.srcElement.className=="menuitems"){
event.srcElement.style.backgroundColor="#D0D8E4"
event.srcElement.style.color="black"
if (display_url==1)
window.status=event.srcElement.url
}
}

function lowlightie5(){
if (event.srcElement.className=="menuitems"){
event.srcElement.style.backgroundColor=""
event.srcElement.style.color="black"
window.status=''
}
}

function jumptoie5(){
if (event.srcElement.className=="menuitems")
window.location=event.srcElement.url
}
</script>

<!--[if IE]>
<div id="ie5menu" onMouseover="highlightie5()" onMouseout="lowlightie5()" onClick="jumptoie5()">
<div align="center"><img src="imagebox/menu.gif" width="100" height="25"></div>
<div class="menuitems" url="lanca_processo.php?modolan=0"><img src="imagebox/ponto.gif" width="6" height="6"> Lançamento</div>
<div class="menuitems" url=""><img src="imagebox/ponto.gif" width="6" height="6"> Alteração</div>
<div class="menuitems" url="pesquisa.php"><img src="imagebox/ponto.gif" width="6" height="6"> Pesquisa</div>
<div class="menuitems" url="transfer.php"><img src="imagebox/ponto.gif" width="6" height="6"> Encaminhamento</div>
<div class="menuitems" url=""><img src="imagebox/ponto.gif" width="6" height="6"> Relatórios</div>
<div class="menuitems" url=""><img src="imagebox/ponto.gif" width="6" height="6"> Etiquetas</div>
<div class="menuitems" url=""><img src="imagebox/ponto.gif" width="6" height="6"> Usuários</div>
<div class="menuitems" url=""><img src="imagebox/ponto.gif" width="6" height="6"> Recados</div>
<div class="menuitems" url="sobre.php"><img src="imagebox/ponto.gif" width="6" height="6"> Sobre o Sistema</div>
<div class="menuitems" url="logout.php"><img src="imagebox/ponto.gif" width="6" height="6"> LogOut</div>
</div>
<![endif]-->
<script language="JavaScript1.2">
document.oncontextmenu=showmenuie5
if (document.all&&window.print)
document.body.onclick=hidemenuie5
</script>



<script>
function avalia() {
var ref = 0;
if (document.form.novolocal.value == "") 
	{
		alert("O destino do processo deve ser preenchido!");
		document.form.novolocal.focus();
		var ref = 1;
		return false;
	}
if (document.form.despacho.value == "") 
	{
		alert("A finalidade da transferência deve ser indicada!");
		document.form.despacho.focus();
		var ref = 1;
		return false;
	}
if (ref==0) 
	{	
		form.submit();
	}		
}
</script>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;ENCAMINHAMENTO DE PROCESSO&nbsp;</strong></div>
	</td>
</tr>
</table>
<BR><BR><BR>
<form action="transfer.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this);" >

<? /**************************************   DADOS DO PROCESSO    ************************************
	**************************************************************************************************
	**************************************************************************************************
	**************************************************************************************************/
if ($idprocesso!="") 
{
	$sql="select * from processo where idprocesso = '".$idprocesso."'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{ 
		$line = mysql_fetch_array($process);
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
?>		<table align="center" border="0" width="51%" cellpadding="0" cellspacing="0"> 
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
				<td class="caixadestaque">Número :</td>
            	<td class="caixatitpesq"><? echo $numero; ?></td>
				<td class="caixadestaque">Emissão :</td>
				<td class="caixatitpesq"><? echo tdate($datadoc,1) ?></td>
			</tr>						
			<tr> 
        		<td class="caixadestaque">Volumes :</td>
           		<td class="caixatitpesq"><? echo $volumes; ?></td>
           	 	<td class="caixadestaque">Nº de Folhas :</td>
            	<td class="caixatitpesq"><? echo $folhas; ?></td>
			</tr>																														
		</table>
<?
} 	/******************** FIM DE DADOS DO PROCESSO ****************************** 
	******************** BUSCA HISTÓRICO DO PROCESSO  **************************/
	$sql= "select * from circulacao where idprocesso = ".$idprocesso."" ;
	$sql=$sql." order by idcircula desc";
	$process = mysql_query($sql) or die ("Conexão falhou!"); 
//	if (mysql_num_rows($process) > 0)
//	{ 

		$line = mysql_fetch_array($process);
		$data = $line['data'];
		if ($line['destino']=="")
		{
			$local = $line['origem'];
		} else {
			$local = $line['destino'];
		}
?>		<br><br>
		<table align="center" border="0" width="31%" cellpadding="0" cellspacing="0">
			<tr> 
				<td  class="caixadestaque">Data:</td>
				<td class="caixatitpesq"><? echo tdate($dataent,1); ?></td>
			</tr>
        	<tr>
  	    		<td class="caixadestaque">Localização:</td>
         		<td class="caixatitpesq"><? echo $local; ?></td>
			</tr>
			<tr> 
				<td width="24%" class="caixadestaque">Destino:</td>
				<td class="caixatitpesq">
                	<select name='novolocal' class="caixa" onChange="javascript:form.submit();">
<? 		
					$sqlquery = "select * from setor";
					//$sqlquery = $sqlquery." where grupo ='".$_SESSION['grupo']."'";
					$sqlquery = $sqlquery." order by setor";
					$processq = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if (mysql_num_rows($processq) > 0) 
					{
						if ($novolocal=="") 
						{
							echo "<option value=''>Selecione o setor de destino</option>\n";
						} else {
							echo "<option value='$novolocal'>$novolocal</option>\n";
						}
						if ($_SESSION['setor_usuario']=='SETOR DE PROTOCOLO') 
						{
?>							<option value='ARQUIVO'>ARQUIVO - ARQUIVO MORTO</option>
<?						}
						while ($line = mysql_fetch_array($processq)) 
						{
							$setor = $line['setor'];
							$descricao = $line['descricao'];
							//$endereco = $line['endereco'];
							//$telefone = $line['telefone'];
							echo "<option value='$setor'>$setor</option>\n";														
						}
					}	mysql_free_result($processq);					
?>					</select>				</td>
			</tr>
			<tr> 
				<td class="caixadestaque">Despacho:</td>
            	<td class="caixatitpesq">
                	<textarea name="despacho" id="despacho" class="cor-inativa" cols="66" rows="3" value="<? echo $despacho; ?>"  onBlur="Blur(this);"><? echo $despacho; ?></textarea>
	           </td>
			</tr>
<? 	//}
	mysql_free_result($process);   // ********** ENCERRA "SE EXISTIR HISTÓRICO"  ************** ?>
			<tr>
	        <td class="caixadestaque">Folhas:</td>
			<td>
			
			<input type="text" name="nfolhas" value="<? echo $nfolhas; ?>" size="2" maxlength="4" onKeyPress="return txtBoxFormat(this, '9999', event);">
			  <input type="text" name="mais" width="3" size="3" onKeyPress="if(event.keyCode==13) {document.form.submit(); }" onBlur="document.form.aviso.value=''">        	
			  

			  </td>
		</tr>
<?	} // fim de if ($processo!="") ?>
	</table>

			    <BR><BR><center>
<b><font color="#990000">Informe o destino;</font></b><br>
<b><font color="#990000">Digite o despacho;</font></b><br>
<b><font color="#990000">Informe o número de folhas acrescentadas.</font></b>
<BR><BR></center>

<input name="idprocesso" type="hidden" value="<? echo $idprocesso; ?>">
							<br><br>
<center>
<? 
//if ($fase=="Gravar") { ?>
<input name="up" type="hidden" value="<? echo $up; ?>">
<input name="nprocesso" type="hidden" value="<? echo $nprocesso; ?>">
<input name="ano" type="hidden" value="<? echo $ano; ?>">
<input name="novadata" type="hidden" value="<? echo $datanova; ?>">
<input name="novahora" type="hidden" value="<? echo $horanova; ?>">
<input type="submit" onFocus=";document.form.aviso.value='Clique em Gravar ou tecle Enter para salvar a transferência!'" onClick="if (document.form.nfolhas.value > (200*<? echo $volumes; ?>)) { ExcedeFolhas(); } " name="btgravar" class="botao" id="btgravar" value="GRAVAR">
<script language="javascript">document.form.nfolhas.focus();</script>
<? // } ?>
<? //if ($novolocal=='') { ($_POST[idprocesso]!=''); ?>
	<? // *****************  BOTÕES  *********************  ?>
	<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOTÕES  *********************  ?>
	</center>
<? // ***************FIM DE MOSTRA RESULTADO ***************** ?>

<? 
if ($novolocal!="" && $despacho!="" && $nfolhas!="")
{
?>	<script>document.form.btgravar.style.visibility='visible';document.form.btgravar.focus();</script>
<?
}
 ?>

</center>
<script language="javascript">

function ExcedeFolhas() {
	alert('Este processo não pode ser encaminhado com este nº de folhas!\n Encaminhe-o ao Protocolo e solicite a abertura de novo tomo(<? echo $volumes + 1; ?>)');
	window.location.href='corpo_do_sistema.php';
}

function MostraMais() {
	var n=new Number()
	n = document.form.nfolhas.value;
	if (n=='mais') 
	{
		document.form.mais.style.visibility = "visible";
		document.form.mais.focus();
	} else {
		form.submit();
	}
}
<? 	if ($novolocal=="") { ?>
	document.form.novolocal.focus();
<? 	} ?>
<? 	if ($despacho=="") { ?>
	document.form.despacho.focus();
<?	}	?>
<? 	if ($novolocal!="" && $despacho=="" && $setor_usuario=='PROTOCOLO') {
	$sql="update circulacao set despacho = 'TRANSFERIDO PELO PROTOCOLO' where idprocesso = ".$idprocesso." and destino = '".$local."'";
	$process = mysql_query($sql) or die("Erro: " . mysql_error()); 
	}	?>	
<? 	if ($nfolhas=="") { ?>
	document.form.nfolhas.focus();
<?	}	?>	
document.form.mais.style.visibility='hidden';
function Focus(obj) {
	document.getElementById(obj.id).className = 'cor-ativa';
}
function Blur(obj) {
	document.getElementById(obj.id).className = 'cor-inativa';
}	
</script>
</form>

</div>
</HEAD>
</HTML>
<? } ?>
<? } else { echo "<center><b>Este processo só pode ser encaminhado pelo setor em que se encontra ou pelo Protocolo!</b></center>"; } ?>