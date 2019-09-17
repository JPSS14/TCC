<?php

class Nivel{
    
    private $idNivel;
    private $nomeNivel;

   
    
    public function getIdNivel(){
        return $this -> idNivel;
    }
    
    public function setIdNivel($idNivel){
        $this -> idNivel = $idNivel;
    }
    
    public function getNomeNivel(){
        return $this -> nomeNivel;
    }
    
    public function setNomeNivel($nomeNivel){
        $this -> nomeNivel = $nomeNivel;
    }
    
    public function conexão(){
    $host="localhost";
    $usuario="root";
    $senha="";
    $bd="tcc";

    $conecta= mysqli_connect($host, $usuario, $senha, $bd);

    if(mysqli_connect_errno()){
        die ("Falha na conexão " . mysqli_connect_errno());
    } else echo ("Você conseguiu!!");
        return $conecta;
    }
    
    public function cadastrar(){
        
        
        
        $inserir = "INSERT INTO nivel (nome_nivel) ";
        $inserir .= "VALUES ('{$this->getNomeNivel()}')";
        
        $operacao_inserir = mysqli_query($this->conexão(), $inserir);
        
        
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
    }
    
    public function listaNivel(){
        $select = "SELECT idnivel, nome_nivel FROM nivel";
        
        $lista_nivel = mysqli_query($this->conexão(),$select);
        
        if(!$lista_nivel){
            die("Erro no banco");
        }
        return $lista_nivel;
    }
    
}


?>