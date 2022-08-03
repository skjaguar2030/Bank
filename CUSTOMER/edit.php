<?php 
session_start();
// ini_set('display_errors', 1);
// error_reporting(~0); 

include '../connection.php';
include "../log_first.php";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "bank";

// $conn = new mysqli ($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['edit_id'])) {

        $id = $_GET['edit_id'];

        // exit($id);
        
        $sql = "SELECT * FROM `customer` WHERE `cstmId` = '$id'";
        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();
        
        $cstmId = $row['cstmId'];
        $cstm1Name = $row['cstm1Name'];
        $cstm2Name = $row['cstm2Name'];
        $phoneNumber = $row['phoneNumber'];
        $email = $row['email'];
        $cstmdob = $row['cstmdob'];
        $social_status = $row['social_status'];
        $accId = $row['accId'];
        
    } else { header('location: list.php'); }

    if(isset($_POST["update-customer"])){
        // update the sql table with the form value where id = $acctype;
        $cstmId = $_POST['cstmId'];
        $cstm1Name = $_POST['cstm1Name'];
        $cstm2Name = $_POST['cstm2Name'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $cstmdob = $_POST['cstmdob'];
        $social_status = $_POST['social_status'];
        $accId = $_POST['accId'];
        $id = $_POST['id'];

        $sql = "UPDATE `customer` SET `cstm1Name` = '$cstm1Name', `cstm2Name` = '$cstm2Name', `phoneNumber` = '$phoneNumber', `email` = '$email', `cstmdob` = '$cstmdob', `social_status` = '$social_status', `accId` = '$accId' WHERE `cstmId` = $id";

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

        <a href="../ACCOUNT/list.php">Account</a>
        <a href="list.php">Customer</a>
        <a href="../LOAN/list.php">Loan</a>

    </nav>
    
    <form action="edit.php" method="post" class="my-form">

        <div class="inputs">
            <label for="">First name:</label>
            <input type="text" name="cstm1Name" required value="<?php echo $cstm1Name; ?>">
        </div>

        <div class="inputs">
            <label for="">Second name:</label>
            <input type="text" name="cstm2Name" value="<?php echo $cstm2Name; ?>">
        </div>

        <div class="inputs">
            <label for="">Date of birth:</label>
            <input type="date" name="cstmdob" value="<?php echo $cstmdob; ?>">
        </div>

        <div class="inputs">
            <label for="">Telephone number:</label>
            <input type="number" name="phoneNumber" value="<?php echo $phoneNmber; ?>">
        </div>

        <div class="inputs">
            <label for="">Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>

        <div class="inputs">
            <label for="">Account Identification: </label>

            <select name="accId" id="accId">

                <option value=""> --Select Acc-- </option>

                <?php

                    $sqlGetAcc = "SELECT * FROM account";
                    $result = $conn->query($sqlGetAcc);
               
                    if ($result->num_rows > 0) {

                        while($row = $result->fetch_assoc()){

                            $selected = "";
                            if($row['accId'] == $accId){
                                $selected = "selected";
                            }

                            echo "<option ". $selected  ." value=". $row['accId'].">". $row['accName']. "</option>";
                        }
                    }
                ?>
            </select>

            <!-- result = condition ? value1: value2; -->

            
        </div>

        <div class="inputs">
            <label for="">Social status:</label>
            <input type="text" name="social_status" value="<?php echo $social_status; ?>">
        </div>

        <input type="submit" value="update customer" name="update-customer">

        <input type="hidden" name="id" value="<?php echo $id; ?>">


    </form>

</body>
</html>
