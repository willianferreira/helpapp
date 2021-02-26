<?php
error_reporting(0);

class Usuario{
    
    public $_db;
    public $_usuario;
    public $_senha;
    
    public function autentica($usuario, $senha)
	{
		$this->_db = new Conexao();
		$this->_cpf = $usuario;
		$this->_data_nascimento = $senha;
		
		if(strlen($usuario) == 0 && strlen($usuario) == 0)
		{
			echo 'invalid_password';
			die();
		}
			
		$stmt = $this->_db->prepare("SELECT * from empresas WHERE usuario = :usuario and senha = :senha limit 1");
		$stmt->bindParam(':usuario', $usuario);
		$stmt->bindParam(':senha', $senha);		
		$stmt->execute();
		
		$results = $stmt->fetch();	
		
		if(count($results) > 0 && ($results["usuario"] == $usuario && $results["senha"] == $senha))
		{
			$_SESSION['usuario'] = $usuario;
			$_SESSION['empresarial'] = 'sim';
			$_SESSION['id'] = base64_encode($results["id"]);
			$_SESSION['nome'] = $results["nome"];
			$_SESSION['hash'] = base64_encode($_SESSION['nome']);

			echo 'success';
			die();
		}
		else
		{
			echo 'invalid_password';
			die();
		}
    }
}










