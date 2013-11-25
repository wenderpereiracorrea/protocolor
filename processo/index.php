<?php import_request_variables("gP"); ?>
<?php 
include "../conexao.php";
connect();

?>

<HTML>
<HEAD>
<TITLE>Sistema para gerar de etiquetas de processo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
</head>

<body topmargin="0">
      <form name="form1" action="index.php" method="post">
		<table width ="60%" align='center' border="1" cellpadding="1" cellspacing="2">
          <tr> 
            <td colspan="6" class="caixaazul"><div align="center"><strong>Controle de Usuários</strong>
			</td>
          </tr>
		  
<script language="javascript">
function SoNumero() 
{
	if ((event.keycode!=13) && 
		(event.keyCode<45 || event.keyCode>57))
			event.returnValue = false;
}
function formatar(src, mask) 
{
	var i = src.value.length;
	var saida = mask.substring(0,1);
	var texto = mask.substring(i)
	if (texto.substring(0,1) != saida) 
	{
		src.value += texto.substring(0,1);
	}
}
VerifiqueTAB=true;
function Mostra(quem, tammax) {
    if ( (quem.value.length == tammax) && (VerifiqueTAB) ) {
        var i=0,j=0, indice=-1;
        for (i=0; i<document.forms.length; i++) {
            for (j=0; j<document.forms[i].elements.length; j++) {
                if (document.forms[i].elements[j].name == quem.name) {
                    indice=i;
                    break;
                }
            }
            if (indice != -1)
                 break;
        }
        for (i=0; i<=document.forms[indice].elements.length; i++) {
            if (document.forms[indice].elements[i].name == quem.name) {
                while ( (document.forms[indice].elements[(i+1)].type == "hidden") &&
                        (i < document.forms[indice].elements.length) ) {
                            i++;
                }
                document.forms[indice].elements[(i+1)].focus();
                VerifiqueTAB=false;
                break;
            }
        }
    }
} 	
</script>

  <? //**************************  CÁLCULO DÍGITO VERIFICADOR   ************************* ?>
  <? if ($nprocesso!="" and $gerar != "") {
$delete = "delete from numeros";
$apagar = mysql_query($delete)
or die ("Falha na execução da consulta");

			
                for ($j=1; $j < 10; $j++) {
				
				//Pega o num do processo e tira o ponto e a barra
				$numprocesso = substr($nprocesso,0,5).substr($nprocesso,6,5).$j.substr($nprocesso,13,4);
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
				}
for ($i = 1;$i<=2;$i++) {
$consulta = "insert into numeros
(NUM) values ('$nprocesso')";
$resultado = mysql_query($consulta)
or die ("Falha na execução da consulta");
}

				} // for

                for ($j=10; $j < 100; $j++) {
				
				//Pega o num do processo e tira o ponto e a barra
				$numprocesso = substr($nprocesso,0,5).substr($nprocesso,6,4).$j.substr($nprocesso,13,4);
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
				}
for ($i = 1;$i<=2;$i++) {
$consulta = "insert into numeros
(NUM) values ('$nprocesso')";
$resultado = mysql_query($consulta)
or die ("Falha na execução da consulta");
}

				} // for

                for ($j=100; $j < 1000; $j++) {
				
				//Pega o num do processo e tira o ponto e a barra
				$numprocesso = substr($nprocesso,0,5).substr($nprocesso,6,3).$j.substr($nprocesso,13,4);
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
				}
for ($i = 1;$i<=2;$i++) {
$consulta = "insert into numeros
(NUM) values ('$nprocesso')";
$resultado = mysql_query($consulta)
or die ("Falha na execução da consulta");
}

				} // for

                for ($j=1000; $j < 10000; $j++) {
				
				//Pega o num do processo e tira o ponto e a barra
				$numprocesso = substr($nprocesso,0,5).substr($nprocesso,6,2).$j.substr($nprocesso,13,4);
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
				}
for ($i = 1;$i<=2;$i++) {
$consulta = "insert into numeros
(NUM) values ('$nprocesso')";
$resultado = mysql_query($consulta)
or die ("Falha na execução da consulta");
}
				} // for


				} // if			
			?>
  <? // **************************  FIM DO CÁLCULO DÍGITO VERIFICADOR   ************************* ?>

  <? // ********************** INÍCIO DE LANÇAMENTO DE NÚMERO DE PROCESSO *********************** ?>
  <style type="text/css">
<!--
.style1 {color: #990000}
-->
  </style>

  <td>Processo:</td>
      <td width="350">
	  <input type="text" name="nprocesso" maxlength="17"  onChange="submit();" onKeyPress='javascript:if (event.keyCode==13){ submit();};SoNumero();formatar(this, "#####.######/####")' value="01530.000001/1991" placehoder="" >&nbsp;<input type="submit" name="gerar" value="Gerar Números"></td>
	  
          </tr>
        <br><br>
        <? // ************ FIM DE LANÇAMENTO DE NÚMERO DE PROCESSO *************** ?>
		<br/>
		</td>
		</table><br/>
		<br/>
		<br/>
		<table width ="60%" align='center' border="1" cellpadding="1" cellspacing="2">
				<a href="imprimir.php" target="_blank">Etiquetas</a><br>
		</table><br/>				
</form>
</HEAD>
</HTML>