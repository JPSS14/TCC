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
        
        <p>Bem vindo, ADM!</p>
        <a href="../Index/Alterar.php">Alterar meu usuario</a><br>
        <a href="AlterarUsuarios.php">Alterar usuários</a><br>
        <a href="AdicionarAdm.php">Adicionar novo Adm</a><br>
        <a href="DeletarUsuario.php">Deletar Usuário</a><br>
        <a href="GerenciarMaterias.php">Gerenciar Matérias</a><br>
        <a href="GerenciarNiveisEnsino.php">Gerenciar Niveis de Ensino</a><br>
        <a href="../Index/AlterarSenha.php">Alterar Senha</a><br>
        <p><a href="../Logout.php">Sair</a></p>
    
    </body>


</html>