<?php

class Discursiva extends Questao{


    private $idDiscursiva;
    private $resposta;

    public function getIdDiscursiva(){
        return $this -> idDiscursiva;
    }
    
    public function setIdDiscursiva($idDiscursiva){
        $this -> idDiscursiva = $idDiscursiva;
    }
    
    public function getResposta(){
        return $this -> resposta;
    }
    
    public function setResposta($resposta){
        $this -> resposta = $resposta;
    }
 
    public function cadastrar($cx){
        $conecta = $cx;
        
        $select = "INSERT INTO discursiva (idquestao, resposta, iddiscursiva) ";
        $select .= "VALUES (LAST_INSERT_ID(), '{$this->getResposta()}',default)";
        
        $inserir = mysqli_query($conecta, $select);
        
        if(!$inserir){
            die("Erro no banco discursiva");
        }
    }
    
    public function alterar($cx, $idDiscursivaS){
        $conecta = $cx;
        $idDiscursiva= $idDiscursivaS;
         
        $select = "UPDATE alternativa SET ";
        $select .= "resposta='{$this->getResposta()}' ";
        $select .= "WHERE iddiscursiva ={$idDiscursiva} "; 
        
        $inserir = mysqli_query($conecta, $select);
        
        if(!$inserir){
            die("Erro no banco alt");
        }
    }
}


?>