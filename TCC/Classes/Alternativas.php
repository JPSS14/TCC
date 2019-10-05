<?php

class Alternativas extends Questao{


    private $idAlternativa;
    private $resposta;
    private $alternativa1;
    private $alternativa2;
    private $alternativa3;


    public function getIdAlternativa(){
        return $this -> idAlternativa;
    }
    
    public function setIdAlternativa($idAlternativa){
        $this -> idAlternativa = $idAlternativa;
    }
    
    public function getResposta(){
        return $this -> resposta;
    }
    
    public function setResposta($resposta){
        $this -> resposta = $resposta;
    }

    public function getAlternativa1(){
        return $this -> alternativa1;
    }
    
    public function setAlternativa1($alternativa1){
        $this -> alternativa1 = $alternativa1;
    }

    public function getAlternativa2(){
        return $this -> alternativa2;
    }
    
    public function setAlternativa2($alternativa2){
        $this -> alternativa2 = $alternativa2;
    }

    public function getAlternativa3(){
        return $this -> alternativa3;
    }
    
    public function setAlternativa3($alternativa3){
        $this -> alternativa3 = $alternativa3;
    }

}


?>