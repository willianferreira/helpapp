<?

    if(isset($_POST['empresas'])){
        $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
        include 'classes/conexao.class.php';
        include 'empresas/empresas.dao.php';
        
        $empresasDao = new EmpresasDao();
        $resEmpresas = $empresasDao->Select();
        
        foreach($resEmpresas as $rowEmpresas) { ?>
        
            <!-- empresa -->
            <tr>
                <td>
                    <div class="media">
                        <figure class="mb-0 avatar avatar-40 mr-2 rounded-circle">
                            <div class="background">
                                <img src="../img/user2.png" alt="">
                            </div>
                        </figure>
                        <div class="media-body">
                            <p class="mb-0"><? echo $rowEmpresas['nome']; ?></p>
                            <p class="text-secondary small">Usuário: <? echo $rowEmpresas['usuario']; ?></p>
                        </div>
                    </div>
                </td>
                <td><? echo $rowEmpresas['fone']; ?></td>
                <td>
                    <? if($rowEmpresas['situacao'] == '0') { echo '<button class="btn-success btn btn-sm rounded">Ativo</button>'; } ?>
                    <? if($rowEmpresas['situacao'] == '1') { echo '<button class="btn-danger btn btn-sm rounded">Suspenso</button>'; } ?>
                </td>
            </tr>
            <!-- empresa -->
            
       <? }                        
        
    }
    
   if(isset($_POST['search_empresa'])){
        $path = 'https://'. $_SERVER['SERVER_NAME'] . '/connect';
        include 'classes/conexao.class.php';
        include 'empresas/empresas.dao.php';
        
        $empresa = addslashes(trim($_POST['search_empresa']));
        
        $empresasDao = new EmpresasDao();
        $resEmpresas = $empresasDao->BuscarEmpresa($empresa);
        
        foreach($resEmpresas as $rowEmpresas) { ?>
        
            <!-- empresa -->
            <tr>
                <td>
                    <div class="media">
                        <figure class="mb-0 avatar avatar-40 mr-2 rounded-circle">
                            <div class="background">
                                <img src="../img/user2.png" alt="">
                            </div>
                        </figure>
                        <div class="media-body">
                            <p class="mb-0"><? echo $rowEmpresas['nome']; ?></p>
                            <p class="text-secondary small">Usuário: <? echo $rowEmpresas['usuario']; ?></p>
                        </div>
                    </div>
                </td>
                <td><? echo $rowEmpresas['fone']; ?></td>
                <td>
                    <? if($rowEmpresas['situacao'] == '0') { echo '<button class="btn-success btn btn-sm rounded">Ativo</button>'; } ?>
                    <? if($rowEmpresas['situacao'] == '1') { echo '<button class="btn-danger btn btn-sm rounded">Suspenso</button>'; } ?>
                </td>
            </tr>
            <!-- empresa -->
            
       <? }                        
        
    }
    
    
?>