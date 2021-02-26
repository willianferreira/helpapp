<?php
include '../includes/session.php';
include 'classes/conexao.class.php';
require 'vendor/autoload.php';
include 'call/call.class.php';
include 'call/call.dao.php';

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

//importa as bibliotecas
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

//solicita a autorizacao com o token
$apiObj = new OpenTok('46874594', '3bb8041b110a0fccade309060dcfe15ca52055e2'); // Somente conecta as credenciais no opentok

if(isset($_POST['make_call'])) {
    
    $call = new Call();
    $callDao = new CallDao();
    
    $resVerificaInterpretes = $callDao->StatusInterpretes();
    
    foreach($resVerificaInterpretes as $rowVerificaInterpretes) {
        if($rowVerificaInterpretes['0'] == 0) {
            
            $call->setNome_usuario($_SESSION['nome']);
            $call->setCreated_at(date("Y-m-d H:i:s"));
            $callDao->CallLost($call);
            
            echo 'fail_interprete';
            die();
        }
    }
    
    $resInterpretes = $callDao->SelectInterpretes();
    
    foreach($resInterpretes as $rowInterpretes) {
        $id_interprete = $rowInterpretes['id'];
    }

    $id_usuario = base64_decode($_SESSION['id']);
    $nome_usuario = $_SESSION['nome'];

    ////////////////////////////////////////////////////////////////////////////////////////////
    $session = $apiObj->createSession(array('mediaMode' => MediaMode::ROUTED)); //cria uma sessao
    $session_code = $session->getSessionId(); //pega o id da sessao
    $token = $apiObj->generateToken($session_code); //gera um token da ligacao baseada na sessao
    ///////////////////////////////////////////////////////////////////////////////////////////

	$created_at = date("Y-m-d H:i:s");
    $status = 'on';

	$call->setId_usuario($id_usuario);
    $call->setNome_usuario($nome_usuario);
    $call->setId_interprete($id_interprete);
	$call->setSession_code($session_code);
    $call->setToken($token);
    $call->setCreated_at($created_at);
    $call->setStatus($status);
    $call->setStatus_atendimento('0');

    $callDao->FazerLigacao($call);
    
    echo $session_code;

}else {
    echo 'failed';
}
?>