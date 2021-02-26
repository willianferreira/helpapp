<?
    $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
    include '../includes/session.php';

    $session_code = addslashes(trim($_GET['session_code']));
    
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Helpvox - Comunicação para Surdos e Deficientes Auditivos</title>

    <? include '../includes/css.php'; ?>
    
    <script>
        
    function CheckCall() {
        
        var session_code = '<? echo $session_code ?>';
        
        $.ajax({
          type: "POST",
          data: {session_code:session_code},
          
          url: "../php/check_call.php",
          dataType: "html",
          success: function(result){

            if(result == 'success') {
              location.href="/connect/dashboard/room.php?session_code="+'<? echo $session_code ?>';
            }
            
            if(result == 'wait') {
            }

          }
        });
    }
        
    </script>

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">       

        <div class="row h-100">
            <div class="col-12 col-md-6 col-lg-4 align-self-center text-center my-3 mx-auto ">
                <div class="mb-3">
                    <img class="img-responsive" src="<? echo $path; ?>/img/logo.png">
                </div>
                
                <div class="mb-3">
                    <img width="100" src="<? echo $path; ?>/img/loader.gif">
                </div>
                <h5 style="color:#ffd505;" class="mb-2 text-uppercase"><strong>AGUARDE...</strong></h5>
                <p style="font-size:16px; color:#fff;">Estamos buscando um intérprete disponível <br>para você!</p>
                <br>
                <button id="cancelar_chamada" class="btn btn-default rounded">Cancelar chamada</button>
                <input type="hidden" name="session_code" id="session_code" value="<? echo $session_code; ?>">
            </div>
        </div>

    </main>

  
    <? include '../includes/js.php'; ?>

    <script type="text/javascript">

      $(function() {
        $('#cancelar_chamada').click(function(event) {
    
            var cancel_call = '1';
            var session_code = $('#session_code').val();
            
            $.ajax({
              type: "POST",
              data: {cancel_call:cancel_call, session_code:session_code},
              
              url: "../php/cancel_call.php",
              dataType: "html",
              success: function(result){
    
                if(result == 'success') {
                  alert('Chamada Cancelada');
                  location.href="../dashboard/";
                }
    
              },
              beforeSend: function(){
                $('#background-load').css({display:"block"});
                $('#text-load').css({display:"block"});
              },
              complete: function(msg){
                $('#background-load').css({display:"none"});
                $('#text-load').css({display:"none"});
              }
            });
    
        });
      });
    
    setInterval(CheckCall, 7000); //3000 MS == 3 segundos

    </script>
    
</body>

</html>
