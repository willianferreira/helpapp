<?php
class EmpresasDao {
    
    public $_db;
    
    public function Inserir(Empresas $empresas){
        $this->_db = new Conexao();
        $stmt = $this->_db->prepare("INSERT into empresas(nome, fone, usuario, senha, hash) VALUES(?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $empresas->getNome());
        $stmt->bindValue(2, $empresas->getFone());
        $stmt->bindValue(3, $empresas->getUsuario());
        $stmt->bindValue(4, $empresas->getSenha());
        $stmt->bindValue(5, $empresas->getHash());
        $stmt->execute();
    }

    public function Select(){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT * FROM empresas");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function BuscarEmpresa($empresa){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT * FROM empresas WHERE nome LIKE '%$empresa%' ");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }


}