<?php

include('index.html');

date_default_timezone_set('America/Sao_Paulo');
 
require_once('../src/PHPMailer.php');
require_once('../src/SMTP.php');
require_once('../src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
if((isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['cod']) && !empty(trim($_POST['cod'])))) {
 
	$nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
	$email = $_POST['email'];
	$mensagem = $_POST['cod'];

 /*Para que de certo. Entre na sua conta do google e mexer na parte de segurança, permitindo aplicativos menos seguros usar seu email */
	
 	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'seuemail@gmail.com';
	$mail->Password = 'suasenha';
	$mail->Port = 587;
 
	$mail->setFrom($email);
	$mail->addAddress('emaildoremetente');
 
	$mail->isHTML(true);
	$mail->Subject = "Contato";
	$mail->Body = "Nome: ".$nome."<br>".
				   "Email: ".$email."<br>".
				   "Mensagem: ".$mensagem;
 
	if($mail->send()) {
		echo 'Email enviado com sucesso.';
	} else {
		echo 'Email não enviado.';
	}
} else {
	echo 'Não enviado: informar o email e a mensagem.';
}

?>