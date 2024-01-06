<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/piggy-bank.png">
    <link rel="stylesheet" href="style.css">
    <style>
    body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    }
        .L {
            padding: 8px 16px;
            font-size: 1rem;
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: 0.2s all;
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .L:hover{
            background-color: #0056b3;
            border-color: #0056b3;
            
        }
        .L:active{
            transform: scale(0.97);
            
        }
        .unbold{
        font-weight: normal !important;
        }
        .navbar {
        padding: 10px;
        background-color: #f8f9fa;
        }
        footer {
            padding: 10px;
            background-color: #343a40;
        }
        .btn:hover{
            color:black;
            border-color:black;
        }
        .focus:focus{
            outline:4px solid rgba(69,255,255,0.7);
        }
        .card-title,.card-text{
            font-size:1.6em;
        }
    </style>
    <title>CashControlHub</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        echo "<script>alert('Please log in first!'); window.location = 'index.php';</script>";
        exit; 
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["new_profile_pic"])) {
        $pic = $_POST['profile_pic'];
        $_SESSION['pic'] = $pic;
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
    
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cashcontrolhub';
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT filename FROM `cashcontrolhub`.`reg` WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$_SESSION['Email']);
    $stmt->execute();
    $stmt->bind_result($filename);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    
    $malesrc = (!empty($filename)) ? "./uploads/$filename" : "./assets/male_avatar.png";
    $femalesrc = (!empty($filename)) ? "./uploads/$filename" : "./assets/female_avatar.png";
    $threechar = substr($_SESSION['Email'],0,3);
    $at = strpos($_SESSION['Email'],'@') ;
    $size = 0;
    if($at !== false)
    {
        $size = $at - 3;
    }
    $str = "";
    for($i = 0;$i<$size;$i++)
    {
        $str .= "*";
    }
    $date = new DateTime($_SESSION['AGE']);
    $now = new DateTime();
    $interval = $now->diff($date);
    ?>
    
    <div class="container-fluid p-3">
        <div class="card" style="width:40%; margin-left:auto; margin-right:auto;">
        <form action="PictureUpload.php" method="post" enctype="multipart/form-data">
               <?php if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true && $_SESSION['gender']== 'm'):?>
                <img class="card-img-top" src="<?php echo $malesrc ?>" style="margin-left:auto;margin-right:auto;display:block; width:100%;">
                <div class="card-body" style="text-align:center;">
                    <a href="EditProfile.php" class="btn btn-success p-2 m-2">Edit Profile</a>
                        <input id="N" class="Filei"style="display:none;" type="file" name="fileToUpload" value="Change Image">
                        <label for="N" onclick="View()" class="focus btn btn-white p-2 m-2 L" style="width:150px;border:1px solid black;font-size:1.1em;">Change Photo</label>
                        <input type="submit" name="submit" class="btn btn-primary" id="SubmitP" style="display:none;">
                        <h4 class="card-title m-2" style="text-align:left;color:black;"><span class="unbold">FullName:</span> <?php echo $_SESSION['username'] . ' ' . $_SESSION['lastname'];?></h4>
                        <h4 class="card-text m-2" style="text-align:left;color:black;">Email:<?php echo $threechar . $str . substr($_SESSION['Email'], $at); ?> </h4>
                        <h4 class="card-text m-2" style="text-align:left;color:black;">Age: <?php echo $interval->y . " Years And ". $interval->m. " Months old" ?></h4>
                    </div>
                <?php elseif(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true && $_SESSION['gender']== 'f'): ?>
                    <img class="card-img-top" src="<?php echo $femalesrc ?>"style="margin-left:auto;margin-right:auto;display:block; width:100%;">
                    <div class="card-body" style="text-align:center;">
                    <a href="EditProfile.php" class="btn btn-success p-2 m-2">Edit Profile</a>
                    <input class="Filei" id="F" style="display:none;" type="file" name="fileToUpload" value="Change Image">
                        <label for="F" onclick="View()" class="focus btn btn-white p-2 m-2 L" style="width:150px;border:1px solid black;font-size:1.1em;">Change Photo</label>
                        <input type="submit" name="submit" style="display:none;" id="SubmitP" class="btn btn-primary">
                        <h5 class="card-title p-2" style="text-align:left;"><span class="unbold">FullName:</span> <?php echo $_SESSION['username'] . ' ' . $_SESSION['lastname'];?></h5>
                        <h5 class="card-text m-2" style="text-align:left;">Email:<?php echo $threechar . $str . substr($_SESSION['Email'], $at); ?> </h5>
                        <h5 class="card-text m-2" style="text-align:left;">Age: <?php echo $interval->y . " Years And ". $interval->m. " Months old" ?></h5>
                    </div>
                <?php endif;?>
        </div></form>
        
    </div>
    <br><br>
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
               <?php

               ?>     
    <script>
        function View(){
            S = document.getElementById("SubmitP")
            S.style.display = "inline-block"
        }
        function toggleTheme() {
        var all = document.getElementById("all");
        if (all.classList.contains("light_theme")) {
          all.classList.remove("light_theme");
          all.classList.add("dark_theme");
        } else {
          all.classList.remove("dark_theme");
          all.classList.add("light_theme");
        }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
