<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="submit" id="DOC_CREATE">
        <div>
            <label for="DOC_NUM">Document Number:</label> <br>
            <input type="text" name="DOC_NUM" id="DOC_NUM" disabled>
        </div>
        <div>
            <label for="RECEIVED_BY">Received By:</label> <br>
            <input type="text" name="RECEIVED_BY" id="RECEIVED_BY" disabled>
        </div>
        <div>
            <label for="DATE_TIME_RECEIVED">Date Received:</label> <br>
            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="DATE_TIME_RECEIVED">
        </div>
        <div>
            <label for="LETTER_DATE">Letter Date:</label> <br>
            <input type="date" name="LETTER_DATE" id="LETTER_DATE">
        </div>
        <div>
            <label for="DOC_TYPE">Document Type:</label> <br>
            <select name="DOC_TYPE" id="DOC_TYPE"></select>
        </div>
        <div>
            <label for="DOC_OFFICE">Office/Agency</label> <br>
            <select name="DOC_OFFICE" id="DOC_OFFICE"></select>

        </div>
        <div>
            <label for="SUBJECT">Subject:</label> <br>
            <input type="text" name="SUBJECT" id="SUBJECT">
        </div>
        <input type="submit" value="Submit">
    </form>
</body>
<script src="../SCRIPTS/Constants.js"></script>
<script type="module">
    import MyAjax from "../SCRIPTS/MyAjax.js";
    //get inputs

    //GET DOC_TYPE
    const DOC_NUM = document.getElementById("DOC_NUM");
    const DOC_TYPE = document.getElementById("DOC_TYPE");
    const DOC_OFFICE = document.getElementById("DOC_OFFICE");
    const DATE_TIME_RECEIVED = document.getElementById("DATE_TIME_RECEIVED");
    const LETTER_DATE = document.getElementById("LETTER_DATE");
    const RECEIVED_BY = document.getElementById("RECEIVED_BY");

    getDOC_TYPE();
    getDOC_OFFICE();
    getDateTime();
    getDate();
    getSessionName();
    updateDOC_NUMBER();
    setInterval(updateDOC_NUMBER, _RESET_TIME);

    function updateDOC_NUMBER() {
        getDOC_NUMBER(DOC_NUM);
    }

    function getDOC_TYPE() {
        const column_names = [
            _TABLE.DOTS_DOC_TYPE.DOC_TYPE_NAME
        ]
        const data = {
            TABLE_NAME: _TABLE.DOTS_DOC_TYPE.NAME,
            REQUEST: _REQUEST.SELECT,
            COLUMNS: column_names,
        }

        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    delete response.SQL;//to be removed
                    setSelect(DOC_TYPE, Object.values(response)[0]);
                } else {
                    console.log(response);
                    //error message
                }
            }
        }, data);
    }

    function getDOC_OFFICE() {
        const column_names = [
            _TABLE.DOTS_DOC_OFFICE.DOC_OFFICE_NAME
        ]
        const data = {
            TABLE_NAME: _TABLE.DOTS_DOC_OFFICE.NAME,
            REQUEST: _REQUEST.SELECT,
            COLUMNS: column_names,
        }

        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    delete response.SQL;//to be removed
                    setSelect(DOC_OFFICE, Object.values(response)[0]);
                } else {
                    console.log(response);
                    //error message
                }
            }
        }, data);
    }

    function getDateTime() {
        const data = {
            REQUEST: _REQUEST.GET_DATE,
            DATE_TIME: "true",
        }
        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    DATE_TIME_RECEIVED.value = Object.values(response)[0];
                } else {
                    console.log(response);
                    //error message
                }
            }
        }, data);
    }
    function getDate() {
        const data = {
            REQUEST: _REQUEST.GET_DATE,
            DATE: "true",

        }
        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    LETTER_DATE.value = Object.values(response)[0];
                } else {
                    console.log(response);
                    //error message
                }
            }
        }, data);
    }

    function getSessionName() {
        const data = {
            REQUEST: _REQUEST.GET_SESSION_NAME,
        }
        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    RECEIVED_BY.value = Object.values(response)[0];
                } else {
                    console.log(response);
                    //error message
                }
            }
        }, data);
    }

    function getDOC_NUMBER(element) {
        const columns = []
        columns.push(_TABLE.DOTS_DOC.DOC_NUMBER);

        const data = {
            TABLE_NAME: _TABLE.DOTS_DOC.NAME,
            REQUEST: _REQUEST.SELECT,
            COLUMNS: columns,
        }
        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
                //message popup
            } else {
                if (response.VALID) {
                    delete response.VALID;
                    delete response.SQL;//to be removed
                    // return Object.values(response)[0];
                    const doc_numbers = Object.values(response)[0];
                    const last_obj = doc_numbers[doc_numbers.length - 1];
                    const last_number = Object.values(last_obj)[0];
                    const number_increased = Number(last_number) + 1;
                    element.value = number_increased;
                } else {
                    console.log(response);
                }
            }
        }, data);
    }

    function setSelect(element, response) {

        element.innerHTML = '';

        response.forEach(function (item) {
            var option = document.createElement('option');

            Object.keys(item).forEach(function (key) {
                option.value = item[key];
                option.innerText = item[key];
            });

            element.appendChild(option);
        });
    }

</script>

<script type="module">
    import JsFunctions from "../SCRIPTS/JsFunctions.js";

    const DOC_CREATE = document.getElementById("DOC_CREATE");

    DOC_CREATE.addEventListener('submit', function (e) {

        JsFunctions.disableFormDefault(e);

    });
</script>

</html>