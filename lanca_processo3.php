<?	
error_reporting(0);
session_start();	
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/Y");
$datas = date("Y/m/d");
$hora= gmdate("H:i" ,time()-(3570*2));

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
		processo(dataent,nprocesso,documento,datadoc,
		numero,procedencia,setorsolicitante,favorecido,cpfcnpj,assunto,anexos,volumes,
		folhas,observacoes, localizacao, data_cadastro)";
	$sql = $sql." values ('".tdate($dataent,0)."','".$nprocesso."','".$documento."','".tdate($datadoc,0)."','".$numero."',
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
		circulacao(data, hora, nprocesso,destino, idprocesso)";
	$sql = $sql." values ('".tdate($datalancamento,0)."','".$hora."','".$nprocesso."','".$localatual."', '".$idprocesso."')";
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

<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>

<script>
function avalia_gravar(form) {
 
 if (calform.nprocesso.value == "") {
     alert("O campo Número do Processo precisa ser informado!");
	 calform.nprocesso.focus();
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
<form action="lanca_processo3.php" method="POST" name="calform" target="_self">

<table width ="80%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr class="cabeçalho">
		<td colspan="4"><center>PROCESSOS COM O CAMPO LIVRE PARA DIGITAÇÃO</center></td>
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
		<td  colspan="3"><input type='text' name='dataent' size='10' maxlength="10" class="cor-inativa" value= '<? if ($dataent=="") { echo date("d/m/Y");  } else {  echo $dataent; } ?>' onChange="javascript:verifica_data2()" onKeyPress="return txtBoxFormat(this, '99/99/9999', event);">
		</td>
	</tr>

	<tr>
  		<td class="caixaazul"><div align='right'>Processo:&nbsp;</div></td>
      	<td colspan="3">
		<input type="text" name="nprocesso" id="nprocesso" size="21" maxlength="50" value="<? echo $nprocesso; ?>">
		</td>
	</tr>

	<tr class="cabeçalho">
    	<td colspan='4'  ><center>ORIGEM</center></td>
	</tr>
	<tr>      
    	<td class="caixaazul"><div align='right'>Espécie:&nbsp;</div></td>
		<td colspan="3">
		<select name='documento' id="documento" class="cor-inativa">
        <?	$sqlquery = "select * from especie order by especie";
			$process = mysql_query($sqlquery) or die("Erro13: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($documento=="") 
				{ ?>
					<option value=''>Selecione o documento</option><?
						while ($line = mysql_fetch_array($process)) 
						{
							$id = $line['id'];
							$especie = $line['especie']; ?>
							<option value='<? echo $especie ;?>'><? echo $especie ;?></option><?
						}
					}
					if ($documento!="") 
					{ ?>
						<option value='<? echo $documento; ?>'><? echo $documento; ?></option><?
						while ($line = mysql_fetch_array($process)) 
						{
							$id = $line['id'];
							$especie = $line['especie']; ?>
							<option value='<? echo $especie ;?>'><? echo $especie ;?></option><?
						}
					}mysql_free_result($process);					
				} ?>
      </select>&nbsp;<a href="especie.php"><img src="imagebox/add.png"></a>
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
		  <select name='setorsolicitante' id="setorsolicitante" class="cor-inativa">
		  <? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($setorsolicitante=="") 
				{ ?>
			<option value=''>Selecione  o setor</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
					}
				}
				if ($setorsolicitante!="") 
				{ ?>
			<option value='<? echo $setorsolicitante; ?>'><? echo $setorsolicitante; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
			}
			mysql_free_result($process); ?>
		  </select>&nbsp;<a href="setores.php"><img src="imagebox/add.png"></a>
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
		  <select name='localatual' id="localatual" >
		  <? 
			$sqlquery = "select * from setor order by setor";
			$process = mysql_query($sqlquery) or die("Erro16: " . mysql_error());
			if (mysql_num_rows($process) > 0) 
			{
				if ($localatual=="") 
				{ ?>
			<option value=''>Selecione  o local atual</option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
			<option value='<? echo $setor; ?>'><? echo $setor; ?> - <? echo $descricao; ?></option><?
					}
				}
				if ($localatual!="") 
				{ ?>
			<option value='<? echo $localatual; ?>'><? echo $localatual; ?></option><?
					while ($line = mysql_fetch_array($process)) 
					{
						$setor = $line['setor'];
						$descricao = $line['descricao'];
						$endereco = $line['endereco'];
						$telefone = $line['telefone']; ?>
						<option value='<? echo $setor; ?>'><? echo $setor; ?></option><?
					}
				}
			}mysql_free_result($process); ?>
		  </select>
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
		<input type='text' name='processos' size='5' value="<? echo $processos; ?>">
		<input type='text' name='ano' size='5' value="<? echo $ano; ?>">
		<input type='text' name='dv' size='5' value="<? echo $dv; ?>">
		</td>
	</tr>

<? // *****************  BOTÕES  *********************  ?>

	<tr class="cabeçalho">
    	<td colspan="4" style="text-align:center;">
		<input name='gravar' id="gravar" type='submit' value='GRAVAR' class='botao' onClick="return avalia_gravar(this);">
		<input name='Encerrar' id="Encerrar" type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">
		</td>
	</tr>
</table>

</form>
</center>

</BODY>
</HTML>



