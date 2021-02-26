<?php
class Call {
    
    public $id_usuario;
    public $nome_usuario;
    public $id_interprete;
    public $session_code;
    public $token;
    public $created_at;
    public $status;
    public $status_atendimento;
    
    function getStatus_atendimento() {
        return $this->status_atendimento;
    }

    function setStatus_atendimento($status_atendimento) {
        $this->status_atendimento = $status_atendimento;
    }

        
    function getNome_usuario() {
        return $this->nome_usuario;
    }

    function setNome_usuario($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

        
    function getId_usuario() {
        return $this->id_usuario;
    }
    
    function getId_interprete() {
        return $this->id_interprete;
    }

    function getSession_code() {
        return $this->session_code;
    }

    function getToken() {
        return $this->token;
    }

    function getCreated_at() {
        return $this->created_at;
    }

    function getStatus() {
        return $this->status;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    function setId_interprete($id_interprete) {
        $this->id_interprete = $id_interprete;
    }

    function setSession_code($session_code) {
        $this->session_code = $session_code;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    function setStatus($status) {
        $this->status = $status;
    }



}