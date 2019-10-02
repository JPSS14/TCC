<?php

include ("Classes/Classes.php");
include ("Classes/Conexão.php");

?>

<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
    header("location:Login.php");
    }else $cpfS = $_SESSION["cpf"];
?>




<!DOCTYPE html>
<html>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet"> 
        <meta charset="utf-8">
        <script type="text/javascript" src="javaScript.js"></script>
        <title>TCC</title>
    </head>
    
    <body>
        
        <header>
            <h1>CYBER PROVAS</h1>
        </header>
          
        <a href="AdicionarNivelEnsino.php">Adicionar Nível</a>
        <a href="DeletarMaterias.php">Deletar Matérias</a>
        <a href="AlterarMaterias.php">Alterar Matérias</a>
    </body>

</html>