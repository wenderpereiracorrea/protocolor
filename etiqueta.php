<?
error_reporting(0);
session_start();	
import_request_variables("gP");
include "conexao.php";
include "valida_user.php";
connect();
$date = date("d/m/Y");
$datas = date("Y/m/d");
$hora= gmdate("H:i" ,time()-(3570*2));

?>

  <? //**************************  CÁLCULO DÍGITO VERIFICADOR   ************************* ?>
  <? if ($gerar != "") {

				//Pega o num do processo e tira o ponto e a barra
				$numprocesso = substr($nprocesso1,0,5).substr($nprocesso1,6,6).$j.substr($nprocesso1,13,4);
				
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
				?>
				<script language="JavaScript">
			    window.location.href = 'rel_capa_processo.php?nprocesso=<? echo $nprocesso; ?>';
				</script>
				<?
				
				} 
				else {
				?><script>alert('Numeração incorreta!!!')</script><?
				}

		
		} // if			
			
			
			if ($_POST[gerar2] != "") {
			
				?>
				<script language="JavaScript">
			    window.location.href = 'rel_capa_processo.php?nprocesso=<? echo $_POST[nprocesso2]; ?>';
				</script>
				<?

			}
			?>
  <? // **************************  FIM DO CÁLCULO DÍGITO VERIFICADOR   ************************* ?>



<? // ******************** INÍCIO DA PÁGINA HTML ****************************** ?>
<HTML>
<HEAD>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>


<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
</HEAD>

<BODY>
<center>
<form action="etiqueta.php" method="POST" name="calform" target="_self">

<table width="60%" align='center' border="1" cellpadding="1" cellspacing="2">
	<tr>
		<td class="caixaazul">
		<b>Digite o número do processo, o sistema irá calcular o dígito verificador e redirecioná-lo à página para impressão da etiqueta:</b>
		</td>
	</tr>
	<tr>
		<td class="caixaazul"> Ano com 4 d&iacute;gitos:&nbsp;
		<input type="text" name="nprocesso1" maxlength="20" onKeyPress="return txtBoxFormat(this, '99999.999999/9999', event);">&nbsp;
		<input name='gerar' type='submit' value='OK' class='botao'>
		</td>
	</tr>


	<tr>
		<td class="caixaazul"> Ano com 2 d&iacute;gitos:&nbsp;
		<input type="text" name="nprocesso2" maxlength="18" onKeyPress="return txtBoxFormat(this, '99999.999999/99-99', event);">&nbsp;
		<input name='gerar2' type='submit' value='OK' class='botao'>
		</td>
	</tr>
</table>
<script>
document.calform.nprocesso1.focus();
</script>
</form>
</center>

</BODY>
</HTML>



