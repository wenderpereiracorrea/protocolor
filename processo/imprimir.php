<? 
session_start();
header("Cache-Control: no-cache, must-revalidate");
include "../conexao.php";
connect();
?>

<?

//if ($_POST[exportar] == "exportar")
//{
 
$consulta1 = "select * from numeros";

$executar_query = mysql_query($consulta1);
$contar = mysql_num_rows($executar_query);
 
 for($i=0;$i<1;$i++)
   {
		$html[$i] .= '';
        $html[$i] .= '<table cellpadding="0" cellspacing="0" border="1">';
        $html[$i] .= '<thead>';
        //  $html[$i] .= '<tr>';
        // $html[$i] .= "<th colspan=\"6\" style=\"font-size:18px; font-weight:bold; color:#069; height:40px;\">Mapeamento de residências</th>";
        //$html[$i] .= '</tr>';
        $html[$i] .= '<tr style="font-size:14px; font-weight:bold;">';
        $html[$i] .= '<th width="100">Num_processo</th>';
        $html[$i] .= '</tr>';
        $html[$i] .= '</thead>';
        $html[$i] .= '<tbody>';
   } 
  $i = 1; 
  while($ret = mysql_fetch_array($executar_query)){ 
   if($i % 2){
       $color = '#F4F4F4';
         } else {
       $color = '#FFFFFF';
         }     
        $html[$i] .= "<tr align=\"center\">";
		$html[$i] .= "<td bgcolor=\"".$color."\" width=\"100%\">".$ret['NUM']."</td>";
        $html[$i] .= "</tr>";
    $i++;
}
$html[$i] .= '</tbody>';
$html[$i] .= '</table>';
  
  $arquivo = 'historico.xls';
  header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
  header ("Cache-Control: no-cache, must-revalidate");
  header ("Pragma: no-cache"); 
  header ("Content-type: application/x-msexcel");
  header ("Content-Disposition: attachment; filename={$arquivo}" );
  header ("Content-Description: PHP Generated Data" );
 
 for($i=0;$i<=$contar;$i++)
  { 
  	 echo $html[$i];
	}
    
    ?>
</body>
</html>





