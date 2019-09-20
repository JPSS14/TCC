<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
       header("location:Login.php");
    }
?>
<!DOCTYPE html>

<html>

    <head>
    
    </head>
    
    <body>
        
        <p>Bem vindo, ADM!</p>
        <a href="Alterar.php">Alterar meu usuario</a>
        <a href="AdicionarAdm.php">Adicionar novo Adm</a>
        <p><a href="Logout.php">Sair</a></p>
    
    </body>


</html>