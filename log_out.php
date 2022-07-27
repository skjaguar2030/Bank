<?php
session_start();

if(isset($_SESSION['LOGGED'])){
    session_unset();
    header('location:AUTH/login.php');
}
?> 