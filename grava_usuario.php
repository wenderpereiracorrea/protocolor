<? 
session_start();
include "conexao.php";
include "valida_user.php";
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
connect();
if($modo=='gravando')
{ 
	$sql="select * from usuario";
	$sql = $sql." where login = '".$novologin."'";	
	$process = mysql_query($sql) or die("Erro: " . mysql_error());	
	if (mysql_num_rows($process) > 0) 
	{	$novologin="";
		?><script>alert('J� existe um usu�rio cadastrado com este login!\nUtilize outro login de acesso!');</script><?
	} else {
		$data = tdate($date,0);
		$sql="insert into usuario (nome,senha,login,lembrete,perfil,cpf,setor,data)";
		$sql=$sql." values('$novonome','$novasenha','$novologin','$lembrete','$perfila','$cpf','$setor','".$data."')";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		?><script>alert('O usu�rio foi cadastrado com sucesso!');window.location.href="lista_usuario.php";</script><?
	}
}				
 /*








$sql = "UPDATE usuario SET nome = '$nome_usuario', login = '$login_usuario',senha = '$senha_usuario', lembrete = '$lembrete', perfil = '$perfila', cpf = '$cpf', setor = '$setor',data = '$data' WHERE idusuario = '$idusuario'";
	//$Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
?>
<script language="javascript">alert('Registro Atualizado com Sucesso!');window.location.href='corpo_do_sistema.php';</script>
<? } ?>
<? if($modo=='excluindo'){ 
		//$sql = "delete from usuario where idusuario = $idusuario";
		//$process = mysql_query($sql) or die("Erro: " . mysql_error());
		?><script language="javascript">//alert(' Usu�rio exclu�do');window.location.href='corpo_do_sistema.php';</script><?
		} ?>
*/
?>	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>PROTOCOLO - Cadastro de Usu�rio</title>
	<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
	<script language="JavaScript" src="auxiliar/date-picker.js"></script>
	</HEAD>
	<body class='corpo'>
	<center>
	<br>
	</head>
	<body>
	<table align="center" width="20%" cellpadding="0" cellspacing="0"> 
	<BR><TR align='center'> 
			<td align="center" colspan="2" class="titulo"></strong> 
						<div align="center">&nbsp;CADASTRO DE NOVO USU�RIO&nbsp;</strong></div>
			</td>
	</table>
	<?	/*
		$sql="select * from usuario";
		$sql = $sql." where idusuario = ".$idusu."";	
		$sql = $sql." order by nome";	
		$process = mysql_query($sql) or die("Erro: " . mysql_error());	
		if (mysql_num_rows($process) > 0) 
		{
			$line = mysql_fetch_array($process);
			$idusuario = $line['idusuario'];
			$login_usuario = $line['login'];
			$nome_usuario = $line['nome'];
			$senha_usuario = $line['senha'];
			$lembrete = $line['lembrete'];
			$perfila = $line['perfil'];
			$cpf = $line['cpf'];
			$setor = $line['setor'];
			$data = $line['data'];
			mysql_free_result($process);
		} */ ?>
	<form action="grava_usuario.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >	
			<table align="center" width="50%" cellpadding="0" cellspacing="0">
				<tr>
					<td>&nbsp;</td>
				</tr> 	
				<tr>
					<td style="visibility:hidden"><div align='right'>ID:&nbsp;</div></td> 
					<td style="visibility:hidden"><input name='idusuario' type='text' id='idusuario' size='12' maxlength='25' class='caixa' value='<? echo ($idusuario);		 ?>' readonly="readonly"></td>
				</tr>
				<tr>
					<td><div align='right'>Nome:&nbsp;</div></td> 
					<td><input name='novonome' type='text' id='novonome' size='40' maxlength='40' class='caixa' value='<? echo ($novonome); ?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";'  onFocus='Focus(this);document.form.aviso.value="Digite o nome do usu�rio.";' onBlur='Blur(this);'></td>
				</tr>  
				<tr>
					<td><div align='right'>Login:&nbsp;</div></td>
					<td><input type='text' name='novologin' id='novologin' size='12'maxlength='12' class='caixa' value='<? echo $novologin?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";'  onFocus='Focus(this);document.form.aviso.value="Digite o nome como o usu�rio ir� se identificar.";if (document.form.novonome.value=="") {alert("O Preenchimento do Nome � Obrigat�rio!");document.form.novonome.focus();};' onBlur='Blur(this);'></td>
				</tr> 
				<tr>
					<td><div align='right'>Senha:&nbsp;</div></td> 
					<td><input name='novasenha' type='password' id='novasenha' size='8' maxlength='8' class='caixa' value='<? echo $novasenha?>'   onFocus='Focus(this);document.form.aviso.value="Digite a senha do usu�rio.";if (document.form.novologin.value=="") {alert("O Preenchimento do Login � Obrigat�rio!");document.form.novologin.focus();};' onBlur='Blur(this);'></td>
				</tr>
<tr>
					<td><div align='right'>Setor:&nbsp;</div></td> 
					<td><select name='setor' id="setor" onFocus='Focus(this);if (document.form.novonome.value!="" && document.form.novologin.value!="" && document.form.novasenha.value=="") {alert("O Preenchimento da Senha � Obrigat�rio!");document.form.novasenha.focus();};if (document.form.novonome.value!="" && document.form.novologin.value=="") {alert("O Preenchimento do Login � Obrigat�rio!");document.form.novologin.focus();};if (document.form.novonome.value=="") {alert("O Preenchimento do Nome � Obrigat�rio!");document.form.novonome.focus();};document.form.aviso.value="Selecione o setor do usu�rio.";'
        	class="cor-inativa" title='Setor do usu�rio (Funarte)' onChange='javascript:document.form.Gravar.style.visibility = "visible";document.form.lembrete.focus();' onBlur='Blur(this);'><? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($setor=="") 
				{ ?>
			<option value=''>Selecione  o setor</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
				if ($setor!="") 
				{ ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
			}mysql_free_result($process); ?>
		  </select></td>
				</tr>
				<tr>
					<td><div align='right'>Lembrete:&nbsp;</div></td> 
					<td><input name='lembrete' type='text' id='lembrete' size='30' maxlength='30' class='caixa' value='<? echo $lembrete?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";'  onFocus='Focus(this);document.form.aviso.value="Digite um lembrete para esquecimento da senha.";if (document.form.novasenha.value=="") {alert("O Preenchimento da Senha � Obrigat�rio!");document.form.novasenha.focus();};'  onBlur='Blur(this);'></td>
				</tr>			 		
				<tr>
					<td><div align='right'>Perfil:&nbsp;</div></td> 
				 	<td><input type="radio" name="perfila" id="perfila" value="1" onFocus="document.form.aviso.value='Permiss�o Total';" >1&nbsp;&nbsp;<input type="radio" name="perfila" id="perfila" value="2" onFocus="document.form.aviso.value='Permiss�o Parcial';" >2&nbsp;&nbsp;<input type="radio" name="perfila" id="perfila" value="3" onFocus="document.form.aviso.value='Permiss�o M�nima';" >3&nbsp;&nbsp;<input type="radio" name="perfila" id="perfila" value="4" onFocus="document.form.aviso.value='Somente Consulta';" checked="checked" >4</td>
				</tr>
				<tr>
					<td><div align='right'>CPF:&nbsp;</div></td> 
			 	<td><input name='cpf' type='text' id='cpf' size='15' maxlength='15' class='caixa' value='<? echo $cpf?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";' onKeyPress="SoNumero();"  onFocus='Focus(this);document.form.aviso.value="Para seguran�a, digite o CPF do usu�rio.";if (document.form.novasenha.value=="") {alert("O Preenchimento da Senha � Obrigat�rio!");document.form.novasenha.focus();};' onBlur='Blur(this);verificaCPF();'></td>
				</tr> 		
			</table> 		
	<br><p><center><input name="aviso" id="aviso" style="text-align:center;" size="100" class="aviso" readonly></center></p><br>
	<center>
			<input type="button" onClick="javascript:confirmausu();" name="Gravar" class="botao" id="Gravar" value="GRAVAR" alt="Gravar">
			<input type="hidden" name="modo" value="gravando">
	<? // *****************  BOT�ES  *********************  ?>
	<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOT�ES  *********************  ?>
	</center>
	</form>
	<script language="javascript">
		document.form.Gravar.style.visibility = "hidden";
	</script>
	<script language="javascript">
		document.form.novonome.focus();
	</script>    
	<script language="javascript">
		function confirmausu() {
		
		 	if (form.novonome.value == "") {
		     alert("O campo nome deve estar preenchido");
			 form.novonome.focus();
		     return false;
			}
			else if (form.novonome.value != "" && form.novologin.value == "") {
		     alert("O campo Login deve estar preenchido");
			 form.login.focus();
		     return false;
			}
			else if (form.novonome.value != "" && form.novologin.value != "" && form.novasenha.value == "") {
		     alert("O campo Senha deve estar preenchido");
			 form.novasenha.focus();
		    return false;
			}
			else if (form.novonome.value != "" && form.novologin.value != "" && form.novasenha.value != "" && form.perfila.value == 0) {
		     alert("O campo Perfil deve estar indicado");
			 form.perfila.focus();
		    return false;
			}
			else if (form.novonome.value != "" && form.novologin.value != "" && form.novasenha.value != "" && form.perfila.value != 0 && form.setor.value == "") {
		     alert("O campo Setor deve estar indicado ");
			 form.setor.focus();
		    return false;
			}
        	form.submit();
		}
	if (document.form.novonome.value!="" && document.form.novologin.value=="") {
			document.form.novologin.focus();
		}	
function verificaCPF() {
	if (document.form.cpf.value!="" && document.form.cpf.value.length == 0) 
	{	alert('O CPF/CNPJ � um campo obrigat�rio !');
		document.form.cpf.focus();
		return false;
	/*} else if (document.calform.cpf.value.length > 0 && (document.calform.cpf.value.length!= 11 || document.calform.cpf.value.length!= 14)) { alert('Preenchimento incorreto de CPF ou CNPJ!');
		document.calform.cpf.value="";
		document.calform.cpf.focus();
		return false;*/	
	} else if (document.form.cpf.value.length < 11 && document.form.cpf.value!="") {
	alert('N�o foram digitados todos os n�meros!\nSe n�o souber ou n�o tiver os dados corretos, deixe em branco!');
		document.form.cpf.focus();document.form.cpf.select();
		return false;			
	} else if (document.form.cpf.value.length == 11) {
		var cpf;
		cpf=document.form.cpf.value;
		document.form.cpf.value=cpf.substr(0,3) + '.' + cpf.substr(3,3) + '.' + cpf.substr(6,3) + '-' + cpf.substr(9,3);
		validaCPF();
	}
}
function validaCPF(){
  var cpf = document.form.cpf.value; // Recebe o valor digitado no campo
  var cpf = cpf.substr(0, 3)+cpf.substr(4, 3)+cpf.substr(8, 3)+cpf.substr(12, 2); 
  var posicao, i, soma, dv, dv_informado;
  var digito = new Array(10); //Cria uma array de 11 posi��es para armazenar o CPF
  dv_informado = cpf.substr(9, 2); // Armazena os dois �ltimos d�gito do CPF
  for (i=0; i<=8; i++) { // Desmembra o n�mero do CPF na array digito
    digito[i] = cpf.substr( i, 1);
  }
  // Calcula o valor do 10� d�gito da verifica��o
  posicao = 10;
  soma = 0;
  for (i=0; i<=8; i++) {
	soma = soma + digito[i] * posicao;
	posicao = posicao - 1;
  }
  digito[9] = soma % 11;
  if (digito[9] < 2) {
	digito[9] = 0;
  }else{
	digito[9] = 11 - digito[9];
  }
  // Calcula o valor do 11� d�gito da verifica��o
  posicao = 11;
  soma = 0;
  for (i=0; i<=9; i++) {
	soma = soma + digito[i] * posicao;
	posicao = posicao - 1;
  }
  digito[10] = soma % 11;
  if (digito[10] < 2) {
	digito[10] = 0;
  }else {
	digito[10] = 11 - digito[10];
  }
  //Verifica se os d�gitos verificadores conferem
  dv = digito[9] * 10 + digito[10];
  if (dv != dv_informado || document.form.cpf.value == 00000000000 ||
			    document.form.cpf.value == 11111111111 || 
			    document.form.cpf.value == 22222222222 || 
			    document.form.cpf.value == 33333333333 || 
			    document.form.cpf.value == 44444444444 || 
			    document.form.cpf.value == 55555555555 || 
			    document.form.cpf.value == 66666666666 || 
			    document.form.cpf.value == 77777777777 || 
			    document.form.cpf.value == 88888888888 || 
			    document.form.cpf.value == 99999999999) {
    alert("CPF inv�lido");
    document.form.cpf.value = "";
	document.form.cpf.focus();
    return false;
  }else{
    //return true;
	    document.form.Gravar.focus();
  }
  return false;
}
	</script>
	</body>
	</html>
