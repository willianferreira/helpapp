<?

    $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
    include '../php/classes/conexao.class.php';
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
    
    
    <?
        if($_SESSION['nivel'] == 'admin'){ 
            include '../includes/menu_admin.php'; 
        } 
    ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        
         <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="menu-btn btn btn-40 btn-link" type="button">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                    <a class="navbar-brand" href="#">
                        <h5 class="mb-0">Olá <? echo $_SESSION['nome']; ?> !</h5>
                    </a>
                </div>
                <div class="ml-auto col-auto">
                    <div class="ml-auto col-auto align-self-center">
                    <a href="?logout=true" class="text-white">
                        Sair do sistema
                    </a>
                </div>
            </div>
        </header>

        <!-- page content start -->
        <div class="container mb-4 px-0">
               
                <div class="container mt-3 mb-4 text-center">
                    <img class="img-responsive" src="<? echo $path ?>/img/logo.png">
                    <h3 class="text-white mt-2">Bem vindo a central de acessibilidade!</h3>
                    <h5 class="text-white mt-2">Clique no serviço que deseja utilizar...</h5>
                </div>

                <div class="swiper-pagination white-pagination text-left mb-3"></div>
            </div>
        </div>
        <div class="main-container">

            <div class="container">

                <div class="row">

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-200 position-relative">
                                <div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-danger rounded">Novo</button>
                                </div>
                                <a href="product.html" class="background">
                                    <img src="<? echo $path ?>/img/servicos/siv.png" alt="">
                                </a>
                            </div>
                            <div class="card-body ">
                                <p class="mb-0"><h4>SIV (Central de Intérpretes)</h4></p>
                                <p class="mb-0 text-justify">Faça ligações por videoconferência para pessoas e empresas com auxilio da central de intérpretes helpvox.</p>
                                <a href="last_calls.php"><button class="btn btn-danger text-white rounded my-3 mx-auto">Últimas Ligações</button></a>
                                <button id="ligar" class="btn btn-success text-white rounded my-3 mx-auto">Fazer Ligação</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-200 position-relative">
                                <div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-danger rounded">Novo</button>
                                </div>
                                <a href="product.html" class="background">
                                    <img src="<? echo $path ?>/img/servicos/sossurdo.png" alt="">
                                </a>
                            </div>
                            <div class="card-body ">
                                <p class="mb-0"><h4>SOS Surdo</h4></p>
                                <p class="mb-0 text-justify">Central de reclamação da comunidade surda sobre falta de acessibilidade.<br><br></p>
                                <a target="_BLANK" href="https://www.sossurdo.com.br" class="btn btn-success text-white rounded my-3 mx-auto">Acessar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-200 position-relative">
                                <div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-danger rounded">Novo</button>
                                </div>
                                <a href="product.html" class="background">
                                    <img src="<? echo $path ?>/img/servicos/helpvox.png" alt="">
                                </a>
                            </div>
                            <div class="card-body ">
                                <p class="mb-0"><h4>Helpvox</h4></p>
                                <p class="mb-0 text-justify">Soluções em acessibilidade para surdos e deficientes auditivos para o setor empresarial.<br><br></p>
                                <a target="_BLANK" href="https://www.helpvox.com.br" class="btn btn-success text-white rounded my-3 mx-auto">Acessar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <? include '../includes/js.php'; ?>

    <script type="text/javascript">

      $(function() {
        $('#ligar').click(function(event) {

            var make_call = '1';
            
            $.ajax({
              type: "POST",
              data: {make_call:make_call},
              
              url: "../php/make_call.php",
              dataType: "html",
              success: function(result){
                  
                  if(result == 'fail_interprete') {
                      alert('Todos os interpretes estão ocupados, aguarde 1 min e tente novamente...');
                  }else {
                      location.href="../dashboard/wait_interprete.php?session_code="+result;
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
      
      <? if($_SESSION['nivel'] == 'admin') { ?>
      function atualizaInterprete() {
      
            var status = 'true';

             $.ajax({
                type: "POST",
                data: {status:status},
                url: "status_interpretes.php",
                beforeSend: function(){
                    $('#background-load').css({display:"block"});
                    $('#text-load').css({display:"block"});
                },
                success: function(result) {
                    $("#status_interpretes").html(result);
                },
                complete: function(msg){
                  $('#background-load').css({display:"none"});
                  $('#text-load').css({display:"none"});
                }
            });
          
      }
      <? } ?>
      
    </script>
    
    
    
</body>

</html>
