<?
include "header.php";
include "conexao.php";
connect();
$dataenc = date("Y-m-d");
$horaenc= gmdate("H:i:s" ,time()-(3570*2));
?>
<html>
<head>
<title>HelpDesk Funarte</title>
</head>


<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" bgcolor="white" style="border-collapse: collapse; border: 1px solid silver" bordercolor="#111111" width="500">
    <tr>
      <td width="50" height="50">&nbsp;</td>
      <td height="50" width="420"><div align="center"></div></td>
      <td width="50" height="50">&nbsp;</td>
    </tr>
    <tr>
      <td width="50" height="205">&nbsp;</td>
      <td width="420" height="205">
<?
if ($login!="" && $senha!="" && $novasenha!="") 
	{ ?> 
		<form name="form" method="POST" action="grava_novasenha.php">
<? 	} else { ?>
		<form name="form" method="POST" action="altera_senha.php">
<? 	} ?>
<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="400" height="205" background="imagebox/logo_abertura.png">
    <tr>
      <td>
      <div align="center">
        <center>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="390">
          <tr>
            <td width="161">&nbsp;</td>
            <td width="152">&nbsp;</td>
            <td width="77">&nbsp;</td>
          </tr>
          <tr>
            <td width="161">&nbsp;</td>
            <td width="152">&nbsp;</td>
            <td width="77">&nbsp;</td>
          </tr>
          <tr>
            <td width="161">&nbsp;</td>
            <td width="152">&nbsp;</td>
            <td width="77">&nbsp;</td>
          </tr>
          <tr>
            <td width="161" align="right"><font face="verdana" size="1" color="#666666"><b>Login:</b></td>
            <td width="152"><input type="text" name="login" size="20" tabindex="1" value="<? echo $login; ?>"></td>
            <td width="77"></td>
          </tr>
		  <tr>
            <td width="161" align="right"><font face="verdana" size="1" color="#666666"><b>Senha Atual:</b></td>
            <td width="152"><input type="password" name="senha" id="senha" size="20" tabindex="2"  value="<? echo $senha; ?>" onChange="form.submit();"></td>
            <td width="77">&nbsp;</td>
		  </tr>
          <tr>
            <td width="161" align="right"><font face="verdana" size="1" color="#666666"><b>Nova Senha:</b></td>
            <td width="152"><input type="password" name="novasenha" id="novasenha" size="20" tabindex="3" value="<? echo $novasenha; ?>"></td>
            <td width="77">&nbsp;</td>
          </tr>
          <tr>
            <td width="161">&nbsp;</td>
            <td width="152"><center><input type="button" value="Gravar" name="B1" tabindex="4" onClick="form.submit();"></center></td>
            <td width="77">&nbsp;</td>
          </tr>

          <tr>
            <td colspan="3"></td>
          </tr>
        </table>
        </center>
      </div>
      </td>
    </tr>
  </table>
  </center>
</div>
</form>
      </td>
      <td width="50" height="205">&nbsp;</td>
    </tr>
    <tr>
      <td width="50" height="50">&nbsp;</td>
      <td height="50" width="420"><center><font face="verdana" size="1" color="#006699"><b>Entre com o seu login de acesso, senha atual e a nova senha</b></font></center></td>
      <td width="50" height="50">&nbsp;</td>
    </tr>
  </table>
  </center>
</div>
<?
if ($login!="") {
	?><script>form.senha.focus();</script><?
} else {
	?><script>form.login.focus();</script><?
}
if ($login!="" && $senha!="" && $novasenha=="") 
{
	$sql = "select * from usuario";
	$sql = $sql. " where login = '" . $login . "'";
	$sql = $sql. " and senha = '" . $senha . "'";
	$process = mysql_query($sql) or die("Query invalida: " . mysql_error());
	if (mysql_num_rows($process) > 0) 
	{
		?><script>document.form.novasenha.focus();</script><?
	} else {
		?><script>alert('Seu login ou senha atual estão incorretos.\nSolicite auxílio ao Protocolo.');window.location.href="index.php";</script><?
	}
}
if ($login!="" && $senha!="" && $novasenha!="") 
{ ?><script>var answer = confirm('ATENÇÃO! \n\n Sua senha atual será alterada!\nTem certeza que deseja continuar? ')
	if (answer){ 
		window.location.href="grava_novasenha.php?login=<? echo $login; ?>&senha=<? echo $senha; ?>&novasenha=<? echo $novasenha; ?>"; 
	} else { 
		window.location.href="index.php";
	}
	</script>
<?
}
?>
</body>
</html>

