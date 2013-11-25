<?
session_start(); // Inicializa a sessao
if (empty($_SESSION["login"])){
	header("Location: index.php");
	exit;
}
?>
<?
   include "header.php";
   include "conexao.php";
   connect(); // valida sessão do usuario e verifica se ele está ativo
   if(empty($_SESSION["login"])) {
?>
	    <script language="JavaScript">
		alert("Dados invalidos favor realizar o login novamente!");
		window.location.assign("../index.php");
		</script>
		<?
	 }else{
	 }
?>

<html>
<? include "header.php"; ?>
<title><?  echo $Title ?></title>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a> 
		
		<a  class="brand" target="principal" href="corpo_do_sistema.php" style="text-decoration: none"><i class="icon-th-large icon-white"></i> Home</a>
		<div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                Login:<a href="#" class="navbar-link"> <? echo $_SESSION["nome"];?> - <? echo $_SESSION["login"];?> </a>
                </p>
                <ul class="nav">
				<!--<li><a  target="_Blank" href="view/html/Introducao.html" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Help</a></li>-->
				<li><a  target="principal" href="protocolo.pdf" style="text-decoration: none"><i class="icon-question-sign icon-white"></i> Help pdf</a></li>
                <li><a  target="principal" href="sobre.php" style="text-decoration: none"><i class=" icon-info-sign icon-white"></i> Sobre</a></li>
                <li><a target="_top" href="logout.php" style="text-decoration: none"><i class="icon-remove icon-white"></i> Logout</a></li>
				</ul>
		</div>
		</div>
		</div>
	</div>
</html>
