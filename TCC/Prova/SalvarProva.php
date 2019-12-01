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
    print_r($_POST);
    $c = new Conexão();
    $cx = $c->conexão();
    $p = new Prova();
    $pq = new ProvaQuestoes();

    $p->setCpf($_SESSION["cpf"]);
    $p->setNomeProva($_POST["nome_prova"]);
    
    
    $p->cadastrar($cx);


    $idProva = mysqli_insert_id($cx);
    $pq->setIdProva($idProva);
    if ($_POST["nFacil"]>0){
        for ($i=1;$i<=$_POST["nFacil"];$i++){

                $pq->setIdAlternativa($_POST["idalternativaf".$i."_".""]);


            echo "rodou = ". $i . " vez";

                $pq->setIdDiscursiva($_POST["iddiscursivaf".$i."_".""]);



            $pq->setIdQuestao($_POST["idquestaof".$i."_".""]);
            echo $pq->getIdProva($idProva);
            echo $pq->getIdAlternativa();
            echo $pq->getIdDiscursiva();
            echo $pq->getIdQuestao();
            echo $p->getNomeProva();
            $pq->cadastrar($cx);

        }
    }
    if ($_POST["nDificil"]>0){
        for ($i=1;$i<=$_POST["nDificil"];$i++){

                $pq->setIdAlternativa($_POST["idalternativa".$i."_".""]);


            echo "rodou = ". $i . " vez";

                $pq->setIdDiscursiva($_POST["iddiscursiva".$i."_".""]);



            $pq->setIdQuestao($_POST["idquestao".$i."_".""]);
            echo $pq->getIdProva($idProva);
            echo $pq->getIdAlternativa();
            echo $pq->getIdDiscursiva();
            echo $pq->getIdQuestao();
            echo $p->getNomeProva();
            $pq->cadastrar($cx);
        
        }
    } 
    
    header("location:MinhasProvas.php");
    
?>


