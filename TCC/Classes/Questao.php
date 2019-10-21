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
}


?>