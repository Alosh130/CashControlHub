<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/piggy-bank.png">
    <title>CashControlHub</title>
</head>
<body>
<?php 
    session_start();
    ?>
    <nav class="navbar navbar-expand bg-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav nav-tabs">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button"></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="add-expense.php" class="dropdown-item" >Add-expenses</a>
                            <hr class="dropdown-divider">
                            <a href="transaction-history.php" class="dropdown-item" >Transaction-history</a>
                            <hr class="dropdown-divider">
                            <a href="view-budget.php" class="dropdown-item" >View-budget</a>
                            <hr class="dropdown-divider">
                            <a href="settings.html" class="dropdown-item" >Settings</a>    
                            <hr class="dropdown-divider">
                            <a href="about.php" class="dropdown-item" >About</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link" >Home</a>
                </li>
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link  ">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link  ">Reports</a>
                </li>
            </ul>
        
        </div>
        <div class="container-fluid justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown p-1">
                    <a href="profile.html" class="nav-link btn btn-light">
                        <img src="assets/user.png" width="25px" class="rounded-pill"> Profile</a>
                    
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link btn btn-light m-1">
                            <img src="assets/enter.png" width="25"> Logout</a>
                    </li>
                </li>
            </ul>
        </div>
    </nav>
    <footer class="bg-dark text-light">
        <div class="container-fluid">
            <ul class="nav justify-content-center">
                <li class="nav-item ">
                    <a href="PrivacyPolicy.html">Privacy Policy <span class="text-light">.</span></a>
                    <a href="Terms&Conditions.html" >&nbsp;Terms & Conditions<span class="text-light">.</span></a>
                    <a href="CookiesPolicy.html">CookiesPolicy<span class="text-light">.</span></a>
                    <span href="#" class="text-primary">All Rights Reserved.&copy;</span>
                </li>
            </ul>
        </div>
    </footer>
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
