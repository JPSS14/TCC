<?php
    session_start();
    unset($_SESSION["email"]);
    unset($_SESSION["cpf"]);
    unset($_SESSION["senha"]);
    unset($_SESSION["usuario"]);
    unset($_SESSION["nivel"]);
    unset($_SESSION["adm"]);
    header("location:Login.php");

?>