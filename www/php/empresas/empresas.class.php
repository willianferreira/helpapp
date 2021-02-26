<?php
class Empresas {
    
    public $nome;
    public $fone;
    public $usuario;
    public $senha;
    public $hash;
    
    function getNome() {
        return $this->nome;
    }

    function getFone() {
        return $this->fone;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getHash() {
        return $this->hash;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setFone($fone) {
        $this->fone = $fone;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setHash($hash) {
        $this->hash = $hash;
    }



}