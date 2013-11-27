<?
//======================================================
// Valores
//======================================================
$data = date('Y-m-d H:i:s');
$txtprotocolo = trim($_POST["txtprotocolo"]);
$txtprocesso = trim($_POST["q"]);

//======================================================
//Conectar
//======================================================
include "conexao.php";
@session_start(); // Inicializa a sess�o
connect();
//======================================================
//Inserir
//======================================================
if ($_POST[inserir] == "inserir")
{
$consulta = "INSERT INTO empilharprocesso
				(nprotocolo,nprocesso,data)
				VALUES
				('$txtprotocolo','$txtprocesso','$data')";
				mysql_query("SET NAMES 'utf8'");
				mysql_query('SET character_set_connection=utf8');
				mysql_query('SET character_set_client=utf8');
				mysql_query('SET character_set_results=utf8');			
$resultado = mysql_query($consulta);  
?>
<script language="JavaScript">
	alert ("Empilhado");
</script>
<script language="JavaScript">
    window.location.assign("adicionaprocessoaoprotocolo.php?modo=parc&idprocesso=<? echo $txtprotocolo ?>");
</script>
<?
}
//======================================================
//Alterar
//======================================================
if ($_POST[excluir] == "excluir")
{
$consulta = "UPDATE  produto 
			 SET 
			  nome =  '$txtnomeproduto',
			  quantidademinima = '$txtquantidademinima',
			  quantidademaxima = '$txtquantidademaxima',
			  descricao = '$txtdescricao',
			  categoria_codcategoria = '$cmbcategoria',
			  unidademedida_codunidademedida = '$cmbunidademedida',
			  ativo = '1',
                          data = '$data'
			 WHERE idproduto = '$txtfichaproduto'";
			mysql_query("SET NAMES 'utf8'");
			mysql_query('SET character_set_connection=utf8');
			mysql_query('SET character_set_client=utf8');
			mysql_query('SET character_set_results=utf8');
$resultado = mysql_query($consulta);  
include "validaerrobanco.php";
?>
<script language="JavaScript">
	alert ("desempilhar");
</script>
<script language="JavaScript">
    window.location.assign("../adicionaprocessoaoprotocolo.php?modo=parc&idprocesso=<?echo $txtfichaproduto?>");
</script>
<?
}

?>