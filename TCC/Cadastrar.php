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
    }else echo ("Você conseguiu!!");
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
        $ml = new MateriasLecionadas();
        
        $pro->setCpf(utf8_decode($_POST["cpf"]));
        $pro->setEstado($_POST["estados"]);
        
        $p -> setUsuario(utf8_decode($_POST["usuario"]));
        $p->setNomeCompleto(utf8_decode($_POST["nome_completo"]));
        $p -> setEmail(utf8_decode($_POST["email"]));
        $p -> setSenha(md5($_POST["senha"]));
        $p -> setCpf($_POST["cpf"]);
        
        $np->setCpf(utf8_decode($_POST["cpf"]));
        $np->setNomeNivel(utf8_decode($_POST["nivel"]));
        
        $ml->setCpf(utf8_decode($_POST["cpf"]));
        $ml->setNomeMateria($_POST["materia"]);
        
        $ml->cadastrar($cx);
        $np->cadastrar($cx);
        $pro->cadastrar($cx);
        $p -> cadastrar($cx);
    }
?>

<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="css.css">
        <link href="https://fonts.googleapis.com/css?family=Saira+Stencil+One&display=swap" rel="stylesheet"> 
        <meta charset="utf-8">
        <script type="text/javascript" src="javaScript.js"></script>
        <title>TCC</title>
    </head>
    
    <body>
        
        <header>
            <h1>CYBER PROVAS</h1>
        </header>
            <div>
                <form class="box" name="formCadastro" action="Cadastrar.php" method="post">
                    
                       
                    <input type="text" name="nome_completo" placeholder="Nome Completo">
                        
                        
                    <input type="text" name="usuario" placeholder="Usuario">
                    
                    
                    <input type="text" name="cpf" placeholder="CPF">
                    
                        
                    <input type="password" name="senha" placeholder="Senha">
                       
                       
                    <input type="text" name="email" placeholder="E-mail">
                        
                        
                    <select name="estados">
                    <?php 
                        $e= new Estados();
                        $tr = $e->listaEstados();
                        while($linha = mysqli_fetch_assoc($tr)){  
                    ?>  
                        <option value="<?php echo $linha["idestado"];?>">
                            <?php echo utf8_encode($linha["nome_estado"]); ?>

                        </option>
                    <?php
                        }
                    ?>
                    </select>
                        
                        
                    <select name="nivel">
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
                        
                        
                    <select name="materia">
                    <?php
                        $m= new Materias();
                        $lm= $m->listaMaterias();
                        while($linha = mysqli_fetch_assoc($lm)){
                    ?>
                        <option value="<?php echo $linha["idmateria"]; ?>">
                            <?php echo utf8_encode($linha["nome_materia"]); ?>
                        </option>
                    <?php
                        }
                    ?>
                    </select>
                        
                        
                    <input type="submit" value="Inserir" onclick="return validarForm()">
                        
                      
                </form>

            </div>
       
    </body>

</html>