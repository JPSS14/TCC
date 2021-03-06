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
    
    public function buscarPessoa($cx, $cpfS){
        $conecta = $cx;
        $cpf = $cpfS;
        $select = "SELECT * FROM pessoa";
        $select .= "WHERE cpf = '{$cpf}'";
        
        $pessoa = mysqli_query($conecta, $select);
        
        if(!$cpf){
            die("Erro no banco, falha na busca do cpf");
        }
        
        return $pessoa;
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
    
    public function adicionarAdm($cx, $cpfNovoAdm){
        $conecta = $cx;
        $cpf = $cpfNovoAdm;
        
        $select = "UPDATE pessoa SET ";
        $select .= "adm = 1 ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $adicionar = mysqli_query($conecta, $select);
        
        if (!$adicionar){
            die("Erro no Banco " . $cpf);
        }
        
        return $adicionar;
    }
    
     public function deletarUsuario($cx, $cpfDeletar){
        $conecta = $cx;
        $cpf = $cpfDeletar;
        
        $select = "SET SQL_SAFE_UPDATES=0 ";
        
        $deletar = mysqli_query($conecta, $select);
        
        if (!$deletar){
            header("location:DeletarUsuarioErro.php");
            die("Erro no Banco b oi" . $cpf);
            echo "oi";
        }
         
        $select = "DELETE FROM professor ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $deletar = mysqli_query($conecta, $select);
        
        if (!$deletar){
            header("location:DeletarUsuarioErro.php");
            die("Erro no Banco a " . $cpf);
            
        } 
        
        $select = "DELETE FROM niveis_professores ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $deletar = mysqli_query($conecta, $select);
        
        if (!$deletar){
            die("Erro no Banco c " . $cpf);
        }
         
         
        $select = "DELETE FROM pessoa ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $deletar = mysqli_query($conecta, $select);
        
        if (!$deletar){
            die("Erro no Banco b " . $cpf);
        }
        
        return $deletar;
    }
    
    public function alterarUsuarios($cx, $cpfAlterar, $nomeUsuario, $nomeCompleto, $emailS){
        $conecta = $cx;
        $cpf = $cpfAlterar;
        $usuario = $nomeUsuario;
        $nome = $nomeCompleto;
        $email = $emailS;
        
        $select = "UPDATE pessoa SET ";
        $select .= "nome_completo = '{$nome}', ";
        $select .= "usuario = '{$usuario}', ";
        $select .= "email = '{$email}' ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $alterar = mysqli_query($conecta, $select);
        
        if (!$alterar){
            die("Erro no banco");
        }
        
        return $alterar;
        
    }
    
    public function alterarSenha($cx, $cpfAlterar, $senhaS){
        $conecta = $cx;
        $cpf = $cpfAlterar;
        $senha = $senhaS;
        
        $select = "UPDATE pessoa SET ";
        $select .= "senha = '{$senha}' ";
        $select .= "WHERE cpf = '{$cpf}' ";
        
        $alterar = mysqli_query($conecta, $select);
        
        if (!$alterar){
            die("Erro no banco");
        }
        
        return $alterar;
        
    }
    
    public function totalQuestoesProfessor($cx, $cpfS){
        $conecta = $cx;
        $cpf = $cpfS;
        
        $select = "DROP VIEW IF EXISTS relatorio";
        $total = mysqli_query($conecta, $select);
        if(!$total){
            die("Erro no banco 1");
        }
        $select = "CREATE VIEW relatorio AS ";
        $select .= "SELECT p.cpf,q.publico FROM pessoa AS p ";
        $select .= "RIGHT JOIN questao AS q ON p.cpf=q.cpf";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 2");
          }
        $select = "SELECT cpf, COUNT(cpf) AS total FROM relatorio WHERE cpf='{$cpf}' AND publico=1";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 3");
        }
             
        return $total;
    }
    
}


?>