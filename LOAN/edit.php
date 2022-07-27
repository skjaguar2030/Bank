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

    if(isset($_GET['edit_id'])) {
        $id = $_GET['edit_id'];
        
        $sql = "SELECT * FROM `loan` WHERE `loanId` = '$id'";
        $result = $conn->query($sql);
        
        $row = $result->fetch_assoc();
        
        $loanId = $row['loanId'];
        $lnamount = $row['lnamount'];
        $lnbalance = $row['lnbalance'];
        $accId = $row['accId'];

        
        
    } else { header('location: list.php'); }

    if(isset($_POST["update-loan"])){

        $loanId = $_POST['loanId'];
        $lnamount = $_POST['lnamount'];
        $lnbalance = $_POST['lnbalance'];
        $accId = $_POST['accId'];
        $id = $_POST['id'];

        $sql = "UPDATE `loan` SET `lnamount` = '$lnamount', `lnbalance` = '$lnbalance', `accId` = '$accId' WHERE `loanId` = $id";

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
        <a href="../CUSTOMER/list.php">Customer</a>
        <a href="list.php">Loan</a>

    </nav>
    
    <form action="edit.php" method="post" class="my-form">

        <div class="inputs">
            <label for="">Loan amount:</label>
            <input type="number" name="lnamount" value="<?php echo $lnamount; ?>">
        </div>

        <div class="inputs">
            <label for="">Loan balance:</label>
            <input type="number" name="lnbalance" value="<?php echo $lnbalance; ?>">
        </div>

        <div class="inputs">
            <label for="">Account identificaton: </label>

            <select name="accId" id="accId">

                <option value="">-- Select --</option>

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
        </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <input type="submit" value="update loan" name="update-loan">

        

    </form>

</body>
</html>

