<? import_request_variables("gP"); ?>
<? 
session_start();
include "conexao.php";
include "valida_user.php";
connect();
if($modo=='gravando'){ 
$data = tdate($data,0);
$senha_usuario = md5($senha_usuario);
 $sql = "UPDATE usuario SET nome = '$nome_usuario', login = '$login_usuario',senha = '$senha_usuario', lembrete = '$lembrete', perfil = '$perfila', cpf = '$cpf', setor = '$setor' WHERE idusuario = '$idusuario'";
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	$Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
?>
<script language="javascript">alert('Registro Atualizado com Sucesso!');window.location.href='corpo_do_sistema.php';</script>
<? } ?>
<? if($modo=='excluindo'){ 
		$sql = "delete from usuario where idusuario = $idusuario";
		$process = mysql_query($sql) or die("Erro: " . mysql_error());
		?><script language="javascript">alert(' Usuário excluído');window.location.href='corpo_do_sistema.php';</script><?
		} ?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>DIPAT - Divisão de Patrimônio</title>
	<script>
		var ie = /msie/i.test(navigator.userAgent);      
		var ieBox = ie && (document.compatMode == null || document.compatMode == "BackCompat");      	
		function checkSize() {
			var canvasEl = ieBox ? document.body : document.documentElement;        
			var w = window.innerWidth || canvasEl.clientWidth;        
			var h = window.innerHeight || canvasEl.clientHeight;        
			document.getElementById("DIV#teste").style.width = Math.max(0, w) + "px";
			document.getElementById("DIV#teste").style.height = Math.max(0, h) + "px";
	      
			}
			window.onload = checkSize;
			window.onresize = checkSize;
		</script>
	<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
	<script language="JavaScript" src="date-picker.js"></script>
	</HEAD>
	<body class='corpo'>
	<DIV ID="DIV#teste">
	<center>
	<br>
	</head>
	<body>
	<table align="center" width="20%" cellpadding="0" cellspacing="0"> 
	<BR><TR align='center'> 
			<td align="center" colspan="2" class="titulo"></strong> 
						<div align="center">&nbsp;DETALHES DO USUÁRIO&nbsp;</strong></div>
			</td>
	</table>
	<?	
		$sql="select * from usuario";
		$sql = $sql." where idusuario = ".$idusu."";	
		$sql = $sql." order by nome";
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');		
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
		} ?>
	<form action="detalhes_usuario.php" method="POST" name="form" target="_self" >	
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
					<td><input name='nome_usuario' type='text' id='nome_usuario' size='40' maxlength='40' class='caixa' value='<? echo ($nome_usuario); ?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";' ></td>
				</tr>  
				<tr>
					<td><div align='right'>Login:&nbsp;</div></td>
					<td><input type='text' name='login_usuario' size='12'maxlength='12' class='caixa' value='<? echo $login_usuario?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";'></td>
				</tr> 
<? if ($_SESSION['perfil']==1) { ?>
				<tr>
					<td><div align='right'>Senha:&nbsp;</div></td> 
					<td><input name='senha_usuario' type="password" id='senha_usuario' size='8' maxlength='18' class='caixa' value='<? echo $senha_usuario?>' onChange='javascript:document.form.Gravar.style.visibility = "visible";'></td>
				</tr>
				<tr>
					<td><div align='right'>Lembrete:&nbsp;</div></td> 
					<td><input name='lembrete' type='text' id='lembrete' size='30' maxlength='30' class='caixa' value='<? echo $lembrete?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";'></td>
				</tr>			 		
				<tr>
					<td><div align='right'>Perfil:&nbsp;</div></td> 
				 	<td><input name='perfila' type='text' id='perfila' size='15' maxlength='15' class='caixa' value='<? echo $perfila?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";' >
					</td>
				</tr>
				<tr>
					<td><div align='right'>CPF:&nbsp;</div></td> 
			 	<td><input name='cpf' type='text' id='cpf' size='15' maxlength='15' class='caixa' value='<? echo $cpf?>' onClick='javascript:document.form.Gravar.style.visibility = "visible";' ></td>
				</tr> 		
<? } ?>
				<tr>
					<td><div align='right'>Setor:&nbsp;</div></td> 
					<td><select name='setor' id='setor' onFocus='Focus();' class="cor-inativa" title='Setor do Usuário (Funarte)' onChange='javascript:document.form.Gravar.style.visibility = "visible";document.form.Gravar.focus();' onBlur="Blur(this);"><? 
			$sqlquery = "select * from setor order by setor";
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET character_set_connection=utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_results=utf8');
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($setor=="") 
				{ ?>
			<option value=''>Selecione  o setor</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
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
			</table> 		
	<br><br>
	<center>
	<? if ($_SESSION['perfil']==1) { ?>
			<input type="button" onClick="javascript:confirmausu();" name="Gravar" class="botao" id="Gravar" value="GRAVAR" alt="Gravar">
			<input type="hidden" name="modo" value="gravando">
			<input type="button" onClick="javascript:window.location.href='detalhes_usuario.php?modo=excluindo';" name="Excluir" class="botao" id="Excluir" value="EXCLUIR" alt="Excluir Usuário">&nbsp;&nbsp;
	<? } ?>
	<? // *****************  BOTÕES  *********************  ?>
	<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOTÕES  *********************  ?>
	</center>
	</form>
	<script language="javascript">
		document.form.Gravar.style.visibility = "hidden";
	</script>
	<script language="javascript">
		function confirmausu() {
		        if (confirm('Confirma Alteração?')){
 	           		form.submit();
				}
		}

	</script>
	</body>
	</html>
