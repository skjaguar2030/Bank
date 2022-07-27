<?php

if(!isset($_SESSION['LOGGED'])){
    header('location:../AUTH/login.php');
}

?>