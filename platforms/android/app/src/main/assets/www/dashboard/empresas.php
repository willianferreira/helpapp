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
                
                <div class="form-group position-relative">
                    <div class="bottom-right">
                        <button id="buscar" class="btn btn-md btn-primary rounded">Buscar</button>
                    </div>
                    <input type="text" class="form-control" id="nome_empresa" placeholder="Buscar uma Empresa" value="">
                </div>
                
                <div class="card mb-4">
                    <div class="card-header border-0 bg-none">
                        <div class="row">
                            <div class="col align-self-center">
                                <h6 class="mb-0">Empresas Homologadas Helpvox</h6>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="cadastrar_empresa.php" class="btn btn-success btn-sm rounded">
                                    Cadastrar Nova Empresa
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="min-tablet font-weight-medium">Empresa</th>
                                    <th class="all font-weight-medium">Fone</th>
                                    <th class=" font-weight-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody id="lista_empresas">
                                
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </main>


    <? include '../includes/js.php'; ?>>

    <script type="text/javascript">

        $(document).ready(function(){
            
            var empresas = 'true';
            
            $.ajax({
                type: "POST",
                data: {empresas:empresas},
                url: "../php/buscar_empresas.php",
                beforeSend: function(){
                    $('#background-load').css({display:"block"});
                    $('#text-load').css({display:"block"});
                },
                success: function(result) {
                    $("#lista_empresas").html(result);
                },
                complete: function(msg){
                  $('#background-load').css({display:"none"});
                  $('#text-load').css({display:"none"});
                }
            });
        });
        
        $('#buscar').click(function(event) {

            var empresa = $('#nome_empresa').val();
            
            if(empresa == '') {
                return;
            }
            
            $.ajax({
              type: "POST",
              data: {search_empresa:empresa},
              
              url: "../php/buscar_empresas.php",
              dataType: "html",
              success: function(result){

                  $("#lista_empresas").html(result);

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

    </script>
    
</body>

</html>
