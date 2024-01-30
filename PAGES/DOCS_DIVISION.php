<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    tr:hover {
        background-color: green;
    }
</style>

<body>
    <div>
        <label for="searchBar">Search:</label>
        <input type="text" name="searchBar" id="searchBar" placeholder="Search">
    </div>
    <table id="TABLE_DOC_DIVISION">
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <form action="submit" id="FORM_DOC_DIVISION_ADD">
        <div>
            <label for="DOC_DIVISION_ADD_NAME">Office Name:</label>
            <br>
            <input type="text" name="DOC_DIVISION_ADD_NAME" id="DOC_DIVISION_ADD_NAME">
        </div>
        <div>
            <label for="DOC_DIVISION_ADD_CODE">Office Code:</label>
            <br>
            <input type="text" name="DOC_DIVISION_ADD_CODE" id="DOC_DIVISION_ADD_CODE">
        </div>
        <input type="submit" value="Add">
    </form>

    <form action="submit" id="FORM_DOC_DIVISION_EDIT">
        <div>
            <label for="DOC_DIVISION_EDIT_NAME">Office Name:</label>
            <br>
            <input type="text" name="DOC_DIVISION_EDIT_NAME" id="DOC_DIVISION_EDIT_NAME" data-keys="DOC_DIVISION_NAME">
        </div>
        <div>
            <label for="DOC_DIVISION_EDIT_CODE">Office Code:</label>
            <br>
            <input type="text" name="DOC_DIVISION_EDIT_CODE" id="DOC_DIVISION_EDIT_CODE" data-keys="DOC_DIVISION_CODE">
        </div>
        <input type="button" value="Delete">
        <input type="submit" value="Edit">
    </form>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";

        const DOC_DIVISION_ADD = document.getElementById("FORM_DOC_DIVISION_ADD");
        const DOC_DIVISION_EDIT = document.getElementById("FORM_DOC_DIVISION_EDIT");
        const DOC_DIVISION_DELETE_BTTN = DOC_DIVISION_EDIT.querySelector("input[type=button]");
        const DOC_DIVISION_TBL = document.getElementById("TABLE_DOC_DIVISION");
        const DOC_DIVISION_SB = document.getElementById("searchBar");

        updateTable("");
        setInterval(function () {
            updateTable(DOC_DIVISION_SB.value.toUpperCase());
        }, _RESET_TIME);

        DOC_DIVISION_ADD.addEventListener('submit', function (e) {

            const DOC_DIVISION_ADD_NAME = DOC_DIVISION_ADD.querySelector('#DOC_DIVISION_ADD_NAME');
            const DOC_DIVISION_ADD_CODE = DOC_DIVISION_ADD.querySelector('#DOC_DIVISION_ADD_CODE');
            const DOC_DIVISION_ADD_BTTN = DOC_DIVISION_ADD.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_DIVISION_ADD_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_DIVISION.NAME,
                REQUEST: _REQUEST.INSERT
            };

            data[_TABLE.DOTS_DOC_DIVISION.DOC_DIVISION_NAME] = DOC_DIVISION_ADD_NAME.value;
            data[_TABLE.DOTS_DOC_DIVISION.DOC_DIVISION_CODE] = DOC_DIVISION_ADD_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_DIVISION_ADD_NAME);
                        JsFunctions.clearInputText(DOC_DIVISION_ADD_CODE);
                        JsFunctions.enableFormButton(DOC_DIVISION_ADD_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_DIVISION_EDIT.addEventListener('submit', function (e) {

            const DOC_DIVISION_EDIT_NAME = DOC_DIVISION_EDIT.querySelector('#DOC_DIVISION_EDIT_NAME');
            const DOC_DIVISION_EDIT_CODE = DOC_DIVISION_EDIT.querySelector('#DOC_DIVISION_EDIT_CODE');
            const DOC_DIVISION_EDIT_BTTN = DOC_DIVISION_EDIT.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_DIVISION_EDIT_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_DIVISION.NAME,
                REQUEST: _REQUEST.UPDATE,
                CONDITION: DOC_DIVISION_EDIT_BTTN.dataset.condition
            };

            data[_TABLE.DOTS_DOC_DIVISION.DOC_DIVISION_NAME] = DOC_DIVISION_EDIT_NAME.value;
            data[_TABLE.DOTS_DOC_DIVISION.DOC_DIVISION_CODE] = DOC_DIVISION_EDIT_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_DIVISION_EDIT_NAME);
                        JsFunctions.clearInputText(DOC_DIVISION_EDIT_CODE);
                        JsFunctions.enableFormButton(DOC_DIVISION_EDIT_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_DIVISION_DELETE_BTTN.addEventListener('click', function (e) {
            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_DIVISION.NAME,
                REQUEST: _REQUEST.DELETE,
                CONDITION: DOC_DIVISION_DELETE_BTTN.dataset.condition
            };


            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        // console.log(response);
                        //success message
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_DIVISION_SB.addEventListener('input', function (e) {
            updateTable(DOC_DIVISION_SB.value.toUpperCase());
        });

        function updateTable(filter) {
            const TBL_BODY = DOC_DIVISION_TBL.querySelector("tbody");
            const TBL_HEAD = DOC_DIVISION_TBL.querySelector("thead");

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_DIVISION.NAME,
                REQUEST: _REQUEST.SELECT,
                COLUMNS: ""
            };

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        // console.log(response.RESULT);
                        JsFunctions.updateTable(response.RESULT, TBL_HEAD, TBL_BODY, filter);
                        addEventOnTR(TBL_HEAD, TBL_BODY);
                    } else {
                        //  console.log(response);
                    }
                }
            }, data);

        }

        function addEventOnTR(thead, tbody) {
            const TrList = tbody.getElementsByTagName('tr');
            const DOC_DIVISION_EDIT_NAME = DOC_DIVISION_EDIT.querySelector('#DOC_DIVISION_EDIT_NAME');
            const DOC_DIVISION_EDIT_CODE = DOC_DIVISION_EDIT.querySelector('#DOC_DIVISION_EDIT_CODE');
            const DOC_DIVISION_EDIT_BTTN = DOC_DIVISION_EDIT.querySelector("input[type=submit]");

            for (let index = 0; index < TrList.length; index++) {
                TrList[index].addEventListener('click', function (e) {

                    const Tr = this;
                    const Td = this.getElementsByTagName('td');
                    const TdValues = [];
                    const TdKeys = [];
                    const TdKeysAndValues = {};

                    for (let i = 0; i < Td.length; i++) {
                        TdValues.push(Td[i].dataset.value);
                        TdKeys.push(Td[i].dataset.keys);
                        TdKeysAndValues[TdKeys[i]] = TdValues[i];

                        if (DOC_DIVISION_EDIT_NAME.dataset.keys == TdKeys[i]) {
                            DOC_DIVISION_EDIT_NAME.value = TdValues[i];
                        }
                        if (DOC_DIVISION_EDIT_CODE.dataset.keys == TdKeys[i]) {
                            DOC_DIVISION_EDIT_CODE.value = TdValues[i];
                        }
                    }

                    DOC_DIVISION_EDIT_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                    DOC_DIVISION_DELETE_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                });
            }
        }


    </script>
</body>

</html>