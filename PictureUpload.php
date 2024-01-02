<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cashcontrolhub';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if (isset($_POST["submit"])) {
        echo 'Submitted!';
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            echo "alert('Sorry, your file was not uploaded.')";
            header("Location: index.php");

        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $filename = basename($_FILES["fileToUpload"]["name"]);
                $data = file_get_contents($target_file);

                $conn->close();
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "UPDATE `cashcontrolhub`.`reg` SET filename = ?, data = ? WHERE Email = ? ";
                $stmt = $conn->prepare($sql);
                if(!$stmt){
                    echo 'Error in preparing the statement: ' . $conn->error;
                    exit();
                }
                $stmt->bind_param("sss", $filename, $data,$_SESSION['Email']);

                if ($stmt->execute()) {
                    header("Location: Profile.php");
                    echo '<script>alert("The query is working")</script>';
                    exit();
                } else {
                    echo 'Error: ' . $stmt->error;
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    $conn->close();
} else {
    http_response_code(405); 
    echo 'Method Not Allowed';
}
?>
