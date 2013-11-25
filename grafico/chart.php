<?php
/*************************************************
 * Micro Bar Chart
 *
 * Version: 1.0
 * Date: 2007-09-12
 *
 * Usage:
 *    include chart.php file into your source code.
 *    Fill the $data array with your values and call
 *    the drawChart function with this array.
 *    See the example index.php file.
 *
 ****************************************************/

function drawChart($chartData){
   global $tableSize;
   $maxValue = 0;

   // First get the max value from the array
   foreach ($chartData as $item) {
      if ($item['value'] > $maxValue) $maxValue = $item['value'];
   }

   // Now set the theoretical maximum value depending on the maxValue
   $maxBar = 1;
   while ($maxBar < $maxValue) $maxBar = $maxBar * 10;

   // Calculate 1px value as the table is 300px
   $pxValue = ceil($maxBar/$tableSize);

   // Now display the table with bars
   echo '<table><tr><th>Título</th><th colspan="2">Valor</th></tr>';
   foreach ($chartData as $item) {
      $width = ceil($item['value']/$pxValue);
   	echo '<tr><td>'.$item['title'].'</td>';
   	echo '<td width="'.($maxBar*$pxValue).'">
   	     <img src="style/barbg.gif" alt="'.$item['title'].'" width="'.$width.'" height="15" /></td>';
   	echo '<td>'.$item['value'].'</td></tr>';
   }
   echo '</table>';

}

?>