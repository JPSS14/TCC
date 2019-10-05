<?php
    include("../Classes/Classes.php");
    include("../Classes/Conexão.php");
?>

<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
    header("location:Login.php");
    }else $cpfS = $_SESSION["cpf"];
?>

<?php

    if(isset($_POST["nomeTopico"])){
        
        $t = new Topico();
        $c = new Conexão();
        $cx = $c->conexão();
        $t->setNomeTopico(utf8_decode($_POST["nomeTopico"]));
        $t->cadastrar($cx);
    
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
           # $t = new Topico();
            #$to = $t->listaMaterias();
           # while($linha = mysqli_fetch_assoc($ma)){
           #     echo $linha["nome_materia"];
          #  }
            
        ?>
        
        <form action="AdicionarTopico.php" method="post">
        
            <input type="text" name="nomeTopico" placeholder="Nome Topico">
            
            <input type="submit" value="Cadastrar">
            
        </form>
        
    </body>

</html>