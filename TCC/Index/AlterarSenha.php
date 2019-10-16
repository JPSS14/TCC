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
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style_index.css" type="text/css">

    <title>Alterar senha</title>
  </head>
  <body>
        <div>
            <?php
                $c = new Conexão();
                $cx = $c->conexão(); 
                $pro = new Professor();
                $prof = $pro->exibirDadosProfessor($cx, $cpfS);
                $linha = mysqli_fetch_assoc($prof);
                
          
            ?>
        <div> 
	    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
            <a class="navbar-brand" href="index.php"style="margin-left:45%">
                <img src="logoipp.png" width="110" height="auto" alt="">
            </a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			  <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left:28%">
			    <ul class="navbar-nav ">
				    <li class="nav-item">
					    <a class="nav-link " href="#" style="font-size:18px;">FEEDBACK</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link active dropdown-toggle" data-toggle="dropdown" style="font-size:18px;" href="#" role="button" aria-haspopup="true" aria-expanded="false" >USUARIO</a>
                        <div class="dropdown-menu dropdown-menu-right"   style="background-color: #048abf; ">
                            <a class="dropdown-item" href="Alterar.php">Alterar meu usuario</a>
                            <a class="dropdown-item active" href="AlterarSenha.php" style="background-color: #f3f2f1; color: black" >Alterar Senha</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout.php">Sair</a>
                        </div>
                    </li>
		  	    </ul>
		    </div>
	    </nav>
        <div class="externa">
            <div class="tela_senha">
                <Div class="alterar_margen">    
                    <form name="formsenha" action="AlterarSenha.php" method="post">
                        <h5 class="text_senha">
                            Alterar senha<br>
                            <small id="text_senha">
                                Sua senha sera alterada e a antiga deixara de existir
                            </small> 
                        </h5>
                        <input type="hidden" name="cpfAlterar" value="<?php echo $linha["cpf"];?>">
                        <div class="form-group">
                            <label for="alterarsenha">Senha</label>
                            <input type="password" class="form-control" name="senha" id="alterarsenha" aria-describedby="emailHelp" placeholder="Nova senha">
                        </div>
                        <button type="submit" value="Alterar" onclick="return validarForm()" class="btn btn-primary">Alterar</button>
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

