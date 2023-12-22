<?php

session_start(); // Start the session

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

    $stmt = $conn->prepare("SELECT * FROM reg WHERE (Email = ? OR Phone = ?) AND Password = ?");
    $stmt->bind_param("sss", $EmailandPhone, $EmailandPhone, $userpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows > 0) {
        // Fetch user data if needed
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];

        // Set session variable to indicate user is logged in
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $firstName;

        // Redirect to index.html
        header('Location: index.php');
        exit();
    } else {
        echo 'Error: Invalid credentials';
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo 'Method Not Allowed';
}
?>
