<?php header("Content-type: text/html; charset=UTF-8");?> 
<?php
session_start(); // Inicializa a sessão
include "conexao.php";
connect();
$date = date("d/m/y");

$hora= gmdate("H:i" ,time()-(3570*2));
$login = addslashes($_POST["login"]);
$senha  = md5(addslashes($_POST["senha"]));
if ($login=="" and ($senha == "" or $senha == "***")) 
{
?>
  <script language="JavaScript">
   alert("Você não possui cadastro no sistema.\n\nFicará limitado somente para consultas.");
  </script>
<?php 
	$login = 'usuario';
	$senha = 'funarte';
	$senha = md5($senha);
}
$sql = "select U.idusuario, U.nome, U.login, U.senha, U.perfil,U.setor,S.codigo";
$sql = $sql. " from usuario U, setor S";
$sql = $sql. " where U.login = '" . $login . "'";
$sql = $sql. " and U.senha = '" . $senha . "'";
if ($login!='usuario') 
{
	$sql = $sql. " and S.setor = U.setor"; 
}
$process = mysql_query($sql) or die("Query invalida: " . mysql_error());
if (mysql_num_rows($process) > 0) 
{
        $line = mysql_fetch_array($process);
        $_SESSION["idusuario"] = $line['idusuario'];
        $_SESSION["nome"] = $line['nome'];
        $_SESSION["login"] = $line['login'];
        $_SESSION["senha"] = $line['senha'];
        $_SESSION["perfil"] = $line['perfil'];
		$_SESSION["codigosetor"] = $line['codigo'];
        $_SESSION["setor_usuario"] = $line['setor'];
        $_SESSION["codigo"] = $line['codigo'];
        ?>
           <script>window.location.href='inicial.php';</script>
        <?
        $sql_ins = "insert into historico (usuario, data, hora, acao,ip) values ('" . $_SESSION["nome"] . "','" .tdate($date,0). "','" . $hora  . "','Entrou no Sistema','".get_ip()."')";
        mysql_query($sql_ins);
} else { ?>
   <script language="JavaScript">
    alert("Usuário e/ou Senha incorreta!");
    window.location.href = 'index.php';
  </script>
<? 
}
?>
<center>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table align="center" cellpadding="0" cellspacing="0" width="60%">
<tr><td><font color="#3366CC"><b>AGUARDE. SEU LOGIN E SENHA ESTÃO SENDO IDENTIFICADOS...</b></font></td></tr>
</table>
</center>