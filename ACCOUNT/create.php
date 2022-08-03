<?php 

    session_start();
    ini_set('display_errors', 1);
    error_reporting(~0);

    include '../connection.php';
    include "../log_first.php";


    // $servername = 'localhost';
    // $username = 'root';
    // $password = '';
    // $dbname = 'bank';


    // $conn = new mysqli ($servername, $username, $password, $dbname); // where is this variable coming from? what does mysqli mean? is this a class 
    // //Answer: it's a built in PHP class 

    // echo $_SESSION["success"];

    if(isset($_POST["add-account"])){

        $accId = $_POST["accId"];

        $accType = $_POST["accType"];

        $accName = $_POST['accName'];

        $accBalance = $_POST['accBalance'];


        //  print_r($_POST);


        $sql = "INSERT INTO `account` (`accId`, `accType`, `accName`,`accBalance`)
        VALUES ('$accId' , '$accType', '$accName', '$accBalance')";


        if ($conn->query($sql) === TRUE) {
            $_SESSION["success_create"] = "ANATOLEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE";
        } 
        
        else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION["success"] = "error: ".  $conn->error;
        }

        header('location: list.php'); // this function will redirect us to another file; in this case it will redirect us to the list.php file where we have the account table of our bank database

    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet"  href="../STYLES/main.php"> 
</head>
<body>

    
    <nav class="nav-bar" style="background: yellow">

        <a class="nav-links" href="list.php">Account</a>
        <a class="nav-links" href="../CUSTOMER/list.php">Customer</a>
        <a class="nav-links" href="../LOAN/list.php">Loan</a>

    </nav>
    
    <form action="create.php" method="post" class="my-form">

    <h2 id="title"> SUBMIT YOUR ACCOUNT INFORMTION HERE</h2>

        <div class="inputs">
            <label for="">Account Identification:</label>
            <input type="text" name="accId">
        </div>

        <div class="inputs">
            <label for="">Account type:</label>
            <input type="text" name="accType">
        </div>

        <div class="inputs">
            <label for="">Account name:</label>
            <input type="text" name="accName">
        </div>

        <div class="inputs">
            <label for="">Account balance: </label>
            <input type="number" name="accBalance">
        </div>

        <input type="submit" value="Add" name="add-account" id="submit-btn">

    </form>

</body>
</html>

