<?php
error_reporting(0);

class Usuario{
    
    public $_db;
    public $_cpf;
    public $_data_nascimento;
    
    public function autentica($cpf, $data_nascimento)
	{
		$this->_db = new Conexao();
		$this->_cpf = $cpf;
		$this->_data_nascimento = $data_nascimento;
		
		if(strlen($cpf) == 0 && strlen($cpf) == 0)
		{
			echo 'invalid_password';
			die();
		}
			
		$stmt = $this->_db->prepare("SELECT id, nome, cpf, data_nascimento, nivel from usuarios WHERE cpf = :cpf and data_nascimento= :data_nascimento limit 1");
		$stmt->bindParam(':cpf', $cpf);
		$stmt->bindParam(':data_nascimento', $data_nascimento);		
		$stmt->execute();
		
		$results = $stmt->fetch();	
		
		if(count($results) > 0 && ($results["cpf"] == $cpf && $results["data_nascimento"] == $data_nascimento))
		{
			$_SESSION['cpf'] = $cpf;
			$_SESSION['id'] = base64_encode($results["id"]);
			$_SESSION['nome'] = $results["nome"];
			$_SESSION['hash'] = base64_encode($_SESSION['nome']);
			$_SESSION['nivel'] = $results["nivel"];

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










