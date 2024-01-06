<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
    body{
        font-family:Arial, Helvetica, sans-serif ;
    }
    .navbar {
    padding: 10px;
    background-color: #f8f9fa;
    }
    footer {
        padding: 10px;
        background-color: #343a40;
    }
    input[type=text],input[type=password],input[type=email],input[type=submit]{
        visibility: hidden;
        transition:0.4 all;
    }
    th{
        max-width: 150px;
    }
    [type=submit]{
        margin-left: 20%;
    }
    input:focus{
        transform:scale(1.2);
        outline:2px double rgba(69,255,255,0.6);
    }
    </style>
    <link rel="icon" type="image/x-icon" href="assets/piggy-bank.png">
    <title>CashControlHub</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        echo "<script>alert('Please log in first!'); window.location = 'index.php';</script>";
        exit; 
    }
    ?>
    <div class="light_theme" id="all">
    <nav class="navbar navbar-expand bg-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav nav-tabs">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button"></a>
                    <ul class="dropdown-menu">
                    <li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
                            <a href="add-expense.php" class="dropdown-item">Add Expenses</a>
                            <hr class="dropdown-divider">
                            <a href="transaction-history.php" class="dropdown-item">Transaction History</a>
                            <hr class="dropdown-divider">
                            <a href="view-budget.php" class="dropdown-item">View Budget</a>
                            <hr class="dropdown-divider">
                        <?php endif; ?>
                        <li>
                            <a href="" class="dropdown-item">Settings &raquo;</a>
                            <ul class="dropdown-menu dropdown-submenu">
                            <li>
                                <a class="dropdown-item btn btn-primary" onclick="toggleTheme()">Dark Theme</a>
                            </li>
                        </ul>
                        </li>
                        
                        <hr class="dropdown-divider">
                        <a href="about.php" class="dropdown-item">About</a>
                        </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php" class="nav-link" >Home</a>
                        </li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link  ">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="reports.php" class="nav-link  ">Reports</a>
                        </li>
                        <?php endif; ?>
            </ul>
        
        </div>
        <div class="container-fluid justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown p-1">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true):?>
                    <a href="profile.php" class="nav-link btn btn-light">
                        <img src="assets/user.png" width="25px" class="rounded-pill"> Profile</a>
                    <?php endif; ?>
                    <li class="nav-item">
                    <a href="<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) ? 'logout.php' : 'login.html'; ?>" class="nav-link btn btn-light m-1">
                            <img src="assets/enter.png" width="25"><?php echo ($_SESSION['loggedin'] ?? false) ? 'Logout' : 'Login'; ?></a>
                    </li>
                </li>
            </ul>
        </div>
    </nav>
    <br><br><br>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "cashcontrolhub";

                $conn = new mysqli($servername,$username,$password,$dbname);
                if($conn->connect_error){
                    die("Connection failed: " . $conn->connect_error);
                }
                $sEmail = $_SESSION['Email'];
                
                if (isset($_POST["submit1"])){
                    if(isset($_POST['cpass1']) && $_SESSION['pwd'] == $_POST['cpass1']){
                    $fname = $_POST['fname'];
                    $sql1 = "UPDATE reg SET FirstName = ? Where Email = '$sEmail'";
                    $stmt1 = $conn->prepare($sql1);
                    if(!$stmt1){
                        echo 'Error in preparing the statement: ' . $conn->error;
                        exit();
                    }
                    $stmt1->bind_param("s",$fname);
                    if($stmt1->execute()){
                        $_SESSION['username'] = $fname;
                        header("Location:{$_SERVER['PHP_SELF']}");
                    }
                    }else{
                        header("Location:{$_SERVER['PHP_SELF']}?error=WrongPassword");
                        exit();
                    }
                    }
                
                    if (isset($_POST["submit2"])){
                        if(isset($_POST["cpass2"]) and $_SESSION['pwd']== $_POST['cpass2']){
                            $lname = $_POST['lname'];
                        $sql2 = "UPDATE reg SET LastName = ? Where Email = '$sEmail'";
                        $stmt2 = $conn->prepare($sql2);
                        if(!$stmt2){
                            echo 'Error in preparing the statement: ' . $conn->error;
                            exit();
                        }
                        $stmt2->bind_param("s",$lname);
                        if($stmt2->execute()){
                            $_SESSION['lastname'] = $lname;
                            header("Location:{$_SERVER['PHP_SELF']}");
                        }
                        }else{
                            header("Location:{$_SERVER['PHP_SELF']}?error=WrongPassword");
                            exit();
                        }
                        
                    }
                if (isset($_POST["submit3"])){
                    if($_POST['pass'] == $_SESSION['pwd']){
                    $userpass = $_POST['rpass'];
                    $sql3 = "UPDATE reg SET Password = ? Where Email = '$sEmail'";
                    $stmt3 = $conn->prepare($sql3);
                    if(!$stmt3){
                        echo 'Error in preparing the statement: ' . $conn->error;
                        exit();
                    }
                    $stmt3->bind_param("s",$userpass);
                    if($stmt3->execute()){
                        $_SESSION['pwd'] = $userpass;
                        header("Location:{$_SERVER['PHP_SELF']}");
                    }
                    }else{
                        header("Location:{$_SERVER['PHP_SELF']}?error=WrongPassword");
                        exit();
                    }
                    
                }
                if (isset($_POST["submit4"])){
                    if($_POST['cpass5'] == $_SESSION['pwd']){
                    $email = $_POST['nemail'];
                    $sql4 = "UPDATE reg SET Email = ? Where Email = '$sEmail'";
                    $stmt4 = $conn->prepare($sql4);
                    if(!$stmt4){
                        echo 'Error in preparing the statement: ' . $conn->error;
                        exit();
                    }
                    $stmt4->bind_param("s",$email);
                    if($stmt4->execute()){
                        $_SESSION['Email'] = $email ;
                        header("Location:{$_SERVER['PHP_SELF']}");
                    }
                    }else{
                        header("Location:{$_SERVER['PHP_SELF']}?error=WrongEmail");
                        exit();
                    }
                    
                }
                if (isset($_POST["submit5"])){
                    $phone = $_POST['phone'];
                    $_SESSION['Pnumber'] = $phone;
                    if(isset($_POST['phone']) and $_POST['phone'] == $_SESSION['Pnumber']){
                    
                    $sql5 = "UPDATE reg SET Phone = ? Where Email = '$sEmail'";
                    $stmt5 = $conn->prepare($sql5);
                    if(!$stmt5){
                        echo 'Error in preparing the statement: ' . $conn->error;
                        exit();
                    }
                    $stmt5->bind_param("s",$phone);
                    if($stmt5->execute()){

                        header("Location:{$_SERVER['PHP_SELF']}");
                        
                    }
                    }else{
                        header("Location:{$_SERVER['PHP_SELF']}?error=WrongPassword");
                        exit();
                    }
                }
                $str = ""; 
                for($i=0;$i<strlen($_SESSION['pwd']);$i++){
                    $str .= "*";
                }
                $threechar = substr($_SESSION['Email'],0,4);
                $at = strpos($_SESSION['Email'],'@');
                $size = 0;
                if($at !== false)
                {
                    $size = $at - 3;
                }
                $string = "";
                for($i = 0;$i<$size;$i++)
                {
                    $string .= "*";
                }
            ?>
    <div style="margin-left:auto;margin-right:auto; width:90%; margin-top:30px;">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <table class="table table-striped table-dark table-hover m-2" style="height: 500px;">
            <tr>
                <th>First Name: <?php echo $_SESSION['username'] ?></th>
                <th><p class="btn btn-success" onclick="Add('F','S1','Cpass1')">Edit</p></th>
                <th><input type="text" name="fname" placeholder="New First Name" id="F"><input name="submit1" type="submit" class="btn btn-danger" id="S1" value="Submit"><br><input type="password" placeholder="Confirm Password" name="cpass1" id="Cpass1"></th>
            </tr>
            <tr>
                    <th>Last Name: <?php echo $_SESSION['lastname'] ?></th>
                    <th ><p class="btn btn-success" onclick="Add('L','S2','Cpass2')">Edit</p></th>
                    <th><input type="text" placeholder="New Last Name" name="lname" id="L"><input name="submit2" type="submit" id="S2" class="btn btn-danger" value="Submit"><br><input type="password" name="cpass2" placeholder="Confirm Password" id="Cpass2"></th>
            </tr>
            <tr>
                <th>Email:<span id="ob"> <?php echo $threechar . $string . substr($_SESSION['Email'], $at); ?></span><input class="m-2" type="checkbox" onclick="toggleEmail()" id="cb"><label for="cb">Show</label></th>
                <th><p class="btn btn-success" onclick="Add('E','S3','Cpass3')">Edit</p></th>
                <th><input type="Email" placeholder="New Email" name="nemail" id="E"><input name="submit4" type="submit" id="S3" class="btn btn-danger" value="Submit"><br><input type="password" name="cpass5" placeholder="Confirm Password" id="Cpass3"></th>
            </tr>
            <tr>
                <th>Password: <?php echo $str; ?> </th>
                <th><p class="btn btn-success" onclick="Add('PWD','S4','rPWD')">Edit</p></th>
                <th><input type="password" name="pass" id="PWD" placeholder="Current Password"><input name="submit3" type="submit" id="S4" class="btn btn-danger" value="Submit"><br><input type="password" name="rpass" id="rPWD" placeholder="New Password"></th>
            </tr>
            <tr>
                <th>Phone: <?php echo $_SESSION['Pnumber'] ?></th>
                <th><p class="btn btn-success" onclick="Add('Pnum','S5','Cpass4')">Edit</p></th>
                <th><input type="text" name="phone" placeholder="New Phone Number" id="Pnum"><input name="submit5" type="submit" id="S5" class="btn btn-danger" value="Submit"><br><input type="password" placeholder="Confirm Password"  name="cpass4" id="Cpass4"></th>
            </tr>
        </table>
        </form>
    </div>
    <footer class="bg-dark text-light fixed-bottom">
        <div class="container-fluid">
            <ul class="nav justify-content-center">
                <li class="nav-item ">
                    <a href="PrivacyPolicy.php">Privacy Policy <span class="text-light">.</span></a>
                    <a href="Terms&Conditions.php" >&nbsp;Terms & Conditions<span class="text-light">.</span></a>
                    <a href="CookiesPolicy.php">CookiesPolicy<span class="text-light">.</span></a>
                    <span href="#" class="text-primary">All Rights Reserved.&copy;</span>
                </li>
            </ul>
        </div>
    </footer>
    </div>
    <script>
        urlParam = new URLSearchParams(window.location.search);
        error = urlParam.get('error');
        if(error === 'WrongPassword'){
            alert("Wrong Password!");

            newUrl = window.location.href.split('?')[0];
            history.replaceState({}, document.title, newUrl);
        }else if(error === "WrongEmail"){
            alert("Wrong Email");
            newUrl = window.location.href.split('?')[0];
            history.replaceState({}, document.title, newUrl);
        }
        function toggleEmail(){
            x = document.getElementById("ob");
            y = document.getElementById("cb");
            if(cb.checked){
                x.innerHTML = "<?php echo $_SESSION['Email'] ?>"
            }
            else{
                x.innerHTML = "<?php echo $threechar . $string . substr($_SESSION['Email'], $at);?>";
            }
        }
        function toggleTheme() {
        var all = document.getElementById("all");
        console.log("Toggle theme function called");
        if (all.classList.contains("light_theme")) {
          all.classList.remove("light_theme");
          all.classList.add("dark_theme");
        } else {
          all.classList.remove("dark_theme");
          all.classList.add("light_theme");
        }
}
        function Add(firstclickedEID,secondclickedEID,ThirdclickedEID="0"){
            firstclickedEID = document.getElementById(firstclickedEID);
            firstclickedEID.style.visibility = "visible";
            firstclickedEID.setAttribute('required','true');

            secondclickedEID = document.getElementById(secondclickedEID);
            secondclickedEID.style.visibility = "visible";
            secondclickedEID.setAttribute('required','true');

            ThirdclickedEID = document.getElementById(ThirdclickedEID);
            ThirdclickedEID.style.visibility = "visible";
            ThirdclickedEID.setAttribute('required','true');
        }

    </script>                            
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>