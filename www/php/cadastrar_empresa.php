<?php
include '../php/classes/conexao.class.php';
include 'empresas/empresas.class.php';
include 'empresas/empresas.dao.php';

/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);*/

if(isset($_POST)) {

    $nome = addslashes(trim($_POST['empresa']));
	$fone = addslashes(trim($_POST['fone']));
	$usuario = addslashes(trim(strtolower($_POST['usuario'])));
	$senha = addslashes(trim(base64_encode($_POST['senha'])));
	$hash = md5(uniqid(""));
	
    $empresas = new Empresas();
    $empresasDao = new EmpresasDao();
    
    $empresas->setNome($nome);
    $empresas->setFone($fone);
    $empresas->setUsuario($usuario);
    $empresas->setSenha($senha);
    $empresas->setHash($hash);

    $empresasDao->Inserir($empresas);
    
    echo 'success';

}


?>