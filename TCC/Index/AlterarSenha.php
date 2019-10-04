<?php
    include("..\Classes/Classes.php");
    include("..\Classes/Conexão.php");
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
        $pe = $p->alterarSenha($cx, $_POST["cpfAlterar"], md5($_POST["senha"]));
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
                $pro = new Professor();
                $prof = $pro->exibirDadosProfessor($cx, $cpfS);
                $linha = mysqli_fetch_assoc($prof);
                    
              
            ?>
            <ul>
                
                <form action="AlterarSenha.php" method="post">
                    
                    <input type="hidden" name="cpfAlterar" value="<?php echo $linha["cpf"];?>">
                    <input type="password" name="senha" placeholder="Senha">
                    <input type="submit" value="Alterar">
                </form>
                
                
                <li><?php echo $linha["cpf"];?></li>
                <li><?php echo $linha["nome_completo"];?></li>
                <li><?php echo $linha["email"];?></li>
                <li><?php echo $linha["senha"];?></li>
             

            </ul>
              
        </div>
      
       
        
        
            <p><a href="../Logout.php">Sair</a></p>
            <p><a href="Validacao.php">Voltar</a></p>
   
      

    </body>


</html>