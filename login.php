<?php
 // Start the session
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

    $EmailandPhone = $_POST['Email'];
    $userpass = $_POST['Pass'];
    $query = "SELECT gender FROM reg WHERE Email = '$EmailandPhone'";
    $gender_result = mysqli_query($conn,$query);
    if($gender_result){
        $row = mysqli_fetch_assoc($gender_result);
        $gender = $row['gender'];

        $_SESSION['gender'] = $gender;
    }

    $stmt = $conn->prepare("SELECT * FROM reg WHERE (Email = ? OR Phone = ?) AND Password = ?");
    $stmt->bind_param("sss", $EmailandPhone, $EmailandPhone, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        // Fetch user data if needed
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];

        // Set session variable to indicate the user is logged in
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $firstName;
        $_SESSION['lastname'] = $lastName;

        // Redirect to indexIN.php
        header('Location: index.php');
        exit();
    } else {
        // Set an error message
        $_SESSION['error_message'] = 'Invalid credentials';
        // Display the error message
        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // Clear the error message

        // Redirect to login.html
        header('Location: login.html');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Method Not Allowed';
}
?>
