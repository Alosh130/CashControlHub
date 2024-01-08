<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body{
        font-family:Arial,helvetica,sans-serif ;
        
    }
    #all{
        background-image:url("./assets/background.avif");
        background-size:contain;
    }
    .navbar {
    padding: 10px;
    background-color: #f8f9fa;
    }
    .section1{
        width:1300px;
        height:500px;
        background-color:grey;
        display:flex;
        justify-content:space-around;
        align-items:flex-start;
        flex-wrap:wrap;
        border:2px double black;
        border-radius:10px;
        background-image:url("./assets/background.jpg");
        background-size:cover;
    }
    .content1{
        align-self:center;
        background-color: rgba(30, 30, 30, 0.5);
    }
    .img1{
        border-radius:12px;
        width:600px;
    }
    footer {
        padding: 10px;
        background-color: #343a40;
    }
    .section1 a{
        display:flex;
        align-self:flex-start;
        font-weight:bold;
        font-size:1.2em;
    }
    .section2 a{
        font-weight:bold;
        font-size:1.2em;
        order:2;
        align-self:flex-end;
    }
    .ti1{
        display:flex;
        flex-direction:row;
    }
    s{
        display:inline;
        text-decoration:underline;
    }
    .section2{
        width:1300px;
        height:400px;
        background-color:rgba(70, 53, 70,0.9);
        display:flex;
        flex-wrap:wrap;
        border:2px double black;
        justify-content:flex-start;
        border-radius:10px;
        flex-direction:row;
    }
    .content2{ 
        order:3;
        
        align-self:center;
        flex:1;
    }
    .img2{
        border-radius:12px;
        height:320px;
        width:500px;
    }
    .image{
        order:1;
        align-self:flex-start;
    }
    </style>
    <link rel="icon" type="image/x-icon" href="assets/piggy-bank.png">
    <title>CashControlHub</title>
</head>
<body>
    <?php
    session_start();
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
                            <a href="#" class="nav-link" >Home</a>
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
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> ' . $_SESSION['username'] . '! You are logged in.</p></div>';
    }
    ?>
    <?php if(isset($_SESSION['loggedin'])===false) :?>
    <div class="section1 p-3 m-5 text-capitalize text-warning">
        <div class="ti1">
        <h1 class="content1">If you want to spare some money and fix your financial problems Join Us And register now starting at 8.99$/month , 59.99$/year <br><s>trial 30 days for free</s></h1>
        <img class="img1" src="./assets/how-to-run-a-volunteer-board-meeting.jpg" alt="Meeting">
        </div>

        <a href="register.html" class="btn btn-success">Register Now</a>
        
        
    </div>
    <?php else: ?>
    <div class="section2 p-3 m-5 text-capitalize text-primary">
            <div class="image">
            <img class="img2" src="./assets/about-us.avif" alt="Meeting">
            </div>
            <div class="content2">
            <h1>Uncover the reasons why <b class="text-success">CashControlHub.com</b> stands out in the realm of financial management.</h1>
            </div>
        <a href="about.php" class="btn btn-primary">Explore More</a>
    </div>
    <?php endif; ?>
    <br>
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
