<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("localhost","root","","tcc"); 


        $nivel_ensino = 1; 
        $topico = 1;
        $tipo = 0;
        $total = 1;
   
    if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))&&(isset($_GET['tipo']))&&(isset($_GET['total']))&&(isset($_GET['facil']))) {

        $nivel_ensino = $_GET['nivel_ensino']; 
        $topico = $_GET['topico'];
        $tipo = $_GET['tipo'];
        $total = $_GET['total'];
        $facil = $_GET['facil'];
        
        if($tipo==0){
            $selecao = "DROP VIEW IF EXISTS prova_alternativa ";
            $produtos = mysqli_query($conecta,$selecao);
            if (!$produtos){
                die ("erro no banco drp");
            }
            $selecao = "CREATE VIEW prova_alternativa AS ";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, q.enunciado, q.imagem, a.idalternativa, ";
            $selecao .= "a.idquestao, a.resposta, a.alternativa1, a.alternativa2, a.alternativa3 ";
            $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
            $selecao .= "ON q.idquestao = a.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao=0 LIMIT {$facil}";
            $produtos = mysqli_query($conecta,$selecao);
            if (!$produtos){
                die ("erro no banco aqui");
            }
            $selecao = "SELECT * FROM prova_alternativa ";
            $produtos = mysqli_query($conecta,$selecao);
             if (!$produtos){
                die ("erro no banco");
            }
            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
            }
        }else{
            $selecao = "DROP VIEW IF EXISTS prova_discursiva ";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "CREATE VIEW prova_discursiva AS ";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, q.imagem, d.iddiscursiva, d.idquestao, ";
            $selecao .= "q.enunciado, d.resposta ";
            $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
            $selecao .= "ON q.idquestao = d.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino}";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "SELECT * FROM prova_discursiva";
            $produtos = mysqli_query($conecta,$selecao);
            
            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
            }
            
        }
         
        mb_convert_variables('UTF-8','iso-8859-1',$retorno);
        echo json_encode($retorno);
       
        
}

    if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))&&(isset($_GET['tipo']))&&(isset($_GET['total']))&&(isset($_GET['dificil']))) {

            $nivel_ensino = $_GET['nivel_ensino']; 
            $topico = $_GET['topico'];
            $tipo = $_GET['tipo'];
            $total = $_GET['total'];
            $dificil = $_GET['dificil'];

            if($tipo==0){
                $selecao = "DROP VIEW IF EXISTS prova_alternativa ";
                $produtos = mysqli_query($conecta,$selecao);
                if (!$produtos){
                    die ("erro no banco drp");
                }
                $selecao = "CREATE VIEW prova_alternativa AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, q.enunciado, q.imagem, a.idalternativa, ";
                $selecao .= "a.idquestao, a.resposta, a.alternativa1, a.alternativa2, a.alternativa3 ";
                $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
                $selecao .= "ON q.idquestao = a.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao=1 LIMIT {$dificil}";
                $produtos = mysqli_query($conecta,$selecao);
                if (!$produtos){
                    die ("erro no banco aqui");
                }
                $selecao = "SELECT * FROM prova_alternativa ";
                $produtos = mysqli_query($conecta,$selecao);
                 if (!$produtos){
                    die ("erro no banco");
                }
                $retorno = array();
                while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
                }
            }else{
                $selecao = "DROP VIEW IF EXISTS prova_discursiva ";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "CREATE VIEW prova_discursiva AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, q.imagem, d.iddiscursiva, d.idquestao, ";
                $selecao .= "q.enunciado, d.resposta ";
                $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
                $selecao .= "ON q.idquestao = d.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino}";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "SELECT * FROM prova_discursiva";
                $produtos = mysqli_query($conecta,$selecao);

                $retorno = array();
                while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
                }

            }

            mb_convert_variables('UTF-8','iso-8859-1',$retorno);
            echo json_encode($retorno);

        
}
        
        
       

?>