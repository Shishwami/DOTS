<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Modal/Modal.css">
    <link rel="stylesheet" href="DOC_PRPS.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
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
        <h1>DOCUMENT PURPOSE</h1>

        <div class="main">

        <div class="search">
            <label for="searchBar">Search:</label>
            <input type="text" name="searchBar" id="searchBar" placeholder="Search">
        </div>
        
        <table id="TABLE_DOC_PRPS">
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

                <form class="form" action="submit" id="FORM_DOC_PRPS_ADD">
                    <div class="head">
                        <label for="DOC_PRPS_ADD_NAME">Purpose Type:</label>
                        <input type="text" name="DOC_PRPS_ADD_NAME" id="DOC_PRPS_ADD_NAME">
                    </div>
                    <div class="head">
                        <label for="DOC_PRPS_ADD_CODE">Purpose Code:</label>
                        <input type="text" name="DOC_PRPS_ADD_CODE" id="DOC_PRPS_ADD_CODE">
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

                <form class="form" action="submit" id="FORM_DOC_PRPS_EDIT">
                    <div class="head">
                        <label for="DOC_PRPS_EDIT_NAME">Purpose Type:</label>
                        <input type="text" name="DOC_PRPS_EDIT_NAME" id="DOC_PRPS_EDIT_NAME" data-keys="DOC_PRPS_NAME">
                    </div>
                    <div class="head">
                        <label for="DOC_PRPS_EDIT_CODE">Purpose Code:</label>
                        <input type="text" name="DOC_PRPS_EDIT_CODE" id="DOC_PRPS_EDIT_CODE" data-keys="DOC_PRPS_CODE">
                    </div>
                    <div class="dlt_inputs">
                        <input type="button" value="Delete">
                        <input type="submit" value="Edit">
                    </div>
                </form>
            </div>
        </div>

        </div>
    </div>

    <script src="../Modal/DevModal.js"></script>
    <script src="../SCRIPTS/Constants.js"></script>
    <script type="module">

        import MyAjax from "../SCRIPTS/MyAjax.js";
        import JsFunctions from "../SCRIPTS/JsFunctions.js";

        const DOC_PRPS_ADD = document.getElementById("FORM_DOC_PRPS_ADD");
        const DOC_PRPS_EDIT = document.getElementById("FORM_DOC_PRPS_EDIT");
        const DOC_PRPS_DELETE_BTTN = DOC_PRPS_EDIT.querySelector("input[type=button]");
        const DOC_PRPS_TBL = document.getElementById("TABLE_DOC_PRPS");
        const DOC_PRPS_SB = document.getElementById("searchBar");

        updateTable("");
        setInterval(function () {
            updateTable(DOC_PRPS_SB.value.toUpperCase());
        }, _RESET_TIME);

        DOC_PRPS_ADD.addEventListener('submit', function (e) {

            const DOC_PRPS_ADD_NAME = DOC_PRPS_ADD.querySelector('#DOC_PRPS_ADD_NAME');
            const DOC_PRPS_ADD_CODE = DOC_PRPS_ADD.querySelector('#DOC_PRPS_ADD_CODE');
            const DOC_PRPS_ADD_BTTN = DOC_PRPS_ADD.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_PRPS_ADD_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.INSERT
            };

            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_NAME] = DOC_PRPS_ADD_NAME.value;
            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_CODE] = DOC_PRPS_ADD_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_PRPS_ADD_NAME);
                        JsFunctions.clearInputText(DOC_PRPS_ADD_CODE);
                        JsFunctions.enableFormButton(DOC_PRPS_ADD_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_PRPS_EDIT.addEventListener('submit', function (e) {

            const DOC_PRPS_EDIT_NAME = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_NAME');
            const DOC_PRPS_EDIT_CODE = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_CODE');
            const DOC_PRPS_EDIT_BTTN = DOC_PRPS_EDIT.querySelector("input[type=submit]");

            JsFunctions.disableFormDefault(e);
            JsFunctions.disableFormButton(DOC_PRPS_EDIT_BTTN);

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.UPDATE,
                CONDITION: DOC_PRPS_EDIT_BTTN.dataset.condition
            };

            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_NAME] = DOC_PRPS_EDIT_NAME.value;
            data[_TABLE.DOTS_DOC_PRPS.DOC_PRPS_CODE] = DOC_PRPS_EDIT_CODE.value;

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        //console.log(response);
                        //success message
                        JsFunctions.clearInputText(DOC_PRPS_EDIT_NAME);
                        JsFunctions.clearInputText(DOC_PRPS_EDIT_CODE);
                        JsFunctions.enableFormButton(DOC_PRPS_EDIT_BTTN);
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_PRPS_DELETE_BTTN.addEventListener('click', function (e) {
            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
                REQUEST: _REQUEST.DELETE,
                CONDITION: DOC_PRPS_DELETE_BTTN.dataset.condition
            };

            MyAjax.createJSON((error, response) => {
                if (error) {
                    // console.log(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        console.log(response);
                        //success message
                    } else {
                        // console.log(response);
                        //error message
                    }
                }
            }, data);

        });

        DOC_PRPS_SB.addEventListener('input', function (e) {
            updateTable(DOC_PRPS_SB.value.toUpperCase());
        });

        function updateTable(filter) {
            const TBL_BODY = DOC_PRPS_TBL.querySelector("tbody");
            const TBL_HEAD = DOC_PRPS_TBL.querySelector("thead");

            const data = {
                TABLE_NAME: _TABLE.DOTS_DOC_PRPS.NAME,
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
            const DOC_PRPS_EDIT_NAME = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_NAME');
            const DOC_PRPS_EDIT_CODE = DOC_PRPS_EDIT.querySelector('#DOC_PRPS_EDIT_CODE');
            const DOC_PRPS_EDIT_BTTN = DOC_PRPS_EDIT.querySelector("input[type=submit]");

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

                        if (DOC_PRPS_EDIT_NAME.dataset.keys == TdKeys[i]) {
                            DOC_PRPS_EDIT_NAME.value = TdValues[i];
                        }
                        if (DOC_PRPS_EDIT_CODE.dataset.keys == TdKeys[i]) {
                            DOC_PRPS_EDIT_CODE.value = TdValues[i];
                        }
                    }

                    DOC_PRPS_EDIT_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                    DOC_PRPS_DELETE_BTTN.dataset.condition = JSON.stringify(TdKeysAndValues);
                });
            }
        }


    </script>
</body>

</html>