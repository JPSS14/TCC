<?php
    include("..\Classes/Classes.php");
    include("..\Classes/Conexão.php");
?>

<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
    header("location:..\Login.php");
    }else $cpfS = $_SESSION["cpf"];
?>



<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style_index.css" type="text/css">

    <title>Minhas provas</title>
  </head>
  <body>
        
  <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
            <a class="navbar-brand" href="../Validacao.php"style="margin-left:45%">
                <img src="../logoipp.png" width="110" height="auto" alt="">
            </a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			    <span class="navbar-toggler-icon"></span>
            </button>
		    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left:23%">
			    <ul class="navbar-nav ">
                    <li class="nav-item">
					  <a class="nav-link " href="../Index/Feedback.php" style="font-size:18px;">FEEDBACK</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:18px;" href="#" role="button" aria-haspopup="true" aria-expanded="false" >USUARIO</a>
                        <div class="dropdown-menu dropdown-menu-right"   style="background-color: #048abf; ">
                            <a class="dropdown-item" href="../Index/Alterar.php"  >Alterar meu usuario</a>
                            <a class="dropdown-item" href="../Index/AlterarSenha.php">Alterar Senha</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout.php">Sair</a>
                        </div>
                    </li>
		  	    </ul>
		    </div>
	    </nav>
        </nav>
        <h5 class="text_alterar">
                Minhas provas<br>
            </h5>
        <div class="externa">
            <div class="tela_prova">
                <Div class="prova_margen"> 
                 
                                    
                    
                            <?php 
                                $p= new Prova();
                                $i=0;
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $pr = $p->minhasProvas($cx, $_SESSION["cpf"]);
                                $p = new Professor();
                                while($linha = mysqli_fetch_assoc($pr)){ 
                                  
                            ?> 
                        <div style="float:left; border:1px ridge #048abf">
                            <form action="MinhaProva.php" method="post" >             
                                <input style="margin-right: 1rem;" class="form-control" type="text" name="nomeprova" id="nomeProva" placeholder="Nome Prova" value="<?php echo $linha["nome"]?>" readonly>
                                <input style="margin-right: 1rem;" class="form-control" type="hidden" name="idprova"  placeholder="Nome Prova" value="<?php echo $linha["idprova"]?>" readonly>
                                 <button style="margin-left:2rem;" type="submit" value="Inserir" onclick="return validarForm()" class="btn btn-primary">Ver Prova</button>
                            </form>
                       </div>
                        
                        <?php 
                                }
                        ?>
                   
                </Div>
            </div> 
        </div> 
     
        
       
           
     
      <script src="../Questao/_js/jquery.js"></script>
      <script>
          var i = parseInt(0);
          for (i=0;i<26;i++){
          var n = document.getElementById('estados['+(i)+']').value;
              console.log(i);
          }
          console.log(i);
      </script>
            
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            
    </body>
</html> 

