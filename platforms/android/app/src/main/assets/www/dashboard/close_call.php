<?php
session_start();
include '../php/classes/conexao.class.php';
include '../php/call/call.dao.php';

/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);*/

if(isset($_GET['session_code'])) {

    $callDao = new CallDao();

    $session_code = addslashes(trim($_GET['session_code']));
    $callDao->CloseCall($session_code);
    
    if(isset($_SESSION['id_interprete'])) {
        
     $callDao->SetInterpreteOcupado($_SESSION['id_interprete'], '1');
        
     echo '<script>window.location.href = "https://www.helpvox.com.br/connect/interpretes/atendimento"</script>';
    }
    
    else {
        echo '<script>window.location.href = "index.php"</script>';
    }

}

?>