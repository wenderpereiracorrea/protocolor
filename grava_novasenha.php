<? 
@session_start();
include "header.php";
include "conexao.php";
connect();
$dataenc = date("Y-m-d");
$horaenc= gmdate("H:i:s" ,time()-(3570*2));
			$sql = "update usuario set senha = '".$novasenha."'";
			$sql = $sql." where login = '".$login."'";
			$sql = $sql." and senha = '".$senha."'";
			$process = mysql_query($sql) or die("Erro: " . $sql);
			$sql="insert into historico (data,hora,usuario,acao,ip)";
			$sql = $sql." values ('".$dataenc."','".$horaenc."','".upper($login)."','Alterou sua senha','".get_ip()."')";
			$process = mysql_query($sql) or die("Erro: " . $sql);
?>
<script>window.location.href="index.php";</script>