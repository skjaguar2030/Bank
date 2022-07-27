<?php 
// Start the session
session_start();

include "../log_first.php";

ini_set('display_errors', 1);
error_reporting(~0);

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bank';


$conn = new mysqli ($servername, $username, $password, $dbname); // where is this variable coming from? what does mysqli mean? is this a class

if(isset($_POST["add-customer"])){

$cstmId = $_POST["cstmId"];

$cstm1Name = $_POST["cstm1Name"];

$cstm2Name = $_POST['cstm2Name'];

$phoneNumber = $_POST['phoneNumber'];

$email = $_POST["email"];

$cstmdob = $_POST["cstmdob"];

$social_status = $_POST['social_status'];

$accId = $_POST['accId'];



$sql = "INSERT INTO `customer` (`cstmId`, `cstm1Name`, `cstm2Name`,`phoneNumber`, `email`, `cstmdob`, `social_status`,`accId`)
VALUES ('$cstmId' , '$cstm1Name', '$cstm2Name', '$phoneNumber', '$email' , '$cstmdob', '$social_status', $accId)";


if ($conn->query($sql) === TRUE) {
$_SESSION["success"] = "OK";
} else {
 
$_SESSION["success"] = "error: ".  $conn->error;
}

header('location: list.php');

// print_r($_POST);
}

$sqlGetAcc = "SELECT * FROM account";
$result = $conn->query($sqlGetAcc);

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

        <a class="nav-links" href="../ACCOUNT/list.php">Account</a>
        <a class="nav-links" href="list.php">Customer</a>
        <a class="nav-links" href="../LOAN/list.php">Loan</a>

    </nav>
    
    <form action="create.php" method="post" class="my-form">

        <h2 id="title"> SUBMIT YOUR CUSTOMER INFORMTION HERE</h2>

        <div class="inputs">
            <label for="">First name:</label>
            <input type="text" name="cstm1Name" required>
        </div>

        <div class="inputs">
            <label for="">Second name:</label>
            <input type="text" name="cstm2Name">
        </div>
        
        <div class="inputs">
            <label for="">Identification number: </label>
            <input type="number" name="cstmId">
        </div>

        <div class="inputs">
            <label for="">Date of birth:</label>
            <input type="date" name="cstmdob">
        </div>

        <div class="inputs">
            <label for="">Telephone number:</label>
            <input type="number" name="phoneNumber">
        </div>

        <div class="inputs">
            <label for="">Email:</label>
            <input type="email" name="email">
        </div>

        <div class="inputs">
            <label for="">Account Identification: </label>

            <select name="accId" id="accId">

                <option value=""> --Select Acc-- </option>

                <?php
               
            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()){
                    echo "<option value=". $row['accId'].">". $row['accName']. "</option>";
                }
                
            }
                ?>
            </select>

            
        </div>

        <div class="inputs">
            <label for="">Social status:</label>
            <input type="text" name="social_status">
        </div>

        <input type="submit" value="Add" name="add-customer" id="submit-btn">

    </form>

</body>
</html>
