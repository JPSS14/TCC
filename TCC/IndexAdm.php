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
        <a href="Alterar.php">Alterar meu usuario</a><br>
        <a href="AdicionarAdm.php">Adicionar novo Adm</a><br>
        <a href="DeletarUsuario.php">Deletar Usuário</a><br>
        <a href="GerenciarMaterias.php">Gerenciar Matérias</a><br>
        <p><a href="Logout.php">Sair</a></p>
    
    </body>


</html>