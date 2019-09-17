<?php

class Serie{
    
    private $idSerie;
    private $nomeSerie;

   
    
    public function getIdSerie(){
        return $this -> idSerie;
    }
    
    public function setIdSerie($idSerie){
        $this -> idSerie = $idSerie;
    }
    
    public function getNomeSerie(){
        return $this -> nomeSerie;
    }
    
    public function setNomeNivel($nomeSerie){
        $this -> nomeSerie = $nomeSerie;
    }
    
    
    
}


?>