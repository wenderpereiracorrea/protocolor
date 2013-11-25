<? 
session_start();
include "conexao.php";
connect();
$database_connTutoiMasters = $dbname;
?>

<?
$colname_rsBusca = "-1";
if (isset($_GET['q'])) {
  $colname_rsBusca = (get_magic_quotes_gpc()) ? $_GET['q'] : addslashes($_GET['q']);
}
$query_rsBusca = sprintf("SELECT * FROM especie
where indice = '$colname_rsBusca'", $colname_rsBusca,$colname_rsBusca);
$rsBusca = mysql_query($query_rsBusca) or die("Erro");
$row_rsBusca = mysql_fetch_assoc($rsBusca);
$totalRows_rsBusca = mysql_num_rows($rsBusca);
?>
<? $counter = 3; do { ?>
<?
    $codigo = $row_rsBusca['descricao'];
    $cont = $cont + 1;
    if ($cont % 2) { $bg = "#FFF"; } else {
    $bg = "#E2E2E2"; }
?>
<tr>
<td style="background-color:<? echo $bg; ?>">
<? echo "<a href='mostra_processo.php?modo=parc&idprocesso=$idprocesso'>"; ?>
<? echo urlencode($row_rsBusca['descricao']); ?></a>
</td>
</tr>
</h1>
<? $counter++; } while ($row_rsBusca = mysql_fetch_assoc($rsBusca)); ?>
<?
mysql_free_result($rsBusca);
?>


