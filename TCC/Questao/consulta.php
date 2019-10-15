<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP com AJAX</title>
        <link href="_css/estilo.css" rel="stylesheet">
    </head>

    <body>
        <main>
            <div id="janela_formulario">
                <form id="pesquisarProdutos">
                    <label for="materias">Materias</label>
                    <select id="materias">
                    </select>
                    <label for="topico">Topico</label>
                    <select id="topico">
                    </select>
                </form>
            </div>
        </main>
        
        
        <script src="_js/jquery.js"></script>
        <script>
            function retornarMaterias(data){
                var materias = "";
                $.each(data, function(chave,valor){
                    materias += '<option value="' + valor.idmateria + '">' + valor.nome_materia + '</option>';
                });
                $('#materias').html(materias);
            }
            
            $('#materias').change(function(e){
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
        </script>
        <script src="http://localhost/TCC/Questao/Retornar_materias.php?callback=retornarMaterias"></script>
    </body>
</html>