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
    <div class="externa">
        <div class="tela_registrar">
            <Div class="login_margen">
                
                <form name="formCadastro" enctype="multipart/form-data" action="SalvarProva.php" method="post">
                    <div class="form-group">
                            <label for="enunciado">Nome da Prova</label>
                            <input class="form-control" type="text" name="nomeProva" id="nomeProva" placeholder="Nome Prova">
                        </div>
                    <div class="form-group">
                        <label id="lblMateria" for="materia">Matéria</label>
                        <select class="form-control" name="materia" id="materia">
                            <option value="" disabled selected>Selecione...</option>
                        </select>
                        <label id="lblTopico" for="topico">Topico</label>
                        <select class="form-control" name="topico" id="topico" onclick="questaoTopico();totalQuestoes();">
                            <option value="" disabled selected>Selecione...</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="nivel">Nivel de ensino</label>
                            <select class="form-control" name="nivel" id="nivel" onclick="questaoNivelEnsino();totalQuestoes();">
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
                        </div>
                    <label id="lblTipo">Questão</label>
                    <select id="tipo" name="tipo" class="form-control" onclick="teste()">
                        <option value="" disabled selected>Selecione...</option>
                        <option value=0>Alternativa</option>
                        <option value=1>Discursiva</option>
                    </select>
                    <div class="form-group" id="tdQuestoes">
                        <label for="Estado">Total Questões</label>
                    </div>
                    <div class="form-group" id="divDificil">
                        <label for="Estado">Questões Dificeis</label>
                        <select style="border: ridge #FF827A" class="form-control" name="dificil" id="dificil" onclick="totalQuestoes();gerarProvaDificil()">
                        </select>
                    </div>
                    <div class="form-group" id="divFacil" >
                        <label for="Estado">Questões Fáceis</label>
                        <select style=" border: ridge #BAFFBE;" class="form-control" name="facil" id="facil" onclick="totalQuestoes();gerarProvaFacil()">
                        </select>
                    </div>
                    <div class="form-group" id="totalQuestoesProva" >
                        <label for="Estado">Total questões na Prova: </label>
                    </div>
                    <div class="form-group">
                            <input class="form-control" type="hidden" name="total" id="total" placeholder="Nome Prova">
                    </div>
                    <div id="validarDiscursiva">
                        
                    </div>
                 </form>
                 <br>
                 <br>
                 <br>

                <form id="formDificil" action="SalvarProva.php" method="post">
                    <div id="provaFacil" style=" border: ridge #BAFFBE;border-radius:20px;">
                           
                    </div>
                        
                    <div id="provaDificil" style="border: ridge #FF827A;border-radius:20px;">

                    </div>
                   
                    
                </form>
            </Div>
        </div>  
    </div> 
      
        <script src="../Questao/_js/jquery.js"></script>
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
                    topico += '<option value="" disabled selected>Selecione...</option>';
                    $.each($.parseJSON(data), function(chave,valor){
                        topico += '<option value="' + valor.idtopico + '">' + valor.nome_topico + '</option>';
                        
                    });
                   
                    $('#topico').html(topico);
                })
            });
            function teste(){
                 
                questaoTipo();
                questaoDificil();
                questaoFacil();
                totalQuestoes();
                gerarProva();
            }
             
            function questaoTopico(){
                
            $('#topico').change(function(e){
                var tp = document.getElementById('topico').value;
                var ne = document.getElementById('nivel').value;   
                
                if( (document.getElementById('nivel').value!="")&&(document.getElementById('topico').value!="")&&(document.getElementById('tipo').value!="")){
                    var dificuldade = 1;
                    var ne = document.getElementById('nivel').value;
                    var tp = document.getElementById('topico').value;
                    var ti = document.getElementById('tipo').value;

                    var total = document.getElementById('tdQuestoes').value;
                    var facil = document.getElementById('facil').value;
                    var dificil = parseInt(document.getElementById('dificil').value);
                    var prova = 1;
                    var total = facil+dificil;
                    
                    
                    $.ajax({
                    type:"GET",
                    data:{tipo:ti,nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                  
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })
                    
                    $.ajax({
                        type:"GET",
                        data:{dif:dificuldade,nivel_ensino:ne,topico:tp,tipo:ti},
                        url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        console.log(data);

                        $.each($.parseJSON(data), function(chave,valor){
                            for (i=0;i<=valor.result;i++){

                                 topico += '<option value="' + i + '">'  + i + '</option>';
                                }
                        
                    });
                   console.log(topico);
                    $('#dificil').html(topico);
                    })
                    
                    
                    $.ajax({
                    type:"GET",
                    data:{dif:0,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    console.log(data);
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                
                             topico += '<option value="' + i + '">'  + i + '</option>';
                            }
                        
                    });
                   console.log(topico);
                    $('#facil').html(topico);
                })
               
                    $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,facil:facil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;

                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" id="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" id="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        });
                        console.log(total);
                       console.log(topico);
                        $('#provaFacil').html(topico);
                })
                    
                    $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,dificil:dificil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;

                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" id="enunciado['+ i +']"value="'+ valor.enunciado +'" disabled>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.resposta +'" disabled>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.nivel_questao +'" disabled>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" id="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" disabled>' ;
                            topico += '</div>';
                            i++;
                        });
                        console.log(total);
                       console.log(topico);
                        $('#provaDificil').html(topico);
                })
                
                }
                
                else if( (document.getElementById('nivel').value!="")&&(document.getElementById('topico').value!="")){
                    var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                $.ajax({
                    type:"GET",
                    data:{nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                        
                        topico += valor.resultado;
                       
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })}else{
                
                $.ajax({
                    type:"GET",
                    data:{topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                    
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })
            }});}
            
            function questaoTipo(){
            $('#tipo').change(function(e){
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = parseInt(document.getElementById('tipo').value);
             
                
                
                if( (document.getElementById('nivel').value!="")&&(document.getElementById('topico').value!="")&&(document.getElementById('tipo').value!="")&&(document.getElementById('facil').value!="")){
                    var total = document.getElementById('tdQuestoes').value;
                    var facil = document.getElementById('facil').value;
                var dificil = parseInt(document.getElementById('dificil').value);
                var prova = 1;
                var total = facil+dificil;
                    
                $.ajax({
                    type:"GET",
                    data:{tipo:ti,nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                  
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })    
                    
                 $.ajax({
                        type:"GET",
                        data:{dif:1,nivel_ensino:ne,topico:tp,tipo:ti},
                        url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        console.log(data);

                        $.each($.parseJSON(data), function(chave,valor){
                            for (i=0;i<=valor.result;i++){

                                 topico += '<option value="' + i + '">'  + i + '</option>';
                                }
                        
                    });
                   console.log(topico);
                    $('#dificil').html(topico);
                    })
                    
                    
                    $.ajax({
                    type:"GET",
                    data:{dif:0,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    console.log(data);
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                
                             topico += '<option value="' + i + '">'  + i + '</option>';
                            }
                        
                    });
                   console.log(topico);
                    $('#facil').html(topico);
                })
                   
                    
                $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,facil:facil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;
                    
                    if(ti==0){
                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" id="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" id="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" id="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        });
                        
                    }else{
                         $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" id="enunciado['+ i +']"value="'+ valor.enunciado +'" disabled>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.resposta +'" disabled>' ;
                            topico += '</div>';
                            i++;
                         
                    })}
                        console.log(total);
                       console.log(topico);
                        $('#provaFacil').html(topico);
                })
                    
                    $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,dificil:dificil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;

                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" id="enunciado['+ i +']"value="'+ valor.enunciado +'" disabled>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.resposta +'" disabled>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" id="resposta['+ i +']"value="'+ valor.nivel_questao +'" disabled>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" id="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" disabled>' ;
                            topico += '<input class="form-control" type="text" id="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" disabled>' ;
                            topico += '</div>';
                            i++;
                        });
                        console.log(total);
                       console.log(topico);
                        $('#provaDificil').html(topico);
                })}else{
                        $.ajax({
                    type:"GET",
                    data:{tipo:ti,nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                  
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })
                    }
            });}
            
            
            
            function questaoNivelEnsino(){
            $('#nivel').change(function(e){
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                
                if( (document.getElementById('nivel').value!="")&&(document.getElementById('topico').value!="")&&(document.getElementById('tipo').value!="")){
                    var dificuldade = 1;
                    var ne = document.getElementById('nivel').value;
                    var tp = document.getElementById('topico').value;
                    var ti = document.getElementById('tipo').value;

                    var total = document.getElementById('tdQuestoes').value;
                    var facil = document.getElementById('facil').value;
                    var dificil = parseInt(document.getElementById('dificil').value);
                    var prova = 1;
                    var total = facil+dificil;
                    
                    
                    $.ajax({
                    type:"GET",
                    data:{tipo:ti,nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                  
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })
                    
                    $.ajax({
                        type:"GET",
                        data:{dif:dificuldade,nivel_ensino:ne,topico:tp,tipo:ti},
                        url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        console.log(data);

                        $.each($.parseJSON(data), function(chave,valor){
                            for (i=0;i<=valor.result;i++){

                                 topico += '<option value="' + i + '">'  + i + '</option>';
                                }
                        
                    });
                   console.log(topico);
                    $('#dificil').html(topico);
                    })
                    
                    
                    $.ajax({
                    type:"GET",
                    data:{dif:0,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    console.log(data);
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                
                             topico += '<option value="' + i + '">'  + i + '</option>';
                            }
                        
                    });
                   console.log(topico);
                    $('#facil').html(topico);
                })
               
                    $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,facil:facil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;

                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" name="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        });
                        console.log(total);
                       console.log(topico);
                        $('#provaFacil').html(topico);
                })
                    
                    $.ajax({
                        type:"GET",
                        data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,dificil:dificil},
                        url:"http://localhost/TCC/Prova/RetornarProva.php",
                        async:false
                    }).done(function(data){
                        var topico = "";
                        var i=1;

                        $.each($.parseJSON(data), function(chave,valor){
                            console.log(valor.idquestao);

                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" name="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        });
                        console.log(total);
                       console.log(topico);
                        $('#provaDificil').html(topico);
                })
                
                }else{
                
                $.ajax({
                    type:"GET",
                    data:{nivel_ensino:ne,topico:tp},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "Total de Questões: ";
                    console.log(data);
                    $.each($.parseJSON(data), function(chave,valor){
                        
                        
                        topico += valor.resultado;
                        
                    });
                   console.log(topico);
                    $('#tdQuestoes').html(topico);
                })
                }
            });}
            
            function questaoDificil(){
            $('#topico').change(function(e){
                var dificuldade = 1;
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = document.getElementById('tipo').value;
                
                var total = document.getElementById('tdQuestoes').value;
                var facil = document.getElementById('facil').value;
                $.ajax({
                    type:"GET",
                    data:{dif:dificuldade,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    console.log(data);
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                
                             topico += '<option value="' + i + '">'  + i + '</option>';
                            }
                        
                    });
                   console.log(topico);
                    $('#dificil').html(topico);
                })
            });}
            
            function questaoDificil(){
            $('#tipo').change(function(e){
                var dificuldade = 1;
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = document.getElementById('tipo').value;
                
                var total = document.getElementById('tdQuestoes').value;
                var facil = document.getElementById('facil').value;
                $.ajax({
                    type:"GET",
                    data:{dif:dificuldade,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    console.log(data);
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                
                             topico += '<option value="' + i + '">'  + i + '</option>';
                            }
                        
                    });
                   console.log(topico);
                    $('#dificil').html(topico);
                })
            });}
            
            function questaoFacil(){
            $('#tipo').change(function(e){
                var dificuldade = 0;
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = document.getElementById('tipo').value;
                $.ajax({
                    type:"GET",
                    data:{dif:dificuldade,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarTotalQuestoes.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        for (i=0;i<=valor.result;i++){
                        topico += '<option value="' + i + '">'  + i + '</option>';
                        }
                    });
                   console.log(topico);
                    $('#facil').html(topico);
                })
            });}
            
            function totalQuestoes(){
                
                if ((document.getElementById('facil').value!="")&&(document.getElementById('dificil').value)){
                var facil = parseInt(document.getElementById('facil').value);
                var dificil = parseInt(document.getElementById('dificil').value);
                
                var topico = "Total de Questões na Prova: " + (facil+dificil);
                var total = facil+dificil;
                $('#totalQuestoesProva').html(topico);
                
                $('#total').val(total);
            }
            }
            
            function gerarProva(){
                $('#tipo').change(function(e){
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = parseInt(document.getElementById('tipo').value);
                var facil = parseInt(document.getElementById('facil').value);
                var dificil = parseInt(document.getElementById('dificil').value);
                var prova = 1;
                var total = facil+dificil;
                $.ajax({
                    type:"GET",
                    data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti},
                    url:"http://localhost/TCC/Prova/RetornarProva.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    
                   if (ti==0){
                    $.each($.parseJSON(data), function(chave,valor){
                        console.log(valor.idquestao);
                        
                       topico += ' <div class="form-group"> ';
                        topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                        topico += '<input class="form-control" type="text" name="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                        if (valor.imagem != null){
                            topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                            topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                        }
                        topico += ' <label for="Estado">Resposta</label> ';
                        topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                        topico += ' <label for="Estado">Nivel da questão</label> ';
                        topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                        topico += ' <label for="Estado">Alternativas</label> ';
                        topico += '<input class="form-control" type="text" name="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                        topico += '<input class="form-control" type="text" name="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                        topico += '<input class="form-control" type="text" name="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                        topico += '<input class="form-control" type="text" name="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                        topico += '</div>';
                        i++;
                    });
                    console.log(total);
                   console.log(topico);
                    $('#prova').html(topico);
                   }else{
                       $.each($.parseJSON(data), function(chave,valor){
                        console.log(valor.idquestao);
                        
                       topico += ' <div class="form-group"> ';
                        topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                        topico += '<input class="form-control" type="text" name="enunciado['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                        if (valor.imagem != null){
                            topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                            topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                        }
                        topico += ' <label for="Estado">Resposta</label> ';
                        topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                        topico += ' <label for="Estado">Nivel da questão</label> ';
                        topico += '</div>';
                        i++;
                    });
                       console.log(total);
                   console.log(topico);
                    $('#prova').html(topico);
                   }
                    
                    
                })
                
            });}
            
            function gerarProvaFacil(){
                $('#facil').change(function(e){
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = document.getElementById('tipo').value;
                var facil = parseInt(document.getElementById('facil').value);
                var dificil = parseInt(document.getElementById('dificil').value);
                var prova = 1;
                var total = facil+dificil;
                $.ajax({
                    type:"GET",
                    data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,facil:facil},
                    url:"http://localhost/TCC/Prova/RetornarProva.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    var i=1;
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        console.log(valor.idquestao);
                        if (ti==0){
                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciadof['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            topico += '<input class="form-control" type="hidden" name="idquestaof'+i+' "value="'+ valor.idquestao +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="idalternativaf'+i+' "value="'+ valor.idalternativa +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="iddiscursivaf'+i+' "value="'+ null +'" readonly>';
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="respostaf['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="respostaf['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" name="alternativa1f['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa2f['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa3f['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa4f['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        }else{
                             topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciadof['+ i +']"value="'+ valor.enunciado +'" readonly>' ;
                            topico += '<input class="form-control" type="hidden" name="idquestaof'+i+' "value="'+ valor.idquestao +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="iddiscursivaf'+i+' "value="'+ valor.iddiscursiva +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="idalternativaf'+i+' "value="'+ null +'" readonly>';
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="respostaf['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="respostaf['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        }
                    });
                    
                    var nome = document.getElementById('nomeProva').value;
                    topico += '<input type="hidden" name="nome_prova" value="'+nome+'">';
                    topico += '<input type="hidden" name="nFacil" value="'+facil+'">';
                    if(dificil==0){
                       topico += '<button  type="submit" value="Inserir" onclick="return validarForm()" class="btn btn-primary">Registrar</button>';
                    }
                    
                    console.log(total);
                   console.log(topico);
                    $('#provaFacil').html(topico);
                })
            });}
            
            function gerarProvaDificil(){
                $('#dificil').change(function(e){
                var ne = document.getElementById('nivel').value;
                var tp = document.getElementById('topico').value;
                var ti = parseInt(document.getElementById('tipo').value);
                var facil = parseInt(document.getElementById('facil').value);
                var dificil = parseInt(document.getElementById('dificil').value);
                var prova = 1;
                var total = facil+dificil;
                $.ajax({
                    type:"GET",
                    data:{total:total,nivel_ensino:ne,topico:tp,tipo:ti,dificil:dificil},
                    url:"http://localhost/TCC/Prova/RetornarProva.php",
                    async:false
                }).done(function(data){
                    var topico = "";
                    var i = 1;
                   
                    $.each($.parseJSON(data), function(chave,valor){
                        console.log(valor.idquestao);
                        if (ti==0){
                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciado['+i+'] "value="'+ valor.enunciado +'" readonly>' ;
                            topico += '<input class="form-control" type="hidden" name="idquestao'+i+' "value="'+ valor.idquestao +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="idalternativa'+i+' "value="'+ valor.idalternativa +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="iddiscursiva'+i+' "value="'+ null +'" readonly>';
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += ' <label for="Estado">Alternativas</label> ';
                            topico += '<input class="form-control" type="text" name="alternativa1['+ i +']"value="'+ valor.alternativa1 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa2['+ i +']"value="'+ valor.alternativa2 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa3['+ i +']"value="'+ valor.alternativa3 +'" readonly>' ;
                            topico += '<input class="form-control" type="text" name="alternativa4['+ i +']"value="'+ valor.alternativa4 +'" readonly>' ;
                            topico += '</div>';
                            i++;
                        }else{
                            topico += ' <div class="form-group"> ';
                            topico += ' <label for="Estado" style="margin-top:5%">Enunciado</label> ';
                            topico += '<input class="form-control" type="text" name="enunciado['+i+'] "value="'+ valor.enunciado +'" readonly>' ;
                            topico += '<input class="form-control" type="hidden" name="idquestao'+i+' "value="'+ valor.idquestao +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="iddiscursiva'+i+' "value="'+ valor.iddiscursiva +'" readonly>';
                            topico += '<input class="form-control" type="hidden" name="idalternativa'+i+' "value="'+ null +'" readonly>';
                            if (valor.imagem != null){
                                topico += ' <label for="Estado" style="margin-top:5%">Imagem</label> <br>';
                                topico += '<img src="../questao/'+ valor.imagem +'" style="width:40%"> <br>' ;
                            }
                            topico += ' <label for="Estado">Resposta</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.resposta +'" readonly>' ;
                            topico += ' <label for="Estado">Nivel da questão</label> ';
                            topico += '<input class="form-control" type="text" name="resposta['+ i +']"value="'+ valor.nivel_questao +'" readonly>' ;
                            topico += '</div>';
                            i++;
                            
                        }
                    });
                    var nome = document.getElementById('nomeProva').value;
                    topico += '<input type="hidden" name="nome_prova" value="'+nome+'">';
                    topico += '<input type="hidden" name="nDificil" value="'+dificil+'">';
                    if(facil==0){
                       topico += '<button  type="submit" value="Inserir" onclick="return validarForm()" style=" margin-left: 10px;" class="btn btn-primary">Registrar</button>';
                    }
                    console.log(total);
                   console.log(topico);
                    $('#provaDificil').html(topico);
                })
            });}
                
                
            
          
        </script>
        <script src="http://localhost/TCC/Questao/Retornar_materias.php?callback=retornarMaterias"></script>
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>