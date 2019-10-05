<?php

class Topico {


    private $idTopico;
    private $nomeTopico;

    public function getIdTopico(){
        return $this -> idTopico;
    }
    
    public function setIdTopico($idTopico){
        $this -> idTopico = $idTopico;
    }
    
    public function getNomeTopico(){
        return $this -> nomeTopico;
    }
    
    public function setNomeTopico($nomeTopico){
        $this -> nomeTopico = $nomeTopico;
    }
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        
        $select = "INSERT INTO topico (nome_topico) ";
        $select .= "VALUES ('{$this->getNomeTopico}')";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
    }
 
}

    
?>