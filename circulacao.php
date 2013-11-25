<? import_request_variables("gP"); ?>
<? 
error_reporting(0);
session_start ();
include "conexao.php";
connect();

$date = date("d/m/Y");
$hora= gmdate("H:i" ,time()-(3570*2));
// Qd clica no botão excluir
if ($_POST[excluir] == "Excluir" and $_POST[id] == "") { ?>
<script>alert('Selecione um Registro!!!')</script> <? }

if ($_POST[excluir] == "Excluir" and $_POST[id] != "") { ?>
<script language="javascript">
if (confirm("Esse registro sera excluido do sistema!\nTem certeza que deseja continuar?") == true) {
window.location.href='circulacao.php?excluir=EXCLUIR2&cod=<? echo $_POST[id]; ?>';
} else {
window.location.href='circulacao.php?excluir=';
}
</script>
<? } ?><?

if ($_GET[excluir] == "EXCLUIR2" and $_GET[cod] != "") {

    $sqlquery = "DELETE FROM circulacao WHERE idcircula = ".$_GET[cod]."";
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Excluiu circulacao para o processo n° ".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . $hist);

?><script language="javascript1.2">alert('Registro Excluido com Sucesso!!!');</script><? 
unset($excluir); }

?>


<?

// Qd clica no botão ATUALIZAR

if ($_POST[alterar] == "Atualizar" and $_POST[id] == "") { ?>
<script>alert('Selecione um Setor!!!')</script> <? }

if ($_POST[alterar] == "Atualizar"  and $_POST[id] != "") {

$sqlquery = "UPDATE circulacao SET nprocesso = '".$_POST[nprocesso]."', data = '".tdate($_POST[data],0)."', hora = '".$_POST[hora]."', origem = 'PROTOCOLO', destino = '".$_POST[destino]."', despacho = '".$_POST[despacho]."' WHERE idcircula = ".$_POST[id].""; 
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Alterou circulacao para o processo n° ".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Atualizado com Sucesso!!!');</script><? 
unset($alterar); }

?>


<? 
if ($_POST[enviar] == "Cadastrar") {

		$sql2 = "select idprocesso from processo where nprocesso = '".$_POST[nprocesso]."'";
		$Resultado2 = mysql_query($sql2) or die("Erro: " . mysql_error());

		if (mysql_num_rows($Resultado2) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$idprocesso = $array_exibir['idprocesso'];
			}} else { echo "Erro na tabela Principal.<br>Favor entrar em contato com o administrador do sistema.<br><a href='circulacao.php'>Voltar</a>"; exit(); }



$insere = "insert into circulacao
             (nprocesso, data, hora, origem, destino, despacho, idprocesso)
			 values
			 ('".$_POST[nprocesso]."', '".tdate($_POST[data],0)."', '".$_POST[hora]."', '".$_POST[origem]."', '".$_POST[destino]."', '".$_POST[despacho]."', '".$idprocesso."')";
$resultado = mysql_query($insere)
or die ("Falha na execução da consulta");

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Inseriu circulacao para o processo n° ".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . $hist);

?>
<script language="javascript" type="text/javascript">
alert('Cadastro Realizado com Sucesso!!!');
</script><? } ?>

<?
// Qd clica no botão consultar
if ($_POST[consultar] == "Consultar") {

		$sql2 = "select nprocesso, hora, origem, destino, despacho, date_format(data, '%d/%m/%Y') as 'data', idcircula
		 from circulacao where nprocesso like '%".$_POST[cons_circulacao]."%' order by nprocesso";
		$Resultado2 = mysql_query($sql2) or die("Erro: " . mysql_error());

 }
?>

<html>
<head>
<title>Sistema de Protocolo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="JavaScript1.2">

function handleEnter (field, event) {
        var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
        if (keyCode == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        }
        else
        return true;
    }      

function avalia_consulta1(form) {
 
 if (form1.cons_circulacao.value == "") {
     alert("O campo Descrição deve estar preenchido");
	 form1.cons_circulacao.focus();
     return false;
  }
} 


function avalia_enviar(form) {
 
 if (form1.nprocesso.value == "") {
     alert("O campo Processo deve estar preenchido");
	 form1.nprocesso.focus();
     return false;
  }
} 

function avalia_id(form) {
 
 if (form1.id.value == "") {
     alert("Faça uma busca e selecione um setor para alterá-lo ou editá-lo!");
	 form1.cons_circulacao.focus();
     return false;
  }
} 


function send3(codigo6, codigo5, codigo4, codigo3, codigo2, codigo1, codigo){

	document.form1.despacho.value=codigo6;
	document.form1.destino.value=codigo5;
	document.form1.origem.value=codigo4;
	document.form1.hora.value=codigo3;
	document.form1.data.value=codigo2;
	document.form1.nprocesso.value=codigo1;
	document.form1.id.value=codigo;

}
</script>

<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
</head>

<body topmargin="0">
      <form name="form1" method="post" action="circulacao.php">
        <br>
<table width ="60%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong>Controle de Movimentações</strong>
			</td>
          </tr>

       <tr> 
       <td colspan="6" class="caixaazul">
       Digite parte da número do processo:&nbsp;
			<input name="cons_circulacao" type="text" onKeyPress="return handleEnter(this, event)" size="30" class="cor-inativa">
			&nbsp;
			<input type="submit" name="consultar" value="Consultar" onClick="return avalia_consulta1(this);">
			</td>
       </tr>

<tr>
         
		<td style="background-color:#FFFFCC" colspan="6">
		
<?

if ($_POST[consultar] == "Consultar") {

		if (mysql_num_rows($Resultado2) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$codigo = $array_exibir['idcircula'];
				$codigo1 = $array_exibir['nprocesso'];
				$codigo2 = $array_exibir['data'];
				$codigo3 = $array_exibir['hora'];
				$codigo4 = $array_exibir['origem'];
				$codigo5 = $array_exibir['destino'];
				$codigo6 = $array_exibir['despacho'];
								
				echo "		   <a href=\"javascript:send3('". $codigo6 ."', '". $codigo5 ."', '". $codigo4 ."', '". $codigo3 ."', '". $codigo2 ."', '". $codigo1 ."', '". $codigo ."')\">";
											   echo $codigo1." - ".$codigo6;
				echo "		   </a>";


echo "<hr>";			

			}}
			
}
?>	  	
</tr>


<tr> 
            <td class="caixaazul">C&oacute;digo da circulação:</td>

<td colspan="5">
<input type="text" name="id" size="5" readonly="true" value="<? echo $_POST[id]; ?>" onMouseOver="MM_displayStatusMsg('Campo somente de leitura, gerado automaticamente na abertura do registro.');return document.MM_returnValue" onMouseOut="MM_displayStatusMsg('');return document.MM_returnValue" style="background-color:#FFFFCC" class="cor-inativa">
</td>
</tr>

<tr> 
            <td class="caixaazul">Processo:</td>

<td colspan="5">
<input type="text" name="nprocesso" size="40" value="<? echo $_POST[nprocesso]; ?>" class="cor-inativa" onKeyPress="return txtBoxFormat(this, '99999.999999/9999-99', event);" maxlength="150">
</td></tr>

<tr> 
            <td class="caixaazul">Data:</td>
<td colspan="5">
<input type="text" name="data" size="40" value="<? echo $_POST[data]; ?>" class="cor-inativa" maxlength="150"  onKeyPress="return txtBoxFormat(this, '99/99/9999', event);"></td>

</tr>

<tr> 
            <td class="caixaazul">Hora:</td>
<td colspan="5">
<input type="text" name="hora" size="40" value="<? echo $_POST[hora]; ?>" class="cor-inativa" maxlength="150"></td>

</tr>
<tr> 
            <td class="caixaazul">Origem:</td>
<td colspan="5">
<input type="text" name="origem" size="40" value="<? echo $_POST[origem]; ?>" class="cor-inativa" maxlength="150"></td>

</tr>
<tr> 
            <td class="caixaazul">Destino:</td>
<td colspan="5">
<select name='destino'>
<option value="<? echo $_POST[destino]; ?>"><? echo $_POST[destino]; ?></option>
<? 		
					$sqlquery = "select * from setor";
					$sqlquery = $sqlquery." order by setor";
					$processq = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if (mysql_num_rows($processq) > 0) 
					{
						while ($line = mysql_fetch_array($processq)) 
						{
							$setorx = $line['setor'];
							echo "<option value='$setorx'>$setorx</option>\n";														
						}
					}	mysql_free_result($processq);					
?>					</select>

</tr>

<tr> 
            <td class="caixaazul">Despacho:</td>
<td colspan="5">
<input type="text" name="despacho" size="60" value="<? echo $_POST[despacho]; ?>" class="cor-inativa" maxlength="255"></td>

</tr>

       <tr> 
            <td colspan="6" align="center" class="caixaazul">
			<input type="submit" name="enviar" value="Cadastrar" style="color:#006600" onClick="return avalia_enviar(this);">&nbsp;
			<input type="submit" name="alterar" value="Atualizar" style="color:#000099" onClick="return avalia_id(this);">&nbsp;			
   			<input type="submit" name="excluir" value="Excluir" style="color:#CC0000" onClick="return avalia_id(this);">	
            </td>
       </tr>


</table>

      </form>
</body>
<? include "footer.php" ?>
</html>
