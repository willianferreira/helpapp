<?php
session_start();
include '../php/classes/conexao.class.php';
include '../php/classes/autenticacao.php';

date_default_timezone_set('America/Sao_Paulo');

if(isset($_POST['usuario'])) {

	$content = [
	    "secret" => "6LdGm-4ZAAAAAJzMjyVDY1laAEszZPRv38_TO1P0",
	    "response" => $_POST["captcha"] ?? "",
	    "remoteip" => $_SERVER["REMOTE_ADDR"] ?? null,
	];

	$opts = [
	    "http" => [
	        "method" => "POST",
	        "content" => http_build_query($content),
	        "header" => "Content-Type: application/x-www-form-urlencoded",
	    ]
	];

	$context = stream_context_create($opts);

	$validation = file_get_contents("https://www.google.com/recaptcha/api/siteverify", FILE_BINARY, $context);

	$response = json_decode($validation);

	if ($response->success) {
	    
		$cpf = addslashes(trim($_POST['usuario']));
		$cpf = preg_replace('/[^0-9]/', '', $cpf);
		$data_nascimento = addslashes(trim($_POST['senha']));	

	    // Avoid Email Injection and Mail Form Script Hijacking
	    $pattern = "/(content-type|bcc:|cc:|to:)/i";
	    if( preg_match($pattern, $cpf) || preg_match($pattern, $data_nascimento)) {
	    	echo 'invalid_captcha';
	        exit;
	    }
	    
	    $login = new Usuario();
	    $login->autentica($cpf, $data_nascimento);

	}else {
		echo 'invalid_captcha';
	}

}


?>