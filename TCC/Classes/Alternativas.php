<?php

class Alternativas extends Questao{


    private $Id_alternativa;
    private $Resposta;
    private $Alternativa1;
    private $Alternativa2;
    private $Alternativa3;


    public function getId_alternativa(){
        return $this -> Id_alternativa;
    }
    
    public function setId_alternativa($Id_alternativa){
        $this -> Id_alternativa = $Id_alternativa;
    }
    
    public function getResposta(){
        return $this -> Resposta;
    }
    
    public function setResposta($Resposta){
        $this -> Resposta = $Resposta;
    }

    public function getAlternativa1(){
        return $this -> Alternativa1;
    }
    
    public function setAlternativa1($Alternativa1){
        $this -> Alternativa1 = $Alternativa1;
    }

    public function getAlternativa2(){
        return $this -> Alternativa2;
    }
    
    public function setAlternativa2($Alternativa2){
        $this -> Alternativa2 = $Alternativa2;
    }

    public function getAlternativa3(){
        return $this -> Alternativa3;
    }
    
    public function setAlternativa3($Alternativa3){
        $this -> Alternativa3 = $Alternativa3;
    }

}


?>