<?php
     include "conexao.php";
     include "valida_user.php";
	 connect();
?>

<HTML>
<HEAD>
 <TITLE><?php echo $Title ?></TITLE>
</HEAD>
<BODY bgcolor="<?php echo $cor_pagina ?>">
<br>
<table width="600" align="center" border="0">
<tr>
<td><center><img src="imagebox/logo_sistema.png"></center></td>
</tr>
<tr>
<td><center>
  <font face="verdana" size="2" color="<?php echo $cor_outros_textos ?>"><b>Sistema Desenvolvido pela Divis&atilde;o de Inform&aacute;tica </b></font>
</center></td>
</tr>

<tr>
<td><font face="verdana" size="2" color="<?php echo $cor_outros_textos ?>">&nbsp;</font><center>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">Fase de Produ&ccedil;&atilde;o</font></p>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">Linguagem PHP</font></p>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">Banco de Dados MYSQL</font></p>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">Scripts Client Side</font></p>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">Melhor Visualizado na Resolu&ccedil;&atilde;o 1024 x 768 </font></p>
</center></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><center>
  <b><font color="#3300CC" size="-1"><a href="protocolo.pdf">Manual de Aplicação</a></font></b>
</center></td>
</tr>
<tr>
<td><center>
  <p>&nbsp;</p>
  <p><font color="<?php echo $cor_outros_textos ?>" size="2" face="verdana">dinfo@funarte.gov.br<br>
    2533-8090 r. 216 <br>
    Administração: Julio Cesar Cavadas</font></p>
</center></td>
</tr>
</table>

</BODY>
</HTML>
