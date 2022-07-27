<?php 

    session_start();
    ini_set('display_errors', 1);
    error_reporting(~0);

    include "../log_first.php";


    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bank';


    $conn = new mysqli ($servername, $username, $password, $dbname); // where is this variable coming from? what does mysqli mean? is this a class 
    //Answer: it's a built in PHP class 

    // echo $_SESSION["success"];

    if(isset($_POST["add-loan"])){

        $loanId = $_POST["loanId"];

        $lnamount = $_POST["lnamount"];

        $lnbalance = $_POST["lnbalance"];

        $accId = $_POST["accId"];


        //  print_r($_POST);


        $sql = "INSERT INTO `loan` (`loanId`, `lnamount`, `lnbalance`,`accId`)

        VALUES ('$loanId' , '$lnamount', '$lnbalance', '$accId')";



        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"] = "ANATOLEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE";
        } 
        
        else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION["success"] = "error: ".  $conn->error;
        }

        header('location: list.php'); // this function will redirect us to another file; in this case it will redirect us to the list.php file where we have the loan table of our bank database

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

        <a class="nav-links" href="../ACCOUNT/list.php">Account</a>
        <a class="nav-links" href="../CUSTOMER/list.php">Customer</a>
        <a class="nav-links" href="list.php">Loan</a>

    </nav>

    
    <form action="create.php" method="post" class="my-form">

    <h2 id="title"> SUBMIT YOUR LOAN INFORMTION HERE</h2>

        <div class="inputs">
            <label for="">Loan identification:</label>
            <input type="number" name="loanId">
        </div>

        <div class="inputs">
            <label for="">Loan amount:</label>
            <input type="number" name="lnamount">
        </div>

        <div class="inputs">
            <label for="">Loan balance:</label>
            <input type="number" name="lnbalance">
        </div>

        <div class="inputs">
            <label for="">Account identificaton: </label>

            <select name="accId" id="">

                <option value="">-- Select --</option>

                <?php 

                    $sqlGetAcc = "SELECT * FROM account";
                    $result = $conn->query($sqlGetAcc);
                
                    if ($result->num_rows > 0) {

                        while($row = $result->fetch_assoc()){
                            echo "<option value=". $row['accId'].">". $row['accName']. "</option>";
                        }
                        
                    }
                
                
                ?>

            </select>
        </div>

        <input type="submit" value="ADD" name="add-loan" id="submit-btn"> 

    </form>

</body>
</html>

