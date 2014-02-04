
<?
error_reporting(0);
function connect(){
	$host = "localhost:3306";   	//host do mysql
	$user = "root";        //usuário mysql
	$pass = "";     		//senha mysql
	$banco = "protocolorui";//nome do banco de dados
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
	}
	elseif ($tipo == 1) {
		$datatrans = explode('-' , $data);
		$data      = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; // era 2 1 0
	}
	elseif ($tipo == 3) {
		$datatrans = explode('-' , $data);
		$data      = "$datatrans[2]/$datatrans[1]/$datatrans[0]"; // era 2 1 0
	}
	else {
		// argumento errado, retorna a data intacta (nao modificada)
		return $data;
	}
	return $data;
}

?>
