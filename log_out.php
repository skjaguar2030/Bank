<?php
session_start();

if(isset($_SESSION['Id'])){
    session_unset();
    header('location:AUTH/login.php');
}

if(isset($_COOKIE['Identification'])){
    setcookie('Identification', $id, time() - 1);
    header('location:AUTH/login.php');
}


?> 