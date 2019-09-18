<?php

class Pessoa{
    
    private $nome_completo;
    private $email;
    private $usuario;
    private $senha;
    private $adm;
    private $cpf;
    
    public function getNomeCompleto(){
        return $this -> nomeCompleto;
    }
    
    public function setNomeCompleto($nomeCompleto){
        $this -> nomeCompleto = $nomeCompleto;
    }
    
    public function getEmail(){
        return $this -> email;
    }
    
    public function setEmail($email){
        $this -> email = $email;
    }
    
    public function getUsuario(){
        return $this -> usuario;
    }
    
    public function setUsuario($usuario){
        $this -> usuario = $usuario;
    }
    
    public function getSenha(){
        return $this -> senha;
    }
    
    public function setSenha($senha){
        $this -> senha = $senha;
    }
    
    public function getAdm(){
        return $this -> adm;
    }
    
    public function setAdm($adm){
        $this -> adm = $adm;
    }
    
    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        echo (" " . $this->getUsuario() . " ");
        $inserir = "INSERT INTO pessoa (usuario, nome_completo, email, senha, cpf, adm)";
        $inserir .= "VALUES ('{$this->getUsuario()}','{$this->getNomeCompleto()}','{$this->getEmail()}','{$this->getSenha()}', ";
        $inserir .= "'{$this->getCpf()}',0)";
        
        $operacao_inserir = mysqli_query($conecta, $inserir);
        
        
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
    }
    
    public function listaPessoa($cx){
        $conecta = $cx;
        $select = "SELECT * FROM pessoa";
        $lista_pessoa = mysqli_query($conecta, $select);
        
        if(!$lista_pessoa){
            die("Erro no banco");
        }
        return $lista_pessoa;
    }
    
    public function buscarCpf($cx, $emailS){
        $conecta = $cx;
        $email = $emailS;
        $select = "SELECT cpf FROM pessoa";
        $select .= "WHERE email = '{$email}'";
        
        $cpf = mysqli_query($conecta, $select);
        
        if(!$cpf){
            die("Erro no banco, falha na busca do cpf");
        }
        
        return $cpf;
    }
    
    public function alterarDadosPessoa($cx, $cpfS, $nomeCompletoS, $usuarioS, $emailS){
        
        $conecta = $cx;
        $usuario = $usuarioS;
        $nomeCompleto = $nomeCompletoS;
        $cpf = $cpfS;
        $email = $emailS;
        
        echo ("...." . $cpf . " " . $nomeCompleto . " " . $usuario . " " );
        
        $select = "UPDATE pessoa SET ";
        $select .= "nome_completo = '{$nomeCompleto}', ";
        $select .= "usuario = '{$usuario}', ";
        $select .= "email = '{$email}' ";
        $select .= "WHERE cpf = '{$cpf}'";
        
    
        $alterarPessoa = mysqli_query($conecta, $select);
        if (!$alterarPessoa){
            die("Erro no Banco");
        }
        
        return $alterarPessoa;
    }
    
    
}


?>