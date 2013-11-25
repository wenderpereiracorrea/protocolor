<? 
     include "conexao.php";
     include "valida_user.php";
    $date = date("d/m/y");
    $hora= gmdate("H:i" ,time()-(3570*2));

?>



<html>
<head><title><?  echo $Title ?></title>
<base target="principal">

<div id="link" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Lançar Processos</b></font>
</div>
<div id="link1" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Alterar Processos</b></font>
</div>
<div id="link2" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Consultar Processos</b></font>
</div>
<div id="link3" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Encaminhar Processos</b></font>
</div>
<div id="link4" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Confirmar recebimento</b></font>
</div>
<div id="link5" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Gerar Relatórios</b></font>
</div>
<div id="link6" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b></b>Gerar Etiquetas</font>
</div>
<div id="link7" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Relação de Usuários</b></font>
</div>
<div id="link8" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Informações sobre o Sistema</b></font>
</div>
<div id="link9" style="position:absolute; z-index:1; visibility: hidden; background-color: #FFFFFF; layer-background-color: #FFFFCC; border: 1px none #000000; left: 52px; top: 16px;">
<font size="1" face="Verdana" color="#000000"><b>Sair do Sistema</b></font>
</div>

<script language="JavaScript" type="text/JavaScript">
//detectando navegador
sAgent = navigator.userAgent;
bIsIE = sAgent.indexOf("MSIE") > -1;
bIsNav = sAgent.indexOf("Mozilla") > -1 && !bIsIE;

//setando as variaveis de controle de eventos do mouse
var xmouse = 0;
var ymouse = 0;
document.onmousemove = MouseMove;

//funcoes de controle de eventos do mouse:
function MouseMove(e){
 if (e) { MousePos(e); } else { MousePos();}
}

function MousePos(e) {
 if (bIsNav){
  xmouse = e.pageX;
  ymouse = e.pageY;
 } 
 if (bIsIE) {
  xmouse = document.body.scrollLeft + event.x;
  ymouse = document.body.scrollTop + event.y;
 }
}

//funcao que mostra e esconde o hint
function Hint(objNome, action){
 //action = 1 -> Esconder
 //action = 2 -> Mover
 
 if (bIsIE) {
  objHint = document.all[objNome]; 
 }
 if (bIsNav) {
  objHint = document.getElementById(objNome);
  event = objHint;
 }
 
 switch (action){
  case 1: //Esconder
   objHint.style.visibility = "hidden";
   break;
  case 2: //Mover
   objHint.style.visibility = "visible";
   objHint.style.left = xmouse + 15;
   objHint.style.top = ymouse + 15;
   break;
 }
 
}

</script>

</head>

<body bgcolor="<?  echo $cor_pagina ?>">

&nbsp;&nbsp;
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="178">
  <tr>
    <td width="35" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="8" height="1" bgcolor="#426DAE">&nbsp;</td>
    <td width="124" height="1" bgcolor="#426DAE"><b><font face="verdana" size="1"><a target="principal" style="text-decoration: none" href="lanca_processo.php" onMouseMove="Hint('link',2)" onMouseOut="Hint('link',1)"><font color="#FFFFFF">Menu de Op&ccedil;&otilde;es </font></a></font></b></td>
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
    <a target="principal" style="text-decoration: none" href="lanca_processo.php?modolan=0" onMouseMove="Hint('link',2)" onMouseOut="Hint('link',1)">
    <font color="#FFFFFF">Lançamento</font></a></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>
<? if ($_SESSION["login"] == 'jorge' || $_SESSION["login"] == 'paulinho' || $_SESSION["login"] == 'ronaldo') { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/alteracao.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a target="principal" style="text-decoration: none" href="altera_processo.php" onMouseMove="Hint('link1',2)" onMouseOut="Hint('link1',1)">
    <font color="#FFFFFF">Alteração</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
<? } ?>
<tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/pesquisa.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
	<a  target="principal" href="pesquisa.php" style="text-decoration: none" onMouseMove="Hint('link2',2)" onMouseOut="Hint('link2',1)">
	 <font color="#FFFFFF">Pesquisa</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>  
<? if ($_SESSION["perfil"] == 1 or $_SESSION["perfil"] == 2) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/encaminha.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a href="encaminha.php" style="text-decoration: none" onMouseMove="Hint('link3',2)" onMouseOut="Hint('link3',1)">
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
    <a href="lista_processo.php?lista_setor=<? echo $setor_usuario; ?>&tipo=confirma" style="text-decoration: none" onMouseMove="Hint('link4',2)" onMouseOut="Hint('link4',1)">
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
    <font face="verdana" size="1"><a href="menu_rel.php" style="text-decoration: none" onMouseMove="Hint('link5',2)" onMouseOut="Hint('link5',1)">
    <font color="#FFFFFF">Relatórios</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
<? if ($_SESSION["perfil"] == 1) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/etiqueta.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a  target="principal" href="etiqueta.php" style="text-decoration: none" onMouseMove="Hint('link2',2)" onMouseOut="Hint('link2',1)">
	<font color="#FFFFFF">Etiquetas</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
<? if ($_SESSION["perfil"] == 1 or $_SESSION["perfil"] == 2 ) { ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/usuarios.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><b>
    <font face="verdana" size="1">
    <a href="lista_usuario.php" style="text-decoration: none" onMouseMove="Hint('link7',2)" onMouseOut="Hint('link7',1)">
    <font color="#FFFFFF">Usuários</font></a></font></b></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <? } ?>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/sistema.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><font face="verdana" size="1">
    <b><a target="principal" href="sobre.php" style="text-decoration: none" onMouseMove="Hint('link8',2)" onMouseOut="Hint('link8',1)">
    <font color="#FFFFFF">Sobre o Sistema</font></a></b></font></td>
    <td width="11" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td width="35" height="30" bgcolor="#FFFFFF">
    <img border="0" src="imagebox/saida.png" width="30" height="30"></td>
    <td width="8" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF">&nbsp;</td>
    <td width="124" bgcolor="#426DAE" height="30" style="border-top: 1px solid #FFFFFF; border-bottom: 1px solid #FFFFFF"><font face="verdana" size="1">
    <b><a target="_top" href="logout.php" style="text-decoration: none" onMouseMove="Hint('link9',2)" onMouseOut="Hint('link9',1)">
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

</html>
