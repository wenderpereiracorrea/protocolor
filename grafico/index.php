<?php
require_once('chart.php');
include "../conexao.php";
connect();

$data = array();
$tableSize = 300;

$i = 0;
		$sqlquery = "select count(idprocesso) as total from digitados_2009";
		$process = mysql_query($sqlquery) or die("Erro: " . mysql_error());
			
		if (mysql_num_rows($process) > 0) {

				while ($line = mysql_fetch_array($process)) {
                $total = $line['total'];

				$data[$i]['title'] = "2009";
				$data[$i]['value'] = $total;
				$i = $i + 1; 
			}
				mysql_free_result($process);					
		}


/**************** F I L L   D A T A   A R R A Y *******************************/
/*$data[0]['title'] = 'Monday';
$data[0]['value'] = 254;
$data[1]['title'] = 'Tuesday';
$data[1]['value'] = 489;
$data[2]['title'] = 'Wednesday';
$data[2]['value'] = 975;
$data[3]['title'] = 'Thursday';
$data[3]['value'] = 563;
$data[4]['title'] = 'Friday';
$data[4]['value'] = 195;*/
/******************************************************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title></title>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div id="main">
      <div class="caption">Gráfico</div>
      <div id="icon">&nbsp;</div>
      <div id="result">
         <?php drawChart($data); ?>
      </div>   
   </div>
</body>   
