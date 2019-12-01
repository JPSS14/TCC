<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("localhost","root","","tcc"); 

   
    if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))&&(isset($_GET['tipo']))&&(isset($_GET['prova']))) {

        $nivel_ensino = $_GET['nivel_ensino']; 
        $topico = $_GET['topico'];
        $tipo = $_GET['tipo'];
        
        if($tipo==0){
            $selecao = "DROP VIEW prova_discursiva ";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "CREATE VIEW prova_alternativa";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, a.idalternativa, a.idquestao, ";
            $selecao .= "q.enunciado, a.resposta, a.alternativa1, a.alternativa2, a.alternativa3 ";
            $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
            $selecao .= "ON q.idquestao = a.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND publico=1";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "SELECT COUNT (*) AS FROM prova_alternativa";
            $produtos = mysqli_query($conecta,$selecao);
                
            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
            }
        }else{
            $selecao = "DROP VIEW prova_discursiva ";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "CREATE VIEW prova_discursiva AS ";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, d.iddiscursiva, d.idquestao, ";
            $selecao .= "q.enunciado, d.resposta ";
            $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
            $selecao .= "ON q.idquestao = d.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND publico=1";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "SELECT * FROM prova_discursiva";
            $produtos = mysqli_query($conecta,$selecao);
            
            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
            }
            
        }
        echo json_encode($retorno);
    }
    if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))&&(isset($_GET['tipo']))&&(isset($_GET['dif']))) {
        $nivel_ensino = $_GET['nivel_ensino']; 
        $topico = $_GET['topico'];
        $tipo = $_GET['tipo'];
        $dif = $_GET['dif'];
        
        if ($tipo==0){
            if ($dif==1){
                $selecao  = "DROP VIEW total_dificil_alternativa ";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "CREATE VIEW total_dificil_alternativa AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, a.idalternativa, a.idquestao ";
                $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
                $selecao .= "ON q.idquestao = a.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao={$dif} AND publico=1";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "SELECT COUNT(*) AS result FROM total_dificil_alternativa";
                $produtos = mysqli_query($conecta,$selecao);
                
                $retorno = array();
                while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
                }
            }else {
                $selecao  = "DROP VIEW total_facil_alternativa ";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "CREATE VIEW total_facil_alternativa AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, a.idalternativa, a.idquestao ";
                $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
                $selecao .= "ON q.idquestao = a.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao={$dif} AND publico=1";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "SELECT COUNT(*) AS result FROM total_facil_alternativa";
                $produtos = mysqli_query($conecta,$selecao);
                
                $retorno = array();
                while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
                }
            }	
        }else {
            if ($dif==1){
                $selecao  = "DROP VIEW total_dificil_discursiva ";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "CREATE VIEW total_dificil_discursiva AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, d.iddiscursiva, d.idquestao ";
                $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
                $selecao .= "ON q.idquestao = d.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao={$dif} AND publico=1";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "SELECT COUNT(*) AS result FROM total_dificil_discursiva";
                $produtos = mysqli_query($conecta,$selecao);
                $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
            }
            }else {
                $selecao  = "DROP VIEW total_facil_discursiva ";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "CREATE VIEW total_facil_discursiva AS ";
                $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, d.iddiscursiva, d.idquestao ";
                $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
                $selecao .= "ON q.idquestao = d.idquestao ";
                $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND q.nivel_questao={$dif} AND publico=1";
                $produtos = mysqli_query($conecta,$selecao);
                $selecao = "SELECT COUNT(*) AS result FROM total_facil_discursiva";
                $produtos = mysqli_query($conecta,$selecao);
                
                $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
            }
            }
            
        }
            
        echo json_encode($retorno);
    }
        
        
        
    


    else if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))&&(isset($_GET['tipo']))) {
        $nivel_ensino = $_GET['nivel_ensino']; 
        $topico = $_GET['topico'];
        $tipo = $_GET['tipo'];
        
        if ($tipo==0){
            $selecao  = "DROP VIEW total_alternativa";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "CREATE VIEW total_alternativa AS ";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, a.idalternativa, a.idquestao ";
            $selecao .= "FROM questao AS q RIGHT JOIN alternativa AS a ";
            $selecao .= "ON q.idquestao = a.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND publico=1 ";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "SELECT COUNT(*) AS resultado FROM total_alternativa";
            $produtos = mysqli_query($conecta,$selecao);

            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
            } 	
        }else {
            $selecao  = "DROP VIEW total_discursiva";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "CREATE VIEW total_discursiva AS ";
            $selecao .= "SELECT q.cpf, q.idtopico, q.idmateria, q.nivel_ensino, q.nivel_questao, d.iddiscursiva, d.idquestao ";
            $selecao .= "FROM questao AS q RIGHT JOIN discursiva AS d ";
            $selecao .= "ON q.idquestao = d.idquestao ";
            $selecao .= "WHERE q.idtopico={$topico} AND q.nivel_ensino={$nivel_ensino} AND publico=1 ";
            $produtos = mysqli_query($conecta,$selecao);
            $selecao = "SELECT COUNT(*) AS resultado FROM total_discursiva";
            $produtos = mysqli_query($conecta,$selecao);

            $retorno = array();
            while($linha = mysqli_fetch_object($produtos)) {
                $retorno[] = $linha;
            }
        }
        echo json_encode($retorno);

    }


    else if((isset($_GET['nivel_ensino']))&&(isset($_GET['topico']))) {
        $catID = $_GET['nivel_ensino']; 
        $topico = $_GET['topico']; 
        $selecao  = "SELECT COUNT(*) AS resultado FROM questao ";
        $selecao .= "WHERE nivel_ensino = {$catID} AND idtopico={$topico} AND publico=1 ";
        $produtos = mysqli_query($conecta,$selecao);

        $retorno = array();
        while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
        } 	

        echo json_encode($retorno);

    }

    else if((isset($_GET['nivel_questao']))&&(isset($_GET['topico']))) {
        $catID = $_GET['nivel_questao']; 
        $topico = $_GET['topico']; 
        $selecao  = "SELECT COUNT(*) AS resultado FROM questao ";
        $selecao .= "WHERE nivel_questao = {$catID} AND idtopico={$topico} AND publico=1 ";
        $produtos = mysqli_query($conecta,$selecao);

        $retorno = array();
        while($linha = mysqli_fetch_object($produtos)) {
            $retorno[] = $linha;
        } 	

        echo json_encode($retorno);

    }

    else if(isset($_GET['topico'])) {
        $topico = $_GET['topico']; 

        $selecao  = "SELECT COUNT(*) AS resultado FROM questao ";
        $selecao .= "WHERE idtopico = {$topico} AND publico=1 ";
        $produto = mysqli_query($conecta,$selecao);

        $retorno = array();
        while($linha = mysqli_fetch_object($produto)) {
            $retorno[] = $linha;
        } 	

        echo json_encode($retorno);

    }

            // fechar conecta
        mysqli_close($conecta);
?>