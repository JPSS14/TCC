<?php

class Discursiva extends Questao{


    private $Id_discursiva;
    private $Resposta;

    public function getId_discursiva(){
        return $this -> Id_discursiva;
    }
    
    public function setId_discursiva($Id_discursiva){
        $this -> Id_discursiva = $Id_discursiva;
    }
    
    public function getIesposta(){
        return $this -> Resposta;
    }
    
    public function setResposta($Resposta){
        $this -> Resposta = $Resposta;
    }
 
}


?>