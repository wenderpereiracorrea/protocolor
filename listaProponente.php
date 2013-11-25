<html>
<head>
<title>Fun&ccedil;&otilde;es Administrativas</title>
<link href="./styles.css" rel=stylesheet type=text/css>
<script>
<!--
function send(codigo){
	window.opener.document.calform.novolocal.value=codigo;
	self.close();
}
//-->
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
   <table border="0" cellpadding="1" cellspacing="1" width="290">
	<?
	include ("./conexao.php");
	connect();

    	echo "      <tr>\n";
      	echo "         <td>\n";
		echo "            <center><b>PROPONENTES CADASTRADOS:</b></center>\n";
		echo "         </td>\n";
    	echo "      </tr>\n";
    	echo "      <tr>\n";
      	echo "         <td>&nbsp;</td>\n";
    	echo "      </tr>\n";

		$sql = "select * from processo";
		$Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
		
		if (mysql_num_rows($Resultado) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado)) {
			
				$codigo = $array_exibir['favorecido'];
				
				echo "      <tr>\n";
				echo "         <td>\n";
				echo "		   <a href=\"javascript:send('". $codigo ."')\">";
							   echo $codigo;
				echo "		   </a>";
				echo "         </td>\n";
				echo "      </tr>\n";
			}
			
		}
	?>   
	</table>
</body>
</html>