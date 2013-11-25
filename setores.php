<? import_request_variables("gP"); ?>
<? 
session_start ();
include "conexao.php";
connect();

// Qd clica no botão excluir
if ($excluir == "Excluir" and $id == "") { ?>
<script>alert('Selecione um Setor!!!')</script> <? }

if ($excluir == "Excluir" and $id != "") { ?>
<script language="javascript">
if (confirm("Esse registro sera excluido do sistema!\nTem certeza que deseja continuar?") == true) {
window.location.href='setores.php?excluir=EXCLUIR2&cod=<? echo $id; ?>';
} else {
window.location.href='setores.php?excluir=';
}
</script>
<? } ?><?

if ($excluir == "EXCLUIR2") {

    $sqlquery = "DELETE FROM setor WHERE idsetor = '$cod'";
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Excluido com Sucesso!!!');</script><? 
unset($excluir); }

?>


<?

// Qd clica no botão ATUALIZAR

if ($alterar == "Atualizar" and $id == "") { ?>
<script>alert('Selecione um Setor!!!')</script> <? }

if ($alterar == "Atualizar"  and $id != "") {

$sqlquery = "UPDATE setor SET setor = '$setor', descricao = '$descricao' WHERE idsetor = '$id'"; 
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Atualizado com Sucesso!!!');</script><? 
unset($alterar); }

?>


<? 
if ($enviar == "Cadastrar") {

$insere = "insert into setor
             (setor, descricao)
			 values
			 ('$setor', '$descricao')";
$resultado = mysql_query($insere)
or die ("Falha na execução da consulta");

?>
<script language="javascript" type="text/javascript">
alert('Cadastro Realizado com Sucesso!!!');
</script><? } ?>

<?
// Qd clica no botão consultar
if ($_POST[consultar_setor] == "Consultar") {

		$sql2 = "select *
		 from setor where setor like '%".$_POST[cons_setor]."%' order by descricao";
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
 
 if (form1.cons_setor.value == "") {
     alert("O campo Descrição deve estar preenchido");
	 form1.cons_setor.focus();
     return false;
  }
} 


function avalia_enviar(form) {
 
 if (form1.setor.value == "") {
     alert("O campo Setor deve estar preenchido");
	 form1.setor.focus();
     return false;
  }
} 

function avalia_id(form) {
 
 if (form1.id.value == "") {
     alert("Faça uma busca e selecione um setor para alterá-lo ou editá-lo!");
	 form1.cons_setor.focus();
     return false;
  }
} 


function send3(codigo2, codigo1, codigo){

	document.form1.descricao.value=codigo2;
	document.form1.setor.value=codigo1;
	document.form1.id.value=codigo;

}
</script>

<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
</head>

<body topmargin="0">
      <form name="form1" method="post" action="setores.php">
        <br>
<table width ="60%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong>Controle de Setores</strong>
			</td>
          </tr>

       <tr> 
       <td colspan="6" class="caixaazul">
       Digite parte da descrição:&nbsp;
			<input name="cons_setor" type="text" onKeyPress="return handleEnter(this, event)" size="30" class="cor-inativa">
			&nbsp;
			<input type="submit" name="consultar_setor" value="Consultar" onClick="return avalia_consulta1(this);">
			</td>
       </tr>

<tr>
         
		<td style="background-color:#FFFFCC" colspan="6">
		
<?

if ($_POST[consultar_setor] == "Consultar") {

		if (mysql_num_rows($Resultado2) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$codigo = $array_exibir['idsetor'];
				$codigo1 = $array_exibir['setor'];
				$codigo2 = $array_exibir['descricao'];
								
				echo "		   <a href=\"javascript:send3('". $codigo2 ."', '". $codigo1 ."', '". $codigo ."')\">";
											   echo $codigo1;
				echo "		   </a>";


echo "<br>";			

			}}
			
}
?>	  	
</tr>


<tr> 
            <td class="caixaazul">C&oacute;digo do Setor:</td>

<td colspan="5">
<input type="text" name="id" size="5" readonly="true" value="<? echo $id; ?>" onMouseOver="MM_displayStatusMsg('Campo somente de leitura, gerado automaticamente na abertura do registro.');return document.MM_returnValue" onMouseOut="MM_displayStatusMsg('');return document.MM_returnValue" style="background-color:#FFFFCC" class="cor-inativa">
</td>
</tr>

<tr> 
            <td class="caixaazul">Setor:</td>

<td colspan="5">
<input type="text" name="setor" size="40" value="<? echo $setor; ?>" class="cor-inativa" maxlength="150">
</td></tr>

<tr> 
            <td class="caixaazul">Descrição:</td>
<td colspan="5">
<input type="text" name="descricao" size="80" value="<? echo $descricao; ?>" class="cor-inativa" maxlength="150"></td>

</tr>


       <tr> 
            <td colspan="6" align="center" class="caixaazul">
			<input type="submit" name="enviar" value="Cadastrar" style="color:#006600" onClick="return avalia_enviar(this);">&nbsp;
<? //if ($_SESSION[login] == "ronaldo") { ?>
			<input type="submit" name="alterar" value="Atualizar" style="color:#000099" onClick="return avalia_id(this);">&nbsp;			
   			<input type="submit" name="excluir" value="Excluir" style="color:#CC0000" onClick="return avalia_id(this);">	
<? //} ?>
            </td>
       </tr>


</table>

      </form>
</body>
</html>
