<? import_request_variables("gP"); ?>
<? 
session_start();
include "conexao.php";
include "valida_user.php";
connect();
function SomarData($data, $dias, $meses, $ano)
{
   //passe a data no formato dd/mm/yyyy 
   $data = explode("/", $data);
   $newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses,
    $data[0] + $dias, $data[2] + $ano) );
   return $newData;
}

//C�LCULO PARA DIFEREN�A DE DATAS
// Pega a data atual
$data_atual = date("Y-m-d");
// Pega o ano da variavel $data_atual
$ano_atual = substr($data_atual,0,4);
// Pega o m�s da variavel $data_atual
$mes_atual = substr($data_atual,5,2);
// Pega o dia da variavel $data_atual
$dia_atual = substr($data_atual,8,2);
// Concatena as partes da data atual  no formato dd-mm-aaaa
$data_atual = $dia_atual."-".$mes_atual."-".$ano_atual;
// Obt�m um timestamp Unix para a data atual onde os 0 // ( zeros ) s�o respectivamente horas , minutos , segundos 
$data_atual = mktime(0,0,0,$mes_atual,$dia_atual,$ano_atual);

?>
<HTML>
<HEAD>
<TITLE>PROTOCOLO - Setor de Protocolo</TITLE>
<link href='auxiliar/styles.css' rel='stylesheet' type='text/css'>
<body>
<DIV ID="DIV#teste">
<br>
				<table align="center" width="70%" cellpadding="0" cellspacing="0"> 
					<tr align='center'>
						<td align="center" colspan="2" class="titulo"></strong> 
						<div align="center">&nbsp;<font size="-2">RELA��O DE USU�RIOS CADASTRADOS</font></strong></div>
						</td>
				</table><br><br>
				<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 
					<tr> 
						<td class="caixadestaque"><center>NOME</center></td><td class="caixadestaque"><center>LOGIN</center></td><td class="caixadestaque"><center>SETOR</center></td><td class="caixadestaque"><center>PERFIL</center></td>
					</tr>						
<?	
	$sql="select * from usuario";
	$sql = $sql." order by nome";	
	$process = mysql_query($sql) or die("Erro: " . mysql_error());								
				while ($line = mysql_fetch_array($process)) 
					{
						$idusuario = $line['idusuario'];
						$login_usuario = $line['login'];
						$senha_usuario = $line['senha'];
						$nome_usuario = $line['nome'];
						$lembrete = $line['lembrete'];
						$perfila = $line['perfil'];
						$cpf = $line['cpf'];
						$setor = $line['setor'];
						
						// Pega o ano da variavel $data
						$ano_banco = substr($data,0,4);
						// Pega o m�s da variavel $data
						$mes_banco = substr($data,5,2);
						// Pega o dia da variavel $data
						$dia_banco = substr($data,8,2);
						// Concatena as partes da data no formato dd-mm-aaaa
						$datavalida = $dia_banco."-".$mes_banco."-".$ano_banco;
						// Obt�m um timestamp Unix para a data do banco onde o 0 // ( zero ) s�o respectivamente horas , minutos , segundos         
						$datavalida = mktime(0,0,0,$mes_banco,$dia_banco,$ano_banco);
						// Faz o calculo da diferen�a em dias entre as duas datas
						//24 horas * 60 Min * 60 seg = 86400
						$dias = ($data_atual - $datavalida)/86400;
						// Pega a parte inteira da variavel $dias
						$dias = ceil($dias);
						?>
							<tr> 
								<td class="caixatitpesq"><a href="detalhes_usuario.php?idusu=<? echo $idusuario; ?>"><? echo $nome_usuario; ?></a></td><td class="caixatitpesq"><a href="detalhes_usuario.php?idusu=<? echo $idusuario; ?>"><center><? echo $login_usuario; ?></center></a></td><td class="caixatitpesq"><a href="detalhes_usuario.php?idusu=<? echo $idusuario; ?>"><center><? if ($setor!='') { echo $setor; } else { echo ' - '; } ?></center></a></td><td class="caixatitpesq"><a href="detalhes_usuario.php?idusu=<? echo $idusuario; ?>"><center><? echo $perfila; ?></center></a></td></tr>
				<?	} ?>														
			</table>
				
			<BR><BR>	
			<table align="center" border="1" width="70%" cellpadding="0" cellspacing="0"> 				
			<tr>
				<td align="center" colspan="10" class="caixaazul"><center>Clique na linha do usu�rio para visualizar detalhes.</center></td>
			</tr>
			</table>
			<br><br>
				<center>
		<? if ($_SESSION['perfil']==1) { ?>
			<input type="button" onClick="javascript:novousu();" name="novo" class="botao" id="novo" value="NOVO USU�RIO" alt="Gravar">
		<? } ?>
	<? // *****************  BOT�ES  *********************  ?>
	<input name='Retornar' type='button' value='RETORNAR' class='botao' onclick='javascript:history.back();'>&nbsp;&nbsp;<input name='Encerrar' type='button' value='ENCERRAR' class='botao' onClick="javascript:window.location.href='corpo_do_sistema.php';">&nbsp;&nbsp;
	<? // *****************  FIM DE BOT�ES  *********************  ?>
	</center>
<? // ***************FIM DE MOSTRA RESULTADO ***************** ?>
	<script language="javascript">
		function novousu() {
window.location.href="grava_usuario.php?modo=novo";
		}
	</script> 
