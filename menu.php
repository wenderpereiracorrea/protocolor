
<? session_start(); ?>
<?
	include "conexao.php";
    $date = date("d/m/y");
    $hora= gmdate("H:i" ,time()-(3570*2));
?>
<div class="container-fluid">
	<div class="row-fluid">
<div class="span2 ">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
<link rel="stylesheet" href="css/template.css" type="text/css" />
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="178">
  <tr>
    <td width="35" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="8" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="124" height="1" bgcolor="#426DAE"><b><font face="verdana" size="1"><font color="#FFFFFF">Menu de Op&ccedil;&otilde;es </font></font></b></td>
    <td width="11" height="1" bgcolor="#426DAE">&nbsp;</td>
  </tr>
  <tr>
    <td width="35" height="3"></td>
    <td width="8" height="3"></td>
    <td width="124" height="3"></td>
    <td width="11" height="3"></td>
  </tr>
<? if ($_SESSION["perfil"] == 1) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/lancamento.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="lanca_protocolo_sistema.php?modolan=0">
    <font color="#FFFFFF">Protocolar</font></a></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>  
<? if ($_SESSION["perfil"] == 1) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/lancamento.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="lanca_processo.php?modolan=0">
    <font color="#FFFFFF">Lançar processo</font></a></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>
<? if ($_SESSION["setor_usuario"] == "Presidencia" || $_SESSION["login"] == 'wendercorrea' || $_SESSION["login"] == 'ronaldo' || $_SESSION["login"] == 'viniciuspandin') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/lancamento.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="lanca_processo_jupiara.php?modolan=0">
    <font color="#FFFFFF">Lançamento Presidência</font></a></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>


<? if ($_SESSION["setor_usuario"] == 'Servico de Arquivo Historico e Institucional' || $_SESSION["login"] == 'ronaldo' || $_SESSION["login"] == 'wendercorrea' || $_SESSION["login"] == 'viniciuspandin') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/alteracao.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="altera_processo.php">
    <font color="#FFFFFF">Alteração</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>

<? if ($_SESSION["setor_usuario"] == 'Servico de Arquivo Historico e Institucional' || $_SESSION["login"] == 'ronaldo' || $_SESSION["login"] == 'wendercorrea' || $_SESSION["login"] == 'viniciuspandin') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/alteracao.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="circulacao.php">
    <font color="#FFFFFF">Circulação</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>

<tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/pesquisa.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
	<a  target="principal" href="pesquisanome.php" style="text-decoration: none">
	 <font color="#FFFFFF">Pesquisa</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>  
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/relatorio.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1"><a  target="principal" href="listagem_setor.php" style="text-decoration: none">
    <font color="#FFFFFF">Processos por setor</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>


<? if ($_SESSION["perfil"] == 1 or $_SESSION["perfil"] == 2) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/encaminha.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" href="encaminha.php" style="text-decoration: none">
     <font color="#FFFFFF">Encaminhamento</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
  <? if ($_SESSION["perfil"] == 1 or $_SESSION["perfil"] == 2 or $_SESSION["perfil"] == 3) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/confirma.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" href="recebimento.php" style="text-decoration: none">
     <font color="#FFFFFF">Recebimento</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
<? if ($_SESSION["perfil"] == 1) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/relatorio.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1"><a target="principal" href="menu_rel.php" style="text-decoration: none">
    <font color="#FFFFFF">Relatórios</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
<? if ($_SESSION["perfil"] == 1) { ?>
  <!--<tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/etiqueta.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a  target="principal" href="etiqueta.php" style="text-decoration: none">
	<font color="#FFFFFF">Etiquetas</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>-->
  <? } ?>
  
  <? if ($_SESSION["perfil"] == 1) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/etiqueta.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a  target="principal" href="processo" style="text-decoration: none">
	<font color="#FFFFFF">Etiquetas</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>

<? if ($_SESSION["login"] == 'ronaldo' || $_SESSION["setor_usuario"] == 'Servico de Arquivo Historico e Institucional' || $_SESSION["login"] == 'wendercorrea' || $_SESSION["login"] == 'viniciuspandin') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/relatorio.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" href="lista_usuario.php" style="text-decoration: none">
    <font color="#FFFFFF">Usuários.</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/sistema.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><font face="verdana" size="1">
    <b><a target="principal" href="sobre.php" style="text-decoration: none">
    <font color="#FFFFFF">Sobre o Sistema</font></a></b></font></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>

<? if ($_SESSION["login"] != "usuario") { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/sistema.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><font face="verdana" size="1">
    <b><a target="principal" href="alterar_senha.php" style="text-decoration: none">
   <font color="#FFFFFF">Alterar Senha</font></a></b></font></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>

<? if ($_SESSION["login"] == 'ronaldo' || $_SESSION["setor_usuario"] == 'Servico de Arquivo Historico e Institucional' || $_SESSION["login"] == 'wendercorrea' || $_SESSION["login"] == 'viniciuspandin') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/alteracao.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="usuarios.php">
    <font color="#FFFFFF">Usuários.</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>

  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/saida.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><font face="verdana" size="1">
    <b><a target="_top" href="logout.php" style="text-decoration: none">
   <font color="#FFFFFF">Logout do Sistema</font></a></b></font></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="35" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="8" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="124" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="11" height="1" bgcolor="#426DAE">&nbsp;</td>
  </tr>
</table>
<? if ($opalt==1) { ?>
<form name="form" action="valida_user.php" method="post">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="178"><tr>
<td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#CC0000"><b><p>
<center>Acesso Restrito!</center>
<center>Entre com o login</center> <center>e senha de autorização</center>
</p></b></font></td>
          <tr>
            <td align="right"><font face="verdana" size="1" color="#666666"><b>Login:</b></font></td>
            <td><input type="text" name="login1" size="10"></td>
		  </tr>
		   <tr>	
			<td align="right"><font face="verdana" size="1" color="#666666"><b>Senha:</b></font></td>
            <td><input type="text" name="senha1" size="10"></td></tr><tr>
			<td colspan="3"><center><input type="submit" value="Entrar" name="B1"></center></td>
          </tr>
</tr></table>
</a>
</form>
<script language="javascript">
document.form.login1.focus();
</script>
<? $opres = 0; } ?>
</body>


</div>
	<link rel="stylesheet" href="css/validationEngine.jquery.css"type="text/css" />
	<link href="css/index.css" rel="stylesheet">
	<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="js/languages/jquery.validationEngine-pt_BR.js"	type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.validationEngine.js"	type="text/javascript" charset="utf-8"></script>
	<script src="js/jsValidate.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>