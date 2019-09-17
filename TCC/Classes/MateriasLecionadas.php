<?php

class MateriasLecionadas{
    
    private $email;
    private $idMateriaLeciona;
    private $nomeMateria;
    

   
    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    public function getIdMateriaLeciona(){
        return $this -> idMateriaLeciona;
    }
    
    public function setIdNivel($idMateriaLeciona){
        $this -> idMateriaLeciona = $idMateriaLeciona;
    }
    
    public function getNomeMateria(){
        return $this -> nomeMateria;
    }
    
    public function setNomeMateria($nomeMateria){
        $this -> nomeMateria = $nomeMateria;
    }
    
    
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        
        $inserir = "INSERT INTO materias_lecionadas (cpf, nome_materia) ";
        $inserir .= "VALUES ('{$this->getCpf()}', (SELECT ";
        $inserir .= " nome_materia FROM materias WHERE ";
        $inserir .= "idmateria = '{$this->getNomeMateria()}'))";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
        
    }
    
    
}


?>