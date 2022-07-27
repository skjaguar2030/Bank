<?php 
    ini_set('display_errors', 1);
    error_reporting(~0);


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bank';


    $conn = new mysqli ($servername, $username, $password, $dbname);

?>