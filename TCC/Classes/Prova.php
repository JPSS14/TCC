<?php

class Prova {


    private $cpf;
    private $nomeProva;
    private $idMateria;

    public function getCpf(){
        return $this -> cpf;
    }
    
    public function setCpf($cpf){
        $this -> cpf = $cpf;
    }
    
    public function getNomeProva(){
        return $this -> nomeProva;
    }
    
    public function setNomeProva($nomeProva){
        $this -> nomeProva = $nomeProva;
    }
    
    
    public function cadastrar($cx){
     
        $conecta = $cx;
       
        $select = "INSERT INTO prova (cpf, nome) ";
        $select .= "VALUES ({$this->getCpf()},'{$this->getNomeProva()}'); ";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
    
    public function minhasProvas($cx,$cpfS){
        $conecta = $cx;
        $cpf = $cpfS;
        
        $select = "SELECT * FROM prova WHERE cpf={$cpf}";
        
        $busca = mysqli_query($conecta,$select);
        
        if(!$busca){
            die("erro no banco");
        }
        
        return $busca;
    }
    
    public function carregarProva($cx,$idprovaS){
        $conecta = $cx;
        $idProva = $idprovaS;
        
        $select = "SELECT * FROM prova_questoes WHERE ";
        $select .= "idprova = {$idProva}";
        
        $carregar = mysqli_query($conecta, $select);
        if(!$carregar){
            die("erro no banco");
        }
        
        return $carregar;
    }
    
    public function carregarQuestao($cx,$idQuestaoS){
        $conecta = $cx;
        $idQuestao = $idQuestaoS;
        
        $select = "SELECT * FROM questao WHERE ";
        $select .= "idquestao = {$idQuestao}";
        
        $carregar = mysqli_query($conecta, $select);
        if(!$carregar){
            die("erro no banco");
        }
        
        return $carregar;
    }
    
    public function carregarAlternativa($cx,$idAlternativaS){
        $conecta = $cx;
        $idAlternativa = $idAlternativaS;
        
        $select = "SELECT * FROM alternativa WHERE ";
        $select .= "idalternativa = {$idAlternativa}";
        
        $carregar = mysqli_query($conecta, $select);
        if(!$carregar){
            die("erro no banco a");
        }
        
        return $carregar;
    }
    
    public function carregarDiscursiva($cx,$idDiscursivaS){
        $conecta = $cx;
        $idDiscursiva = $idDiscursivaS;
        
        $select = "SELECT * FROM discursiva WHERE ";
        $select .= "iddiscursiva = {$idDiscursiva}";
        
        $carregar = mysqli_query($conecta, $select);
        if(!$carregar){
            die("erro no banco aqui");
        }
        
        return $carregar;
    }
    
    public function alterar($cx,$topicoS){
        $topico = $topicoS;
        $conecta = $cx;
       
        $select = "UPDATE  topico SET ";
        $select .= "nome_topico= '{$this->getNomeTopico()}' ";
        $select .= "WHERE idtopico={$topico}";
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco");
        }
        
        return $inserir;
    }
    
    public function deletarProva($cx,$idProvaS){
        $idProva = $idProvaS;
        $conecta = $cx;
       
        $select = "DELETE  FROM prova_questoes  ";
        $select .= "WHERE idprova={$idProva}";
       
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco prova questoes");
        }
        
        $select = "DELETE  FROM prova  ";
        $select .= "WHERE idprova={$idProva}";
       
        
        $inserir = mysqli_query($conecta, $select);
        
        if (!$inserir){
            die("Erro no Banco prova ");
        }
        
        return $inserir;
    }
 
}

    
?>