<?php 
session_start();
include '../connection.php';

ini_set('display_errors', 1);
error_reporting(~0);

if(isset($_POST["login"])){
$email = $_POST['email'];

$password = $_POST['password'];


// $sql = "INSERT INTO `users` (`email`, `password`)
// VALUES ('$email', '$password')";

//select users where email and pass match

// if number of rrows returned == 0; means that no matching records 

// else get the data related to the user retrived i.e names,...

$sql= " SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

$result = $conn->query($sql);

// if ($conn->query($sql) === TRUE) {
//     } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
//     }


if ($result->num_rows == 0){
    
        die("no matching records");
        
    } else{ 
        $row = $result->fetch_assoc();

        

        
        $_SESSION['Id'] = $row['Id'];

        $_SESSION['firstName'] = $row['firstName'];


        header('location:../CUSTOMER/list.php');
    }

   
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <link rel="stylesheet" href="../STYLES/auth.php">
    </head>

    <body>

        <!-- my form starts from here -->
        <form action="login.php" method="post" class="my-form">

            <p id="title">CUSTOMER LOGIN</p>

            <div class="inputs">
                <label>Email</label>
                <input type="email" name="email">
            </div>  
            
            <div class="inputs">
                <label for="password">Password</label>
                <input type="password" name="password">
            </div> 

            <div class="submit">
                <input type="submit" value="LOGIN" name="login" id="submit-btn">
            </div>

        </form>
        <!-- my form ends here -->

    </body>
</html>