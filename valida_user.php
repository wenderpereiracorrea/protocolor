<?
@session_start(); // Inicializa a sessão

   if ($_SESSION["login"] != "") {
      $login = $_SESSION["login"]; }
      
   if ($_SESSION["senha"] != "") {
      $senha = $_SESSION["senha"]; }
	  
   if (empty($login) OR empty($senha)) {
      ?><script>window.location='index.php'</script><?
   }
?>
