<?php
    include("Classes/Classes.php");
    include("Classes/Conexão.php");
?>

<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
    header("location:Login.php");
    }else $cpfS = $_SESSION["cpf"];
?>

<?php
    if(isset($_POST["cpfAlterar"])){
        
        $c = new Conexão();
        $cx = $c->conexão(); 
        $p = new Pessoa();
        $pe = $p->alterarUsuarios($cx, $_POST["cpfAlterar"], $_POST["usuario"], $_POST["nome"], $_POST["email"]);
    }
?>

<!DOCTYPE html>

<html>

    <head>
    
    </head>
    
    <body>
        
        <p>Bem vindo!</p>
        
        <div>
            <?php
                $c = new Conexão();
                $cx = $c->conexão(); 
                $p = new Pessoa();
                $pe = $p->listaPessoa($cx);
                while($linha = mysqli_fetch_assoc($pe)){
                    
                    if($linha["adm"]!=1){
            ?>
            <ul>
                
                <form action="AlterarUsuarios.php" method="post">
                    <input type="hidden" name="cpfAlterar" value="<?php echo $linha["cpf"];?>">
                    
                    <input type="text" name="nome" value="<?php echo $linha["nome_completo"];?>">
                    
                    <input type="text" name="email" value="<?php echo $linha["email"];?>">
                    
                    <input type="text" name="usuario" value="<?php echo $linha["usuario"];?>">
                    
                    
                    <input type="submit" value="Alterar">
                </form>
                
                
                <li><?php echo $linha["usuario"];?></li>
                <li><?php echo $linha["nome_completo"];?></li>
                <li><?php echo $linha["email"];?></li>
                <li><?php echo $linha["cpf"];?></li>
             

            </ul>
              
        </div>
        
        <?php
                    }
                }
        
        ?>
       
        
        
            <p><a href="Logout.php">Sair</a></p>
            <p><a href="Validacao.php">Voltar</a></p>
   
      

    </body>


</html>