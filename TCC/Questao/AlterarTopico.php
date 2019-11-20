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

<?php

    if(isset($_POST["nomeTopico"])){
        
        $t = new Topico();
        $c = new Conexão();
        $cx = $c->conexão();
        $t->setNomeTopico(utf8_decode($_POST["nomeTopico"]));
        $t->alterar($cx,$_POST["topico"]);
    
    }

?>


<!DOCTYPE html>
<html>

    <head>
        <link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet"> 
        <meta charset="utf-8">
        <script type="text/javascript" src="javaScript.js"></script>
        <title>TCC</title>
    </head>
    
    <body>
        
        <header>
            <h1>CYBER PROVAS</h1>
        </header>
          
        <?php 
           # $t = new Topico();
            #$to = $t->listaMaterias();
           # while($linha = mysqli_fetch_assoc($ma)){
           #     echo $linha["nome_materia"];
          #  }
            
        ?>
        
        <form action="AlterarTopico.php" method="post">
            
            <select id="materia" name="materia"></select>
            <select class="form-control" name="topico" id="topico" onclick="questaoTopico()">
                            <option value="" disabled selected>Selecione...</option>
                        </select>
            <input type="text" name="nomeTopico" placeholder="Nome Topico">
            
            <input type="submit" value="Alterar">
            
        </form>
        
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
                    topico += '<option value="" disabled selected>Selecione...</option>';
                    $.each($.parseJSON(data), function(chave,valor){
                        topico += '<option value="' + valor.idtopico + '">' + valor.nome_topico + '</option>';
                        
                    });
                   
                    $('#topico').html(topico);
                })
            });
        
        </script>
        <script src="http://localhost/TCC/Questao/Retornar_materias.php?callback=retornarMaterias"></script>
    </body>

</html>