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
        
        <p>Bem vindo!</p>
        <p><a href="Logout.php">Sair</a></p>
    
    </body>


</html>