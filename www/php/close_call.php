<?php
include '../includes/session.php';
include 'classes/conexao.class.php';
include 'call/call.dao.php';

if(isset($_POST['close_call'])) {

    $callDao = new CallDao();

    $session_code = addslashes(trim($_POST['close_call']));

    $callDao->CloseCall($session_code);
    
    if(isset($_SESSION['id_interprete'])) {
        
     $callDao->SetInterpreteOcupado($_SESSION['id_interprete'], '1');
     echo '<script>window.location.href = "https://www.helpvox.com.br/connect/interpretes/atendimento"</script>';
     
    }
    
    echo 'success';

}

?>