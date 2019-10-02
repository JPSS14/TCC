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
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        
        $inserir = "INSERT INTO nivel (nome_nivel) ";
        $inserir .= "VALUES ('{$this->getNomeNivel()}')";
        
        $operacao_inserir = mysqli_query($conecta, $inserir);
        
        
        
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
    
    public function alterarNivel($cx, $idNivel, $nomeNivel){
        
        $conecta = $cx;
        $nome = $nomeNivel;
        $id = $idNivel;
        
        $select = "UPDATE nivel SET ";
        $select .= "nome_nivel = '{$nome}' ";
        $select .= "WHERE idnivel = {$id} ";
        
        $alterar = mysqli_query($conecta, $select);
        
        if(!$alterar){
            die("Erro no banco");
        }
        
        return $alterar;
        
    }
    
    public function deletarNivel($cx, $idNivel){
        
        $conecta = $cx;
        $id = $idNivel;
        
        $select = "DELETE FROM nivel ";
        $select .= "WHERE idnivel = {$id} ";
        
        $deletar = mysqli_query($conecta, $select);
        
        if(!$deletar){
            die("Erro no banco");
        }
        
        return $deletar;
        
    }
    
}


?>