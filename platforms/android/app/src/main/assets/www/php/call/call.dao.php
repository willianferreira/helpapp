<?php
class CallDao {
    
    public $_db;
    
    public function FazerLigacao(Call $call){
        $this->_db = new Conexao();
        $stmt = $this->_db->prepare("INSERT into ligacao(id_usuario, nome_usuario, id_interprete, session_code, token, created_at, status, status_atendimento) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $call->getId_usuario());
        $stmt->bindValue(2, $call->getNome_usuario());
        $stmt->bindValue(3, $call->getId_interprete());
        $stmt->bindValue(4, $call->getSession_code());
        $stmt->bindValue(5, $call->getToken());
        $stmt->bindValue(6, $call->getCreated_at());
        $stmt->bindValue(7, $call->getStatus());
        $stmt->bindValue(8, $call->getStatus_atendimento());
        $stmt->execute();
    }
    
    public function FazerLigacaoInterprete(Call $call){
        $this->_db = new Conexao();
        $stmt = $this->_db->prepare("INSERT into ligacao(id_usuario, nome_usuario, id_interprete, session_code, token, created_at, status, status_atendimento) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $call->getId_usuario());
        $stmt->bindValue(2, $call->getNome_usuario());
        $stmt->bindValue(3, $call->getId_interprete());
        $stmt->bindValue(4, $call->getSession_code());
        $stmt->bindValue(5, $call->getToken());
        $stmt->bindValue(6, $call->getCreated_at());
        $stmt->bindValue(7, $call->getStatus());
        $stmt->bindValue(8, $call->getStatus_atendimento());
        $stmt->execute();
    }
    
    public function CallLost(Call $call2){
        $this->_db = new Conexao();
        $stmt = $this->_db->prepare("INSERT into call_lost(nome_usuario, created_at) VALUES(?, ?)");
        $stmt->bindValue(1, $call2->getNome_usuario());
        $stmt->bindValue(2, $call2->getCreated_at());
        $stmt->execute();
    }

    public function Select(){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT * FROM ligacao");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function SelectInterpretes(){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT * FROM interpretes WHERE status = 1 ORDER BY RAND() limit 1");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function StatusInterpretes(){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT count(id) FROM interpretes WHERE status = 1");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function SetInterpreteOcupado($id_interprete, $status){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE interpretes SET status = '$status' WHERE id = '$id_interprete'");
        if($stmt == "") { return '0'; } else { $stmt;}
    }

    public function SelectUltimasLigacoes(){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT id, nome_usuario, session_code, created_at, status, status_atendimento FROM ligacao order by id desc limit 30");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }

    public function SelectSession($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT * FROM ligacao WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }

    /*public function CancelarChamada($id_usuario, $session_code, $updated_at){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET updated_at = '$updated_at', status = 'off' WHERE id_usuario = '$id_usuario' and session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }*/
    
    public function CloseCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET status = 'off' WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    /*public function CancelCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("DELETE FROM ligacao WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }*/
    
    public function CancelCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET status = 'off', id_interprete = '0' WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function OpenCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET status = 'on' WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }

    public function AtenderChamada($id_interprete, $session_code, $updated_at, $status_atendimento){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET id_interprete = '$id_interprete', updated_at = '$updated_at', status_atendimento = '$status_atendimento'  WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { $stmt;}
    }
    
    public function CheckCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT status_atendimento FROM ligacao WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function SelectUltimasLigacoesEmpresas($id_usuario){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT id, nome_usuario, id_interprete, session_code, created_at, status, status_atendimento FROM ligacao WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) and id_usuario = '$id_usuario' order by created_at desc");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function AtualizaInterprete($id_interprete, $session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET id_interprete = '$id_interprete', status_atendimento = '0' WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function TransferCall($session_code){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE ligacao SET status_atendimento = '0', status = 'on' WHERE session_code = '$session_code'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    
    public function DesativaInterprete($id_interprete){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("UPDATE interpretes SET status = '0' WHERE id = '$id_interprete'");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    
    //seleciona a ligacao especifica de acordo com o interprete
    public function SelectCall($id_interprete){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT nome_usuario, id_interprete, session_code FROM ligacao WHERE id_interprete = '$id_interprete' and status_atendimento = '0' order by id desc limit 1");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }
    
    public function SelectLastCalls($id_interprete){
        $this->_db = new Conexao();
        $stmt = $this->_db->query("SELECT nome_usuario, created_at FROM ligacao WHERE id_interprete = '$id_interprete' order by created_at desc limit 10");
        if($stmt == "") { return '0'; } else { return $stmt;}
    }


}