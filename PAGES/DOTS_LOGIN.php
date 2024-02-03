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
            <label for="USERNAME">Username:</label>
            <input type="text" name="USERNAME" id="USERNAME">
        </div>
        <div>
            <label for="PASSWORD">Password:</label>
            <input type="text" name="PASSWORD" id="PASSWORD">
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

        var columns = [
            DOTS_ACCOUNT.HRIS_ID,
            DOTS_ACCOUNT.FULL_NAME,
            DOTS_ACCOUNT.INITIAL,
        ]

        data = {
            ...data,
            TABLE_NAME: DOTS_ACCOUNT.NAME,
            REQUEST: _REQUEST.SELECT,
            COLUMNS: columns
        };



        MyAjax.createJSON((error, response) => {
            if (!error) {
                if (response.VALID) {
                    delete response.VALID;
                    createSession(response);
                }
            } else {
                alert(error);
            }
        }, data);
    });

    function createSession(response) {
        const object = Object.values(response)[0];

        var data = {
            REQUEST: _REQUEST.CREATE_SESSION,
        }
        Object.assign(data,object[0]);

        MyAjax.createJSON((error, response) => {
            if (!error) {
                if (response.VALID) {
                    location.href = "./DOC_RECEIVE.php";
                }
            } else {
                alert(error);
            }
        }, data);

    }

</script>

</html>