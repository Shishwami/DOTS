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
    <div>
        <table id="TABLE_DOC_PRPS">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <form action="submit" id="FORM_DOC_PRPS_ADD">
        <div>
            <label for="DOC_PRPS_ADD_NAME">Purpose Type:</label>
            <br>
            <input type="text" name="DOC_PRPS_ADD_NAME" id="DOC_PRPS_ADD_NAME" data-keys="DOC_PRPS_NAME">
        </div>
        <div>
            <label for="DOC_PRPS_ADD_CODE">Purpose Code:</label>
            <br>
            <input type="text" name="DOC_PRPS_ADD_CODE" id="DOC_PRPS_ADD_CODE" data-keys="DOC_PRPS_CODE">
        </div>
        <input type="submit" value="Add">
    </form>

    <form action="submit" id="FORM_DOC_PRPS_EDIT">
        <div>
            <label for="DOC_PRPS_EDIT_NAME">Purpose Type:</label>
            <br>
            <input type="text" name="DOC_PRPS_EDIT_NAME" id="DOC_PRPS_EDIT_NAME" data-keys="DOC_PRPS_NAME">
        </div>
        <div>
            <label for="DOC_PRPS_EDIT_CODE">Purpose Code:</label>
            <br>
            <input type="text" name="DOC_PRPS_EDIT_CODE" id="DOC_PRPS_EDIT_CODE" data-keys="DOC_PRPS_CODE">
        </div>
        <input type="button" value="Delete">
        <input type="submit" value="Edit">
    </form>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";


        const DOC_PRPS_ADD = document.getElementById("FORM_DOC_PRPS_ADD");
        const DOC_PRPS_EDIT = document.getElementById("FORM_DOC_PRPS_EDIT");
        const DOC_PRPS_DELETE_BTTN = DOC_PRPS_EDIT.querySelector("input[type=button]");
        const DOC_PRPS_TBL = document.getElementById("TABLE_DOC_PRPS");
        const DOC_PRPS_SB = document.getElementById("searchBar");

        getTable("");
        setInterval(function () {
            getTable(DOC_PRPS_SB.value.toUpperCase());
        }, _RESET_TIME);

        DOC_PRPS_SB.addEventListener('input', function (e) {
            getTable(DOC_PRPS_SB.value.toUpperCase());
        });

        DOC_PRPS_ADD.addEventListener('submit', function (e) {

            JsFunctions.disableFormDefault(e);

            const DOC_PRPS_NAME = DOC_PRPS_ADD.querySelector('#DOC_PRPS_ADD_NAME');
            const DOC_PRPS_CODE = DOC_PRPS_ADD.querySelector('#DOC_PRPS_ADD_CODE');
            const SubmitButton = DOC_PRPS_ADD.querySelector('input[type=submit]');

            const keysAndValues = {}
            keysAndValues[DOC_PRPS_NAME.dataset.keys] = DOC_PRPS_NAME.value;
            keysAndValues[DOC_PRPS_CODE.dataset.keys] = DOC_PRPS_CODE.value;

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.INSERT,
            }

            data[DOC_PRPS_NAME.dataset.keys] = DOC_PRPS_NAME.value;
            data[DOC_PRPS_CODE.dataset.keys] = DOC_PRPS_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        //success message
                        DOC_PRPS_NAME.value = "";
                        DOC_PRPS_CODE.value = "";
                    } else {
                        //no data taken
                    }
                } else {
                    alert(error);
                }
            }, data);

        });

        DOC_PRPS_EDIT.addEventListener('submit', function (e) {

            JsFunctions.disableFormDefault(e);

            const SubmitButton = DOC_PRPS_EDIT.querySelector('input[type=submit]');
            JsFunctions.disableElement(SubmitButton);
            const inputName = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_NAME');
            const inputCode = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_CODE');

            const keysAndValues = sessionStorage.getItem('TEMP_DATA');

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.UPDATE,
                CONDITION: keysAndValues,
            }
            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_NAME] = inputName.value;
            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_CODE] = inputCode.value;

            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        //success
                        JsFunctions.enableElement(SubmitButton);
                    } else {
                        //no data taken
                    }
                } else {
                    alert(error);
                }
            }, data);
        });

        DOC_PRPS_EDIT.addEventListener('click', function (e) {
            const keysAndValues = sessionStorage.getItem('TEMP_DATA');

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.DELETE,
                CONDITION: keysAndValues,
            }

            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        //success
                    } else {
                        //no data taken
                    }
                } else {
                    alert(error);
                }
            }, data);
        });

        function getTable(filter) {
            const tHead = DOC_PRPS_TBL.querySelector('thead');
            const tBody = DOC_PRPS_TBL.querySelector('tbody');

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.SELECT,
            }
            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        const results = response.RESULT;
                        JsFunctions.updateTable(results, tHead, tBody, filter);
                        setTableEvent(tBody);
                    } else {
                        //no data taken
                    }
                } else {
                    alert(error);
                }
            }, data);
        }

        function setTableEvent(tBody) {
            const tableRows = tBody.querySelectorAll('tr');
            const inputName = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_NAME');
            const inputCode = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_CODE');
            const keysAndValues = {};

            for (let i = 0; i < tableRows.length; i++) {
                const tableRow = tableRows[i];
                const rowCells = tableRow.querySelectorAll('td');
                tableRow.addEventListener('click', function (e) {
                    for (let o = 0; o < rowCells.length; o++) {
                        const cell = rowCells[o];
                        const cellValue = cell.dataset.value;
                        const cellKeys = cell.dataset.keys;

                        keysAndValues[cellKeys] = cellValue;

                        if (inputName.dataset.keys == cellKeys) {
                            inputName.value = cellValue;
                        }
                        if (inputCode.dataset.keys == cellKeys) {
                            inputCode.value = cellValue;
                        }
                    }
                    sessionStorage.setItem('TEMP_DATA', JSON.stringify(keysAndValues));
                });

            }
        }

    </script>
</body>

</html>