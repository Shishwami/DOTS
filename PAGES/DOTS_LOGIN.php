<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/DOTS_LOGIN.css">
    <link rel="stylesheet" href="../CSS/DOTS_NAV.css">
    <title>CHRMO - DOTS</title>
</head>

<body>
    <?php //include '../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="login-box"> <!-- Login Form Container -->

        <h1>CHRMO - DOTS</h1>

        <form class="login-form" action="DOTS_LOGIN.html" class="login" method="post" id="FORM_LOGIN">
            <div class="container">
                <label for="uname"></label>
                <input type="text" placeholder="Username" name="uname" id="uname" required id="INPUT_USERNAME">
            </div>

            <div class="container">
                <label for="pword"></label>
                <input type="password" placeholder="Password" name="pword" required id="INPUT_PASSWORD">
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

<script>
    const rmCheck = document.getElementById("RememberMe"),
        unameInput = document.getElementById("uname");

    if (localStorage.checkbox && localStorage.checkbox !== "") {
        rmCheck.setAttribute("checked", "checked");
        unameInput.value = localStorage.username;
    } else {
        rmCheck.removeAttribute("checked");
        unameInput.value = "";
    }

    function RememberMe() {
        if (rmCheck.checked && unameInput.value !== "") {
            localStorage.username = unameInput.value;
            localStorage.checkbox = rmCheck.value;
        } else {
            localStorage.username = "";
            localStorage.checkbox = "";
        }
    }
</script>

<script>

    const FORM_LOGIN = document.getElementById("FORM_LOGIN");

    FORM_LOGIN.addEventListener('submit', function (e) {
        const INPUT_USERNAME =FORM_LOGIN.querySelector('#INPUT_USERNAME');
        const INPUT_PASSWORD =FORM_LOGIN.querySelector('#INPUT_PASSWORD');

        const data = {
            TABLE_NAME: 
        }
    });


</script>

</html>