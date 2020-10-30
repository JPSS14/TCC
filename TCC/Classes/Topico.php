<?php

class Topico {


    private $idTopico;
    private $nomeTopico;
    private $idMateria;

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
    
    public function getIdMateria(){
        return $this -> idMateria;
    }
    
    public function setIdMateria($idMateria){
        $this -> idMateria = $idMateria;
    }
    
    public function cadastrar($cx){
     
        $conecta = $cx;
       
        $select = "INSERT INTO topico (idmateria, nome_topico) ";
        $select .= "VALUES ({$this->getIdMateria()},'{$this->getNomeTopico()}'); ";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
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
    
    public function retornarTopico($cx, $idTopicoS){
        $conecta = $cx;       
        $idTopico = $idTopicoS;
        
        
        $select = "SELECT * FROM topico WHERE idtopico={$idTopico}  ";
         $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco topico");
        }
        
        
        return $busca;
    }
 
}

    
?>