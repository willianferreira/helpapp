<?

    if(isset($_POST['status'])){
        $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
        include '../php/classes/conexao.class.php';
        include '../interpretes/php/interpretes.dao.php';
        
        $interpretesDao = new InterpretesDao();
        $resInterpretes = $interpretesDao->SelectMenu();
        
        echo '<h6 style="margin-bottom:0px; margin-top:10px;">Status:</h6>';
        
        foreach($resInterpretes as $rowInterpretes) {
            if($rowInterpretes['status'] == '0') {
                echo '<li style="font-size:15px; background:#f00; color:#fff; border-radius:5px; padding:5px; text-align: center; margin-bottom:5px;"><i><span style="font-size:13px;" class="material-icons">account_circle</span> '.$rowInterpretes['nome'].'</i></li>';
            }
    
            if($rowInterpretes['status'] == '1') {
                echo '<li style="font-size:15px; background:#0a8e19; color:#fff; border-radius:5px; padding:5px; text-align: center; margin-bottom:5px;"><i><span style="font-size:13px;" class="material-icons">account_circle</span> '.$rowInterpretes['nome'].'</i></li>';
            }
    
            if($rowInterpretes['status'] == '2') {
                echo '<li style="font-size:15px; background:#f4f113; color:#000; border-radius:5px; padding:5px; text-align: center; margin-bottom:5px;"><i><span style="font-size:13px;" class="material-icons">account_circle</span> '.$rowInterpretes['nome'].'</i></li>';
            }
        }
    }
    
    
?>