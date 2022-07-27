<?php
// include '../connection.php';

// Setting this SESSION on all pages so that they won't open unless someone logs in first

// if(!isset($_SESSION['Id'])){
//     header('location:../AUTH/login.php');
// } 


// Setting this COOKIE so that when it expires the page will redirect the user to the login page

// if(isset($_COOKIE['Identification']) /*|| !isset($_SESSION['Id']) && !isset($_SESSION['auth'])*/) {
//     $sql = 'select `id` from `users` where `users`.`id` = "$_COOKIE["Identification"]"';
//     if( $sql == false) { echo "this account doesnt exist"; }
// } else { header('location:../AUTH/login.php'); }


if(!isset($_COOKIE['Identification'])){
    header('location:../AUTH/login.php'); 
}
else{
    $cookie_id = $_COOKIE['Identification'];
    $s = "SELECT * FROM users WHERE id = $cookie_id";
    $res = $conn->query($s);
    if($res->num_rows != 1){
    header('location:../AUTH/login.php'); 
    }
}

// $row = $result->fetch_assoc();

// // if (/*$result->num_rows == 0*/ $email == $row['email'] && $password == $row['password']){ 

// //     $_SESSION['Id'] = $row['id'];

// //     $_SESSION['firstName'] = $row['firstName'];

// //     $id = $row['id'];

// //     setcookie('Identification', $id, time() + 60, '/');

// //     header('location:../CUSTOMER/list.php');
    
// // }

?>