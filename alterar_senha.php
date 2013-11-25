<? import_request_variables("gP"); ?>
<?	@session_start();	
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/Y");
$datas = date("Y/m/d");
$hora= gmdate("H:i" ,time()-(3570*2));


if ($_POST[gravar] != "") {
if ($_SESSION[senha] != $_POST[senha_atual]) {
echo "<center><b>A senha atual não está correta!</b></center><br><br>";
} else {
		$sql = "update usuario set ";
		$sql.= "senha = '". $_POST[senha_nova]."' ";
		$sql.= "where idusuario = ". $_SESSION[idusuario]."";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
echo "<center><b>Senha atualizada com sucesso!</b></center><br><br>";
}
}
?>

<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<!--  vallidação bootstrao  e jquery validation -->	
<!-- jQUERY PARA VALIDAÇÃO-->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
<link rel="stylesheet" href="css/template.css" type="text/css" />
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/languages/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
</head>
<script>
	    jQuery(document).ready(function () {  // binds form submission and fields to the validation engine
	    jQuery("#form1").validationEngine();
		});
</script>

<script>
function avalia_gravar(form) {
 
 if (calform.senha_atual.value == "") {
     alert("A Senha Atual precisa ser informada!");
	 calform.senha_atual.focus();
     return false;
  }
 if (calform.senha_nova.value == "") {
     alert("Informe a nova senha!");
	 calform.senha_nova.focus();
     return false;
  }
 if (calform.senha_nova.value != calform.senha_nova2.value) {
     alert("As senhas não conferem!");
	 calform.senha_nova.focus();
     return false;
  }
} 

</script>

<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
</HEAD>

<BODY>
<center>

<table width="40%" cellpadding="0" cellspacing="0"> 
<TR align='center'> 
	<td align="center" colspan="2" class="titulo"></strong> 
		<div align="center">&nbsp;ALTERAR SENHA&nbsp;</strong></div>
	</td>
</tr>		
</table>
<BR><BR><BR>

<form id="form1" action="alterar_senha.php" method="POST" name="calform" target="_self">

<table width="40%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite a senha atual:</b>
		</td>
		<td class="caixaazul">
		<input type="password" class="validate[required]" name="senha_atual" size="40">&nbsp;
		</td>
	</tr>

	<tr>
		<td class="caixaazul">
		<b>Digite a nova senha:</b>
		</td>
		<td class="caixaazul">
		<input type="password" class="validate[required,minSize[4]]" name="senha_nova" size="40">&nbsp;
		</td>
	</tr>

	<tr>
		<td class="caixaazul">
		<b>Redigite a nova senha:</b>
		</td>
		<td class="caixaazul">
		<input type="password" class="validate[required,minSize[4]]" name="senha_nova2" size="40">&nbsp;
		</td>
	</tr>

	<tr class="cabeçalho">
    	<td colspan="4" style="text-align:center;">
		<input name='gravar' id="gravar" type='submit' value='GRAVAR' class='botao' onClick="return avalia_gravar(this);">
		</td>
	</tr>
</table>

</form>
</center>

</BODY>
</HTML>



