<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(~0);

include "../log_first.php";

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "bank";

$conn = new mysqli ($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['edit_id']))
    {
        $id = $_GET['edit_id'];
        
        $sql = "SELECT * FROM `account` WHERE `accId` = '$id'";
        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();
        
        $accId = $row['accId'];
        $accType = $row['accType'];
        $accName = $row['accName'];
        $accBalance = $row['accBalance'];
        
    }
    else{
        header('location: list.php');
    }

    if(isset($_POST["update-account"])){
        // update the sql table with the form value where id = $acctype;
        $accId = $_POST['accId'];
        $accType = $_POST['accType'];
        $accName = $_POST['accName'];
        $accBalance = $_POST['accBalance'];
        $id = $_POST['id'];

        $sql = "UPDATE `account` SET `accType` = '$accType', `accName` = '$accName', `accBalance` = '$accBalance' WHERE `accId` = '$id'";

        $result = $conn->query($sql);

        if ($result === TRUE) {
            header('location: list.php');
        } else { die  ($conn->error); }
        
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
</head>
<body>

    
    <nav class="nav-bar" style="background: yellow">

        <a href="list.php">Account</a>
        <a href="../CUSTOMER/list.php">Customer</a>
        <a href="../LOAN/list.php">Loan</a>

    </nav>
    
    <form action="edit.php" method="post" class="my-form">

        <div class="inputs">
            <label for="">Account Identification:</label>
            <input type="number" name="accId" value="<?php echo $accId; ?>">
        </div>

        <div class="inputs">
            <label for="">Account type:</label>
            <input type="text" name="accType" value="<?php echo $accType; ?>">
        </div>

        <div class="inputs">
            <label for="">Account name:</label>
            <input type="text" name="accName" value="<?php echo $accName; ?>">
        </div>

        <div class="inputs">
            <label for="">Account balance: </label>
            <input type="number" name="accBalance" value="<?php echo $accBalance; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="update account" name="update-account">

    </form>

</body>
</html>