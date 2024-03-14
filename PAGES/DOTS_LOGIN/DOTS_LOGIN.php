<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/DOTS_LOGIN.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/Notifications.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    
    <title>CHRMO - DOTS</title>
</head>
<body>
    <?php //include '../DOTS_NAVBAR/DOTS_NAV.php';?>
    
    <div class="login-box"> <!-- Login Form Container -->
        <div class="login_border">
            <h1>CHRMO - DOTS</h1>

            <form class="login-form" action="DOTS_LOGIN.html" class="login" id="FORM_LOGIN" method="post">
                <div class="container">
                    <!-- <label for="USERNAME"></label> -->
                    <input type="text" placeholder="Username" name="USERNAME" id="USERNAME">
                </div>

                <div class="container">
                    <!-- <label for="PASSWORD"></label> -->
                    <input type="password" placeholder="Password" name="PASSWORD" id="PASSWORD">
                </div>

                <!-- <div class="container">
                    <input type="checkbox" value="RememberMe" id="RememberMe">
                    <label class="rmb" for="RememberMe">Remember Me</label>
                </div> -->
                <br>
                 <input type="submit" value="LOGIN" name="submit"> 
            </form>

            <script src="../../SCRIPTS/Constants.js"></script>

            <!-- <div class="container">
                <a href="#">Reset Password</a>
            </div> -->
        </div>
    </div>
    <?php
    include "../Notifications/Notifications.php";
    ?>
</body>
<!-- <script src="DOTS_LOGIN.js"></script> -->
<script type="module" src="./script.js"></script>

</html>