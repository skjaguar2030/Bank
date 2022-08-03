<?php 

include '../connection.php';

if(isset($_POST["register"])){
$firstName = $_POST["firstName"];

$lastName = $_POST["lastName"];

$birthday = $_POST['birthday'];

$phoneNumber = $_POST['phoneNumber'];

$email = $_POST['email'];

$password = $_POST['password'];


$sql = "INSERT INTO `users` (`firstName`, `lastName`, `birthday`, `phoneNumber`, `email`, `password`)
VALUES ('$firstName' , '$lastName', '$birthday', '$phoneNumber', '$email', '$password')";


if ($conn->query($sql) === TRUE) {
 echo "New record created successfully";
} else {
 echo "Error: " . $sql . "<br>" . $conn->error;
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
        <form action="register.php" method="post" class="my-form">

            <p id="title">FOR REGISTRATION, PLEASE SUBMIT YOUR DATA HERE</p>

            <div class="inputs">
                <label>First Name</label>
                <input type="text" name="firstName">
            </div>

            <div class="inputs">
                <label>Last Name</label>
                <input type="text" name="lastName" paceholder="andika jina la ukoo wako hapa...">
            </div>

            <div class="inputs">
                <label>Date of birth</label>
                <input type="date" name="birthday">
            </div>

            <div class="inputs">
                <label>Mobile</label>
                <input type="text" name="phoneNumber">
            </div> 

            <div class="inputs">
                <label>Email</label>
                <input type="email" name="email">
            </div>  
            
            
            <div class="inputs">
                <label>Password</label>
                <input type="password" name="password">
            </div> 

            <div id="condition-line">
                <input type="checkbox">
                <label>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, maxime? Corporis laboriosam perspiciatis expedita laudantium, quaerat nemo voluptatum atque fugit! <span><a href="#">Click here...</a></span> </label>
            </div>   

            <div class="submit">
                <input type="submit" value="REGISTER" name="register" id="submit-btn">
            </div>

        </form>
        <!-- my form ends here -->

    </body>
</html>