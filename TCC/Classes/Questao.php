<?php

class Questao{


    private $enunciado;
    private $idQuestao;
    private $materia;
    private $topico;
    private $nivelQuestao;
    private $cpf;


    public function getEnunciado(){
        return $this -> enunciado;
    }
    
    public function setEnunciado($enunciado){
        $this -> enunciado = $enunciado;
    }
    
    public function getIdQuestao(){
        return $this -> idQuestao;
    }
    
    public function setIdQuestao($idQuestao){
        $this -> idQuestao = $idQuestao;
    }

    public function getMateria(){
        return $this -> materia;
    }
    
    public function setMateria($materia){
        $this -> materia = $materia;
    }

    public function getTopico(){
        return $this -> topico;
    }
    
    public function setTopico($topico){
        $this -> topico = $topico;
    }

    public function getNivelQuestao(){
        return $this -> NivelQuestao;
    }
    
    public function setNivelQuestao($NivelQuestao){
        $this -> nivelQuestao = $nivelQuestao;
    }

    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
}


?>