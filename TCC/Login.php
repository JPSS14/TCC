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
   

    if(isset($_POST["email"])){
        session_start();
        $email = $_POST["email"];
        
        $senha = $_POST["senha"];
        
        $login = "SELECT * FROM pessoa ";
        $login .= "WHERE email = '{$email}' AND ";
        $login .= "senha = '{$senha}' ";
        
        $loginAdm = "SELECT adm FROM pessoa ";
        $loginAdm .= "WHERE email = '{$email}' ";
        
        $acesso = mysqli_query($conecta, $login);
        if (!$acesso){
            die ("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        $acessoAdm = mysqli_query($conecta, $loginAdm);
        if(!$acessoAdm){
            die("Falha na consulta ao banco");
        }
        
        $adm = mysqli_fetch_assoc($acessoAdm);
        
        echo $informacao["senha"] . " .. 111   ";
     
        
        if (empty($informacao)){
            $mensagem = "Login sem sucesso.";
            echo $mensagem;
            header("location:Login.php");

            if ($adm["adm"]==1){
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["adm"]=$adm["adm"];
                $_SESSION["senha"]=$informacao["senha"];
                header("location:IndexAdm.php");
            }
            else{

                header("location:Index.php");
            }
        }
    }

?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css.css">
        <title>TCC</title>
    </head>
    
    <body>
        <header>
            <h1>CYBER PROVAS</h1>
        </header>
        
        <div>
            <form class="box" name="formLogin" action="ValidacaoTeste.php" method="post">
            
                <input type="text" name="email" placeholder="Email">
                
                <input type="password" name="senha" placeholder="Senha">
                
                <input type="submit" value="Entrar">
                
                <input type="submit" value="Cadastrar" onclick="window.navigate('Cadastrar.php')">
            
            </form>
            
        </div>
      
    </body>

</html>

<?php
    mysqli_close($conecta);
?>