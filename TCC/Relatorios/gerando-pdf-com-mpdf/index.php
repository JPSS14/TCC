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

 if ($_POST["info"]=="prova"){
                                
     
                                $p = new Prova();
                                $c = new Conexão();
                                $cx = $c->conexão();
                                $pr = $p->carregarProva($cx,$_POST["idprova"]);
                                 
                                $i = 0;
                                $html ="";
                                $html .='<div width="100%" style="border:2px solid black;"></div>';
                                $html .=  '<img src="../../logoipp.png" width="20%" id="logo"> ';
                                $html .='<div width="100%" style="border:2px solid black;"></div>';
                                
                                 
     
                while($linha = mysqli_fetch_assoc($pr)){ 
                                
                                $q = $p->carregarQuestao($cx,$linha["idquestao"]);
                                     $questao = mysqli_fetch_assoc($q);
                                if (isset($linha["idalternativa"])){     
                                    $a = $p->carregarAlternativa($cx,$linha["idalternativa"]);
                                         $alternativa = mysqli_fetch_assoc($a);
                                }
                                if (isset($linha["iddiscursiva"])){
                                    $d = $p->carregarDiscursiva($cx,$linha["iddiscursiva"]);
                                         $discursiva = mysqli_fetch_assoc($d);
                                }
                    
                                if($linha["idalternativa"]!=0){
                                     $i++;
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .  $i . ' ) '  .  utf8_encode($questao["enunciado"]) . '  </p>';
                    
                    
                                    if (isset($questao["imagem"])){
                                        $html .= '<img src="../../Questao/'  .  utf8_encode($questao["imagem"]) . '" width="50%" >';
                                    }
                                    $tot = 0;
                                    if (isset($alternativa["alternativa1"])){
                                        $v1 = $alternativa["alternativa1"];
                                        $tot++;    
                                    }
                                    if (($alternativa["alternativa2"])!=null){
                                        $v2 = $alternativa["alternativa2"];
                                        $tot++;    
                                    }
                                    if (($alternativa["alternativa3"])!=null){
                                        $v3 = $alternativa["alternativa3"];
                                        $tot++;    
                                    }
                                    if (($alternativa["alternativa4"])!=null){
                                        $v4 = $alternativa["alternativa4"];
                                        $tot++;    
                                    }
                                    if (isset($alternativa["resposta"])){
                                        $v5 = $alternativa["resposta"];
                                        $tot++;    
                                    }
                                    if ($tot==5){    
                                     $al = rand(1,$tot);  
                                        if ($al==1){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' e) '  .  utf8_encode($alternativa["alternativa4"]) . '  </p>';
                                        }elseif($al==2){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' e) '  .  utf8_encode($alternativa["alternativa4"]) . '  </p>';
                                        }elseif($al==3){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' e) '  .  utf8_encode($alternativa["alternativa4"]) . '  </p>';
                                        }elseif($al==4){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                        
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' e) '  .  utf8_encode($alternativa["alternativa4"]) . '  </p>';
                                        }elseif($al==5){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa4"]) . '  </p>';
                                        
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' e) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                        }
                                    }elseif ($tot==4){    
                                     $al = rand(1,$tot);  
                                        if ($al==1){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> '  . ' a) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> '  . ' b) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                  
                                        }elseif($al==2){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                 
                                        }elseif($al==3){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                        
                                     
                                        }elseif($al==4){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa3"]) . '  </p>';
                                     
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' d) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                        
                                     
                                        }
                                    }elseif ($tot==3){    
                                     $al = rand(1,$tot);  
                                        if ($al==1){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                        
                                  
                                        }elseif($al==2){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                                     
                                        
                                 
                                        }elseif($al==3){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa2"]) . '  </p>';
                    
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .   ' c) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                     
                                        
                                     
                                        }
                                    }elseif ($tot==2){    
                                     $al = rand(1,$tot);  
                                        if ($al==1){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     
                                        
                                  
                                        }elseif($al==2){
                                            
                                            
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' a) '  .  utf8_encode($alternativa["alternativa1"]) . '  </p>';
                    
                                     $html .= '<p style="font-size:12px;margin-top:-8px;"> ' .  ' b) '  .  utf8_encode($alternativa["resposta"]) . '  </p>';
                                     
                                        
                                 
                                        }
                                    }
                    
                    
                    
                    
                                   
                                        
                                     
                                 }else{
                                    $i++;
                                     $html .= '<p style="width:1100px;font-size:12px;"> ' .  $i . ' ) '  .  utf8_encode($questao["enunciado"]) . '  </p>';
                    
                    
                                    if (isset($questao["imagem"])){
                                        $html .= '<img src="../../Questao/'  .  utf8_encode($questao["imagem"]) . '" width="50%" >';
                                    }
                                     $html .= '<p >' .'_____________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________' . ' </p>';
                                }
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