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
    
    if(isset($_POST["usuario"])){
        $p = new Professor();
        $c = new Conexão();
        $cx = $c->conexão();
        $p->alterarDados($cx,$cpfS,$_POST["estados"]);
        $pe = new Pessoa();
        $pe->alterarDadosPessoa($cx, $cpfS, $_POST["nome_completo"], $_POST["usuario"], $_POST["email"]);
    }
    
    
?>

<!DOCTYPE html>

<html>

    <head>
    
    </head>
    
    <body>
        
        <p>Bem vindo!</p>
        
        <div>
            <?php
                $c = new Conexão();
                $cx = $c->conexão(); 
                $pro = new Professor();
                $prof = $pro->exibirDadosProfessor($cx, $cpfS);
                $linha = mysqli_fetch_assoc($prof)
                    
                
            ?>
            <ul>

                <li><?php echo $linha["usuario"];?></li>
                <li><?php echo $linha["nome_completo"];?></li>
                <li><?php echo $linha["email"];?></li>
                <li><?php echo $linha["estado"];?></li>
                <li><?php echo $linha["nome_nivel"];?></li>
                <li><?php echo $linha["nome_materia"];?></li>

            </ul>
            
        
         
          <div>
                <form class="box" name="formCadastro" action="Alterar.php" method="post">
                    
                       
                    <input type="text" name="nome_completo" placeholder="Nome Completo" value="<?php echo $linha["nome_completo"];?>">
                        
                        
                    <input type="text" name="usuario" placeholder="Usuario" value="<?php echo $linha["usuario"];?>">
                       
                    <input type="text" name="email" placeholder="E-mail" value="<?php echo $linha["email"];?>">
                    
                    <select name="estados">
                    <?php 
                        $estado = $linha["estado"];
                        echo $estado;
                        echo $linha["estado"];
                        $e= new Estados();
                        $e1= new Estados();
                        $tr = $e->listaEstados();
                        $estadoAtual = $e1->exibirEstado($cx,$linha["estado"]);
                        $meuEstado = mysqli_fetch_assoc($estadoAtual);
                        while($linha = mysqli_fetch_assoc($tr)){
                            
                            if ($meuEstado["idestado"]==$linha["idestado"]){
                    
                    ?>  
                        <option value="<?php echo $linha["idestado"];?>" selected>
                            <?php echo utf8_encode($linha["nome_estado"]); ?>

                        </option>
                        
                            <?php
                                } else{
                            ?>
                    
                        <option value="<?php echo $linha["idestado"];?>">
                            <?php echo utf8_encode($linha["nome_estado"]); ?>

                        </option>
                        
                    <?php
                            }
                        }
                    ?>
                    </select>
                        
                        
                    <input type="submit" value="Inserir" onclick="return validarForm()">
                        
                      
                </form>
              
            </div>
       
        
        
            <p><a href="../Logout.php">Sair</a></p>
            <p><a href="Validacao.php">Voltar</a></p>
        </div>
    </body>


</html>