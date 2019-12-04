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


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css" type="text/css">

    <title>Alterar informoções da conta</title>
  </head>
  <body>
        
	    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
            <a class="navbar-brand" href="../Validacao.php"style="margin-left:45%">
                <img src="../logoipp.png" width="110" height="auto" alt="">
            </a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			  <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left:28%">
			    <ul class="navbar-nav ">
				    <li class="nav-item">
					   <a class="nav-link " href="../Index/Feedback.php" style="font-size:18px;">FEEDBACK</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link active dropdown-toggle" data-toggle="dropdown" style="font-size:18px;" href="#" role="button" aria-haspopup="true" aria-expanded="false" >USUARIO</a>
                        <div class="dropdown-menu dropdown-menu-right"   style="background-color: #048abf; ">
                            <a class="dropdown-item active" href="Alterar.php" style="background-color: #f3f2f1; color: black" >Alterar meu usuario</a>
                            <a class="dropdown-item" href="AlterarSenha.php">Alterar Senha</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout.php">Sair</a>
                        </div>
                    </li>
		  	    </ul>
		    </div>
	    </nav>
 
                 
                             <?php
                                print_r($_POST);

                                $p = new Prova();
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $pr = $p->carregarProva($cx,$_POST["idprova"]);
                                 while($linha = mysqli_fetch_assoc($pr)){ 

                                $q = $p->carregarQuestao($cx,$linha["idquestao"]);
                                     $questao = mysqli_fetch_assoc($q);
                                if (isset($linha["idalternativa"])){     
                                    $a = $p->carregarAlternativa($cx,$linha["idalternativa"]);
                                         $alternativa = mysqli_fetch_assoc($a);
                                }
                                if (isset($linha["iddiscursiva"])){
                                    $d = $p->carregarDiscursiva($cx,$linha["iddiscursiva"]);
                                         $discursiva = mysqli_fetch_assoc($d);
                                }
                            ?>       
                    
					<div class="prova_margen">
                            <input class="form-control" type="text" name="enunciado"value="<?php echo $questao["enunciado"]?>" readonly>
                            <?php
                                if($questao["imagem"]!=""){
                            ?> 
                            <img src="<?php echo ("../questao/".$questao["imagem"])?>" style="width:10%"> <br>
                            <?php
                                }
                            ?>
                            <?php
                                if($linha["idalternativa"]!=""){
                            ?>
                            <input class="form-control" type="text" style=" border: ridge #BAFFBE;" name="enunciado"value="<?php echo $alternativa["resposta"]?>" readonly>
                            <input class="form-control" type="text" style="border: ridge #FF827A" name="enunciado"value="<?php echo $alternativa["alternativa1"]?>" readonly>
                            <input class="form-control" type="text" style="border: ridge #FF827A" name="enunciado"value="<?php echo $alternativa["alternativa2"]?>" readonly>
                            <input class="form-control" type="text" style="border: ridge #FF827A" name="enunciado"value="<?php echo $alternativa["alternativa3"]?>" readonly>
                            <input class="form-control" type="text" style="border: ridge #FF827A" name="enunciado"value="<?php echo $alternativa["alternativa4"]?>" readonly>
                            <?php
                                }
                            ?>
                            <?php
                                if($linha["iddiscursiva"]!=""){
                            ?>
                            <input class="form-control" style=" border: ridge #BAFFBE;" type="text" name="enunciado"value="<?php echo $discursiva["resposta"]?>" readonly></div>
                            <?php
                                }
                            ?>
                        <?php 
                                }
                        ?>

     
        
       
          
     
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