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
            <label for="OFFICE_AGENCY">Office/Agency</label> <br>
            <select name="OFFICE_AGENCY" id="OFFICE_AGENCY"></select>

        </div>
        <div>
            <label for="LETTER_DATE">Date Received:</label> <br>
            <input type="date" name="LETTER_DATE" id="LETTER_DATE">
        </div>
        <div>
            <label for="SUBJECT">Date Received:</label> <br>
            <input type="text" name="SUBJECT" id="SUBJECT">
        </div>
        <input type="submit" value="Submit">
    </form>
</body>

</html>