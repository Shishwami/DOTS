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

    const FORM_LOGIN = document.getElementById('FORM_LOGIN');

    FORM_LOGIN.addEventListener('submit', function (e) {

        JsFunctions.disableFormDefault(e);

        const INPUT_USERNAME = FORM_LOGIN.querySelector('#INPUT_USERNAME');
        const INPUT_PASSWORD = FORM_LOGIN.querySelector('#INPUT_PASSWORD');
        const SUBMIT_BUTTON = FORM_LOGIN.querySelector("input[type=submit]");

        JsFunctions.disableElement(SUBMIT_BUTTON);

        const columns = [];
        columns.push(_TABLE.DOTS_ACCOUNT_INFO.HRIS_ID);
        columns.push(_TABLE.DOTS_ACCOUNT_INFO.FULL_NAME);
        columns.push(_TABLE.DOTS_ACCOUNT_INFO.INITIAL);

        const data = {
            TABLE_NAME: _TABLE.DOTS_ACCOUNT_INFO.NAME,
            REQUEST: _REQUEST.SELECT,
            COLUMNS: columns,
        }

        data[_TABLE.DOTS_ACCOUNT_INFO.USERNAME] = INPUT_USERNAME.value;
        data[_TABLE.DOTS_ACCOUNT_INFO.PASSWORD] = INPUT_PASSWORD.value;


        MyAjax.createJSON((error, response) => {
            if (!error) {
                if (response.VALID) {
                    //success message
                    // console.log(response.RESULT[0]);
                    createSession(response.RESULT[0]);
                } else {
                    //no data taken
                    console.log(response);
                }
            } else {
                alert(error);
            }
        }, data);

        function createSession(results) {
            const data2 = {

            };
            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        //success message

                    } else {
                        //no data taken
                        console.log(response);
                    }
                } else {
                    alert(error);
                }
            }, data);
        }

    });
</script>

</html>