<?php
    session_start();
    if(!isset($_SESSION['usuario'])) header("location:main.php");
    session_unset();
    if(!isset($_SESSION['usuario'])) header("location:main.php");
?>
