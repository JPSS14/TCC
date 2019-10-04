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

    if(isset($_POST["nomeMateria"])){
        
        $m = new Materias();
        $c = new Conexão();
        $cx = $c->conexão();
        $m -> alterarMaterias($cx, $_POST["idMaterias"], $_POST["nomeMateria"]);
    
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
            $m = new Materias();
            $ma = $m->listaMaterias();
            while($linha = mysqli_fetch_assoc($ma)){
                echo $linha["nome_materia"];
            
            
        ?>
        
        <form action="AlterarMaterias.php" method="post">
        
            <input type="text" name="nomeMateria" placeholder="Nome Matéria" value="<?php echo $linha["nome_materia"];?>">
            
            <input type="hidden" name="idMaterias" placeholder="Nome Matéria" value="<?php echo $linha["idmateria"];?>">
            
            <input type="submit" value=Alterar>
            
        </form>
        <?php
            }
        ?>
    </body>

</html>