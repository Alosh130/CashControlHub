<?php

 session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cashcontrolhub';

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $EmailandPhone = $_POST['Email'];$_SESSION['Email'] = $EmailandPhone;
    $userpass = $_POST['Pass'];
    $query1 = "SELECT gender FROM reg WHERE Email = '$EmailandPhone'";
    $gender_result = mysqli_query($conn,$query1);
    if($gender_result){
        $row = mysqli_fetch_assoc($gender_result);
        $gender = $row['gender'];

        $_SESSION['gender'] = $gender;
    }
    $query2 = "SELECT filename FROM reg WHERE Email = '$EmailandPhone'";
    $filenameResult = mysqli_query($conn,$query2);
    if($filenameResult)
    {
        $row = mysqli_fetch_assoc($filenameResult);
        $img = $row['filename'];
        $_SESSION['filename'] = $img ;
    }

    $stmt = $conn->prepare("SELECT * FROM reg WHERE (Email = ? OR Phone = ?) AND Password = ?");
    $stmt->bind_param("sss", $EmailandPhone, $EmailandPhone, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];

        
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $firstName;
        $_SESSION['lastname'] = $lastName;

        header('Location: index.php');
        exit();
    } else {

        $_SESSION['error_message'] = 'Invalid credentials';

        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); 


        header('Location: login.html');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); 
    echo 'Method Not Allowed';
}
?>
