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
    <table id="TABLE_DOC_OFFICE">
        <thead>
            <tr>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <form action="submit" id="FORM_DOC_OFFICE_ADD">
        <div>
            <label for="DOC_OFFICE_ADD_NAME">Purpose Type:</label>
            <br>
            <input type="text" name="DOC_OFFICE_ADD_NAME" id="DOC_OFFICE_ADD_NAME">
        </div>
        <div>
            <label for="DOC_OFFICE_ADD_CODE">Purpose Code:</label>
            <br>
            <input type="text" name="DOC_OFFICE_ADD_CODE" id="DOC_OFFICE_ADD_CODE">
        </div>
        <input type="submit" value="Add">
    </form>

    <form action="submit" id="FORM_DOC_OFFICE_EDIT">
        <div>
            <label for="DOC_OFFICE_EDIT_NAME">Purpose Type:</label>
            <br>
            <input type="text" name="DOC_OFFICE_EDIT_NAME" id="DOC_OFFICE_EDIT_NAME" data-keys="DOC_OFFICE_NAME">
        </div>
        <div>
            <label for="DOC_OFFICE_EDIT_CODE">Purpose Code:</label>
            <br>
            <input type="text" name="DOC_OFFICE_EDIT_CODE" id="DOC_OFFICE_EDIT_CODE" data-keys="DOC_OFFICE_CODE">
        </div>
        <input type="button" value="Delete">
        <input type="submit" value="Edit">
    </form>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";

        const DOC_OFFICE_ADD = document.getElementById("FORM_DOC_OFFICE_ADD");
        const DOC_OFFICE_EDIT = document.getElementById("FORM_DOC_OFFICE_EDIT");
        const DOC_OFFICE_DELETE_BTTN = DOC_OFFICE_EDIT.querySelector("input[type=button]");
        const DOC_OFFICE_TBL = document.getElementById("TABLE_DOC_OFFICE");
        const DOC_OFFICE_SB = document.getElementById("searchBar");

        updateTable("");
        setInterval(function () {
            updateTable(DOC_OFFICE_SB.value.toUpperCase());
        }, _RESET_TIME);

        DOC_OFFICE_ADD.addEventListener('submit', function (e) {

            const DOC_OFFICE_ADD_NAME = DOC_OFFICE_ADD.querySelector('#DOC_OFFICE_ADD_NAME');
            const DOC_OFFICE_ADD_CODE = DOC_OFFICE_ADD.querySelector('#DOC_OFFICE_ADD_CODE');
            const DOC_OFFICE_ADD_BTTN = DOC_OFFICE_ADD.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_OFFICE_ADD_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.INSERT
            };

            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_NAME] = DOC_OFFICE_ADD_NAME.value;
            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_CODE] = DOC_OFFICE_ADD_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_OFFICE_ADD_NAME);
                        JsFunctions.clearInputText(DOC_OFFICE_ADD_CODE);
                        JsFunctions.enableFormButton(DOC_OFFICE_ADD_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_OFFICE_EDIT.addEventListener('submit', function (e) {

            const DOC_OFFICE_EDIT_NAME = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_NAME');
            const DOC_OFFICE_EDIT_CODE = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_CODE');
            const DOC_OFFICE_EDIT_BTTN = DOC_OFFICE_EDIT.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_OFFICE_EDIT_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.UPDATE,
                CONDITION: DOC_OFFICE_EDIT_BTTN.dataset.condition
            };

            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_NAME] = DOC_OFFICE_EDIT_NAME.value;
            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_CODE] = DOC_OFFICE_EDIT_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_OFFICE_EDIT_NAME);
                        JsFunctions.clearInputText(DOC_OFFICE_EDIT_CODE);
                        JsFunctions.enableFormButton(DOC_OFFICE_EDIT_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_OFFICE_DELETE_BTTN.addEventListener('click', function (e) {
            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.DELETE,
                CONDITION: DOC_OFFICE_DELETE_BTTN.dataset.condition
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

        DOC_OFFICE_SB.addEventListener('input', function (e) {
            updateTable(DOC_OFFICE_SB.value.toUpperCase());
        });

        function updateTable(filter) {
            const TBL_BODY = DOC_OFFICE_TBL.querySelector("tbody");
            const TBL_HEAD = DOC_OFFICE_TBL.querySelector("thead");

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
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
            const DOC_OFFICE_EDIT_NAME = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_NAME');
            const DOC_OFFICE_EDIT_CODE = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_CODE');
            const DOC_OFFICE_EDIT_BTTN = DOC_OFFICE_EDIT.querySelector("input[type=submit]");

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

                        if (DOC_OFFICE_EDIT_NAME.dataset.keys == TdKeys[i]) {
                            DOC_OFFICE_EDIT_NAME.value = TdValues[i];
                        }
                        if (DOC_OFFICE_EDIT_CODE.dataset.keys == TdKeys[i]) {
                            DOC_OFFICE_EDIT_CODE.value = TdValues[i];
                        }
                    }

                    DOC_OFFICE_EDIT_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                    DOC_OFFICE_DELETE_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                });
            }
        }


    </script>
</body>

</html>