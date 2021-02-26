<?php
session_start();
include '../php/classes/conexao.class.php';
include '../php/call/call.dao.php';

if(isset($_GET['session_code'])) {

    $callDao = new CallDao();

    $session_code = addslashes($_GET['session_code']);
    $id_interprete = addslashes(trim($_SESSION['id_interprete']));
    
    $callDao->OpenCall($session_code);
    $callDao->DesativaInterprete($id_interprete);
    $res = $callDao->TransferCall($session_code);
    
    $resInterpretes = $callDao->SelectInterpretes();
    foreach($resInterpretes as $rowInterpretes) {
        $id_interprete = $rowInterpretes['id'];
    }
    
    $callDao->AtualizaInterprete($id_interprete, $session_code);

}

?>

<html>
<head>
    
    <style type="text/css">

	body { font-family: arial; background:#082a78; color:#fff; }	

	</style>
    
	<title></title>
</head>
<body>
    
    <div style="width:1000px; margin:auto; margin-top:10%;">

		<div style="width:290px; height:100px; margin:auto;">
			<img width="290" height="100" src="https://www.helpvox.com.br/connect/img/logo.png" />
		</div>
		
		<div style="width:120px; height:120px; margin:auto;">
			<img width="120" height="120" src="../img/loader.gif" />
		</div>

		<div style="text-align:center;">
			<h1>Intérprete, aguarde...<br> Estamos transferindo a sua ligação!</h1>
		</div>

	</div>

</body>

<? include '../includes/js.php'; ?>

<script type="text/javascript">

    function CheckCall() {
        
        var session_code = '<? echo $session_code ?>';
        
        $.ajax({
          type: "POST",
          data: {session_code:session_code},
          
          url: "../php/check_call.php",
          dataType: "html",
          success: function(result){

            if(result == 'success') {
              location.href="../interpretes/atendimento/index.php";
            }
            
            if(result == 'wait') {
                alert('nada ainda');
            }

          }
        });
    }
    
    setInterval(CheckCall, 7000); //3000 MS == 3 segundos
    
</script>

</html>