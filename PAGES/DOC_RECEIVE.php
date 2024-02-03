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

            delete data.DOC_NUM;
            delete data.RECEIVED_BY;

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

        const FORM_RECEIVE = document.getElementById("FORM_RECEIVE");





    });
</script>

</html>