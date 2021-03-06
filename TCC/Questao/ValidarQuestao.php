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
    if(isset($_POST["idquestaoNova"])){
        
        $c = new Conexão();
        $cx = $c->conexão(); 
        $q = new Questao();
        $que = $q->validarQuestao($cx,$_POST["idquestaoNova"]);
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
    <link rel="stylesheet" href="../style_index.css" type="text/css">

    <title>Validar Questões</title>
    </head>
    <body> 
    
	    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
            <a class="navbar-brand" href="..\Validacao.php"style="margin-left:45%">
                <img src="../logoipp.png" width="110" height="auto" alt="">
            </a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			    <span class="navbar-toggler-icon"></span>
            </button>
		    <div class="collapse navbar-collapse" id="navbarNav" style="margin-left:23%">
			    <ul class="navbar-nav ">
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:18px;" href="#" role="button" aria-haspopup="true" aria-expanded="false" >ADM</a>
                        <div class="dropdown-menu dropdown-menu-right"   style="background-color: #048abf; ">
                            <a class="dropdown-item "  href="../IndexAdm/GerenciarUsuarios.html"  >Gerenciar Usuarios</a>
                            <a class="dropdown-item" href="../IndexAdm/GerenciarMaterias.html"  >Gerenciar Matérias</a>
                            <a class="dropdown-item" href="../IndexAdm/GerenciarNiveldeensino.html"  >Gerenciar Niveis de Ensino</a>
                            <a class="dropdown-item" href="../IndexAdm/GerenciarTopicos.html"  >Gerenciar Topicos</a>
                            <a class="dropdown-item" href="../IndexAdm/GerenciarRelatorios.php"  >Gerenciar Relatórios</a>
                            <a class="dropdown-item" href="../IndexAdm/GerenciarQuestoes.php"  >Gerenciar Questões</a>
                            <a class="dropdown-item" href="../IndexAdm/Feedbacks.php"  >Feedbacks</a>
                        </div>	
                    <li class="nav-item">
					  <a class="nav-link " href="#" style="font-size:18px;">FEEDBACK</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="font-size:18px;" href="#" role="button" aria-haspopup="true" aria-expanded="false" >USUARIO</a>
                        <div class="dropdown-menu dropdown-menu-right"   style="background-color: #048abf; ">
                            <a class="dropdown-item" href="..\Index/Alterar.php"  >Alterar meu usuario</a>
                            <a class="dropdown-item" href="..\Index/AlterarSenha.php">Alterar Senha</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="Logout.php">Sair</a>
                        </div>
                    </li>
		  	    </ul>
		    </div>
        </nav>
        <div class="externa">
            <h5 class="text_alterar">
                Validar Questões<br>
            </h5>
			<div>
                <?php
                    $c = new Conexão();
                    $cx = $c->conexão(); 
                    $q = new Questao();
                    $p = new Prova();
                    $m = new Materias();
                    $t = new Topico();
                    $qu = $q->retornarNaoValidada($cx);
                    while($linha = mysqli_fetch_assoc($qu)){
                        
                       
                    $a = $q->retornarAlternativa($cx,$linha["idquestao"]);
                    $alternativa = mysqli_fetch_assoc($a);
                    
                    $d = $q->retornarDiscursiva($cx,$linha["idquestao"]);
                    $discursiva = mysqli_fetch_assoc($d); 
                        
                    $ma = $m->retornarMaterias($cx, $linha["idmateria"]);
                    $materia = mysqli_fetch_assoc($ma);
                        
                    $to = $t->retornarTopico($cx, $linha["idtopico"]);
                    $topico = mysqli_fetch_assoc($to); 
                ?>
                <ul>
                        
                <form action="ValidarQuestao.php" method="post" class="form-inline" >
                    
                    <label style="margin-right:1000px;">Matéria: <?php echo $materia["nome_materia"]?></label>
                    <label style="margin-right:1000px;">Tópico: <?php echo $topico["nome_topico"]?></label>
                       
                        <input style="width:1100px;" class="form-control" type="text" placeholder="usuario" value="<?php echo utf8_encode($linha["enunciado"]);?>" >
                       
                                
                         <?php
                                if($alternativa["idalternativa"]!=""){
                                    if($linha["imagem"]!=""){
                        ?>
                        <img src="<?php echo ($linha["imagem"])?>" style="width:12%;">
                        <?php
                                }
                       
                        ?>
                       <input style="background-color:#BAFFBE;width:1100px;" class="form-control" name="resposta" type="text"  value="<?php echo utf8_encode($alternativa["resposta"]);?>" >
                        <input style=" background-color:#FF827A;width:1100px;" name="alternativa1" class="form-control" type="text"  value="<?php echo utf8_encode($alternativa["alternativa1"]);?>" >
                        <input style="background-color:#FF827A;width:1100px;" name="alternativa2" class="form-control" type="text"  value="<?php echo utf8_encode($alternativa["alternativa2"]);?>" >
                        <input style="background-color:#FF827A;width:1100px;" name="alternativa3" class="form-control" type="text"  value="<?php echo utf8_encode($alternativa["alternativa3"]);?>" >
                        <input  style=" background-color:#FF827A;width:1100px;margin-right: 1rem;" name="alternativa4" class="form-control" type="text"  value="<?php echo utf8_encode($alternativa["alternativa4"]);?>" >
                        <input  type="hidden" name="idalternativa" value="<?php echo $alternativa["idalternativa"];?>">
                        <input  type="hidden" name="idquestaoNova" value="<?php echo $linha["idquestao"];?>">
                        <button type="submit" value="Adicionar Adm" class="btn btn-primary">Validar</button>
                        <?php
                                }else{ if($linha["imagem"]!=""){
                        ?>
                        <img src="<?php echo ($linha["imagem"])?>" style="width:12%;">
                        <?php
                                }
                        ?>
                        <input style="margin-right: 1rem; background-color:#BAFFBE;width:1100px;" class="form-control" type="text"  value="<?php echo utf8_encode($discursiva["resposta"]);?>" >
                        <input  type="hidden" name="idquestaoNova" value="<?php echo $linha["idquestao"];?>">
                        <button type="submit" value="Adicionar Adm" class="btn btn-primary">Validar</button>
                        <?php
                                }
                        ?>
                    </form>
                    
                </ul>
                  
            
            
            <?php
                    }

            ?>
                </div>
        </div> 
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        </body>
</html> 

