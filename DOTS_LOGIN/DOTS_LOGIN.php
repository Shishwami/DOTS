<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="DOTS_LOGIN.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <title>CHRMO - DOTS</title>
</head>
<body>
    <?php //include '../DOTS_NAVBAR/DOTS_NAV.php';?>
    
    <div class="login-box"> <!-- Login Form Container -->

        <h1>CHRMO - DOTS</h1>

        <form class="login-form" action="DOTS_LOGIN.html" class="login" method="post">
            <div class="container">
                <label for="uname"></label>
                <input type="text" placeholder="Username" name="uname" id="uname" required>
            </div>

            <div class="container">
                <label for="pword"></label>
                <input type="password" placeholder="Password" name="pword" required>
            </div>

            <div class="container">
                <input type="checkbox" value="RememberMe" id="RememberMe">
                <label class="rmb" for="RememberMe">Remember Me</label>
            </div>
            <br>
            <input type="submit" value="Login" name="submit" onclick="RememberMe()">
        </form>

        <div class="container">
            <a href="#">Reset Password</a>
        </div>
    </div>

</body>
</html>