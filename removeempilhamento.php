<?
//======================================================
//Conectar
//======================================================
include "conexao.php";
@session_start(); // Inicializa a sessão
connect();
?>
<?
if(($_GET["idproduto"])=='') {
    $idproduto = -1;
}else{
$idproduto = ($_GET["idproduto"]);
$idremover = ($_GET["idremover"]);
$consulta = "DELETE FROM empilharprocesso WHERE nprocesso ='$idproduto'";

$resultado = mysql_query($consulta); 
include "validaerrobanco.php";
?>
<script language="JavaScript">
	window.location.assign("adicionaprocessoaoprotocolo.php?modo=parc&idprocesso=<?echo $idremover?>");
</script>
<?
}
?>
