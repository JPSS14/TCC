<?php

class Feedback {


    private $cpf;
    private $assunto;
    private $mensagem;

    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    public function getAssunto(){
        return $this -> assunto;
    }
    
    public function setAssunto($assunto){
        $this -> assunto = $assunto;
    }
    
    public function getMensagem(){
        return $this -> mensagem;
    }
    
    public function setMensagem($mensagem){
        $this -> mensagem = $mensagem;
    }
    
    public function cadastrar($cx){
     
        $conecta = $cx;
       
        $select = "INSERT INTO feedback (cpf, assunto, mensagem) ";
        $select .= "VALUES ('{$this->getCpf()}','{$this->getAssunto()}','{$this->getMensagem()}'); ";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco fdb");
        }
        
        return $inserir;
    }
    
    public function listarFeedbacks($cx){
        $conecta = $cx;
       
        $select = "SELECT * FROM feedback";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
    
    public function deletarFeedback($cx,$idFeedback){
        $feedback = $idFeedback;
        $conecta = $cx;
       
        $select = "DELETE  FROM feedback  ";
        $select .= "WHERE idfeedback={$feedback}";
       
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
 
}

    
?>