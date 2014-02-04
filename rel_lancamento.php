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
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>


<script>
function avalia_pesquisar(form) {
 
 if (calform.datainipesq.value != "" && calform.datafimpesq.value == "") {
     alert("Para fazer a pesquisa por período é necessário o preenchimento das duas datas!");
	 calform.datafimpesq.focus();
     return false;
  }

 if (calform.datafimpesq.value != "" && calform.datainipesq.value == "") {
     alert("Para fazer a pesquisa por período é necessário o preenchimento das duas datas!");
	 calform.datainipesq.focus();
     return false;
  }

 if (calform.datafimpesq.value == "" && calform.datainipesq.value == "" && calform.nprocesso.value == "") {
     alert("Escolha um critério!");
	 calform.datainipesq.focus();
     return false;
  }
}
</script>
</HEAD>
<body class='corpo'>
<center>
<br><br>		
<TABLE width="30%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
	<tr align='center'> 
		<td align="center" colspan="5" class="titulo">
			<div align="center"><strong>&nbsp;HISTÓRICO DE LANÇAMENTOS&nbsp;</strong></div>
		</td>
	</tr>
</TABLE>
<BR><BR>
<form action="rel_lancamento_dados.php" method="POST" name="calform" target="_self">
<TABLE width="75%" BORDER=1 align="center" CELLPADDING=2 CELLSPACING=2 border="1" >
<tr><td>
Data Inicial:
  <input type='text' name='datainipesq' size='10' class='caixa' onKeyPress="javascript:SoNumero();" onKeyDown='FormataDataIni(form, this.name, event)' onKeyUp='Mostra(this, 10)' value="<? echo $datainipesq; ?>">
  &nbsp;<a href="javascript:show_calendar('form.datainipesq');"><img src="imagebox/show-calendar.gif" width=20 height=16 border=0></a>&nbsp;&nbsp;Data Final:
<input type='text' name='datafimpesq' size='10' class='caixa' onKeyPress="javascript:SoNumero();" onChange="form.submit();" OnKeyDown='FormataDataFim(form, this.name, event)' onKeyUp='Mostra(this, 10); ' value="<? echo $datafimpesq; ?>">&nbsp;<a href="javascript:show_calendar('form.datafimpesq');"><img src="imagebox/show-calendar.gif" width=20 height=16 border=0></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td></tr>

<tr><td>
<div align="right"><input name="pesquisar" value="Pesquisar" class="botao" onClick="return avalia_pesquisar(this);" type="submit">
<a href="#" onclick="window.print(); return false;">Imprimir</a>
</div>
</td></tr>
</TABLE>

</form>

</center>
</HEAD>

</HTML>