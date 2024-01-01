<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cashcontrolhub';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $firstName = $lastName = $userpassword = $Email = $Age = $phone = $gender = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $userpassword = $_POST['password'];
    $Email = $_POST['Email'];$_SESSION['Email'] = $Email;
    $Age = $_POST['Birthday'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $rPassword = $_POST['rpassword'];
    }
    $checkemail = "SELECT * FROM reg WHERE Email = '$Email'";
    $checkresult = $conn->query($checkemail);

    $checkphone = "SELECT * FROM reg WHERE Phone = '$phone'";
    $checkPresult = $conn->query($checkphone);

    if($checkresult->num_rows > 0 || $checkPresult->num_rows >0){
        //Email and phone already exists
        echo"Email or Phone already exists!";
    }else{
        if($userpassword != $rPassword){
           echo '<script>alert("Passwords doesn\'t Match")</script>';
        }else{
            $sql = "INSERT INTO `cashcontrolhub`.`reg` (FirstName, LastName, Password,Email, Birthday,Phone, Gender)
            VALUES ('$firstName', '$lastName', '$userpassword','$Email', '$Age', '$phone', '$gender')";

            if($conn->query($sql)=== TRUE){
                header("Location:login.html");
                echo $firstName . ' ' . $lastName . ' Successfully Registered!';
            }else{
                echo 'Error: '. $conn->error;
            }
        }
        
    }
    // Close connection
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Method Not Allowed';
}
?>
