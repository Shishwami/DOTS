<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="submit" id="FORM_LOGIN">
        <div>
            <label for="INPUT_USERNAME">Username:</label>
            <input type="text" name="INPUT_USERNAME" id="INPUT_USERNAME">
        </div>
        <div>
            <label for="INPUT_PASSWORD">Password:</label>
            <input type="text" name="INPUT_PASSWORD" id="INPUT_PASSWORD">
        </div>
        <div>
            <input type="submit" value="LOGIN">
        </div>
    </form>
    <script src="../SCRIPTS/Constants.js"></script>
</body>

<script type="module">

    import MyAjax from "../SCRIPTS/MyAjax.js"
    import JsFunctions from "../SCRIPTS/JsFunctions.js"

    const FORM_LOGIN = document.getElementById("FORM_LOGIN");

    FORM_LOGIN.addEventListener('submit', function (e) {
        e.preventDefault();

        var data = JsFunctions.FormToJson(FORM_LOGIN);

        data = {
            ...data,
            TABLE_NAME: DOTS_ACCOUNT.NAME,
            REQUEST: _REQUEST.SELECT,
        };

        MyAjax.createJSON((error, response) => {
            if (!error) {
                if (response.VALID) {
                    alert("Success");
                }
            } else {
                alert(error);
            }
        }, data);
    });

</script>

</html>