<?php
    include ("Classes/Classes.php");
    include ("Classes/Conexão.php");
?>


<?php
    
    $host="localhost";
    $usuario="root";
    $senha="";
    $bd="tcc";

    $conecta = mysqli_connect($host, $usuario, $senha, $bd);

    if (mysqli_connect_errno()){
        die("Falha na conexão");    
    } else echo ("Você conseguiu!!");
?>

<?php

    print_r($_POST);
    session_start();

    if(isset($_POST["email"])){
        
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        
        $login = "SELECT * FROM pessoa ";
        $login .= "WHERE email = '{$email}' ";
        
        $acesso = mysqli_query($conecta, $login);
        
        if (!$acesso){
            die("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        echo $informacao["email"];
        
        if(($informacao["email"]==$email)&&($informacao["adm"]==1)&&($informacao["senha"]==(md5($senha)))){
            header("location:IndexAdm/IndexAdm.php");
            $_SESSION["cpf"]=$informacao["cpf"];
        }
        else if (($informacao["email"]==$email)&&($informacao["senha"]==(md5($senha)))){
            header("location:Index/Index.php");
            $_SESSION["cpf"]=$informacao["cpf"];
        }
        else{
            $mensagem = "Deu ruim";
            echo $mensagem;
        }
    
    }
?>
<!DOCTYPE html>
    
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    
    <body>
        
        <?php
           echo  " 1111 " . $_POST["email"];
            $c = new Conexão();
            $cx = $c->conexão();
            $p = new Pessoa();
            $pe = $p->listaPessoa($cx);
            $linha = mysqli_fetch_assoc($pe);
            echo $linha["usuario"];
        
        ?>

       
    </body>
</html>    
    
    


