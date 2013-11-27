<? import_request_variables("gP");
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
    BOTď SUPERIOR DO FORMULARIO
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
<!-- jQUERY PARA VALIDAȃO-->
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
<script type="text/javascript" src="buscaProcessoprotocolo.js"></script>
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
			<td class="caixadestaque">Nº :</td>
            <td class="caixatitpesq"><? echo $numero; ?></td>
			<td class="caixadestaque">Emissão:</td>
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
			<form name="form1" id="form1" method="post" action="empilhandoprocesso.php">
    	    <div class="container">
			<input type="hidden" name="txtprotocolo" value="<?php echo $nprocesso;?>" />
    		<p>
			<label for="q" style="background:#96B4EB;"><b>Selecione o processo para empilhar</b></label>
			<!--<input type="text" id="q" name="q" accesskey="p" tabindex="1" onKeyUp="buscaInstantanea();" size="20" />-->
            <select  id="q" name="q" accesskey="p"  onchange="buscaInstantanea();">
					<option value="<?php echo $txtativo;?>">
					<? echo $txtativonome ?>
					</option>
					<?
					$sql = "select distinct procedencia,nprocesso, idprocesso, assunto, tipoprocesso_idtipoprocesso
                            from  
							processo as proc
							where tipoprocesso_idtipoprocesso = '2'
							order by nprocesso desc";
					mysql_query("SET NAMES 'utf8'");
					mysql_query('SET character_set_connection=utf8');
					mysql_query('SET character_set_client=utf8');
					mysql_query('SET character_set_results=utf8');
					$Resultado = mysql_query($sql) or die("Erro: " . mysql_error());
					while ($array_exibir = mysql_fetch_array($Resultado))
					{
					?>
					<option value="<?echo $array_exibir['nprocesso']?>">
					<? echo strtoupper($array_exibir['nprocesso'])?> 
					</option>
					<?
					$i++;
					}
					?>
		</select>
                <button type="submit" id="idinserir" name="inserir" value="inserir"> <i class="icon-plus icon-white"></i> Empilhar processo </button>
            <div id="resultadoBusca" style="margin-left:30px;">&nbsp;</div>
            </p>

            </div>
     </form>
	</fieldset>

    <div class="container">
	<label for="q" style="background:#96B4EB;"><b>Processo empilhados</b></label>
	<?
		$sqlResultadoprodutospedido = 
									"SELECT empilha.nprotocolo,empilha.nprocesso,empilha.data,proc.assunto
									from empilharprocesso as empilha,processo as proc
										where empilha.nprotocolo = '$nprocesso' and
										empilha.nprotocolo = proc.nprocesso 
									"; //str.ativo = opr.idopcao
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		$Resultadoprodutospedido = mysql_query($sqlResultadoprodutospedido) or die("Erro: " . mysql_error());
		$totalconsult = mysql_num_rows($Resultadoprodutospedido);
		if ($totalconsult < 1) {
			?>
			<!-- total de resultados da consulta -->
			<!--=============================================================
			JS
			=============================================================-->
		<? } elseif ($totalconsult >= 15000) { ?>
			<div class="alert alert-block alert-error fade in">
				<? echo "FAVOR REFINAR A CONSULTA SOMENTE OS PRIMEIROS 150 ITENS SÃO EXIBIDOS" ?>
			</div>
			<table style="width: 100%; border: solid 1px #ddd;" style="background:#96B4EB;" cellpadding="3" cellspacing="3">
				<tr>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>nº protocolo </b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>nº processo</b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>data</b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>Data cadastro</b>
					<? if ($_SESSION["tipousuario"] == '1') { ?>	
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b><i class="icon-pencil icon-white"></i> Desempilhar</b></td>
					<? } ?>  <!-- Fim Desenvolvedor -->
					</td>
				</tr>
			<? } else { ?>
				<span style="background:#96B4EB;"><? echo "Total: $totalconsult" ?></span>
				<table style="width: 100%; border: solid 1px #ddd;"	style="background:#96B4EB;" cellpadding="4" cellspacing="4">
					<tr>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>nº protocolo </b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>nº processo</b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>Data empilhamento</b></td>
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b>Assunto</b>
					<? if ($_SESSION["tipousuario"] == '1') { ?>	
					<td style="background-color: #96B4EB; color: #FFFFFF;"><b><i class="icon-pencil icon-white"></i> Desempilhar</b></td>
					<? } ?>  <!-- Fim Desenvolvedor -->
					</tr>
				<? } ?>
				<?
				while ($array_exibir = mysql_fetch_array($Resultadoprodutospedido)) {
					$valprod = urlencode($array_exibir['nprocesso'])
					?><!-- Inicio da formação dos links para exibir a consulta -->
					<tr>
						<td><label><?php echo $array_exibir['nprotocolo'] ?></label>
						<td><label><?php echo $array_exibir['nprocesso'] ?></label>
						<td><label><?php echo $array_exibir['data'] ?></label>
						<td><label><?php echo $array_exibir['assunto'] ?></label>
						<? if ($_SESSION["tipousuario"] == '1') { ?>	
						<td><a href="removeempilhamento.php?modo=parc&idproduto=<?php echo $array_exibir['nprocesso'] ?>&idremover=<?php echo $array_exibir['nprotocolo'] ?>&idnomesetor=<?php echo $array_exibir['nprocesso'] ?>" onclick="return confirm('Confirma o desempilhamento do registro Id: <?php echo $array_exibir['codsetor'] ?>')"><i class="icon-pencil icon-white"></i> Desempilhar</a>
						<? } ?>  <!-- Fim Desenvolvedor -->
				   </tr>
					<?
					$i++;
				}
?>
</div>
	
    </div>

	<? import_request_variables("gP"); ?>
<? 
error_reporting(0);
session_start ();
include "conexao.php";
connect();

$date = date("d/m/Y");
$hora= gmdate("H:i" ,time()-(3570*2));
// Qd clica no botão excluir
if ($_POST[excluir] == "Excluir" and $_POST[id] == "") { ?>
<script>alert('Selecione um Registro!!!')</script> <? }

if ($_POST[excluir] == "Excluir" and $_POST[id] != "") { ?>
<script language="javascript">
if (confirm("Esse registro sera excluido do sistema!\nTem certeza que deseja continuar?") == true) {
window.location.href='circulacao.php?excluir=EXCLUIR2&cod=<? echo $_POST[id]; ?>';
} else {
window.location.href='circulacao.php?excluir=';
}
</script>
<? } ?><?

if ($_GET[excluir] == "EXCLUIR2" and $_GET[cod] != "") {

    $sqlquery = "DELETE FROM circulacao WHERE idcircula = ".$_GET[cod]."";
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Excluiu circulacao para o processo nР".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . $hist);

?><script language="javascript1.2">alert('Registro Excluido com Sucesso!!!');</script><? 
unset($excluir); }

?>


<?

// Qd clica no botão ATUALIZAR

if ($_POST[alterar] == "Atualizar" and $_POST[id] == "") { ?>
<script>alert('Selecione um Setor!!!')</script> <? }

if ($_POST[alterar] == "Atualizar"  and $_POST[id] != "") {
        mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');		
$sqlquery = "UPDATE circulacao SET nprocesso = '".$_POST[nprocesso]."', data = '".tdate($_POST[data],0)."', hora = '".$_POST[hora]."', origem = 'PROTOCOLO', destino = '".$_POST[destino]."', despacho = '".$_POST[despacho]."' WHERE idcircula = ".$_POST[id].""; 
	$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Alterou circulacao para o processo nР".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . mysql_error());

?><script language="javascript1.2">alert('Registro Atualizado com Sucesso!!!');</script><? 
unset($alterar); }

?>


<!--<? 
if ($_POST[enviar] == "Cadastrar") {

		$sql2 = "select idprocesso from processo where nprocesso = '".$_POST[nprocesso]."'";
		mysql_query("SET NAMES 'utf8'");
        mysql_query('SET character_set_connection=utf8');
        mysql_query('SET character_set_client=utf8');
        mysql_query('SET character_set_results=utf8');		
		$Resultado2 = mysql_query($sql2) or die("Erro: " . mysql_error());

		if (mysql_num_rows($Resultado2) > 0) {

			while ($array_exibir = mysql_fetch_array($Resultado2)) {
			
				$idprocesso = $array_exibir['idprocesso'];
			}} else { echo "Erro na tabela Principal.<br>Favor entrar em contato com o administrador do sistema.<br><a href='circulacao.php'>Voltar</a>"; exit(); }



$insere = "insert into circulacao
             (nprocesso, data, hora, origem, destino, despacho, idprocesso)
			 values
			 ('".$_POST[nprocesso]."', '".tdate($_POST[data],0)."', '".$_POST[hora]."', '".$_POST[origem]."', '".$_POST[destino]."', '".$_POST[despacho]."', '".$idprocesso."')";
$resultado = mysql_query($insere)
or die ("Falha na execução da consulta");

	$hist="insert into historico (data,hora,usuario,acao) 
		values ('" . tdate($date,0) . "','" . $hora  . "','".$_SESSION[nome]."','Inseriu circulacao para o processo nР".$_POST[nprocesso]."')";	
	$process_hist = mysql_query($hist) or die("Erro: " . $hist);

?>-->
<script language="javascript" type="text/javascript">
alert('Cadastro Realizado com Sucesso!!!');
</script><? } ?>
<html>
<head>
<title>Sistema de Protocolo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript1.2">
function handleEnter (field, event) {
        var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
        if (keyCode == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        }
        else
        return true;
    }      
function avalia_consulta1(form) {
 if (form1.cons_circulacao.value == "") {
     alert("O campo Descrição deve estar preenchido");
	 form1.cons_circulacao.focus();
     return false;
  }
} 
function avalia_enviar(form) {
 if (form1.nprocesso.value == "") {
     alert("O campo Processo deve estar preenchido");
	 form1.nprocesso.focus();
     return false;
  }
} 
function avalia_id(form) {
 if (form1.id.value == "") {
     alert("Faça uma busca e selecione um setor para alteração ou editção!");
	 form1.cons_circulacao.focus();
     return false;
  }
} 
function send3(codigo6, codigo5, codigo4, codigo3, codigo2, codigo1, codigo){
	document.form1.despacho.value=codigo6;
	document.form1.destino.value=codigo5;
	document.form1.origem.value=codigo4;
	document.form1.hora.value=codigo3;
	document.form1.data.value=codigo2;
	document.form1.nprocesso.value=codigo1;
	document.form1.id.value=codigo;
}
</script>
</head>
<SCRIPT src="funcoes.js" type=text/javascript></SCRIPT>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<script src="bootstrap/js/bootstrap-dropdown.js"></script>
</body>
<? include "footer.php" ?>
</html>