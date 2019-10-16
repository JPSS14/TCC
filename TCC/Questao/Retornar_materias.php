<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("localhost","root","","tcc");

    $selecao = "SELECT idmateria, nome_materia FROM materias";
    $materias = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($materias)) {
        $retorno[] = $linha;
    } 	

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>