<?php



class Professor extends pessoa{
    
   
    private $estado;
    private $idProfessor;
    

    public function getEstado(){
        return $this -> estado;
    }
    
    public function setEstado($estado){
        $this -> estado = $estado;
    }
    
    public function getIdProfessor(){
        return $this->idProfessor;
    }
    
    public function setIdProfessor($idProfessor){
        $this->idProfessor = $idProfessor;
    }
    
   
    
    public function cadastrar($cx){
        
        $conecta = $cx;
        echo (" " . $this->getEstado() . " ");
        $inserir = "INSERT INTO professor (cpf, estado) ";
        $inserir .= "VALUES ('{$this->getCpf()}', (SELECT ";
        $inserir .= "nome_estado FROM estados WHERE ";
        $inserir .= "idestado='{$this->getEstado()}'))";
        
        $operacao_inserir = mysqli_query($conecta, $inserir);
        
        
        
        if(!$operacao_inserir){
            die("Erro no banco!");
        }
    }
    
    public function exibirDados($cx){
        $conecta = $cx;
        
        $select = "SELECT p.senha, p.nome_completo, p.usuario, p.email, pro.estado, ";
        $select .= "nvp.nome_nivel, ml.nome_materia ";
        $select .= "FROM pessoa AS p ";
        $select .= "RIGHT JOIN senha AS p ON p.cpf = pro.cpf ";
        $select .= "RIGHT JOIN professor AS pro ON p.cpf = pro.cpf ";
        $select .= "RIGHT JOIN niveis_professores AS nvp ON p.cpf = nvp.cpf ";
        $select .= "RIGHT JOIN materias_lecionadas AS ml ON p.cpf = ml.cpf";
        
        $exibirDados = mysqli_query($conecta, $select);
        if(!$exibirDados){
            die("Erro no banco");
        }
        return $exibirDados;
    }
    
    public function exibirDadosProfessor($cx, $cpfS){
        $conecta = $cx;
        $cpf = $cpfS;
        
        $select = "SELECT p.cpf, p.senha, p.nome_completo, p.usuario, p.email, pro.estado, ";
        $select .= "nvp.nome_nivel ";
        $select .= "FROM pessoa AS p ";
        $select .= "RIGHT JOIN professor AS pro ON p.cpf = pro.cpf ";
        $select .= "RIGHT JOIN niveis_professores AS nvp ON p.cpf = nvp.cpf ";
        $select .= "WHERE p.cpf = '{$cpf}'";
        
        
        
        $exibirDados = mysqli_query($conecta, $select);
        if(!$exibirDados){
            die("Erro no banco");
        }
        return $exibirDados;
    }
    
   public function alterarDados($cx, $cpfS, $estadoS){
       $conecta = $cx;
       $cpf = $cpfS;
       $estado = $estadoS;
       
      
       $select = "UPDATE professor SET ";
       $select .= "estado = (SELECT nome_estado ";
       $select .= "FROM estados WHERE idestado = {$estado}) ";
       $select .= "WHERE cpf = '{$cpf}'; ";
        
       echo $estado;
       echo $cpf;
       
       $alterarProfessor = mysqli_query($conecta, $select);
       
       if(!$alterarProfessor){
           die("Erro no banco");
       }
       
       return $alterarProfessor;
   
   }
    
    public function totalEstado($cx, $estado){
        $conecta = $cx;
        $estados = $estado;
        
        $select = "DROP VIEW IF EXISTS relatorio";
        $total = mysqli_query($conecta, $select);
        if(!$total){
            die("Erro no banco 1");
        }
        $select = "CREATE VIEW relatorio AS ";
        $select .= "SELECT e.nome_estado FROM estados AS e ";
        $select .= "RIGHT JOIN professor AS p ON e.nome_estado=p.estado";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 2");
          }
        $select = "SELECT nome_estado, COUNT(nome_estado) AS total FROM relatorio WHERE nome_estado='{$estados}'";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 3");
        }
             
        return $total;
    }
    
    public function totalProfessores($cx){
        $conecta = $cx;
        
       
        $select = "SELECT COUNT(cpf) AS total FROM professor";

        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco");
          }
             
        return $total;
    }

}


?>