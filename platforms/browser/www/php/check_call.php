<?php
//include '../includes/session.php';
include 'classes/conexao.class.php';
include 'call/call.dao.php';

if(isset($_POST['session_code'])) {

    $callDao = new CallDao();

    $session_code = addslashes(trim($_POST['session_code']));
    $res = $callDao->CheckCall($session_code);
    
    foreach($res as $row) {
        if($row['status_atendimento'] == '1') {
            echo 'success';
        } else {
            
            $resInterpretes = $callDao->SelectInterpretes();
            foreach($resInterpretes as $rowInterpretes) {
                $id_interprete = $rowInterpretes['id'];
            }
            
            $callDao->AtualizaInterprete($id_interprete, $session_code);
            
            echo 'wait';
            //troca o interprete
        }
    }

}

?>