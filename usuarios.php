<? import_request_variables("gP"); ?>
<? 
session_start ();
include "conexao.php";
include "valida_user.php";
connect();

// Qd clica no botão excluir
if ($excluir == "Excluir" and $id == "") { ?>
<script>alert('Selecione um Registro!!!')</script> <? }

if ($excluir == "Excluir" and $id != "") { ?>
<script language="javascript">
if (confirm("Esse registro sera excluido do sistema!\nTem certeza que deseja continuar?") == true) {
window.location.href='usuarios.php?excluir=EXCLUIR2&cod=<? echo $id; ?>';
} else {
window.location.href='usuarios.php?excluir=';
}
</script>
<? } ?><?

if ($excluir == "EXCLUIR2" and $_GET[cod] != "") {

    $sqlquery = "DELETE FROM usuario WHERE idusuario = ".$_GET[cod]."";
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Excluido com Sucesso!!!');</script><? 
unset($excluir); }

?>


<?

// Qd clica no botão ATUALIZAR

if ($_POST[alterar] == "Atualizar" and $_POST[id] == "") { ?>
<script>alert('Selecione um Setor!!!')</script> <? }

if ($_POST[alterar] == "Atualizar"  and $_POST[id] != "") {


$sqlquery = "UPDATE usuario SET senha = '".md5($_POST[senha])."', nome = '".$_POST[nome]."', perfil = '".$_POST[perfil]."', setor = '".$_POST[setor]."' WHERE idusuario = ".$_POST[id].""; 
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Atualizado com Sucesso!!!');</script><? 
unset($alterar); }

?>


<? 
if ($_POST[enviar] == "Cadastrar") {
					mysql_query("SET NAMES 'utf8'");
					mysql_query('SET character_set_connection=utf8');
					mysql_query('SET character_set_client=utf8');
					mysql_query('SET character_set_results=utf8');
					$sqlquery = "select * from usuario where login = '".$_POST[login]."'";
					$processq = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if (mysql_num_rows($processq) > 0) 
					{ echo "Este login já está sendo utilizado por outro usuário!"; } else {

$insere = "insert into usuario
             (login, senha, nome, perfil, setor)
			 values
			 ('".$_POST[login]."', '".md5($_POST[senha])."', '".$_POST[nome]."', '".$_POST[perfil]."', '".$_POST[setor]."')";
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');
				$resultado = mysql_query($insere)
or die ("Falha na execução da consulta");

?>
<script language="javascript" type="text/javascript">
alert('Cadastro Realizado com Sucesso!!!');
</script><? } } ?>

<?
// Qd clica no botão consultar
if ($_POST[consultar] == "Consultar") {

		$sql2 = "select login, senha, nome, perfil, setor, idusuario
		 from usuario where nome like '%".$_POST[cons_nome]."%' order by nome";
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
 
 if (form1.cons_nome.value == "") {
     alert("O campo Nome deve estar preenchido");
	 form1.cons_nome.focus();
     return false;
  }
} 


function avalia_enviar(form) {
 
 if (form1.login.value == "") {
     alert("O campo Login deve estar preenchido");
	 form1.login.focus();
     return false;
  }

 if (form1.nome.value == "") {
     alert("O campo Nome deve estar preenchido");
	 form1.nome.focus();
     return false;
  }
} 

function avalia_id(form) {
 
 if (form1.id.value == "") {
     alert("Faça uma busca e selecione um setor para alterá-lo ou editá-lo!");
	 form1.cons_nome.focus();
     return false;
  }
} 


function send3(codigo5, codigo4, codigo3, codigo2, codigo1, codigo){

	document.form1.setor.value=codigo5;
	document.form1.perfil.value=codigo4;
	document.form1.nome.value=codigo3;
	document.form1.senha.value=codigo2;
	document.form1.login.value=codigo1;
	document.form1.id.value=codigo;

}
</script>

<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<!--  vallidação bootstrao  e jquery validation -->	
<!-- jQUERY PARA VALIDAÇÃO-->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
<link rel="stylesheet" href="css/template.css" type="text/css" />
<!--<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/languages/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>-->
</head>
<script>
	    jQuery(document).ready(function () {  // binds form submission and fields to the validation engine
	    jQuery("#form1").validationEngine();
		});
</script>
<!--  vallidação bootstrao  e jquery validation -->	

<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
</head>

<body topmargin="0">
      <form name="form1" id="form1" method="post" action="usuarios.php">
        <br>
<table width ="60%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong>Controle de Usuários</strong>
			</td>
          </tr>

       <tr> 
       <td colspan="6" class="caixaazul">
       Digite parte do nome:&nbsp;
			<input name="cons_nome" type="text" onKeyPress="return handleEnter(this, event)" size="30" class="cor-inativa">
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
			
				$codigo = $array_exibir['idusuario'];
				$codigo1 = $array_exibir['login'];
				$codigo2 = md5($array_exibir['senha']);
				$codigo3 = $array_exibir['nome'];
				$codigo4 = $array_exibir['perfil'];
				$codigo5 = $array_exibir['setor'];
								
				echo "		   <a href=\"javascript:send3('". $codigo5 ."', '". $codigo4 ."', '". $codigo3 ."', '". $codigo2 ."', '". $codigo1 ."', '". $codigo ."')\">";
											   echo $codigo3;
				echo "		   </a>";


echo "<hr>";			

			}}
			
}
?>	  	
</tr>


<tr> 
            <td class="caixaazul">C&oacute;digo do usuário:</td>

<td colspan="5">
<input type="text" name="id" size="5" readonly="true" value="<? echo $_POST[id]; ?>" onMouseOver="MM_displayStatusMsg('Campo somente de leitura, gerado automaticamente na abertura do registro.');return document.MM_returnValue" onMouseOut="MM_displayStatusMsg('');return document.MM_returnValue" style="background-color:#FFFFCC" class="cor-inativa">
</td>
</tr>

<tr> 
            <td class="caixaazul">Login:</td>

<td colspan="5">
<input type="text" name="login" class="validate[required,minSize[4]]" size="40" value="<? echo $_POST[login]; ?>" class="cor-inativa" maxlength="150">
</td></tr>

<tr> 
            <td class="caixaazul">Senha:</td>
<td colspan="5">
<input type="text" name="senha" class="validate[required,minSize[4]]" size="40" value="<? echo $_POST[senha]; ?>" class="cor-inativa" maxlength="150"></td>

</tr>

<tr> 
            <td class="caixaazul">Nome:</td>
<td colspan="5">
<input type="text" name="nome" class="validate[required,minSize[4]]" size="40" value="<? echo $_POST[nome]; ?>" class="cor-inativa" maxlength="150"></td>

</tr>
<tr> 
            <td class="caixaazul">Perfil:</td>
<td colspan="5">
<select class="validate[required]" name="perfil">
<option value=""></option>
<option value="1">Administrador</option>
<option value="3">Operador</option>
</select>

</tr>
<tr> 
            <td class="caixaazul">Setor:</td>
<td colspan="5">
                	<select class="validate[required" name='setor'>
<option value=""></option>
<? 		
					$sqlquery = "select * from setor";
					$sqlquery = $sqlquery." order by setor";
					mysql_query("SET NAMES 'utf8'");
					mysql_query('SET character_set_connection=utf8');
					mysql_query('SET character_set_client=utf8');
					mysql_query('SET character_set_results=utf8');
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
            <td colspan="6" align="center" class="caixaazul">
			<input type="submit" name="enviar" value="Cadastrar" style="color:#006600" onClick="return avalia_enviar(this);">&nbsp;
			<input type="submit" name="alterar" value="Atualizar" style="color:#000099" onClick="return avalia_id(this);">&nbsp;			
   			<input type="submit" name="excluir" value="Excluir" style="color:#CC0000" onClick="return avalia_id(this);">	
            </td>
       </tr>


</table>

      </form>
</body>

</html>
