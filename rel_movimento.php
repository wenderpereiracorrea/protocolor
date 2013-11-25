<? import_request_variables("gP"); ?>
<? 
session_start();
include "conexao.php";
connect();
	// ******************* TRANSFORMA A APRESENTAÇÃO DA DATA ****** INÍCIO *********************// ******************* TRANSFORMA A APRESENTAÇÃO DA DATA ****** FIM *********************	

?>
<HTML>
<HEAD>
<TITLE>Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="date-picker.js"></script>
<script language="JavaScript">
function FormataDataIni(pForm, pCampo,pTeclaPres) { 
      var wTecla = pTeclaPres.keyCode; 
      wVr = pForm[pCampo].value; 
      wVr = wVr.replace( ".", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
       
      wTam = wVr.length + 1; 

      if ( wTecla != 9 && wTecla != 8 ){ 
            if ( wTam > 2 && wTam < 5 ) 
                  pForm[pCampo].value = wVr.substr( 0, wTam - 2  ) + '/' + wVr.substr( wTam - 2, wTam ); 
            if ( wTam >= 5 && wTam <= 10 ) 
                  pForm[pCampo].value = wVr.substr( 0, 2 ) + '/' + wVr.substr( 2, 2 ) + '/' + wVr.substr( 4, 4 );  
      }                   
}
function FormataDataFim(pForm, pCampo,pTeclaPres) { 
      var wTecla = pTeclaPres.keyCode; 
      wVr = pForm[pCampo].value; 
      wVr = wVr.replace( ".", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
      wVr = wVr.replace( "/", "" ); 
       
      wTam = wVr.length + 1; 

      if ( wTecla != 9 && wTecla != 8 ){ 
            if ( wTam > 2 && wTam < 5 ) 
                  pForm[pCampo].value = wVr.substr( 0, wTam - 2  ) + '/' + wVr.substr( wTam - 2, wTam ); 
            if ( wTam >= 5 && wTam <= 10 ) 
                  pForm[pCampo].value = wVr.substr( 0, 2 ) + '/' + wVr.substr( 2, 2 ) + '/' + wVr.substr( 4, 4 );  
      }                  
} 
</script>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #0000CC;
}
-->
</style>
</HEAD>
<body class='corpo'>
<center>
<br><br>		
<TABLE width="30%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
	<tr align='center'> 
		<td align="center" colspan="5" class="titulo">
			<div align="center"><strong>&nbsp;HISTÓRICO&nbsp;</strong></div>
		</td>
	</tr>
</TABLE>
<BR><BR>
<form action="rel_movimento.php" method="POST" name="form" target="_self">
<TABLE width="75%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >
<tr><td>
<center>
Data Inicial:<input type='text' name='datainipesq' size='10' class='caixa' onKeyPress="javascript:SoNumero();" OnKeyDown='FormataDataIni(form, this.name, event)' onKeyUp='Mostra(this, 10)' value="<? echo $datainipesq; ?>">&nbsp;<a href="javascript:show_calendar('form.datainipesq');"><img src="imagebox/show-calendar.gif" width=20 height=16 border=0></a>&nbsp;&nbsp;Data Final:<input type='text' name='datafimpesq' size='10' class='caixa' onKeyPress="javascript:SoNumero();" onFocus='nextfield =pesqnome;' OnKeyDown='FormataDataFim(form, this.name, event)' onKeyUp='Mostra(this, 10); ' value="<? echo $datafimpesq; ?>">&nbsp;<a href="javascript:show_calendar('form.datafimpesq');"><img src="imagebox/show-calendar.gif" width=20 height=16 border=0></a></center></td></tr><tr><td><center>Pesquisar por:
<select name='pesqnome'  class="caixa" onChange="form.submit();" >
				<?
					$sqlquery = "select * from usuario order by login";
					$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if ($pesqnome<>'') {
						echo "<option value='$pesqnome'>$pesqnome</option>\n";
					} else {
						echo "<option value=''>Todos</option>\n";
					}
					while ($line = mysql_fetch_array($process)) {
						$nome_usuario = $line['nome'];
						echo "<option value='$nome_usuario'>$nome_usuario</option>\n";														
					}
					mysql_free_result($process);					

				 ?>
					</select>
&nbsp;</center></td></tr>
</TABLE><br><br>
<input name="pesquisar" value="Pesquisar" class="botao" type="submit">
<BR><BR>	
<TABLE width="80%" BORDER=0 align="center" cellpadding="1" cellspacing="1">
	<tr>
	  <td width="3%" style="visibility:hidden"><center>ID</center></td><td width="15%" class="caixadestaque"><center><a href="rel_movimento.php?ordem=data&pesqnome=<? echo $pesqnome; ?>">DATA</a></center></td><td width="10%" class="caixadestaque"><center>HORA</center></td><td width="10%" class="caixadestaque"><center><a href="rel_movimento.php?ordem=maquina&pesqnome=<? echo $pesqnome; ?>">MÁQUINA</a></center></td><td width="15%" class="caixadestaque"><center><a href="rel_movimento.php?ordem=usuario&pesqnome=<? echo $pesqnome; ?>">USUÁRIO</a></center></td><td width="47%" class="caixadestaque"><center><a href="rel_movimento.php?ordem=acao&pesqnome=<? echo $pesqnome; ?>">AÇÃO</a></center></td>
	</tr>
<? 
		if ($datainipesq<>"" && $datainipesq<>"") { 

		$sqlquery = "select * from historico ";
		
		//if ($pesqnome<>"") {
		$sqlquery = $sqlquery." where usuario <> '".$pesqnome."'";
		//}
		if ($datainipesq<>"" && $datafimpesq=="") { 
			$sqlquery = $sqlquery." and data = '".tdate($datainipesq,0)."'";
		}
		if ($datainipesq<>"" && $datafimpesq<>"") { 
			$sqlquery = $sqlquery." and data >= '".tdate($datainipesq,0)."'";
			$sqlquery = $sqlquery." and data <= '".tdate($datafimpesq,0)."'";
		}
		if ($ordem == "") {			
			$sqlquery = $sqlquery." order by id desc, hora desc";
		}
		if ($ordem == "data") {			
			$sqlquery = $sqlquery." order by data desc, hora desc";
		}
		if ($ordem == "maquina") {			
			$sqlquery = $sqlquery." order by ip";
		}
		if ($ordem == "usuario") {			
			$sqlquery = $sqlquery." order by usuario";
		}
		if ($ordem == "acao") {			
			$sqlquery = $sqlquery." order by acao";
		} 
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($process) > 0) {
					while ($line = mysql_fetch_array($process)) {
						$id = $line['id'];
						$data = $line['data'];
						$hora = $line['hora'];
						$usuario_hist = $line['usuario'];
						$ip = $line['ip'];
						$acao = $line['acao'];
						?>
						<tr>
							<td style="visibility:hidden"><? echo ($id); ?></td><td class="caixa"><? echo tdate($data,1); ?></td><td class="caixa"><? echo ($hora); ?></td><td class="caixa"><? echo ($ip); ?></td><td class="caixa"><? echo ($usuario_hist); ?></td><td class="caixa"><? echo ($acao); ?></td>
						</tr>
						<?
					}
		}
				mysql_free_result($process);					
}
?>		
</TABLE>
</form>
</center>
</HEAD>
<? include "footer.php" ?>
</HTML>