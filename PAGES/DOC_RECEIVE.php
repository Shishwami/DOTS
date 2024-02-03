<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="submit" id="FORM_RECEIVE">
        <div>
            <label for="DOC_NUM">Document Number:</label> <br>
            <input type="text" name="DOC_NUM" id="DOC_NUM" disabled>
        </div>
        <div>
            <label for="FULLNAME">Received By:</label> <br>
            <input type="text" name="FULLNAME" id="FULLNAME" disabled>
            <input type="text" name="RECEIVED_BY" id="RECEIVED_BY" hidden>
            <input type="text" name="DOC_OPERATION" id="RECEIVED_BY" value="RECEIVED"hidden>
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
            <select name="DOC_TYPE" id="DOC_TYPE">
                <option value="">Please Select Type</option>
            </select>
        </div>
        <div>
            <label for="DOC_OFFICE">Office/Agency</label> <br>
            <select name="DOC_OFFICE" id="DOC_OFFICE">
                <option value="">Please Select Office</option>
            </select>

        </div>
        <div>
            <label for="DOC_SUBJECT">Subject:</label> <br>
            <input type="text" name="DOC_SUBJECT" id="DOC_SUBJECT">
        </div>
        <input type="submit" value="Submit">
    </form>
</body>

<script src="../SCRIPTS/Constants.js"></script>
<script type="module">

    import JsFunctions from "../SCRIPTS/JsFunctions.js";
    import MyAjax from "../SCRIPTS/MyAjax.js";

    document.addEventListener('DOMContentLoaded', function (event) {

        const FORM_RECEIVE = document.getElementById("FORM_RECEIVE");

        FORM_RECEIVE.addEventListener('submit', function (e) {
            e.preventDefault();

            var data = JsFunctions.FormToJson(FORM_RECEIVE);

            data = {
                ...data,
                TABLE_NAME: DOTS_DOCUMENT.NAME,
                REQUEST: _REQUEST.INSERT,
            };

            console.log(data);

            MyAjax.createJSON((error, response) => {
                if (!error) {
                    if (response.VALID) {
                        alert("Success");
                    }
                } else {
                    alert(error);
                }
            }, data);
        });

    });


</script>


<script type="module">

    import JsFunctions from "../SCRIPTS/JsFunctions.js";
    import MyAjax from "../SCRIPTS/MyAjax.js";

    document.addEventListener('DOMContentLoaded', function (event) {

        setDOC_NUM();
        setDOC_TYPE();
        setDOC_OFFICE();
        getSessionName();
        getSessionInitial();

        function setDOC_NUM() {

            const columns = [
                DOTS_DOCUMENT.DOC_NUMBER,
            ]

            var data = {
                TABLE_NAME: DOTS_DOCUMENT.NAME,
                REQUEST: _REQUEST.SELECT,
            }

            MyAjax.createJSON((error, response) => {
                if (error) {
                    alert(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        delete response.VALID;
                        const doc_numbers = Object.values(response)[0];
                        const last_obj = doc_numbers[doc_numbers.length - 1];
                        const last_number = Object.values(last_obj)[0];
                        const number_increased = Number(last_number) + 1;
                        DOC_NUM.value = number_increased;
                    } else {
                        console.log(response);
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
                        FULLNAME.value = Object.values(response)[0];
                    } else {
                        console.log(response);
                        //error message
                    }
                }
            }, data);
        }

        function getSessionInitial() {
            const data = {
                REQUEST: _REQUEST.GET_SESSION_INITIAL,
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

        function setDOC_TYPE() {

            const columns = [
                DOTS_DOC_TYPE.DOC_TYPE_NAME,
            ]

            var data = {
                TABLE_NAME: DOTS_DOC_TYPE.NAME,
                REQUEST: _REQUEST.SELECT,
                COLUMNS: columns
            }
            MyAjax.createJSON((error, response) => {
                if (error) {
                    alert(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        delete response.VALID;
                        JsFunctions.setSelect(DOC_TYPE, Object.values(response)[0]);
                    } else {
                        console.log(response);
                    }
                }
            }, data);
        }

        function setDOC_OFFICE() {

            const columns = [
                DOTS_DOC_OFFICE.DOC_OFFICE_NAME,
            ]

            var data = {
                TABLE_NAME: DOTS_DOC_OFFICE.NAME,
                REQUEST: _REQUEST.SELECT,
                COLUMNS: columns
            }
            MyAjax.createJSON((error, response) => {
                if (error) {
                    alert(error);
                    //message popup
                } else {
                    if (response.VALID) {
                        delete response.VALID;
                        JsFunctions.setSelect(DOC_OFFICE, Object.values(response)[0]);
                    } else {
                        console.log(response);
                    }
                }
            }, data);
        }
    });
</script>

</html>