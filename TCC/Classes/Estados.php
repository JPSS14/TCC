<?php

class Estados{
    
    private $idEstado;
    private $nomeEstado;
    private $sigla;
   
    
    public function getIdEstado(){
        return $this -> idEstado;
    }
    
    public function setIdEstado($idEstado){
        $this -> idEstado = $idEstado;
    }
    
    public function getNomeEstado(){
        return $this -> nomeEstado;
    }
    
    public function setNomeEstado($nomeEstado){
        $this -> nomeEstado = $nomeEstado;
    }
    
    public function getSigla(){
        return $this -> sigla;
    }
    
    public function setSigla($sigla){
        $this -> sigla = $sigla;
    }
    
    public function conexão(){
    $host="localhost";
    $usuario="root";
    $senha="";
    $bd="tcc";

    $conecta= mysqli_connect($host, $usuario, $senha, $bd);

    if(mysqli_connect_errno()){
        die ("Falha na conexão " . mysqli_connect_errno());
    } else 
        return $conecta;
    }
    
    public function cadastrar(){
        
        $inserir = "INSERT INTO estados (sigla, nome_estado) ";
        $inserir .= "VALUES ('{$this->getSigla()}','{$this->getNomeEstado()}')";
        
        $operacao_inserir = mysqli_query($this -> conexão(),$inserir);
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
        
    }
    
    public function listaEstados(){
        
        $select = "SELECT idestado, nome_estado ";
        $select .= "FROM estados ";
        $lista_estados = mysqli_query($this->conexão(),$select);
        if(!$lista_estados){
            die("Erro no banco");
        }
        return $lista_estados;
    }
    
     public function exibirEstado($cx, $usuarioS){
        $conecta = $cx;
        $usuario = $usuarioS;
        
        $select = "SELECT idestado FROM estados ";
        $select .= "WHERE nome_estado = '{$usuario}'";
         
        
         
        $estadoAtual = mysqli_query($conecta, $select);
        if(!$estadoAtual){
            die("Erro no banco");
        }
        return $estadoAtual;
    }
    
}


?>