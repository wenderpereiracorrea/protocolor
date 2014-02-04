<? 
@session_start();
include "conexao.php";
connect();
$date = date("d/m/y");
$hora= gmdate("H:i" ,time()-(3570*2));
if ($login_sol==$login) { ?>
<script>alert('Deve ser escolhido outro usuário autorizado!');</script><?
$login_sol="";
}
if ($login_sol!="" & $password!="") 
{
	$sql = "select U.idusuario, U.nome, U.login, U.senha, U.perfil,U.setor,S.codigo";
	$sql = $sql. " from usuario U, setor S";
	$sql = $sql. " where U.login = '" . $login_sol . "'";
	$sql = $sql. " and U.senha = '" . $password . "'";
	$sql = $sql. " and S.setor = U.setor"; 
	$process = mysql_query($sql) or die("Query invalida: " . mysql_error());
	if (mysql_num_rows($process) > 0) 
	{
		$line = mysql_fetch_array($process);
		$usuario_sol = $line['nome'];
		$sql_ins = "insert into historico (usuario, data, hora, acao,ip) values ('" . $usuario_sol . "','" . tdate($date,0) . "','" . $hora  . "','Habilitou Alteração','".get_ip()."')";
    	$process = mysql_query($sql_ins) or die("Query invalida: " . mysql_error());
?>		<script>alert('O usuário <? echo $usuario_sol; ?> está participando das alterações!');window.location.href='altera_processo.php';</script> <?		
	} else {
?>	<script language="JavaScript">
		alert("Usuário não Cadastrado ou Senha Incorreta!");
    	window.location.href = 'autoriza.php';
	  </script>
<? 	}
}
?>
<html>
<head>
<link href="auxiliar/styles.css" rel=stylesheet type=text/css>
<style type="text/css">
<!--
.style1 {color: #003300}
-->
</style>
</head>
<body><br><br><br><br><br><br><br><br><br>
<table align="center" cellpadding="0" cellspacing="5" width="40%">
	<tr>
		<td colspan="2"><center>
		  <h5 class="style1" >Para alterações é necessária a participação solidária de outro usuário cadastrado!</h5>
		</center></td>
	</tr>
</table>
<form action="autoriza.php" method="POST" name="form" target="_self" >
<center>
<table>
	<tr>
		<td class="caixadestaque"><b>Usuário:</b></td>&nbsp;&nbsp;<td><input type="text" name="login_sol" id="login_sol" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="10" tabindex="1"></td>
    </tr>
    <tr>
		<td  class="caixadestaque"><b>Senha:</b></td>&nbsp;&nbsp;<td><input type="password" name="password" id="password" class="cor-inativa" onFocus="Focus(this);" onBlur="Blur(this);" size="10" tabindex="2"></td>
	</tr>
    <tr>
        <td colspan="2">&nbsp;</td>
	</tr>
    <tr>           
        <td colspan="2" ><input type="submit" value="Entrar" name="B1" tabindex="3"><input type="button" value="Voltar" name="B2" tabindex="4" onClick="history.back();"></td>
	</tr>
<script>
if (document.form.login_sol.value=="") 
{
	document.form.login_sol.focus();
} else {
	document.form.password.focus();
}	
</script>         
</table>
</center>
</form>
</body>
</html>
