<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid;
    }

    table {
        border-collapse: collapse;
    }

    table tr {
        margin: 0;
        padding: 0;
    }

    tr:hover {
        background-color: coral;
    }
</style>

<body>

    <div>
        <input type="text" name="searchBar" id="searchBar">
        <label for="RADIO_RECEIVE">Receive
            <input type="radio" name="ACTION_TYPE" id="RADIO_RECEIVE" value="receive" checked>
        </label>
        <label for="RADIO_SEND">Send
            <input type="radio" name="ACTION_TYPE" id="RADIO_SEND" value="send">
        </label>
    </div>

    <table id="DOC_VIEW_BASIC" name="DOC_VIEW_BASIC">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <form action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
        <div>
            <label for="SEND_DOC_NUM">Document Number:</label>
            <input type="text" name="DOC_NUM" id="SEND_DOC_NUM" readonly>
        </div>
        <div>
            <label for="SEND_DATE_TIME_RECEIVED">Date Received:</label>
            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="SEND_DATE_TIME_RECEIVED">
        </div>
        <div>
            <label for="SEND_DOC_PRPS">Documnet Purpose:</label>
            <select name="PRPS_ID" id="SEND_DOC_PRPS">
                <option value="" disabled selected>Please Select Purpose</option>
                <!-- to be filled using database -->
            </select>
        </div>
        <div>
            <label for="SEND_R_DEPT_ID">Department:</label>
            <select name="R_DEPT_ID" id="SEND_R_DEPT_ID">
                <option value="" disabled selected>Please Select Department</option>
                <!-- to be filled using database -->
            </select>
        </div>
        <div>
            <label for="SEND_DOC_ADDRESSEE">Addressee:</label>
            <select name="R_USER_ID" id="SEND_DOC_ADDRESSEE">
                <option value="" disabled selected>Please Select Addressee</option>
                <!-- to be filled using database -->
            </select>
        </div>

        <div>
            <label for="SEND_DOC_NOTES">Notes:</label>
            <input type="text" name="DOC_NOTES" id="SEND_DOC_NOTES">
        </div>

        <input type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1" readonly>
        <input type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="" readonly>
        <input type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="" readonly>

        <input type="submit" value="Send">
    </form>

</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>