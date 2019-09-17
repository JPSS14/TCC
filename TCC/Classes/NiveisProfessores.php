<?php

class NiveisProfessores{
    
    private $idNiveis;
    private $cpf;
    private $nomeNivel;
    

   
    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    public function getIdNiveis(){
        return $this -> idNiveis;
    }
    
    public function setIdNivel($idNiveis){
        $this -> idNiveis = $idNiveis;
    }
    
    public function getNomeNivel(){
        return $this -> nomeNivel;
    }
    
    public function setNomeNivel($nomeNivel){
        $this -> nomeNivel = $nomeNivel;
    }
    
    
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        
        $inserir = "INSERT INTO niveis_professores (cpf, nome_nivel) ";
        $inserir .= "VALUES ('{$this->getCpf()}', "; 
        $inserir.="(SELECT nome_nivel FROM nivel WHERE ";
        $inserir.= "idnivel='{$this->getNomeNivel()}'))";
        
        $operacao_inserir = mysqli_query($conecta,$inserir);
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
        
    }
    
    
}


?>