<?php 
session_start();
header ("Content-Type:text/html; charset=iso-8859-1");

include "conexao.php";
connect();

$database_connTutoiMasters = $dbname;

//$connTutoiMasters = mysql_connect("host=$host port=$port dbname=$database_connTutoiMasters user=$user password=$password");	

?>
<br><br>
<table style="width:70%; border:solid 1px #333333;" cellpadding="4" cellspacing="4">
<tr>
<td style="background-color:#9999CC; color:#FFFFFF;"><b>Processo</b></td>
<td style="background-color:#9999CC; color:#FFFFFF;"><b>Assunto</b></td>
<td style="background-color:#9999CC; color:#FFFFFF;"><b>Favorecido</b></td>
</tr>

<?php
$colname_rsBusca = "-1";
if (isset($_GET['q'])) {
  $colname_rsBusca = (get_magic_quotes_gpc()) ? $_GET['q'] : addslashes($_GET['q']);
}

$query_rsBusca = sprintf("select nprocesso, idprocesso, assunto, favorecido
from  processo
where (favorecido LIKE '%%%s%%') LIMIT 150", $colname_rsBusca,$colname_rsBusca);
$rsBusca = mysql_query($query_rsBusca) or die("Erro");
$row_rsBusca = mysql_fetch_assoc($rsBusca);
$totalRows_rsBusca = mysql_num_rows($rsBusca);
?>
<?php $counter = 3; do { ?>


<?
				$codigo = $row_rsBusca['nprocesso'];
				$idprocesso = $row_rsBusca['idprocesso'];
				$assunto = $row_rsBusca['assunto'];
				$favorecido = $row_rsBusca['favorecido'];

				// Colorir linha sim, linha não ####################
				$cont = $cont + 1;
				if ($cont % 2) { $bg = "#FFF"; } else {
				$bg = "#E2E2E2"; }
				// Colorir linha sim, linha não ####################
				
?>

<tr>

<td style="background-color:<? echo $bg; ?>">
<? echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>"; ?>
<?php echo urlencode($row_rsBusca['nprocesso']); ?></a>
</td>

<td style="background-color:<? echo $bg; ?>">
<? echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>"; ?>
<?php echo urlencode($row_rsBusca['assunto']); ?></a>
</td>

<td style="background-color:<? echo $bg; ?>">
<? echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>"; ?>
<?php echo urlencode($row_rsBusca['favorecido']); ?></a>
</td>
</tr>


</h1>

<?php $counter++; } while ($row_rsBusca = mysql_fetch_assoc($rsBusca)); ?>
<?php
mysql_free_result($rsBusca);
?>


