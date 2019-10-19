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
                $_SESSION["email"] = $_POST["email"];
                header("location:Index.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">

    <title>Login</title>
  </head>
  <body> 
	<nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
    <a class="navbar-brand" href="index.html">
      <img src="logoipp.png" width="110" height="auto" alt="">
    </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ">
				<li class="nav-item ">
					<a class="nav-link active" href="login.php" style="font-size:18px;">LOGIN</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="cadastrar.php" style="font-size:18px;">REGISTRAR-SE</a>
				</li>
			</ul>
		</div>
	</nav>
    <div class="externa">
        <div class="tela">
            <Div class="login_margen">
                
                <form name="formLogin" action="ValidacaoTeste.php" method="post">
                    <div class="form-group">
                      <label for="loginemail">Endereço de email</label>
                      <input type="email" class="form-control" name="email" id="loginemail" aria-describedby="emailHelp" placeholder="Seu email">
                      <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                    </div>
                    <div class="form-group">
                        <label for="loginsenha">Senha</label>
                     <input type="password" class="form-control" name="senha" id="loginsenha" placeholder="Senha">
                    </div>
                     <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Lembrar de min</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                 </form>


            </Div>
        </div>  
    </div> 
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

<?php
    mysqli_close($conecta);
?>