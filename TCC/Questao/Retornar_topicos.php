<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("localhost","root","","tcc");

    if(isset($_GET['idmateria'])) {
        $catID = $_GET['idmateria'];
    } else {
        $catID = 5;
    }

    $selecao  = "SELECT idtopico, nome_topico, idmateria FROM topico ";
    $selecao .= "WHERE idmateria = {$catID}";
    $produtos = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($produtos)) {
        $retorno[] = $linha;
    } 	

    echo json_encode($retorno);
    
    // fechar conecta
    mysqli_close($conecta);
?>