<?
if (mysql_errno()){
   $erro = mysql_errno();
}else    {
 
}
switch ($erro) {
    case 1062:
        echo " Identificador já utilizado pelo sistema: ". $erro;
		break;
    case 1064:
        echo " Erro 1064 entre em contato com o Administrador";
        break;
	case 1046:
      echo " Erro 1046 entre em contato com o Administrador";
			//No database select
    break;
	default: 
	echo $erro;
	//echo ("Erro: " . mysql_error());
}

?>