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
    if(isset($_POST["cpfDeletar"])){
        
        $c = new Conexão();
        $cx = $c->conexão(); 
        $p = new Pessoa();
        $pe = $p->deletarUsuario($cx, $_POST["cpfDeletar"]);
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
                
                <form action="DeletarUsuario.php" method="post">
                    <input type="hidden" name="cpfDeletar" value="<?php echo $linha["cpf"];?>">
                    <input type="submit" value="Deletar Usuário">
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
       
        
        
            <p><a href="../Logout.php">Sair</a></p>
            <p><a href="Validacao.php">Voltar</a></p>
   
      

    </body>


</html>