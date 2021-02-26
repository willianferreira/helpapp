<?php
class UsuariosDao {
    
    public $_db;
    
    public function Inserir(Usuarios $usuarios){
        $this->_db = new Conexao();
        $stmt = $this->_db->prepare("INSERT into usuarios(nome, email, cpf, data_nascimento) VALUES(?, ?, ?, ?)");
        $stmt->bindValue(1, $usuarios->getNome());
        $stmt->bindValue(2, $usuarios->getEmail());
        $stmt->bindValue(3, $usuarios->getCpf());
        $stmt->bindValue(4, $usuarios->getData_nascimento());
        $stmt->execute();
    }
    
    public function SendMail($email, $nome){
        
        include('../../../phpmailer/class.phpmailer.php'); 
        include('../../../phpmailer/class.smtp.php'); 
        
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
       $mail->FromName = "Helpvox Connect" ; // Nome de quem envia o email
       $mail->AddAddress($email, $nome); // Email e nome de quem receberá //Responder
       $mail->WordWrap = 50; // Definir quebra de linha
       $mail->IsHTML = true ; // Enviar como HTML
       $mail->Subject = 'Mensagem do Site' ; // Assunto
       $mail->Body = 'NÃO RESPONDA, ESTE É UM E-MAIL AUTOMÁTICO DO SITE.<br/><br/>' . $corpo . '<br/>' ; //Corpo da mensagem caso seja HTML
       $mail->AltBody = "$corpo" ; //PlainText, para caso quem receber o email não aceite o corpo HTML
    
       if(!$mail->Send())  { echo "Houve um erro enviando o email: ".$mail->ErrorInfo; }
       
    }
    
    public function VerificaCPF($cpf){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT count(id) FROM usuarios WHERE cpf = '$cpf'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }

}