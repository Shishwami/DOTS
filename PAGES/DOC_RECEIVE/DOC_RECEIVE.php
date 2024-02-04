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

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>