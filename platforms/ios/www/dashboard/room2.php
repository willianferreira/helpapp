<?
session_start();
require '../php/vendor/autoload.php';

//importa as bibliotecas
use OpenTok\OpenTok;
use OpenTok\MediaMode;
use OpenTok\ArchiveMode;

if(isset($_GET['session_code'])) {
    
    include '../php/classes/conexao.class.php';
    include '../monitoring/monitoring.dao.php';
    
    $monitoringDao = new MonitoringDao();
    $verifySession = $monitoringDao->VerifySession(addslashes($_GET['session_code']));
    
    /*foreach($verifySession as $sessionVerified) {
       if($sessionVerified['status'] == 'off') {
           echo '<script language= "JavaScript">location.href="https://www.helpvox.com.br";</script>';
       }
    }*/
    
    $session_code = addslashes(trim($_GET['session_code'])); //get da sessao
    $apiObj = new OpenTok('46874594', '3bb8041b110a0fccade309060dcfe15ca52055e2'); // Somente conecta as credenciais no opentok
    $token = $apiObj->generateToken($session_code); //gera um token da ligacao baseada na sessao
}else {
    echo '<script language= "JavaScript">location.href="https://www.helpvox.com.br";</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title> Video e Chat - Helpvox </title>
    <meta name="viewport" content="width=device-width, user-scalable=no" />
     <script src="https://static.opentok.com/v2/js/opentok.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.min.js" charset="utf-8"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" charset="utf-8"></script>
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link type="text/css" rel="stylesheet" media="all and (min-width: 702px)" href="css/app.css"> <!-- desktop -->
    <link type="text/css" rel="stylesheet" media="all and (min-width: 1px) and (max-width: 701px)" href="css/app2.css"> <!-- mobile -->
    
    <script type="text/javascript">
        
        var SAMPLE_SERVER_BASE_URL = 'https://www.helpvox.com.br';

        var API_KEY = '46874594';
        var SESSION_ID = '<? echo $session_code ?>';
        var TOKEN = '<? echo $token ?>';
        
    </script>
    
    <style>
    
        /* Loading */
        #background-load { position: fixed;background: #000;z-index: 500000;width: 100%;min-height: 100%;opacity: 0.8;display: none; }
        #text-load { position: fixed;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%);z-index: 500001;display: none;}
        
        .OT_subscriber { z-index:9999 !important; }
        #background-load { z-index:1 !important; }
        
        #subscriber { z-index:99999 !important; }
        #publisher { z-index:99999 !important; }
        #helpvox { z-index:999999 !important; }
        #textchat { z-index:999999 !important; }
        
        #mobile { display:none; }
    
        @media all and (min-width: 1001px) {
            #btn {
                padding: 5px;
                position: absolute;
                z-index: 100;
                bottom: 5%;
                left: 43%;
                cursor:pointer;
                
            }
            
            #text-load { left:50% !important; }
        }
    
        @media all and (max-width: 1000px) {
            #btn {
                padding: 5px;
                position: absolute;
                z-index: 100;
                bottom: 5%;
                left: 39%;
                cursor:pointer;
                
            }
            
            #chat {
                padding: 5px;
                position: absolute;
                z-index: 101;
                bottom: 5%;
                left: 80%;
                cursor:pointer;
                
            }
        }
        
        
    </style>
    
</head>

<body>
    
    <!-- LOADING -->
    <div id="background-load">
    <div class="carregamento">          
          <div id="text-load"><img width="150" src="<? echo $path; ?>/img/loader.gif"></div> 
        </div>
    </div>
        
        <div id="helpvox"><img width="100%" src="https://www.helpvox.com.br/images/logo.png" /> 
        <? if(isset($_SESSION['id_interprete'])) { ?>
        <a class="btn btn-success" id="transfer_call" href="transfer_call.php?session_code=<? echo $_GET['session_code']; ?>">Transferir Ligação</a> 
        <? } ?>
        
        </div>
        
        <div id="subscriber">
            
            <div style="display:block;" id="background-load">
            <div style="display:block;" class="carregamento">          
                  <div style="display:block;" id="text-load"><img width="150" src="<? echo $path; ?>/img/loader.gif"></div> 
                </div>
            </div>
            
        </div>
        
        <div id="publisher">
            <div id="btn" style="padding:5px;"><img src="https://www.helpvox.com.br/connect/img/call_off.png" /></div>
            <div id="chat" style="padding:5px;"><img src="https://www.helpvox.com.br/connect/img/chat.png" /></div>
        </div>
        
        <div id="textchat">
         <p id="history"></p>
         <div class="chat">
             <!--<p style="font-family:arial; margin-left:20px;">Chat para Usuários:</p>-->
             <form>
                  <input type="text" placeholder="Chat para Usuários. Digite uma mensagem..." id="msgTxt" />
                  <input id="enviar" type="submit" name="enviar" value="enviar" />
                  <button id="fechar" style="position: absolute;bottom: 5px;right: 12px;width: 91%;border-radius: 10px;background-color: #B02B2B; /* Red */border: none;color: white;padding: 8px 20px;text-align: center;text-decoration: none; display: inline-block;font-size: 13px;">Fechar Chat</button>
             </form>
         </div>
        </div>

    
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script type="text/javascript">
    
    
        var session_code = "<?php echo $_GET['session_code']; ?>";
          
        $("#btn").click(function() {
            
          session.disconnect();
          window.location.href = "close_call.php?session_code="+session_code;
          
        });
        
        $( "#fechar" ).click(function() {
          $("#textchat").css("display", "none");
        });
        
        $( "#chat").click(function() {
          $("#textchat").css("display", "block");
        });
        
        $('#transfer_call').click(function(event) {

            $('#background-load').css({display:"block"});
            $('#text-load').css({display:"block"});

        });
        
        $(window).on("load", function(){
            $('#background-load').css('display', 'none');
            $('#text-load').css('display', 'none');
        });
        
        
    </script>
    
    
    
</body>

</html>