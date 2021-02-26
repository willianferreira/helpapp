<?php
include '../php/classes/conexao.class.php';
include 'usuarios/usuarios.class.php';
include 'usuarios/usuarios.dao.php';
include('../../phpmailer/class.phpmailer.php'); 
include('../../phpmailer/class.smtp.php'); 

date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST)) {

    $nome = addslashes(trim($_POST['nome']));
	$email = addslashes(trim($_POST['email']));
	$cpf = addslashes(trim($_POST['cpf']));
	$cpf = preg_replace('/[^0-9]/', '', $cpf);
	$data_nascimento = addslashes(trim($_POST['data_nascimento']));
	
    $usuarios = new Usuarios();
    $usuariosDao = new UsuariosDao();
    
    $verificaCPF = $usuariosDao->VerificaCPF($cpf);
    foreach($verificaCPF as $CPFVerificado) {
        if($CPFVerificado['0'] > 0) {
            echo 'cpf';
            die();
        }
    }
    
    $usuarios->setNome($nome);
    $usuarios->setEmail($email);
    $usuarios->setCpf($cpf);
    $usuarios->setData_nascimento($data_nascimento);

    $usuariosDao->Inserir($usuarios);
    
    $corpo = '<p style="text-align:center;"><img src="https://www.helpvox.com.br/images/connect.png" /><br><br></p><p style="font-family: arial; text-align:center;">Olá, <strong>'.$nome.'</strong><br><h4 style="text-align:center;"><strong style="text-align:center; color: #0c449d; font-family: arial;">BEM VINDO AO HELPVOX CONNECT!<br></strong></h4><p>';
    $corpo .= '<p style="font-family: arial; text-align:center;">Na central de acessibilidade do Helpvox você tem acesso a todos os serviços disponibilizados pela empresa, bem como o Helpvox empresarial, SOS Surdo e o Helpvox Connect que é uma plataforma de comunicação entre surdos e ouvintes através da central de intérpretes. Com este serviço você pode se comunicar com qualquer pessoa ou empresa.<br><p style="text-align:center; font-size:16px; background:#1055bf; padding:10px; color:#fff; font-family:arial;">Para acessar basta clicar no botão abaixo e fazer o login com seu CPF e Data de nascimento.</p>';
    $corpo .= '<br><p style="text-align:center;"><a style="font-family: arial; background: #ac1111; font-weight:bold; border-radius:10px; padding:10px; color:#fff; text-align:center;" target="_BLANK" href="https://www.helpvox.com.br/connect">FAZER LOGIN</a></p>';
    
   $mail = new PHPMailer();
   $mail->IsSMTP(); 
   $mail->CharSet = 'UTF-8';
   $mail->True;
   $mail->Host = "mail.helpvox.com.br"; // Servidor SMTP
   $mail->SMTPSecure = "ssl"; // conexão segura com TLS
   $mail->Port = 465; 
   $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
   $mail->Username = "nao-responda@helpvox.com.br"; // SMTP username
   $mail->Password = "creativem4st3r"; // SMTP password
   $mail->From = "nao-responda@helpvox.com.br"; // From
   $mail->FromName = "Site" ; // Nome de quem envia o email
   $mail->AddAddress($email, 'Bem vindo ao Helpvox!'); // Email e nome de quem receberá //Responder
   $mail->WordWrap = 50; // Definir quebra de linha
   $mail->IsHTML = true ; // Enviar como HTML
   $mail->Subject = 'Helpvox Connect' ; // Assunto
   $mail->Body = '' . $corpo . '<br/>NÃO RESPONDA, ESTE É UM E-MAIL AUTOMÁTICO DO SITE.<br/>' ; //Corpo da mensagem caso seja HTML
   $mail->AltBody = "$corpo" ; //PlainText, para caso quem receber o email não aceite o corpo HTML
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  //$mail->SMTPDebug = 2; //Alternative to above constant

  if(!$mail->Send()) // Envia o email
   { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo;
   }
    
    echo 'success';

}


?>