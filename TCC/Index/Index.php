<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
        header("location:../Login.php");
    }
?>
<!DOCTYPE html>

<html>

    <head>
    
    </head>
    
    <body>
        
        <p>Bem vindo!</p>
        <a href="../Questao/CadastrarQuestao.php">Criar Questão</a><br>
        <a href="Alterar.php">Alterar meu usuario</a>
        <a href="AlterarSenha.php">Alterar Senha</a><br>
        <p><a href="../Logout.php">Sair</a></p>
    
    </body>


</html>