
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
?>
<?php
/******
 * Upload de imagens
 ******/
 
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'imagens/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo ("<img src =" . $destino . ">");
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';
?>
<?php
        $q = new Questao();
        if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
            $imagem = $destino;
            $q->setImagem($imagem);
            $c = new Conexão();
            $cx = $c->conexão();
            $q->setCpf($_SESSION["cpf"]);
            $q->setEnunciado(utf8_decode($_POST["enunciado"]));
            $q->setNivelQuestao($_POST["dificuldade"]);
            $q->setNivelEnsino($_POST["nivel"]);
            $q->setMateria($_POST["materia"]);
            $q->setTopico($_POST["topico"]);
            $q->cadastrarImg($cx,$imagem);
            if($_POST["tipo"]==0){
                $a = new Alternativas();
                $a->setResposta(utf8_decode($_POST["respostaAlt"]));
                $a->setAlternativa1(utf8_decode($_POST["alternativa1"]));
                $a->setAlternativa2(utf8_decode($_POST["alternativa2"]));
                $a->setAlternativa3(utf8_decode($_POST["alternativa3"]));
                $a->setAlternativa4(utf8_decode($_POST["alternativa4"]));
                $a->cadastrar($cx);
            }else{
                $d = new Discursiva();
                $d->setResposta(utf8_decode($_POST["respostaDis"]));
                $d->cadastrar($cx);
            }
        }else{
            $c = new Conexão();
            $cx = $c->conexão();
            $q->setCpf($_SESSION["cpf"]);
            $q->setEnunciado(utf8_decode($_POST["enunciado"]));
            $q->setNivelQuestao($_POST["dificuldade"]);
            $q->setNivelEnsino($_POST["nivel"]);
            $q->setMateria($_POST["materia"]);
            $q->setTopico($_POST["topico"]);
            $q->cadastrar($cx);
            if($_POST["tipo"]==0){
                $a = new Alternativas();
                $a->setResposta(utf8_decode($_POST["respostaAlt"]));
                $a->setAlternativa1(utf8_decode($_POST["alternativa1"]));
                $a->setAlternativa2(utf8_decode($_POST["alternativa2"]));
                $a->setAlternativa3(utf8_decode($_POST["alternativa3"]));
                $a->setAlternativa4(utf8_decode($_POST["alternativa4"]));
                $a->cadastrar($cx);
            }else{
                $d = new Discursiva();
                $d->setResposta(utf8_decode($_POST["respostaDis"]));
                $d->cadastrar($cx);
            }
        }
        
    
        
        

?>
