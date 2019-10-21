<?php

class Alternativas extends Questao{

    private $idquestao;
    private $idAlternativa;
    private $resposta;
    private $alternativa1;
    private $alternativa2;
    private $alternativa3;
    private $alternativa4;

    public function getIdQuestao(){
        return $this -> idQuestao;
    }
    
    public function setIdQuestao($idQuestao){
        $this -> idQuestao = $idQuestao;
    }
    
    public function getIdAlternativa(){
        return $this -> idAlternativa;
    }
    
    public function setIdAlternativa($idAlternativa){
        $this -> idAlternativa = $idAlternativa;
    }
    
    public function getResposta(){
        return $this -> resposta;
    }
    
    public function setResposta($resposta){
        $this -> resposta = $resposta;
    }

    public function getAlternativa1(){
        return $this -> alternativa1;
    }
    
    public function setAlternativa1($alternativa1){
        $this -> alternativa1 = $alternativa1;
    }

    public function getAlternativa2(){
        return $this -> alternativa2;
    }
    
    public function setAlternativa2($alternativa2){
        $this -> alternativa2 = $alternativa2;
    }

    public function getAlternativa3(){
        return $this -> alternativa3;
    }
    
    public function setAlternativa3($alternativa3){
        $this -> alternativa3 = $alternativa3;
    }
    public function getAlternativa4(){
        return $this -> alternativa4;
    }
    
    public function setAlternativa4($alternativa4){
        $this -> alternativa4 = $alternativa4;
    }
    
    public function cadastrar($cx){
        $conecta = $cx;
        
        $select = "INSERT INTO alternativa (idquestao, resposta, alternativa1, alternativa2, alternativa3, alternativa4, idalternativa) ";
        $select .= "VALUES (LAST_INSERT_ID(),'{$this->getResposta()}', '{$this->getAlternativa1()}', '{$this->getAlternativa2()}', ";
        $select .= "'{$this->getAlternativa3()}','{$this->getAlternativa4()}',default)";
        
        $inserir = mysqli_query($conecta, $select);
        
        if(!$inserir){
            die("Erro no banco alt");
        }
    }

}


?>