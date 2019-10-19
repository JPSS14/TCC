<?php
    include ("Classes/Classes.php");
    include ("Classes/Conexão.php");
?>
<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
        header("location:../Login.php");
    }
    echo ("Bem vindo " . $_SESSION["nivel"]);
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

    if(isset($_SESSION["email"])){
        
        $login = "SELECT * FROM pessoa ";
        $login .= "WHERE email = '{$_SESSION["email"]}' ";
        
        $acesso = mysqli_query($conecta, $login);
        
        if (!$acesso){
            die("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        echo $informacao["email"];
        
        $selectN = "SELECT * FROM niveis_professores ";
        $selectN .= "WHERE cpf = '{$informacao["cpf"]}'";
        
        $nivel = mysqli_query($conecta, $selectN);
        
        $informacaoN = mysqli_fetch_assoc($nivel);
        
        if(($informacao["email"]==$_SESSION["email"])&&($informacao["adm"]==1)){
            header("location:IndexAdm/IndexAdm.php");
            $_SESSION["cpf"]=$informacao["cpf"];
            $_SESSION["email"]=$informacao["email"];
            $_SESSION["nivel"]=$informacaoN["idnivel"];
        }
        else if (($informacao["email"]==$_SESSION["email"])){
            header("location:Index/Index.php");
            $_SESSION["cpf"]=$informacao["cpf"];
            $_SESSION["email"]=$informacao["email"];
            $_SESSION["nivel"]=$informacaoN["idnivel"];
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
    
    


