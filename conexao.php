<?
error_reporting(0);

function connect(){
	$host = "127.0.0.1:3306";   	//host do mysql
	$user = "root";        //usuário mysql
	$pass = "mysql";     		//senha mysql
	$banco = "protocolobn"; 		//nome do banco de dados
	$conn = mysql_connect($host,$user,$pass);
	$db = mysql_select_db($banco,$conn);
	}

function tdate($data , $tipo)
{
// de data-br para mysql
if ($tipo == 0) {
	$datatrans = explode('/', $data);
	$data      = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
// de mysql para data-br
} elseif ($tipo == 1) {
	$datatrans = explode('-' , $data);
	$data      = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; // era 2 1 0
} else {
	// argumento errado, retorna a data intacta (nao modificada)
	return $data;
}
return $data;
}

function get_ip()
{
  $variables = array('REMOTE_ADDR',
                     'HTTP_X_FORWARDED_FOR',
                     'HTTP_X_FORWARDED',
                     'HTTP_FORWARDED_FOR',
                     'HTTP_FORWARDED',
                     'HTTP_X_COMING_FROM',
                     'HTTP_COMING_FROM',
                     'HTTP_CLIENT_IP');

  //$return = 'Unknown';

  foreach ($variables as $variable)
  {
      if (isset($_SERVER[$variable]))
      {
          $return.= $_SERVER[$variable];
      }
  }
  
  return $return;
}

function upper($str) { 
	return strtr(strtoupper($str),"àáâãçèéêíòóôõùüúû","ÀÁÂÃÇÈÉÊÍÒÓÔÕÙÜÚÛ"); 
	} 		

function lower($str) { 
	return strtr(strtolower($str),"ÀÁÂÃÇÈÉÊÍÒÓÔÕÙÜÚÛ","àáâãçèéêíòóôõùüúû"); 
	} 
?>
