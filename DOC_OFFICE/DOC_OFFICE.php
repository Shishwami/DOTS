<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Modal/Modal.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <link rel="stylesheet" href="DOC_OFFICE.css">
    <title></title>
</head>
<style>
    tr:hover {
        background-color: green;
    }
</style>

<body>
    <?php include '../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="container" id="main">

        <h1>Office</h1>

        <div class="main">

            <div class="search">
                <div>
                    <label for="searchBar">Search:</label>
                    <input type="text" name="searchBar" id="searchBar" placeholder="Search">
                </div>
            </div>

            <table id="TABLE_DOC_OFFICE">
                <thead>
                    <tr>

                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
            
            <button class="opt_btn" id="add">Add</button>
            <button class="opt_btn" id="dlt">Delete</button>

            <div class="modal" id="add_modal">
                <div class="modal_content add">
                    <div class="modal_banner">
                        <span class="add_close">&times;</span>
                        <h1>Add Something</h1>
                    </div>

                    <form class="form" action="submit" id="FORM_DOC_OFFICE_ADD">
                        <div class="head">
                            <label for="DOC_OFFICE_ADD_NAME">Office Type:</label>
                            <input type="text" name="DOC_OFFICE_ADD_NAME" id="DOC_OFFICE_ADD_NAME" data-keys="DOC_OFFICE_NAME">
                        </div>
                        <div class="head">
                            <label for="DOC_OFFICE_ADD_CODE">Office Code:</label>
                            <input type="text" name="DOC_OFFICE_ADD_CODE" id="DOC_OFFICE_ADD_CODE" data-keys="DOC_OFFICE_CODE">
                        </div>
                        <div class="add_inputs">
                            <input type="submit" value="Add">
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal" id="dlt_modal">
                <div class="modal_content dlt">
                    <div class="modal_banner">
                        <span class="dlt_close">&times;</span>
                        <h1>Add Something</h1>
                    </div>

                    <form class="form" action="submit" id="FORM_DOC_OFFICE_EDIT">
                        <div class="head">
                            <label for="DOC_OFFICE_EDIT_NAME">Office Type:</label>
                            <input type="text" name="DOC_OFFICE_EDIT_NAME" id="DOC_OFFICE_EDIT_NAME" data-keys="DOC_OFFICE_NAME">
                        </div>
                        <div class="head">
                            <label for="DOC_OFFICE_EDIT_CODE">Office Code:</label>
                            <input type="text" name="DOC_OFFICE_EDIT_CODE" id="DOC_OFFICE_EDIT_CODE" data-keys="DOC_OFFICE_CODE">
                        </div>
                        <input type="button" value="Delete">
                        <input type="submit" value="Edit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <script src="../Modal/DevModal.js"></script>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";


        const DOC_OFFICE_ADD = document.getElementById("FORM_DOC_OFFICE_ADD");
        const DOC_OFFICE_EDIT = document.getElementById("FORM_DOC_OFFICE_EDIT");
        // const DOC_OFFICE_DELETE_BTTN = DOC_OFFICE_EDIT.querySelector("input[type=button]");
        const DOC_OFFICE_TBL = document.getElementById("TABLE_DOC_OFFICE");
        // const DOC_OFFICE_SB = document.getElementById("searchBar");

        getTable("");
        setInterval(function () {
            getTable("");
        }, _RESET_TIME);
        // DOC_OFFICE_SB.addEventListener('input', function (e) {
        //     updateTable(DOC_OFFICE_SB.value.toUpperCase());
        // });

        DOC_OFFICE_ADD.addEventListener('submit', function (e) {

            JsFunctions.disableFormDefault(e);

            const DOC_OFFICE_NAME = DOC_OFFICE_ADD.querySelector('#DOC_OFFICE_ADD_NAME');
            const DOC_OFFICE_CODE = DOC_OFFICE_ADD.querySelector('#DOC_OFFICE_ADD_CODE');
            const SubmitButton = DOC_OFFICE_ADD.querySelector('input[type=submit]');

            const keysAndValues = {}
            keysAndValues[DOC_OFFICE_NAME.dataset.keys] = DOC_OFFICE_NAME.value;
            keysAndValues[DOC_OFFICE_CODE.dataset.keys] = DOC_OFFICE_CODE.value;

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.INSERT,
            }

            data[DOC_OFFICE_NAME.dataset.keys] = DOC_OFFICE_NAME.value;
            data[DOC_OFFICE_CODE.dataset.keys] = DOC_OFFICE_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        //success message
                    } else {
                        //no data taken
                    }
                } else {
                    alert(error);
                }
            }, data);

        });

        DOC_OFFICE_EDIT.addEventListener('submit', function (e) {

            JsFunctions.disableFormDefault(e);

            const SubmitButton = DOC_OFFICE_EDIT.querySelector('input[type=submit]');
            JsFunctions.disableElement(SubmitButton);
            const inputName = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_NAME');
            const inputCode = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_CODE');

            const keysAndValues = sessionStorage.getItem('TEMP');

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.UPDATE,
                CONDITION: keysAndValues,
            }
            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_NAME] = inputName.value;
            data[_TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_CODE] = inputCode.value;

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

        function getTable(filter) {
            filter = "";
            const tHead = DOC_OFFICE_TBL.querySelector('thead');
            const tBody = DOC_OFFICE_TBL.querySelector('tbody');

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
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
            const inputName = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_NAME');
            const inputCode = DOC_OFFICE_EDIT.querySelector('#DOC_OFFICE_EDIT_CODE');
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
                    sessionStorage.setItem('TEMP', JSON.stringify(keysAndValues));
                });

            }
        }

    </script>
</body>

</html>