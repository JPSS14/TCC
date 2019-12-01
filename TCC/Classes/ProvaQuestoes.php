<?php

class ProvaQuestoes {

    private $idProva;
    private $idQuestao;
    private $idAlternativa;
    private $idDiscursiva;
    
    public function getIdProva(){
        return $this -> idProva;
    }
    
    public function setIdProva($idProva){
        $this -> idProva = $idProva;
    }
    
    public function getIdQuestao(){
        return $this -> idQuestao;
    }
    
    public function setIdQuestao($idQuestao){
        $this -> idQuestao = $idQuestao;
    }
    
    public function getIdAlternativa(){
        return $this -> idAlternativa;
    }
    
    public function setIdAlternativa($idAlternativa){
        $this -> idAlternativa = $idAlternativa;
    }
    
    public function getIdDiscursiva(){
        return $this -> idDiscursiva;
    }
    
    public function setIdDiscursiva($idDiscursiva){
        $this -> idDiscursiva = $idDiscursiva;
    }
    
    public function cadastrar($cx){
     
        $conecta = $cx;
       
        $select = "INSERT INTO prova_questoes (idprova_questoes, idprova, idquestao, idalternativa, iddiscursiva) ";
        $select .= "VALUES (default, {$this->getIdProva()}, {$this->getIdQuestao()},{$this->getIdAlternativa()},{$this->getIdDiscursiva()}); ";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco aqui");
        }
        
        return $inserir;
    }
    
    
    
    public function alterar($cx,$topicoS){
        $topico = $topicoS;
        $conecta = $cx;
       
        $select = "UPDATE  topico SET ";
        $select .= "nome_topico= '{$this->getNomeTopico()}' ";
        $select .= "WHERE idtopico={$topico}";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
    
    public function deletar($cx,$topicoS){
        $topico = $topicoS;
        $conecta = $cx;
       
        $select = "DELETE  FROM topico  ";
        $select .= "WHERE idtopico={$topico}";
       
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
 
}

    
?>