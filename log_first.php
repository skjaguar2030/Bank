<?php
//session_start()

// Setting this SESSION on all pages so that they won't open unless someone logs in first

// if(!isset($_SESSION['Id'])){
//     header('location:../AUTH/login.php');
// } 

if(!isset($_COOKIE['Identification'])){
    header('location:../AUTH/login.php'); 
} else {
    $cookie_id = $_COOKIE['Identification'];
    $s = "SELECT * FROM users WHERE id = $cookie_id";
    $res = $conn->query($s);
    
    if($res->num_rows != 1){
        header('location:../AUTH/login.php'); 
    }
}

?>