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
 
}


?>