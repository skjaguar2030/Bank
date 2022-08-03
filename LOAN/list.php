<?php 
session_start();
// ini_set('display_errors', 1);
// error_reporting(~0);
include '../connection.php';
include "../log_first.php";

?>

<!DOCTYPE htzml>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="../STYLES/table_style.php"> 
</head>
<body>

    <nav class="nav-bar">

        <a class="nav-links" href="../ACCOUNT/list.php">Account</a>
         <a class="nav-links" href="../CUSTOMER/list.php">Customer</a> <!-- this link can be accessed directly in this file like this ( <a href="list.php">customer</a> ) -->
        <a class="nav-links" href="../LOAN/list.php">Loan</a>

        <span id='user'></span>
        <a href="../log_out.php">Log Out</a>

    </nav>

    <h2 id="title"> LOAN TABLE</h2>

    <?php

    if(isset($_SESSION["success"])){
        echo "<h2> ". $_SESSION["success"] ." </h2>";
        unset($_SESSION["success"]); 
    }

    if(isset($_SESSION["error"])){
        echo "<h2> ". $_SESSION["error"] ." </h2>";
        unset($_SESSION["error"]); 
    }

        
    
    ?>


    <!-- Creating a table for our database so that we can display the CRUD operation -->
    <?php  
    
        // $servername = 'localhost';
        // $username = 'root';
        // $password  = '';
        // $dbname = 'bank';

        // $conn = new mysqli ($servername, $username, $password, $dbname);

        if($conn->connect_error) {
            die('connection failed:' . $conn->connect_error); // whats the meaning of these arrows
        }

        $sql = 'SELECT * FROM loan';
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            echo '<table>

                <tr>
                    <th class="juice">Loan Identification</th>
                    <th>Loan Amount</th>
                    <th>Loan Balance</th>
                    <th>Account ID</th>
                    <th>Action</th>
                </tr>';

            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["loanId"]."</td><td>".$row["lnamount"]."</td><td>".$row["lnbalance"]."</td><td>".$row["accId"]."</td><td id='action'><a class='a1' href='list.php?delete_id=".$row['loanId']."'>Delete</a> <a class='a2' href='edit.php?edit_id=".$row['loanId']."'>Edit</a></td></tr>"; // what does the question mark mean where " list.php?delete_id= ... " 
            }

            echo "</table>"; 
            } else{
            echo "0 result";

        }

        // header("Content-type: text/css");

        // $background_color = 'red';
    
    ?>

    <button id="btn"><a href="create.php">ADD LOAN</a></button>

    
    <!-- Setting the DELETE operation for our loan table -->
    <?php
    
    // delete record

    if(isset($_GET["delete_id"])){
        $delID = $_GET["delete_id"];  //$delID  != $delId;
        $sql = "DELETE FROM `loan` WHERE `loanId` = $delID";
        $result = $conn->query($sql);

        
        // Setting a session and calling it when the DELETE operation is executed
        if ($result === TRUE) {
            $_SESSION["success_delete"] = "ffffffffff";
            
        } else { die  ($conn->error); }

        if(isset($_SESSION["success_delete"])){
            echo "<h2> ". $_SESSION["success_delete"] ." </h2>";
            unset($_SESSION["success_delete"]); 
        }

        if(isset($_SESSION["error"])){
            echo "<h2> ". $_SESSION["error"] ." </h2>";
            unset($_SESSION["error"]); 
        }
    }

    
    ?>
</body>
</html> 


