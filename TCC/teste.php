<?php
    include ("Classes/Classes.php");
    include ("Classes/Conexão.php");
?>
<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
        header("location:../Login.php");
    }else $cpfS = $_SESSION["cpf"];
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


<!DOCTYPE html>
    
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    
    <body>
        
          <?php
                $c = new Conexão();
                $cx = $c->conexão(); 
                $pro = new Professor();
                $prof = $pro->exibirDadosProfessor($cx, $cpfS);
              
                while($linha = mysqli_fetch_assoc($prof)){
                      if(!isset($prof)){
                    echo ("ruim");
                }
                   
                }
           
            ?>


       
    </body>
</html>    
    
    


