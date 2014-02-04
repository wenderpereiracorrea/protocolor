<?php
error_reporting(0);
session_start(); // Inicializa a sessão
     include "header.php";
	 include "conexao.php";
	 connect();
?>
<? 

/*    $sQuery_recado = " select concluido
                from recados
                where concluido like 'n%' and user_from like '$nome_usuario'";
    $oUsers_recado = mysql_query($sQuery_recado);
    $num_registros_recado = mysql_num_rows($oUsers_recado);
    $oRow_recado = mysql_fetch_object($oUsers_recado);


    if ($num_registros_recado > 0) { ?>
        <script>
        window.open('lista_recados.php','envio','scrollbars=yes,width=810,height=250');
        </script>
     <?

    } else {
//       echo "caso contrário.";

    }
*/
?>




<html>
<head>
<title><?  echo $Title ?></title>
<base target="conteúdo">
</head>

<body topmargin="0" bgcolor="<?  echo $cor_pagina ?>">



</body>

</html>
