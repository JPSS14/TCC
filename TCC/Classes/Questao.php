<?php

class Questao{


    private $Enunciado;
    private $Id_questao;
    private $Materia;
    private $Topico;
    private $Nivel_questao;
    private $CPF;


    public function getEnunciado(){
        return $this -> Enunciado;
    }
    
    public function setEnunciado($Enunciado){
        $this -> Enunciado = $Enunciado;
    }
    
    public function getId_questao(){
        return $this -> Id_questao;
    }
    
    public function setId_questao($Id_questao){
        $this -> Id_questao = $Id_questao;
    }

    public function getMateria(){
        return $this -> Materia;
    }
    
    public function setMateria($Materia){
        $this -> Materia = $Materia;
    }

    public function getTopico(){
        return $this -> Topico;
    }
    
    public function setTopico($Topico){
        $this -> Topico = $Topico;
    }

    public function getNivel_questao(){
        return $this -> Nivel_questao;
    }
    
    public function setNivel_questao($Nivel_questao){
        $this -> Nivel_questao = $Nivel_questao;
    }

    public function getCPF(){
        return $this -> CPF;
    }
    
    public function setCPF($CPF){
        $this -> CPF = $CPF;
    }
}


?>