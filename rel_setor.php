<?php header("Content-type: text/html; charset=UTF-8");?> 
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
			<div align="center"><strong>DISTRIBUIÇÃO DOS PROCESSOS&nbsp;</strong></div>
		</td>
	</tr>
</TABLE>
<BR><BR>
<form action="rel_setor.php" method="POST" name="form" target="_self">
  <br>
  <br>
<input name="Voltar" value="Sair" class="botao" onClick="javascript: window.location.href='corpo_do_sistema.php';" type="button">
<BR><br><br>
<TABLE width="75%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >
<tr>
<td><center>Setor:
<select name='pesqsetor'  class="caixa" onChange="form.submit();" >
				<?
					$sqlquery = "select * from setor";
					$sqlquery = $sqlquery." order by setor";
					echo "SQL = ".$sqlquery;
					$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
					if ($pesqsetor<>'') {
						echo "<option value='$pesqsetor'>$pesqsetor</option>\n";
					} else {
						echo "<option value=''>Todos</option>\n";
					}
					while ($line = mysql_fetch_array($process)) {
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						echo "<option value='$setor'>$setor - $descricao</option>\n";														
					}
					mysql_free_result($process);					

				 ?>
					</select>
&nbsp;</center></td></tr>
</TABLE><br>
<BR>	
<TABLE width="80%" BORDER=0 align="center" cellpadding="1" cellspacing="1">
	<tr>
	  <td width="3%" style="visibility:hidden"><center>ID</center></td><td width="20%" class="caixadestaque"><center><a href="rel_setor.php?ordem=processo&pesqsetor=<? echo $pesqsetor; ?>">PROCESSO</a></center></td><!--td width="15%" class="caixadestaque"><center>ENCAMINHAMENTO</center></td--><td width="70%" class="caixadestaque"><center><a href="rel_setor.php?ordem=assunto&pesqsetor=<? echo $pesqsetor; ?>">ASSUNTO</a></center></td><td width="10%" class="caixadestaque"><center><a href="rel_setor.php?ordem=setor&pesqsetor=<? echo $pesqsetor; ?>">SETOR</a></center></td>
	</tr>
<? 
		//if ($datainipesq<>"" && $datainipesq<>"") { }

		$sqlquery = "select P.nprocesso, P.assunto,P.localizacao from processo P";
		if ($pesqsetor!="") {
			$sqlquery = $sqlquery."  where localizacao = '".$pesqsetor."'";
		} else {
			$sqlquery = $sqlquery." where P.localizacao <> 'ARQUIVO'";
		}
		if ($ordem=="" || $ordem=="setor") {
			$sqlquery = $sqlquery."  order by localizacao";
		}
		if ($ordem=="processo") {
			$sqlquery = $sqlquery."  order by nprocesso";
		}
		if ($ordem=="assunto") {
			$sqlquery = $sqlquery."  order by assunto";
		}
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
		if (mysql_num_rows($process) > 0) {
					while ($line = mysql_fetch_array($process)) {
						$id = $line['idprocesso'];
						$processo = $line['nprocesso'];
						//$data = $line['data'];
						$assunto = $line['assunto'];
						$localizacao = $line['localizacao'];
						?>
						<tr>
							<td style="visibility:hidden"><? echo ($id); ?></td><td class="caixa"><? echo ($processo); ?></td><!--td class="caixa"><? echo tdate($data,1); ?></td--><td class="caixa"><? echo ($assunto); ?></td><td class="caixa"><? echo ($localizacao); ?></td>
						</tr>
						<?
					}
		}
				mysql_free_result($process);					
?>		
</TABLE>
</form>
</center>
</HEAD>
</HTML>