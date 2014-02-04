<?php
$nome		= $_POST["Nome"];	// Pega o valor do campo Nome
$fone		= $_POST["Fone"];	// Pega o valor do campo Telefone
$email		= $_POST["Email"];	// Pega o valor do campo Email
$mensagem	= $_POST["Mensagem"];	// Pega os valores do campo Mensagem

// Variбvel que junta os valores acima e monta o corpo do email

$Vai 		= "Nome: $nome\n\nE-mail: $email\n\nTelefone: $fone\n\nMensagem: $mensagem\n";

require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'enviador@gmail.com');	// <-- Insira aqui o seu GMail
define('GPWD', 'senha');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticaзгo ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 465 deverб estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}

// Insira abaixo o email que irб receber a mensagem, o email que irб enviar (o mesmo da variбvel GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por ъltimo a variбvel com o corpo do email.

 if (smtpmailer('recebedor@dominio.com.br', 'enviador@gmail.com', 'Nome do Enviador', 'Assunto do Email', $Vai)) {

	Header("location:http://www.dominio.com.br/obrigado.html"); // Redireciona para uma pбgina de obrigado.

}
if (!empty($error)) echo $error;
?>