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
    <link rel="stylesheet" href="style.css" type="text/css">

    <title>registrar</title>
  </head>
  <body> 
  <nav class="navbar navbar-expand-lg navbar-light"  style="background-color:#048abf">
      <a class="navbar-brand" href="index.html">
          <img src="logoipp.png" width="110" height="auto" alt="">
      </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ">
				<li class="nav-item ">
					<a class="nav-link" href="login.php" style="font-size:18px;">LOGIN</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="cadastrar.php" style="font-size:18px;">REGISTRAR-SE</a>
				</li>
			</ul>
		</div>
	</nav>
    <div class="externa">
        <div class="tela_registrar">
            <Div class="login_margen">
                
                <form name="formCadastro" action="Cadastrar.php" method="post">
                    <div class="form-group">
                      <label for="registraremail">Endereço de email</label>
                      <input type="email" class="form-control" name="email" id="registraremail" aria-describedby="emailHelp" placeholder="Seu email">
                      <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                     </div>
                    <div class="form-group">
                        <label for="registrarsenha">Senha</label>
                     <input type="password" class="form-control" name="senha" id="registrarsenha" placeholder="Senha">
                    </div>
                    <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Seu Usuario">
                        </div>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" name="nome_completo" id="nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF">
                    </div>
                    <div class="form-group">
                        <label for="Estado">Estado</label>
                        <select class="form-control" name="estados" id="Estado">
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
                    </div>
                    <div class="form-group">
                        <label for="nivel">Nivel de ensino</label>
                        <select class="form-control" name="nivel" id="nivel">
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
                    <button type="submit" value="Inserir" onclick="return validarForm()" class="btn btn-primary">Registrar</button>
                 </form>


            </Div>
        </div>  
    </div> 
    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>