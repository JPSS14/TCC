<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
        header("location:../Login.php");
    }
    echo ("Bem vindo " . $_SESSION["nivel"]);
?>

<?php

include ("../Classes/Classes.php");
include ("../Classes/Conexão.php");
    
?>

<?php
    
    $host="localhost";
    $usuario="root";
    $senha="";
    $bd="tcc";

    $conecta = mysqli_connect($host, $usuario, $senha, $bd);

    if (mysqli_connect_errno()){
        die("Falha na conexão");
    }else echo ("Você conseguiu!!");
        
          $c = new Conexão();
        $cx = $c->conexão();
      $q = new Questao();
        $qe = $q->idQuestao($cx, $_SESSION["cpf"], "O que é? o que é?");
        $linha = mysqli_fetch_assoc($qe);
        echo ($linha["idquestao"] . "11");
    
?>


<?php 

    if(isset($_POST["email"])){
        
        print_r($_POST);
       
        $c = new Conexão();
        $cx = $c->conexão();
        $p = new Pessoa();
        $e = new Estados();
        $pro = new Professor();
        $np = new NiveisProfessores();

        
        $pro->setCpf(utf8_decode($_POST["cpf"]));
        $pro->setEstado($_POST["estados"]);
        
        $p -> setUsuario(utf8_decode($_POST["usuario"]));
        $p->setNomeCompleto(utf8_decode($_POST["nome_completo"]));
        $p -> setEmail(utf8_decode($_POST["email"]));
        $p -> setSenha(md5($_POST["senha"]));
        $p -> setCpf($_POST["cpf"]);
        
        $np->setCpf(utf8_decode($_POST["cpf"]));
        $np->setNomeNivel(utf8_decode($_POST["nivel"]));
        
        $q = new Questao();
        echo ($q->idQuestao($cx, $cpfS, $enunciadoS));
       
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
    <link rel="stylesheet" href="../style.css" type="text/css">

    <script type="text/javascript" src="../jquery-3.2.1.min.js"></script>
    <title>registrar</title>
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
					  <a class="nav-link " href="#" style="font-size:18px;">FEEDBACK</a>
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
    <div class="externa">
        <div class="tela_questao">
            <Div class="login_margen">
                
                <form name="formCadastro" enctype="multipart/form-data" action="ValidarQuestao.php" method="post">
                    <div class="form-group">
                            <label for="enunciado">Enunciado</label>
                            <input class="form-control" type="text" name="enunciado" id="enunciado" placeholder="Seu Enunciado">
                        </div>
                    <div class="form-group">
                        <label for="nome">Adicionar imagem</label>
                        <input name="arquivo" type="file" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="Estado">Dificuldade</label>
                        <select class="form-control" name="dificuldade" id="dificuldade">
                            <option value=0>Fácil</option>
                            <option value=1>Difícil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="nivelP" name="nivelP" value="<?php echo $_SESSION["nivel"] ?>">
                        <label for="nivel">Nivel de ensino</label>
                        <select class="form-control" name="nivel" id="nivel" onchange="mudar()">
                            <option value="" disabled selected>Selecione...</option>
                            <?php
                                $n= new Nivel();
                                $ln= $n->listaNivel();
                                while($linha = mysqli_fetch_assoc($ln)){
                            ?>
                                <option value="<?php echo $linha["idnivel"];?>">
                                    <?php echo utf8_encode($linha["nome_nivel"]); ?>
                                </option>
                            <?php
                                }
                            ?>
                        </select>
                        <small id="nivelErro" class="form-text text-muted"></small>
                        <label id="lblMateria" for="materia" style="display:none">Matéria</label>
                        <select class="form-control" name="materia" id="materia" style="display:none">
                            <option value="" disabled selected>Selecione...</option>
                        </select>
                        <label id="lblTopico" for="topico" style="display:none">Topico</label>
                        <select class="form-control" name="topico" id="topico" style="display:none">
                            <option value="" disabled selected>Selecione...</option>
                        </select>
                    </div>
                    <label id="lblTipo" style="display:none">Questão</label>
                    <select id="tipo" name="tipo" class="form-control" onchange="validar()" style="display:none">
                        <option value="" disabled selected>Selecione...</option>
                        <option value=0>Alternativa</option>
                        <option value=1>Discursiva</option>
                    </select>
                    <div id="validarAlternativa" style="display:none">
                        <div class="form-group">
                            <label for="resposta">Resposta</label>
                            <input class="form-control" type="text" name="respostaAlt" id="resposta" placeholder="Resposta Correta">
                        </div>
                         <div class="form-group">
                            <input class="form-control" type="text" name="alternativa1" id="alternativa1" placeholder="Alternativa">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="alternativa2" id="alternativa2" placeholder="Alternativa">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="alternativa3" id="alternativa3" placeholder="Alternativa">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="alternativa4" id="alternativa4" placeholder="Alternativa">
                        </div>
                        <button  type="submit" value="Inserir" onclick="return validarForm()" class="btn btn-primary">Registrar</button>
                    </div> 
                    <div id="validarDiscursiva" style="display:none">
                        <div class="form-group">
                            <label for="resposta">Resposta</label>
                            <input class="form-control" type="text" name="respostaDis" id="resposta" placeholder="Resposta Correta">
                        </div>
                        <button  type="submit" value="Inserir" onclick="return validarForm()" class="btn btn-primary">Registrar</button>
                    </div>
                 </form>

                
            </Div>
        </div>  
    </div> 
      
        <script src="_js/jquery.js"></script>
        <script>
            function retornarMaterias(data){
                var materias = "";
                materias += '<option value="" disabled selected>Selecione...</option>';
                $.each(data, function(chave,valor){
                    materias += '<option value="' + valor.idmateria + '">' + valor.nome_materia + '</option>';
                });
                $('#materia').html(materias);
            }
            
            $('#materia').change(function(e){
                var idmateria = $(this).val();
                
                $.ajax({
                    type:"GET",
                    data:"idmateria=" + idmateria,
                    url:"http://localhost/TCC/Questao/Retornar_topicos.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    $.each($.parseJSON(data), function(chave,valor){
                        topico += '<option value="' + valor.idtopico + '">' + valor.nome_topico + '</option>';
                        
                    });
                   
                    $('#topico').html(topico);
                })
            })
            
            function mudar(){
                var np = document.getElementById('nivelP').value;
                var n = document.getElementById('nivel').value;
                
                if(n>np){
                    var mensagem = "Nivel de ensino incompativel com o seu";
                    $('#nivelErro').html(mensagem);
                    $('#materia').css('display','none');
                    $('#topico').css('display','none');
                    $('#lblMateria').css('display','none');
                    $('#lblTopico').css('display','none');
                    $('#tipo').css('display','none');
                    $('#lblTipo').css('display','none');
                }
                else if(n<=np){
                    var mensagem = "";
                    $('#nivelErro').html(mensagem);
                    $('#materia').css('display','block');
                    $('#topico').css('display','block');
                    $('#lblMateria').css('display','block');
                    $('#lblTopico').css('display','block');
                    $('#tipo').css('display','block');
                    $('#lblTipo').css('display','block');
                }
            }
             function validar(){
                var op = document.getElementById('tipo').value;
                 if(op==0){
                     $('#validarDiscursiva').css('display','none');
                     $('#validarAlternativa').css('display','block');
                 }else if(op==1){
                     $('#validarAlternativa').css('display','none');
                     $('#validarDiscursiva').css('display','block');
                 }
            ;}
        </script>
        <script src="http://localhost/TCC/Questao/Retornar_materias.php?callback=retornarMaterias"></script>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>