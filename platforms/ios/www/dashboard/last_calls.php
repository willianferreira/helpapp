<?
    include '../includes/session.php';
    include '../php/classes/conexao.class.php';
    include '../monitoring/monitoring.dao.php';
    include '../php/call/call.dao.php';
    
    $monitoringDao = new MonitoringDao();
    $callDao = new CallDao();
    
    $id_usuario = base64_decode($_SESSION['id']);
    
    $resLigacoes = $callDao->SelectUltimasLigacoesEmpresas($id_usuario);
    

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
                        <span class="material-icons"></span>
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
            </div>
        </header>

        <!-- page content start -->
        <div class="container mb-4 px-0">
               
                <div class="container mt-3 mb-4 text-center">
                    <img class="img-responsive" src="<? echo $path ?>/img/logo.png">
                </div>
                
                <h3 class="text-white mt-2 text-center">Central de Acessibilidade</h3>

                <div class="text-left mb-3"><a href="index.php"><button class="btn btn-danger">Voltar</button></a></div>
            </div>
        </div>
        <div class="main-container">
            
            <h4 class="text-black mt-2 text-center">Ligações Recentes!</h4>

            <div class="container">

                <div class="card">
                    <div class="card-body px-0">
                        <div class="list-group list-group-flush">
                            
                            <? foreach($resLigacoes as $rowLigacoes) { ?>
                            <a class="list-group-item">
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        <? if($rowLigacoes['id_interprete'] != '0') { ?>
                                        <i style="color:#02aa0c;" class="material-icons">check_circle</i>
                                        <? } else { ?>
                                        <i style="color:#db1c1c;" class="material-icons">power_settings_new</i>
                                        <? } ?>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="row mb-1">
                                            <div class="col">
                                                <? if($rowLigacoes['id_interprete'] != '0') { ?>
                                                <h5 class="mb-0">Ligação Efetuada</h5>
                                                <p class="medium">Ligação atendida pelo operador.</p>
                                                <? } else { ?>
                                                <h5 style="color:#db1c1c;" class="mb-0">Ligação não atendida</h5>
                                                <p class="medium">Ligação não atendida pelo operador.</p>
                                                <? } ?>
                                            </div>
                                            <div class="col-auto pl-0">
                                                <h6 style="color:#082a78;" class="medium"><? echo date("d/m/Y - H:i", strtotime($rowLigacoes['created_at'])); ?> hrs</h6>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </a>
                            <? } ?>

                        </div>
                
            </div>
        </div>
    </main>


    <? include '../includes/js.php'; ?>

    
</body>

</html>
