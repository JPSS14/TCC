<?php
    include("Classes/Classes.php");
    include("Classes/Conexão.php");
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
        
        $p -> cadastrar($cx);
        $np->cadastrar($cx);
        $pro->cadastrar($cx);
        header("location:Login.php");
    }
    
   
?>



