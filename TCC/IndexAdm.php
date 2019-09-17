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
        <a href="Alterar.php">Alterar</a>
        <p><a href="Logout.php">Sair</a></p>
    
    </body>


</html>