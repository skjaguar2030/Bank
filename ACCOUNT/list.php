<?php 
    session_start();

    include '../connection.php';
    include "../log_first.php";

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

        <span id='user'></span>
        <a href="../log_out.php">Log Out</a>

    </nav>

    <h2 id="title"> ACCOUNT TABLE</h2>


    <?php

        // here we confirm if connnection has succeed or failed by a session
        if(isset($_SESSION["success"])){
            echo "<h2> ". $_SESSION["success"] ." </h2>";
            unset($_SESSION["success"]); 
        }
    
        if(isset($_SESSION["error"])){
            echo "<h2> ". $_SESSION["error"] ." </h2>";
            unset($_SESSION["error"]);
        }
    

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * from account";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            echo "<table> 
            <tr>
                <th>Account ID</th>
                <th>Account Type</th>
                <th>Account Name</th>
                <th>Account Balance</th>
                <th>action</th>
            </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["accId"]."</td><td>".$row["accType"]." </td><td>".$row["accName"]."</td><td>".$row["accBalance"]."</td><td id='action'><a a class='a1' href='#'>Delete</a> <a a class='a2' href='edit.php?edit_id=".$row["accId"]."'>Edit</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    ?>
    
    <button id="btn"><a href="create.php">ADD ACCOUNT</a></button>

</body>
</html> 