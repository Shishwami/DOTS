<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table id="TABLE_DOC_TYPE">
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <form action="submit" id="FORM_DOC_TYPE_ADD">
        <div>
            <label for="DOC_TYPE_ADD_NAME">Document Type:</label>
            <br>
            <input type="text" name="DOC_TYPE_ADD_NAME" id="DOC_TYPE_ADD_NAME">
        </div>
        <div>
            <label for="DOC_TYPE_ADD_CODE">Document Code:</label>
            <br>
            <input type="text" name="DOC_TYPE_ADD_CODE" id="DOC_TYPE_ADD_CODE">
        </div>
        <input type="submit" value="Add">
    </form>

    <form action="submit" id="FORM_DOC_TYPE_EDIT">
        <div>
            <label for="DOC_TYPE_EDIT_NAME">Document Type:</label>
            <br>
            <input type="text" name="DOC_TYPE_EDIT_NAME" id="DOC_TYPE_EDIT_NAME">
        </div>
        <div>
            <label for="DOC_TYPE_EDIT_CODE">Document Code:</label>
            <br>
            <input type="text" name="DOC_TYPE_EDIT_CODE" id="DOC_TYPE_EDIT_CODE">
        </div>
        <input type="button" value="Delete">
        <input type="submit" value="Edit">
    </form>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";

        const DOC_TYPE_ADD = document.getElementById("FORM_DOC_TYPE_ADD");
        const DOC_TYPE_TBL = document.getElementById("TABLE_DOC_TYPE");

        updateTable();

        DOC_TYPE_ADD.addEventListener('submit', function (e) {
            const DOC_TYPE_ADD_NAME = DOC_TYPE_ADD.querySelector('#DOC_TYPE_ADD_NAME');
            const DOC_TYPE_ADD_CODE = DOC_TYPE_ADD.querySelector('#DOC_TYPE_ADD_CODE');
            const DOC_TYPE_ADD_BTTN = DOC_TYPE_ADD.querySelector("input[type=submit]");
            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_TYPE_ADD_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_TYPE.NAME,
                REQUEST: _REQUEST.INSERT
            };

            data[_TABLE.DOTS_DOC_TYPE.DOC_TYPE_NAME] = DOC_TYPE_ADD_NAME.value;
            data[_TABLE.DOTS_DOC_TYPE.DOC_TYPE_CODE] = DOC_TYPE_ADD_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    console.log(error);
                } else {
                    if (response.valid) {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            }, data);

            console.log(data);
        });

        function updateTable() {
            const TBL_BODY = DOC_TYPE_TBL.querySelector("tbody");
            const TBL_HEAD = DOC_TYPE_TBL.querySelector("thead");

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_TYPE.NAME,
                REQUEST: _REQUEST.SELECT,
                COLUMNS: ""
            };

            MyAjax.createJSON((error, response) => {
                if (error) {
                    console.log(error);
                } else {
                    if (response.VALID) {
                        console.log(response.RESULT);
                        JsFunctions.updateTable(response.RESULT,TBL_HEAD,TBL_BODY);
                    } else {
                        console.log(response);
                    }
                }
            }, data);

        }


    </script>
</body>

</html>