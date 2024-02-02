<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <label for="searchBar">Search:</label>
        <input type="text" name="searchBar" id="searchBar" placeholder="Search">
    </div>
    <table id="DOC_VIEW_TBL">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>


    <form action="submit" id="FORM_DOC_EDIT">
        <div>
            <label for="DATE_TIME_RECEIVED">Date Received:</label> <br>
            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="DATE_TIME_RECEIVED"
                data-keys="DATE_TIME_RECEIVED">
        </div>
        <div>
            <label for="LETTER_DATE">Letter Date:</label> <br>
            <input type="date" name="LETTER_DATE" id="LETTER_DATE" data-keys="LETTER_DATE">
        </div>
        <div>
            <label for="DOC_TYPE">Document Type:</label> <br>
            <select name="DOC_TYPE" id="DOC_TYPE" data-keys="DOC_TYPE">
                <option value="">Please Select Type</option>
            </select>
        </div>
        <div>
            <label for="DOC_OFFICE">Office/Agency</label> <br>
            <select name="DOC_OFFICE" id="DOC_OFFICE" data-keys="OFFICE_AGENCY">
                <option value="">Please Select Office</option>
            </select>

        </div>
        <div>
            <label for="SUBJECT">Subject:</label> <br>
            <input type="text" name="SUBJECT" id="SUBJECT" data-keys="SUBJECT">
        </div>
        <input type="submit" value="Edit">
    </form>


</body>
<script src="../SCRIPTS/Constants.js"></script>
<script>

</script>
<script type="module">

    import MyAjax from "../SCRIPTS/MyAjax.js";
    import JsFunctions from "../SCRIPTS/JsFunctions.js";

    const DOC_VIEW_TBL = document.getElementById("DOC_VIEW_TBL");
    const DOC_VIEW_SB = document.getElementById("searchBar");
    const FORM_DOC_EDIT = document.getElementById("FORM_DOC_EDIT");

    const DOC_TYPE = document.getElementById("DOC_TYPE");
    const DOC_OFFICE = document.getElementById("DOC_OFFICE");

    getTable("");
    getDOC_OFFICE();
    getDOC_TYPE();
    setInterval(function () {
        getTable(DOC_VIEW_SB.value.toUpperCase());
    }, _RESET_TIME);

    DOC_VIEW_SB.addEventListener('input', function (e) {
        getTable(DOC_VIEW_SB.value.toUpperCase());
    });

    FORM_DOC_EDIT.addEventListener('submit', function (e) {
        JsFunctions.disableFormDefault(e);

        const SubmitButton = FORM_DOC_EDIT.querySelector('input[type=submit]');
        JsFunctions.disableElement(SubmitButton);
    });

    function getTable(filter) {
        const tHead = DOC_VIEW_TBL.querySelector('thead');
        const tBody = DOC_VIEW_TBL.querySelector('tbody');

        const data = {
            TABLE_NAME: _TABLE.DOTS_DOC.NAME,
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

        const DATE_TIME_RECEIVED = FORM_DOC_EDIT.querySelector("#DATE_TIME_RECEIVED");
        const LETTER_DATE = FORM_DOC_EDIT.querySelector("#LETTER_DATE");
        const DOC_TYPE = FORM_DOC_EDIT.querySelector("#DOC_TYPE");
        const DOC_OFFICE = FORM_DOC_EDIT.querySelector("#DOC_OFFICE");
        const SUBJECT = FORM_DOC_EDIT.querySelector("#SUBJECT");

        const elements = [
            DATE_TIME_RECEIVED, LETTER_DATE, DOC_TYPE, DOC_OFFICE, SUBJECT
        ]
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

                    for (let p = 0; p < elements.length; p++) {
                        const element = elements[p];
                        console.log(element, ":", element.value);
                        if (elements[p].dataset.keys == cellKeys) {
                            elements[p].value = cellValue;
                        }
                    }

                }
                sessionStorage.setItem('TEMP_DATA', JSON.stringify(keysAndValues));

            });

        }
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

    function setSelect(element, response) {

        response.forEach(function (item) {
            var option = document.createElement('option');

            Object.keys(item).forEach(function (key) {
                option.value = item[key];
                option.innerText = item[key];
            });

            element.appendChild(option);
        });
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


</script>

</html>