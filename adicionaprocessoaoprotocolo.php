<?
$data = date('Y-m-d H:i:s');  
$nprocesso = isset( $_GET['idprocesso'] ) ? $_GET['idprocesso'] : '-1';
?>
<?
include "conexao.php";
@session_start(); // Inicializa a sessão
$_SESSION["Ficha"] = $_POST["txtfichaproduto"];
connect();
?>
<!--======================================================================
    BOTÃO SUPERIOR DO FORMULARIO
    ===================================================================-->
        <?
          $sql = "select * from processo 
					where nprocesso = '$nprocesso'";
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');			
        $Resultadoprecoproduto = mysql_query($sql) or die("Erro: " . mysql_error());
        while ($line = mysql_fetch_array($Resultadoprecoproduto)) 
        {
            
		$idprocesso = $line['idprocesso'];
		$nprocesso = $line['nprocesso'];
		$documento = $line['documento'];
		$datadoc = $line['datadoc'];
		$numero = $line['numero'];
		$dataent = $line['dataent'];
		$up = $line['up'];
		$nprocesso = $line['nprocesso'];
		$ano = $line['ano'];
		$dv = $line['dv'];
		$procedencia = $line['procedencia'];
		$setorsolicitante = $line['setorsolicitante'];
		$favorecido = $line['favorecido'];
		$cpfcnpj = $line['cpfcnpj'];
		$assunto = $line['assunto'];
		$anexos = $line['anexos'];
		$volumes = $line['volumes'];
		$folhas = $line['folhas'];
		$observacoes = $line['observacoes'];
		$setordestino = $line['setordestino'];
		$datasaida = $line['datasaida']; 
            
        }
             
        ?>

        
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="bootstrap/css/docs.css" rel="stylesheet">
<link href="bootstrap/js/google-code-prettify/prettify.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.js"></script>
<![endif]-->
<!-- jQUERY PARA VALIDAÇÃO-->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" />
<link rel="stylesheet" href="css/template.css" type="text/css" />
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/languages/jquery.validationEngine-pt_BR.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/ico/favicon.png">
</head>
<script>
jQuery(document).ready(function () {  // binds form submission and fields to the validation engine
jQuery("#form1").validationEngine();
});
</script>
<body>
<form name="form1" id="form1" method="post" action="dao/empenhoinsert.php">
<!--=============================================================
    ADICIONADO PRODUTOS
    =============================================================-->
	<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script language="JavaScript" src="auxiliar/date-picker.js"></script>
<body>
<BR>
	<table align="center" width="50%" cellpadding="0" cellspacing="0"> 
		<tr align='center'> 
			<td align="center" colspan="2" class="titulo"></strong> 
				<div align="center">&nbsp;DETALHES DO PROTOCOLO</strong></div>
		</td>
		</tr>	
	</table>
	<BR>
<form action="transfer.php" method="POST" name="form" target="_self" onSubmit="javascript:return avalia(this)" >

	<table align="center" border="0" width="51%" cellpadding="0" cellspacing="0"> 
		<tr> 
			<td  class="caixadestaque">Protocolo :</td>
			<td colspan="2" class="caixatitpesq"><? echo $nprocesso; ?></td>
		</tr>
        <tr>
  	    	<td class="caixadestaque">Registro :</td>
            <td class="caixatitpesq"><? echo tdate($dataent,1) ?></td>
		</tr>
		<tr> 
			<td width="24%" class="caixadestaque">Assunto :</td>
			<td colspan="4" class="caixatitpesq"><? echo $assunto; ?></td>
		</tr>
		<tr> 
			<td class="caixadestaque">Doc. de Origem :</td><td width="24%" class="caixatitpesq"><? echo $documento; ?></td>
			<td width="18%" class="caixadestaque">Setor :</td>
			<td width="34%" class="caixatitpesq"><? echo $setorsolicitante; ?></td>
	    </tr>						
		<tr> 
			<td class="caixadestaque">Número :</td>
            <td class="caixatitpesq"><? echo $numero; ?></td>
			<td class="caixadestaque">Emissão :</td>
			<td class="caixatitpesq"><? echo tdate($datadoc,1) ?></td>
		</tr>						
		<tr> 
        	<td class="caixadestaque">Volumes :</td>
            <td class="caixatitpesq"><? echo $volumes; ?></td>
            <td class="caixadestaque">Nº de Folhas :</td>
            <td class="caixatitpesq"><? echo $folhas; ?></td>
		</tr>																														
		<!--<tr> 
        	<td class="caixadestaque">Anexos :</td>
            <td class="caixatitpesq" colspan="3"><? if ($anexos == "") { echo "&nbsp;"; } else { echo $anexos; } ?></td>
		</tr> -->
		</table>
	
	 </form>
	</fieldset>
<script src="bootstrap/js/bootstrap-dropdown.js"></script>
</body>
</html>