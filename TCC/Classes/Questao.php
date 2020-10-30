<?php

class Questao{


    private $enunciado;
    private $idQuestao;
    private $materia;
    private $topico;
    private $nivelQuestao;
    private $cpf;
    private $imagem;
    private $nivelEnsino;

    public function getNivelEnsino(){
        return $this -> nivelEnsino;
    }
    
    public function setNivelEnsino($nivelEnsino){
        $this -> nivelEnsino = $nivelEnsino;
    }
    public function getImagem(){
        return $this -> imagem;
    }
    
    public function setImagem($imagem){
        $this -> imagem = $imagem;
    }
    public function getEnunciado(){
        return $this -> enunciado;
    }
    
    public function setEnunciado($enunciado){
        $this -> enunciado = $enunciado;
    }
    
    public function getIdQuestao(){
        return $this -> idQuestao;
    }
    
    public function setIdQuestao($idQuestao){
        $this -> idQuestao = $idQuestao;
    }

    public function getMateria(){
        return $this -> materia;
    }
    
    public function setMateria($materia){
        $this -> materia = $materia;
    }

    public function getTopico(){
        return $this -> topico;
    }
    
    public function setTopico($topico){
        $this -> topico = $topico;
    }

    public function getNivelQuestao(){
        return $this -> nivelQuestao;
    }
    
    public function setNivelQuestao($nivelQuestao){
        $this -> nivelQuestao = $nivelQuestao;
    }

    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    public function cadastrarImg($cx, $destino){
        $conecta = $cx;
        $imagem = $destino;
        $select = "INSERT INTO questao (idquestao, cpf, enunciado, nivel_questao, idmateria, idtopico, publico, imagem, nivel_ensino) ";
        $select .= "VALUES (default,'{$this->getCpf()}','{$this->getEnunciado()}',{$this->getNivelQuestao()},{$this->getMateria()}, ";
        $select .= "{$this->getTopico()},0,'{$imagem}',{$this->getNivelEnsino()})";
        
        $cadastrar = mysqli_query($conecta, $select);
        if (!$cadastrar){
            die("Erro no banco");
        }
        
    }
     public function cadastrar($cx){
        $conecta = $cx;
        $select = "INSERT INTO questao (idquestao, cpf, enunciado, nivel_questao, idmateria, idtopico, publico, nivel_ensino) ";
        $select .= "VALUES (default,'{$this->getCpf()}','{$this->getEnunciado()}',{$this->getNivelQuestao()},{$this->getMateria()}, ";
        $select .= "{$this->getTopico()},0,{$this->getNivelEnsino()})";
        
        $cadastrar = mysqli_query($conecta, $select);
        if (!$cadastrar){
            die("Erro no banco questao");
        }
        
    }
    public function idQuestao($cx, $cpfS, $enunciadoS){
        $conecta = $cx;
        $cpf = $cpfS;
        $enunciado = $enunciadoS;
        
        $select ="SELECT * FROM questao WHERE ";
        $select .= "cpf = '{$cpf}' AND enunciado = '{$enunciado}' ";
        echo $cpf;
        echo $enunciado;
        
        $busca = mysqli_query($conecta, $select);
        $linha = mysqli_fetch_assoc($busca);
        echo $linha["cpf"];
        if(!$busca){
            die("Erro no banco");
        }
        return $busca;
    }
    
    public function retornarNaoValidada($cx){
        $conecta = $cx;       
        
        $select = "SELECT * FROM questao ";
        $select .= "WHERE  publico=0";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco a");
        }
        
        return $busca;
    }
    
    public function retornarAlternativa($cx, $idQuestaoS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        
        $select = "SELECT * FROM alternativa ";
        $select .= "WHERE  idquestao={$idQuestao}";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco a");
        }
        
        return $busca;
    }
    
    public function retornarDiscursiva($cx, $idQuestaoS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        
        $select = "SELECT * FROM discursiva ";
        $select .= "WHERE  idquestao={$idQuestao}";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco d");
        }
        
        return $busca;
    }
    
    public function validarQuestao($cx, $idQuestaoS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        
        $select = "UPDATE questao SET ";
        $select .= "publico=1 ";
        $select .= "WHERE  idquestao={$idQuestao}";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco v");
        }
        
        return $busca;
    }
    
    public function deletarQuestaoAlternativa($cx, $idQuestaoS, $idAlternativaS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        $idAlternativa = $idAlternativaS;
        
        $select = "DELETE FROM alternativa ";
        $select .= "WHERE  idquestao={$idQuestao}";
         $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco deletar alternativa");
        }
        $select = "DELETE FROM questao ";
        $select .= "WHERE  idquestao={$idQuestao}";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco deletar");
        }
        
        return $busca;
    }
    
    public function deletarQuestaoDiscursiva($cx, $idQuestaoS, $idDiscursivaS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        $idDiscursiva = $idDiscursivaS;
        
        $select = "DELETE FROM discursiva ";
        $select .= "WHERE  idquestao={$idQuestao}";
         $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco deletar discursiva");
        }
        $select = "DELETE FROM questao ";
        $select .= "WHERE  idquestao={$idQuestao}";
        
        $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco deletar");
        }
        
        return $busca;
    }
    
    public function alterar($cx, $idQuestaoS){
        $conecta = $cx;       
        $idQuestao = $idQuestaoS;
        
        
        $select = "UPDATE questao SET ";
        $select .= "enunciado='{$this->getEnunciado()}' ";
        $select .= "WHERE  idquestao={$idQuestao} ";
         $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco alterar questao");
        }
        
        
        return $busca;
    }
    
    
    
    
}


?>