<? import_request_variables("gP"); error_reporting(0); ?>
<?	@session_start();	

include "conexao.php";
include "valida_user.php";
connect();

include "ajax.php";


$date = date("d/m/Y");
$datas = date("Y/m/d");
$hora= gmdate("H:i" ,time()-(3570*2));

// REAPROVEITEI ESTE BLOCO DO EDSON ********************************************
	if ($modolan==0) {
		$sql = "delete from temp_processo";
		$sql = $sql." where usuario = '".$login."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
	}
// *****************************************************************************
?>

<?
if ($_POST[gravar] != "") 
{

		$sql = "select * from processo where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
		if (mysql_num_rows($process) > 0) { ?>
		<script>
		alert('Este número de processo já foi cadastrado na base de dados!');
		</script>
		<? 
		unset ($nlancamento);unset ($dataent);unset ($nprocesso);unset ($documento);unset ($datadoc);
		unset ($numero);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpf);
		unset ($assunto);unset ($anexos);unset ($volumes);unset ($folhas);unset ($observacoes);
		} else {

	$sql="insert into 	
		processo(dataent,nprocesso,up,processo,ano,dv,documento,datadoc,
		numero,procedencia,setorsolicitante,favorecido,cpfcnpj,assunto,anexos,volumes,
		folhas,observacoes, localizacao, data_cadastro)";
	$sql = $sql." values ('".tdate($dataent,0)."','".$nprocesso."','".$up."',
		'".$processo."','".$ano."','".$dv."','".$documento."','".tdate($datadoc,0)."','".$numero."',
		'".$procedencia."','".$setorsolicitante."','".$favorecido."','".$cpf."',
		'".$assunto."','".$anexos."',".$volumes.",".$folhas.",'".$observacoes."','".$localatual."', '".tdate($datalancamento,0)."')";
	$process = mysql_query($sql) or die("Erro: " . $sql);

//PRIMEIRO ENCAMINHAMENTO -----------------------------------------------------
		$sql = "select idprocesso from processo where nprocesso like '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro10: " . mysql_error());
		if (mysql_num_rows($process) > 0) 
		{
			$line = mysql_fetch_array($process);
			$idprocesso = $line['idprocesso'];	
		}
		 
	$sql="insert into 	
		circulacao(data, hora, nprocesso,destino, idprocesso, observacao)";
	$sql = $sql." values ('".tdate($datalancamento,0)."','".$hora."','".$nprocesso."','".$localatual."', '".$idprocesso."', 'EM TRANSITO')";
	$process = mysql_query($sql) or die("Erro: " . $sql);
//FIM PRIMEIRO ENCAMINHAMENTO -------------------------------------------------

//	echo "<br>SQL = ".$sql;
	$sql="insert into historico (data,hora,usuario,acao,ip) 
			values ('".$datas."','".$hora."','".upper($login)."','Inseriu o processo n° ".$nprocesso."','".get_ip()."')";	
	$process = mysql_query($sql) or die("Erro: " . $sql);		
//	echo "<br>SQL = ".$sql;
	unset ($nlancamento);unset ($dataent);unset ($nprocesso);unset ($documento);unset ($datadoc);
	unset ($numero);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpf);
	unset ($assunto);unset ($anexos);unset ($volumes);unset ($folhas);unset ($observacoes);
?><script>alert('Lançamento efetuado com sucesso!')</script><?
} 

}
?>

  <? //**************************  CÁLCULO DÍGITO VERIFICADOR   ************************* ?>
  <? if ($gerar != "") {

				//Pega o num do processo e tira o ponto e a barra
/*				$numprocesso = substr($nprocesso1,0,5).substr($nprocesso1,6,6).$j.substr($nprocesso1,13,4);
				
				$up = substr($nprocesso1,0,5);
				$processo = substr($nprocesso1,6,6);
				$ano = substr($nprocesso1,13,4);
				
				$M=1;
				$NUM=$numprocesso;
				$TOTD1=0;
				//Loop para os 14 dígitos (sem barra e sem ponto)
				for ($i=14; $i>=0;$i--) 
				{ 
					//Incrementa a variável M
					$M=$M+1;
					//Faz um cálculo em cada substring e soma na variável TOTD1
					$TOTD1 = $TOTD1+(substr($NUM,$i,1)*$M); 
				}
				
				//Cálculo do dígito 1
				$D1=11-($TOTD1 % 11);
				if ($D1 > 9) 
				{ 
					$D1=$D1-10; 
				}
				$M=1;
				$NUM=$numprocesso.$D1;
				$TOTD2=0;
				for ($i=15; $i>=1;$i--) 
				{ 
					$M=$M+1;
					$TOTD2 = $TOTD2+(substr($NUM,$i,1)*$M); 
				}
				//Cálculo do dígito 2
				$D2=11-($TOTD2 % 11);
				if ($D2 > 9) 
				{ 
					$D2=$D2-10; 
				} 
				if (strlen($numprocesso) == 15) 
				{ 
					$nprocesso=substr($numprocesso,0,5).".".substr($numprocesso,5,6)."/".substr($numprocesso,11,4)."-".$D1.$D2;
					$dv = $D1.$D2;
				} 
				else {
				?><script>alert('Numeração incorreta!!!')</script><?
				}


		$sql = "select * from processo where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
		if (mysql_num_rows($process) > 0) { ?>
		<script>
		alert('Este número de processo já foi cadastrado na base de dados!');
		</script>
		<? 
		unset ($nlancamento);unset ($dataent);unset ($nprocesso);unset ($documento);unset ($datadoc);
		unset ($numero);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpf);
		unset ($assunto);unset ($anexos);unset ($volumes);unset ($folhas);unset ($observacoes);
		} 
		
		} // if			
*/
if (strlen($nprocesso1) != 15) { ?>
<script>alert('Numeração Incorreta!')</script>
<? } else {
    $processo = $nprocesso1;
	$d1 = (($processo{14} * 2) + ($processo{13} * 3) + ($processo{12} * 4) + ($processo{11} * 5) + ($processo{10} * 6) + ($processo{9} * 7) + ($processo{8} * 8) + ($processo{7} * 9) + ($processo{6} * 10) + ($processo{5} * 11) + ($processo{4} * 12) + ($processo{3} * 13) + ($processo{2} * 14) + ($processo{1} * 15) + ($processo{0} * 16));
	
	$resto = ($d1%11);
	$d1 = (11-$resto);

		if ($d1 > 9 and $d1 < 20) {
		$d1 = ($d1 - 10);
		}
		if ($d1 > 19 and $d1 < 30) {
		$d1 = ($d1 - 20);
		}
		if ($d1 > 29 and $d1 < 40) {
		$d1 = ($d1 - 30);
		}
		if ($d1 > 39 and $d1 < 50) {
		$d1 = ($d1 - 40);
		}
		if ($d1 > 49 and $d1 < 60) {
		$d1 = ($d1 - 50);
		}
		if ($d1 > 59 and $d1 < 70) {
		$d1 = ($d1 - 60);
		}
		if ($d1 > 69 and $d1 < 80) {
		$d1 = ($d1 - 70);
		}
		if ($d1 > 79 and $d1 < 90) {
		$d1 = ($d1 - 80);
		}
		if ($d1 > 89 and $d1 < 100) {
		$d1 = ($d1 - 90);
		}

	$processo = $processo.$d1;

	$d2 = (($processo{15} * 2) + ($processo{14} * 3) + ($processo{13} * 4) + ($processo{12} * 5) + ($processo{11} * 6) + ($processo{10} * 7) + ($processo{9} * 8) + ($processo{8} * 9) + ($processo{7} * 10) + ($processo{6} * 11) + ($processo{5} * 12) + ($processo{4} * 13) + ($processo{3} * 14) + ($processo{2} * 15) + ($processo{1} * 16) + ($processo{0} * 17));
	
	$resto = ($d2%11);
	
		$d2 = (11-$resto);
	
		if ($d2 > 9 and $d2 < 20) {
		$d2 = ($d2 - 10);
		}
		if ($d2 > 19 and $d2 < 30) {
		$d2 = ($d2 - 20);
		}
		if ($d2 > 29 and $d2 < 40) {
		$d2 = ($d2 - 30);
		}
		if ($d2 > 39 and $d2 < 50) {
		$d2 = ($d2 - 40);
		}
		if ($d2 > 49 and $d2 < 60) {
		$d2 = ($d2 - 50);
		}
		if ($d2 > 59 and $d2 < 70) {
		$d2 = ($d2 - 60);
		}
		if ($d2 > 69 and $d2 < 80) {
		$d2 = ($d2 - 70);
		}
		if ($d2 > 79 and $d2 < 90) {
		$d2 = ($d2 - 80);
		}
		if ($d2 > 89 and $d2 < 100) {
		$d2 = ($d2 - 90);
		}
	
	$dv = $d1.$d2;
	$up = substr($processo,0,5);
	$processos = substr($processo,5,6);
	$ano = substr($processo,11,4);
	 
	$nprocesso = substr($processo,0,5).".".substr($processo,5,6)."/".substr($processo,11,4)."-".$d1.$d2;

		$sql = "select * from processo where nprocesso = '".$nprocesso."'";
		$process = mysql_query($sql) or die("Erro: " . $sql);
		if (mysql_num_rows($process) > 0) { ?>
		<script>
		alert('Este número de processo já foi cadastrado no banco de dados!');
		</script>
		<? 
		unset ($nlancamento);unset ($dataent);unset ($nprocesso);unset ($documento);unset ($datadoc);
		unset ($numero);unset ($procedencia);unset ($setorsolicitante);unset ($favorecido);unset ($cpf);
		unset ($assunto);unset ($anexos);unset ($volumes);unset ($folhas);unset ($observacoes);
		}
		
} // ELSE
} // if			

			?>
  <? // **************************  FIM DO CÁLCULO DÍGITO VERIFICADOR   ************************* ?>



<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<script>
function avalia_gravar(form) {
 
 if (calform.nprocesso.value == "") {
     alert("O campo Número do Processo precisa ser gerado!");
	 calform.nprocesso1.focus();
     return false;
  }
 if (calform.documento.value == "") {
     alert("O campo Espécie deve ser selecionado!");
	 calform.documento.focus();
     return false;
  }
 if (calform.datadoc.value == "") {
     alert("O campo Data, localizado ao lado do campo Espécie não pode estar em branco!");
	 calform.datadoc.focus();
     return false;
  }
 if (calform.procedencia.value == "") {
     alert("O campo Procedência deve ser preenchido!");
	 calform.procedencia.focus();
     return false;
  }
 if (calform.setorsolicitante.value == "") {
     alert("O campo Setor deve ser selecionado!");
	 calform.setorsolicitante.focus();
     return false;
  }
 if (calform.assunto.value == "") {
     alert("O campo Assunto deve ser preenchido!");
	 calform.assunto.focus();
     return false;
  }
 if (calform.localatual.value == "") {
     alert("O campo Localização deve ser preenchido!");
	 calform.localatual.focus();
     return false;
  }
} 

</script>

<script>
	function verifica_data() { //************ Confere a data da nota fiscal **************
		dia = (document.calform.datadoc.value.substring(0,2)); 
		mes = (document.calform.datadoc.value.substring(3,5)); 
		ano = (document.calform.datadoc.value.substring(6,10)); 
		situacao = ""; 
		// verifica o dia valido para cada mes 
		if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
		situacao = "falsa"; 
		} 
		// verifica se o mes e valido 
		if (mes < 01 || mes > 12 ) { 
			situacao = "falsa"; 
		} 
		// verifica se e ano bissexto 
		if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
			situacao = "falsa"; 
		}
		// verifica o ano 
		if (ano < 1950 || ano > 2200) { 
			situacao = "falsa"; 
		}
		if (document.calform.datadoc.value == "") { 
			situacao = "falsa"; 
		} 
	
		if (situacao == "falsa") { 
			alert("Data errada!"); 
			document.calform.datadoc.value=""; 
			document.calform.datadoc.focus();
		} 
	}	

	function verifica_data2() { //************ Confere a data da nota fiscal **************
		dia = (document.calform.dataent.value.substring(0,2)); 
		mes = (document.calform.dataent.value.substring(3,5)); 
		ano = (document.calform.dataent.value.substring(6,10)); 
		situacao = ""; 
		// verifica o dia valido para cada mes 
		if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
		situacao = "falsa"; 
		} 
		// verifica se o mes e valido 
		if (mes < 01 || mes > 12 ) { 
			situacao = "falsa"; 
		} 
		// verifica se e ano bissexto 
		if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
			situacao = "falsa"; 
		}
		// verifica o ano 
		if (ano < 1950 || ano > 2200) { 
			situacao = "falsa"; 
		}
		if (document.calform.dataent.value == "") { 
			situacao = "falsa"; 
		} 
	
		if (situacao == "falsa") { 
			alert("Data errada!"); 
			document.calform.dataent.value=""; 
			document.calform.dataent.focus();
		} 
	}	

	function verifica_data3() { //************ Confere a data da nota fiscal **************
		dia = (document.calform.datalancamento.value.substring(0,2)); 
		mes = (document.calform.datalancamento.value.substring(3,5)); 
		ano = (document.calform.datalancamento.value.substring(6,10)); 
		situacao = ""; 
		// verifica o dia valido para cada mes 
		if ((dia < 01)||(dia < 01 || dia > 30) && (  mes == 04 || mes == 06 || mes == 09 || mes == 11 ) || dia > 31) { 
		situacao = "falsa"; 
		} 
		// verifica se o mes e valido 
		if (mes < 01 || mes > 12 ) { 
			situacao = "falsa"; 
		} 
		// verifica se e ano bissexto 
		if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
			situacao = "falsa"; 
		}
		// verifica o ano 
		if (ano < 1950 || ano > 2200) { 
			situacao = "falsa"; 
		}
		if (document.calform.datalancamento.value == "") { 
			situacao = "falsa"; 
		} 
	
		if (situacao == "falsa") { 
			alert("Data errada!"); 
			document.calform.datalancamento.value=""; 
			document.calform.datalancamento.focus();
		} 
	}	

</script>

<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
</HEAD>

<BODY>
<center>
<form action="lanca_processo_jupiara.php" method="POST" name="calform" target="_self">

<table width ="38%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o número do processo e o sistema irá calcular o dígito verificador:</b>
		</td>
	</tr>
	<tr>
		<td class="caixaazul">
		<input type="text" name="nprocesso1" maxlength="15" onKeyPress="return txtBoxFormat(this, '999999999999999', event);">&nbsp;
		<input name='gerar' type='submit' value='Gerar Número' class='botao'>
		</td>
	</tr>
</table>

<br><br>

<table width ="80%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr class="cabeçalho">
		<td colspan="4"><center>PROCESSO</center></td>
	</tr>
	<? 	// ************** Busca o último número de lançamento ******************
		$sql = "select max(idprocesso) as max from processo";
		$process = mysql_query($sql) or die("Erro10: " . mysql_error());
		if (mysql_num_rows($process) > 0) 
		{
			$line = mysql_fetch_array($process);
			$idprocesso = $line['max'] + 1;	
		} ?>

<? // ********* CAMPOS DE PROCESSO  ********** ?>
	<tr>
		<td class="caixaazul"><div align='right'>Lançamento nº:&nbsp;</div></td>
		<td>
		<input type="text" name="nlancamento" class="cor-inativa" value="<? echo $idprocesso; ?>" size="6" readonly title="Número de Lançamento">
		</td>
      	
		<td class="caixaazul"><div align='right'>Data:&nbsp;</div></td>
		<td colspan="3"><input type='text' name='dataent' size='10' maxlength="10" class="cor-inativa" value= '<? if ($dataent=="") { echo date("d/m/Y");  } else {  echo $dataent; } ?>' onChange="javascript:verifica_data2()" onKeyPress="return txtBoxFormat(this, '99/99/9999', event);">
		</td>
	</tr>

	<tr>
  		<td class="caixaazul"><div align='right'>Processo:&nbsp;</div></td>
      	<td colspan="3">
		<input type="text" name="nprocesso" id="nprocesso" size="21" maxlength="20" value="<? echo $nprocesso; ?>" readonly="true">
		&nbsp;
		
		</td>
	</tr>

	<tr class="cabeçalho">
    	<td colspan='4'  ><center>ORIGEM</center></td>
	</tr>
	<tr>      
    	<td class="caixaazul"><div align='right'>Espécie:&nbsp;</div></td>
		<td colspan="3">

<input type="text" id="singleBirdRemote3" name="documento" size="60" />
		</td></tr>
		
		<tr>
		<td class="caixaazul"><div align='right'>Data:&nbsp;</div></td>
    	<td colspan="3"><input type='text' name='datadoc' id='datadoc' size='10' maxlength="10" class="cor-inativa"	value= '<? if ($datadoc=="") { echo date("d/m/Y");  } else {  echo $datadoc; } ?>' onChange="javascript:verifica_data()" onKeyPress="return txtBoxFormat(this, '99/99/9999', event);">
		</td>
    </tr>

    <tr>
    	<td class="caixaazul"><div align='right'>Número:&nbsp;</div></td>
    	<td>
		<input type='text' name='numero' id="numero" size='15'maxlength='30'  class="cor-inativa" value='<? echo $numero; ?>'>
		</td>
		
		<td class="caixaazul"><div align='right'>Procedência:&nbsp;</div></td>
    	<td width="350" colspan="3"> 
   	  	<input type='text' name='procedencia' id="procedencia" size='40' maxlength='60' class="cor-inativa" value='<? if ($procedencia == "") { echo "FUNARTE"; } else { echo $procedencia; } ?>' onChange="javascript:this.value=this.value.toUpperCase();"></td>
	</tr>

	<tr>
    	<td class="caixaazul"><div align='right'>Setor:&nbsp;</div></td>
		<td colspan="3" >
<input type="text" id="singleBirdRemote" name="setorsolicitante" size="60" />
	</td>
  	</tr>

<? // ********* CAMPOS DE DETALHES  ********** ?>

	<tr class="cabeçalho">
    	<td colspan='4'><center>DETALHES</center></td>
	</tr>  
	<tr>
    	<td class="caixaazul"><div align='right'>Interessado:&nbsp;</div></td>
    	<td>
		<textarea name="favorecido" id="favorecido" cols="30" rows="2" wrap="hard" class="cor-inativa"  onChange="javascript:this.value=this.value.toUpperCase();"><? echo $favorecido; ?></textarea ></td>
	  <td  class="caixaazul" ><div align='right'>CPF/CNPJ:</div></td>
	    <td>
        	<input type='text' name='cpf' id="cpf" class="cor-inativa" maxlength='18' size='18' value='<? echo $cpf; ?>'></td>
	</tr>
	<tr>
    	<td class="caixaazul" ><div align='right'>Assunto :&nbsp;</div></td>
    	<td colspan="3" >
        	<textarea name="assunto" id="assunto" cols="74" rows="3" wrap="hard" class="cor-inativa" onChange="javascript:this.value=this.value.toUpperCase();"><? echo $assunto; ?></textarea ></td>
	</tr>
	<tr>
  	  <td class="caixaazul" ><div align='right'>Anexos :&nbsp;</div></td>
    	<td colspan="3" >
        	<textarea name="anexos" id="anexos" cols="74" rows="3" wrap="hard" class="cor-inativa" onChange="javascript:this.value=this.value.toUpperCase();"><? if($anexos!="") { echo $anexos; } ?></textarea ></td>
	</tr>
	<tr>
    	<td class="caixaazul" ><div align='right'>Volumes :&nbsp;</div></td>
    	<td>
		<input type='text' name='volumes' id="volumes" size='5' class="cor-inativa" 
        value="<? if ($volumes!='') { echo $volumes; } else { ?>1<? } ?>"></td>
		
		<td class="caixaazul" ><div align='right'>Folhas:&nbsp;</div></td>
		<td>
		<input type='text' name='folhas' id="folhas" size='5' maxlength="5" class="cor-inativa" value ='<? if ($folhas!='') { echo $folhas; } else { ?>0<? } ?>' onKeyPress="return txtBoxFormat(this, '99999', event);"></td>
	</tr>
	<tr>
    	<td class="caixaazul" ><div align='right'>Observações :&nbsp;</div></td>
    	<td colspan="3">
        	<textarea name="observacoes" id="observacoes" cols="74" rows="2" wrap="hard" class="cor-inativa" onChange="javascript:this.value=this.value.toUpperCase();" ><? echo $observacoes; ?></textarea></td>
	</tr>

		<tr>
   		  <td class="caixaazul"><div align='right'>Localização:&nbsp;</div></td>
			<td colspan="3" >

<input type="text" id="singleBirdRemote2" name="localatual" size="60" />
		  </td>
		  </tr>

		<tr>
   		  <td class="caixaazul"><div align='right'>Data do Encaminhamento:&nbsp;</div></td>
			<td colspan="3" >
		<input type='text' name='datalancamento' size='10' maxlength="10" class="cor-inativa" value= '<? if ($datalancamento=="") { echo date("d/m/Y");  } else {  echo $datalancamento; } ?>' onChange="javascript:verifica_data3()" onKeyPress="return txtBoxFormat(this, '99/99/9999', event);">
		</td>
		</tr>	

	<tr style="display:none;">
    	<td colspan="4">
		<input type='text' name='up' size='5' value="<? echo $up; ?>">
		<input type='text' name='processo' size='5' value="<? echo $processos; ?>">
		<input type='text' name='ano' size='5' value="<? echo $ano; ?>">
		<input type='text' name='dv' size='5' value="<? echo $dv; ?>">
		</td>
	</tr>

<? // *****************  BOTÕES  *********************  ?>

	<tr class="cabeçalho">
    	<td colspan="4" style="text-align:center;">
		<input name='gravar' id="gravar" type='submit' value='GRAVAR' class='botao' onClick="return avalia_gravar(this);">
		</td>
	</tr>
</table>
<? 
if ($_POST[nprocesso] != "") {
?>
<br><br>
<a href="rel_capa_processo?nprocesso=<? echo $_POST[nprocesso]; ?>">Imprimir Etiqueta</a>
<?
}
?>
</form>
</center>

</BODY>
</HTML>



