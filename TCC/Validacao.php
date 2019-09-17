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
        $login .= "WHERE email = '{$email}' AND ";
        $login .= "senha = '{$senha}' ";
        
        $loginAdm = "SELECT adm FROM pessoa ";
        $loginAdm .= "WHERE email = '{$email}' ";
        
        $acesso = mysqli_query($conecta, $login);
        if (!$acesso){
            die ("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        
        echo $informacao["senha"] . " .. 111   ";
        
        $acessoAdm = mysqli_query($conecta, $loginAdm);
        if(!$acessoAdm){
            die("Falha na consulta ao banco");
        }
        
        $adm = mysqli_fetch_assoc($acessoAdm);
        
        
     
        
        if (empty($informacao)){
            $mensagem = "Login sem sucesso.";
            echo $mensagem;
            header("location:IndexAdm.php");
        }
            if ($adm["adm"]==1){
                $_SESSION["email"];
                $_SESSION["adm"]=$adm["adm"];
                $_SESSION["senha"]=$informacao["senha"];
                header("location:IndexAdm.php");
            }
            else{

                header("location:Index.php");
            }
        
    }

?>


<?php
    mysqli_close($conecta);
?>