<?php
include '../includes/session.php';
include 'classes/conexao.class.php';
include 'call/call.dao.php';

if(isset($_POST['cancel_call'])) {

    $callDao = new CallDao();

    $session_code = addslashes(trim($_POST['session_code']));
    $id_usuario = base64_decode($_SESSION['id']);
	$updated_at = date("Y-m-d H:i:s");

    $callDao->CancelCall($session_code);
    
    echo 'success';

}

?>