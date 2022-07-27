<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(~0);

include '../connection.php';
include "../log_first.php";
// include "../auth.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"  href="../STYLES/table_style.php">
</head>
<body>

    <nav class="nav-bar" style="background: yellow">

        <a class="nav-links" href="../ACCOUNT/list.php">Account</a>
        <a class="nav-links" href="../CUSTOMER/list.php">Customer</a>
        <a class="nav-links" href="../LOAN/list.php">Loan</a>

        <span id='user'> <?php echo $_SESSION['firstName']; ?> </span>
        <a class="nav-links" id="logout" href="../log_out.php">Log Out</a>

    </nav>
    
    <h2 id="title"> CUSTOMER TABLE</h2>

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

    <?php
    
            
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "bank";

        // // Create connection
        // $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM customer";  // can we type query inside php???


        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table> 
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Second Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Social Status</th>
                <th>Account ID</th>
                <th>Action</th>
                
            </tr>";
            
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["cstmId"]."</td><td>".$row["cstm1Name"]." </td><td>".$row["cstm2Name"]."</td><td>".$row["phoneNumber"]."</td><td>".$row["email"]."</td><td>".$row["cstmdob"]." </td><td>".$row["social_status"]."</td><td>".$row["accId"]."</td><td id='action'><a class='a1' href='#'>Delete</a> <a class='a2' href='edit.php?edit_id=".$row['cstmId']."'>Edit</a></td></tr>";
            }

            echo "</table>";
            
        } else { echo "0 results"; }
    ?>

    <button id="btn"><a href="create.php">add customer</a></button>
    
</body>
</html> 