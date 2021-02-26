<?
    $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
    include '../includes/session.php';
    
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

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <? include '../includes/css.php'; ?>
    
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="products">
    
    <!-- LOADING -->
    <div id="background-load">
    <div class="carregamento">          
          <div id="text-load"><img width="150" src="<? echo $path; ?>/img/loader.gif"></div> 
        </div>
    </div>

    <!-- screen loader -->
    <div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon icon-100 mb-4 rounded-circle">
                        <img src="<? echo $path; ?>/img/favicon144.png" alt="" class="w-100">
                    </div>
                    <h4 class="text-default">Helpvox</h4>
                    <p class="text-secondary">Tecnologia para inclusão social</p>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                    <a class="navbar-brand" href="index.php">
                        <h5 class="mb-0">Voltar</h5>
                    </a>
                </div>
                <div class="ml-auto col-auto">
                    <a href="profile.html" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                        <figure class="m-0 background">
                            <img src="img/user1.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </header>
        
        <div class="container mt-3 mb-4 text-center">
            <img class="img-responsive" src="<? echo $path ?>/img/logo.png">
        </div>

        <!-- page content start -->
        <div class="main-container">
            <div class="container">
                
                <div id="alert">
                    
                    
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="subtitle mb-0 text-center">
                            Homologar Contrato de Empresa
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group float-label active">
                            <input id="empresa" type="text" class="form-control" value="">
                            <label class="form-control-label">Nome da Empresa:</label>
                        </div>
                        <div class="form-group float-label">
                            <input id="fone" type="text" class="form-control" autofocus>
                            <label class="form-control-label">Fone:</label>                            
                        </div>
                        <div class="form-group float-label">
                            <input id="usuario" type="text" class="form-control" >
                            <label class="form-control-label">Crie um nome de usuário:</label>                            
                        </div>
                        <div class="form-group float-label">
                            <input id="senha" type="password" class="form-control" >
                            <label class="form-control-label">Crie uma senha:</label>                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="cadastrar" class="btn btn-success rounded">Cadastrar Empresa</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <? include '../includes/js.php'; ?>
    <script src="../js/jquery.maskedinput.min.js"></script>

	<script type="text/javascript">
	    $("#fone").mask("(99) 99999-9999");
  	</script>

    <script type="text/javascript">

      $(function() {
        $('#cadastrar').click(function(event) {

            var empresa = $('#empresa').val();
            var fone = $('#fone').val();
            var usuario = $('#usuario').val();
            var senha = $('#senha').val();
            
            $.ajax({
              type: "POST",
              data: {empresa:empresa, fone:fone, usuario:usuario, senha:senha},
              
              url: "../php/cadastrar_empresa.php",
              dataType: "html",
              success: function(result){

                  $('#alert').html('<div class="alert alert-success"><b>Empresa ativa e homologada com sucesso!</b></div>');
                  $('#empresa').val("");
                  $('#fone').val("");
                  $('#usuario').val("");
                  $('#senha').val("");
                  
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

    </script>
    
</body>

</html>
