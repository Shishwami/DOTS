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
            <label for="DATE_TIME_RECEIVED">Date Received:</label> <br>
            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="DATE_TIME_RECEIVED">
        </div>
        <div>
            <label for="RECEIVED_BY">Received By:</label> <br>
            <input type="text" name="RECEIVED_BY" id="RECEIVED_BY" disabled>
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
            <label for="LETTER_DATE">Date Received:</label> <br>
            <input type="date" name="LETTER_DATE" id="LETTER_DATE">
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

    const DOC_TYPE = document.getElementById("DOC_TYPE");
    const DOC_OFFICE = document.getElementById("DOC_OFFICE");

    getDOC_TYPE();
    getDOC_OFFICE();

    function getDOC_TYPE() {
        console.log("GETDOCYY");
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
                console.log(error);
                //message popup
            } else {
                if (response.VALID) {
                    console.log(response);
                    //success message
                    setSelect(DOC_TYPE, response.RESULT);
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
                console.log(error);
                //message popup
            } else {
                if (response.VALID) {
                    console.log(response);
                    //success message
                    setSelect(DOC_OFFICE, response.RESULT);
                } else {
                    console.log(response);
                    //error message
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

</html>