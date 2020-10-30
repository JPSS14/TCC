<?php

class Materias{
    
    private $idMateria;
    private $nomeMateria;

   
    
    public function getIdMateria(){
        return $this -> idMateria;
    }
    
    public function setIdMateria($idMateria){
        $this -> idMateria = $idMateria;
    }
    
    public function getNomeMateria(){
        return $this -> nomeMateria;
    }
    
    public function setNomeMateria($nomeMateria){
        $this -> nomeMateria = $nomeMateria;
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
        
        
        
        $inserir = "INSERT INTO materias (nome_materia) ";
        $inserir .= "VALUES ('{$this->getNomeMateria()}')";
        
        $operacao_inserir = mysqli_query($this->conexão(), $inserir);
        
        
        
        if(!$operacao_inserir){
            die("Erro no banco");
        }
    }
    
    public function listaMaterias(){
        $select="SELECT idmateria, nome_materia FROM ";
        $select.="materias ORDER BY nome_materia ASC";
        
        $lista_materias = mysqli_query($this->conexão(),$select);
        
        if(!$lista_materias){
            die("Erro no banco");
        }
        
         mb_convert_variables('UTF-8','iso-8859-1',$lista_materias);
        return $lista_materias;
    }
    
    public function deletarMaterias($cx, $materiaDeletar){
        $conecta = $cx;
        $materia = $materiaDeletar;
        
        $select = "DELETE FROM materias ";
        $select .= "WHERE idmateria = '{$materia}'";
            
        $deletar = mysqli_query($conecta, $select);
        
        if(!$deletar){
            header("location:DeletarMateriaErro.php");
            die("Erro no Banco");
              
        }
        
        return $deletar;
    }
    
    public function alterarMaterias($cx, $idMaterias, $nomeMateria){
        $conecta = $cx;
        $idMateria = $idMaterias;
        $materia = $nomeMateria;
        
        $select = "UPDATE materias SET ";
        $select .= "nome_materia = '{$materia}' ";
        $select .= "WHERE idmateria = {$idMateria}";
        
        $alterar = mysqli_query($conecta, $select);
        
        if(!$alterar){
            die("Erro no Banco");
        }
        
        return $alterar;
        
    }
    
    public function exibirTopicos(){
        $id = $_GET['id'];
        $select = "SELECT * FROM topico ";
        $select .= "WHERE idmateria = '{$id}' ORDER BY nome ";
        
        $exibir = mysqli_query($this->conecta,$select);
        
        while($linha = mysqli_fetch_assoc($exibir)){
            $nome = $linha["nome"];
            $id = $linha["idtopico"];
            
            echo '<option value="$id">echo $nome</option>';
        }
    }
     public function totalQuestoes($cx, $materia){
        $conecta = $cx;
        $materias = $materia;
        
        $select = "DROP VIEW IF EXISTS relatorio";
        $total = mysqli_query($conecta, $select);
        if(!$total){
            die("Erro no banco 1");
        }
        $select = "CREATE VIEW relatorio AS ";
        $select .= "SELECT m.nome_materia, q.publico FROM materias AS m ";
        $select .= "RIGHT JOIN questao AS q ON m.idmateria=q.idmateria";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 2");
          }
        $select = "SELECT nome_materia, COUNT(nome_materia) AS total FROM relatorio WHERE nome_materia='{$materias}' AND publico=1";
        $total = mysqli_query($conecta, $select);
          if(!$total){
            die("Erro no banco 3");
        }
             
        return $total;
    }
    
     public function retornarMaterias($cx, $idMateriaS){
        $conecta = $cx;       
        $idMateria = $idMateriaS;
        
        
        $select = "SELECT * FROM materias WHERE idmateria={$idMateria}  ";
         $busca = mysqli_query($conecta, $select);
        if(!$busca){
            die("erro no banco alterar questao");
        }
        
        
        return $busca;
    }
    
}


?>