<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="assets/piggy-bank.png">
    <link rel="stylesheet" href="style.css">
    <title>CashControlHub</title>
</head>
<body>
    <?php
    session_start();
    
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
    <div class="container-fluid">
        <div class="card" style="width:35%; margin-left:auto; margin-right:auto;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
               <?php if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']=== true && $_SESSION['gender']== 'm'):?>
                <img class="card-img-top" src="./assets/male_avatar.png" style="margin-left:auto;margin-right:auto;display:block; width:350px;">
                <div class="card-body" style="text-align:center;">
                        <input id="Filei" type="button" name="profile_pic" onclick="changeFile()" value="Change Image">
                        <h4 class="card-title" style="text-align:center;"><?php echo $_SESSION['username'] . ' ' . $_SESSION['lastname'];?></h4>
                    </div>
                <?php else: ?>
                    <img class="card-img-top" src="./assets/female_avatar.png"style="margin-left:auto;margin-right:auto;display:block; width:350px;">
                    <div class="card-body" style="text-align:center;">
                    <input id="Filei" type="button" name="profile_pic" onclick="changeFile()" value="Change Image">
                        <h4 class="card-title" style="text-align:center;"><?php echo $_SESSION['username'] . ' ' . $_SESSION['lastname'];?></h4>
                    </div>
                <?php endif;?>
        </div></form>
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
               <?php

               ?>     
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
        function changeFile(){
            document.getElementById("Filei").outerHTML = "";
            var existing = document.querySelector(".card-body")
            var inputfile = document.createElement("input");
            inputfile.type = "file";
            var subbtn = document.createElement("input");
            subbtn.type = "submit";
            existing.appendChild(inputfile);
            existing.appendChild(subbtn);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
