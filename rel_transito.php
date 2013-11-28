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
			<div align="center"><strong>&nbsp;PROCESSOS EM TRÂNSITO&nbsp;</strong></div>
		</td>
	</tr>
</TABLE>
<BR><BR>
<form action="rel_transito.php" method="POST" name="form" target="_self">
  <br>
  <br>
<input name="Voltar" value="Sair" class="botao" onClick="javascript: window.location.href='corpo_do_sistema.php';" type="button">
<BR><BR>	
<TABLE width="80%" BORDER=0 align="center" cellpadding="1" cellspacing="1">
<a href="#" onclick="window.print(); return false;">Imprimir</a>
	<tr>
	  <td width="3%" style="visibility:hidden"><center>ID</center></td>
	  <td width="20%" class="caixadestaque">
            <center>
                <a href="rel_transito.php?ordem=processo">PROCESSO</a>
            </center>
                </td>
                    <td width="15%" class="caixadestaque">
            <center>
                <a href="rel_transito.php?ordem=encaminha">ENCAMINHAMENTO</a>
            </center>
            </td>
            <td width="15%" class="caixadestaque"><center>
                <a href="rel_transito.php?ordem=destino">DESTINO</a></center>
            </td>
            <td width="50%" class="caixadestaque"><center>DESPACHO</center></td>
			</tr>
<? 
		//if ($datainipesq<>"" && $datainipesq<>"") { }

		$sqlquery = "select * from circulacao";
		$sqlquery = $sqlquery."  where observacao = 'EM TRÂNSITO'";
		if ($ordem=='processo') {
			$sqlquery = $sqlquery."  order by nprocesso";
		}
		if ($ordem=='encaminha') {
			$sqlquery = $sqlquery."  order by data desc";
		}
		if ($ordem=='destino') {
			$sqlquery = $sqlquery."  order by destino";
		}
		$process = mysql_query($sqlquery);
		include "validaerrobanco.php";            
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		if (mysql_num_rows($process) > 0) {
					while ($line = mysql_fetch_array($process)) {
						$id = $line['idprocesso'];
						$processo = $line['nprocesso'];
						$data = $line['data'];
						$destino = $line['destino'];
						$despacho = $line['despacho'];
						?>
						<tr>
							<td style="visibility:hidden"><? echo ($id); ?></td>
							<td class="caixa"><? echo ($processo); ?></td>
							<td class="caixa"><? echo tdate($data,1); ?></td>
							<td class="caixa"><? echo ($destino); ?></td>
							<td class="caixa"><? echo ($despacho); ?></td>
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