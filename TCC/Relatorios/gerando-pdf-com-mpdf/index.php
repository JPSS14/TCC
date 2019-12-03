	<?php
    include("../../Classes/Classes.php");
    include("../../Classes/Conexão.php");
?>

<?php
    session_start();
    if (!isset($_SESSION["cpf"])){
    header("location:Login.php");
    }else $cpfS = $_SESSION["cpf"];
?>

<?php 
        if ($_POST["info"]=="professoresQuestoes"){
                                $p= new Pessoa();
                                $i=0;
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $pe = $p->listaPessoa($cx);
                                $q = new Questao();
$html ="";
                                $html .=  '<img src="../../logoipp.png" width="20%" style="position:center;"> ';
                                $html .=  '<p style="float:right;">' . "Data: " . date('d/m/y') . '<p />';
                                while($linha = mysqli_fetch_assoc($pe)){ 
                                   $pes = $p->totalQuestoesProfessor($cx,$linha["cpf"]);
                                      $linha1 = mysqli_fetch_assoc($pes);
                                    
                                    $html .=  '<div style="border: 3px solid black"> ';
                                    $html .=  '<p> CPF: ' . $linha1["cpf"] . '</p>';
                                    $html .= '<p> Nome: ' . $linha["nome_completo"] . '</p>' ;
                                    $html .= '<p> Total de Questões: ' . $linha1["total"] . '</p>';
                                    $html .=  '</div> ';
                                }
                                echo $html;}

        if ($_POST["info"]=="materias"){
                               $m= new Materias();
                                $tr = $m->listaMaterias();
                                $i=0;
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $q = new Questao();
                                 $html ="";
                                $html .=  '<img src="../../logoipp.png" width="20%" style="position:center;"> ';
                                $html .=  '<p style="float:right;">' . "Data: " . date('d/m/y') . '<p />';
           
                                while($linha = mysqli_fetch_assoc($tr)){ 
                                    
                               
                                   $ma = $m->totalQuestoes($cx,$linha["nome_materia"]);
                                      $linha1 = mysqli_fetch_assoc($ma);
                              
                                    
                                    $html .=  '<div style="border: 3px solid black"> ';
                                    $html .= '<p> Nome Materia: ' . $linha["nome_materia"] . '</p>' ;
                                    $html .= '<p> Total de Questões: ' . $linha1["total"] . '</p>';
                                    $html .=  '</div> ';
                                }
                                echo $html;}

    if ($_POST["info"]=="estados"){
                                $e= new Estados();
                                $tr = $e->listaEstados();
                                $i=0;
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $p = new Professor();
                                   
                                 $html ="";
                                $html .=  '<img src="../../logoipp.png" width="20%" style="position:center;"> ';
                                $html .=  '<p style="float:right;">' . "Data: " . date('d/m/y') . '</p>';
                                while($linha = mysqli_fetch_assoc($tr)){ 
                                    
                               
                                   $pro = $p->totalEstado($cx,$linha["nome_estado"]);
                                      $linha1 = mysqli_fetch_assoc($pro);
                              
                                    
                                    $html .=  '<div style="border: 3px solid black;"> ';
                                    $html .= '<p> Estado: ' . utf8_encode($linha["nome_estado"]) . '</p>' ;
                                    $html .= '<p > Total de Professores: ' . $linha1["total"] . '</p>';
                                    $html .= '</div>';
                                }
                               }
                            ?> 

<?php 
 include("mpdf60/mpdf.php");

 $html .= "
 
 ";

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;