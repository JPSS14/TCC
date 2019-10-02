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

<?php

    if(isset($_POST["nomeNivel"])){
        
        $n = new Nivel();
        $c = new Conexão();
        $cx = $c->conexão();
        $n->setNomeNivel(utf8_decode($_POST["nomeNivel"]));
        $n->cadastrar($cx);
    
    }

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
          
        <?php 
            $n = new Nivel();
            $ni = $n->listaNivel();
            while($linha = mysqli_fetch_assoc($ni)){
                echo $linha["nome_nivel"];
            }
            
        ?>
        
        <form action="AdicionarNivelEnsino.php" method="post">
        
            <input type="text" name="nomeNivel" placeholder="Nome Nivel">
            
            <input type="submit" value="Cadastrar">
            
        </form>
        
    </body>

</html>