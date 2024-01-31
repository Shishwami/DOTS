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

        <form action="submit" class="login-form" class="login" id="FORM_LOGIN">
            <div class="container">
                <label for="INPUT_USERNAME"></label>
                <input type="text" placeholder="Username" name="INPUT_USERNAME" id="INPUT_USERNAME" required>
            </div>

            <div class="container">
                <label for="INPUT_PASSWORD"></label>
                <input type="password" placeholder="Password" name="INPUT_PASSWORD" id="INPUT_PASSWORD" required>
            </div>

            <div class="container">
                <input type="checkbox" value="RememberMe" id="RememberMe">
                <label class="rmb" for="RememberMe">Remember Me</label>
            </div>
            <br>
            <input type="submit" value="Login" name="submit">
        </form>

        <div class="container">
            <a href="#">Reset Password</a>
        </div>
    </div>
    <script>
        const rmCheck = document.getElementById("RememberMe"),
            unameInput = document.getElementById("INPUT_USERNAME");

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

</body>



<script type="module" src="../SCRIPTS/Constants.js">

    import MyAjax from "../SCRIPTS/MyAjax.js";
    import JsFunction from "../SCRIPTS/JsFunctions.js"

    const FORM_LOGIN = document.getElementById("FORM_LOGIN");

    FORM_LOGIN.addEventListener('submit', function (e) {

        JsFunction.disableFormDefault(e);

        const INPUT_USERNAME = FORM_LOGIN.querySelector('#INPUT_USERNAME');
        const INPUT_PASSWORD = FORM_LOGIN.querySelector('#INPUT_PASSWORD');

        const data = {
            TABLE_NAME: _TABLE.DOTS_ACCOUNT_INFO.NAME,
            REQUEST: _REQUEST.SELECT,
        }

        data[_TABLE.DOTS_ACCOUNT_INFO.USERNAME] = INPUT_USERNAME.value;
        data[_TABLE.DOTS_ACCOUNT_INFO.PASSWORD] = INPUT_PASSWORD.value;

        MyAjax.createJSON((error, response) => {
            console.log(response);
        }, data);

    });


</script>

</html>