<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <input type="text" name="searchBar" id="searchBar">

    <table id="DOC_VIEW_MAIN" name="DOC_VIEW_MAIN">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div>
        <button name="BTN_DOC_CREATE" id="BTN_DOC_CREATE">CREATE</button>
        <button name="BTN_DOC_SEND" id="BTN_DOC_SEND">SEND</button>
        <button name="BTN_DOC_ATTACHMENTS" id="BTN_DOC_ATTACHMENTS">ATTACHMENTS</button>
    </div>
    <div>
        <h1>CREATE MODAL</h1>
        <form action="submit" id="FORM_DOC_RECEIVE">
            <div>
                <label for="CREATE_DOC_NUM">Document Number:</label> <br>
                <input type="text" name="DOC_NUM" id="CREATE_DOC_NUM" disabled>
            </div>
            <div>
                <label for="CREATE_FULLNAME">Received By:</label> <br>
                <input type="text" name="FULLNAME" id="CREATE_FULLNAME" disabled>
            </div>
            <div>
                <label for="CREATE_DATE_TIME_RECEIVED">Date Received:</label> <br>
                <input type="datetime-local" name="DATE_TIME_RECEIVED" id="CREATE_DATE_TIME_RECEIVED">
            </div>
            <div>
                <label for="CREATE_LETTER_DATE">Letter Date:</label> <br>
                <input type="date" name="LETTER_DATE" id="CREATE_LETTER_DATE">
            </div>
            <div>
                <label for="CREATE_DOC_TYPE">Document Type:</label> <br>
                <select name="DOC_TYPE" id="CREATE_DOC_TYPE">
                    <option value="" disabled selected>Please Select Type</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="CREATE_DOC_OFFICE">Office/Agency</label> <br>
                <select name="S_OFFICE_ID" id="CREATE_DOC_OFFICE">
                    <option value="" disabled selected>Please Select Office</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="CREATE_DOC_SUBJECT">Subject:</label> <br>
                <input type="text" name="DOC_SUBJECT" id="CREATE_DOC_SUBJECT">
            </div>

            <input type="text" name="DOC_STATUS" id="CREATE_DOC_STATUS" value="0">

            <input type="submit" value="Submit">

        </form>
    </div>
    <div>
        <h1>SEND MODAL</h1>
        <form action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
            <div>
                <label for="SEND_DOC_NUM">Document Number:</label>
                <input type="text" name="DOC_NUM" id="SEND_DOC_NUM" readonly>
            </div>
            <div>
                <label for="SEND_DOC_PRPS">Documnet Purpose:</label>
                <select name="DOC_PRPS" id="SEND_DOC_PRPS">
                    <option value="" disabled selected>Please Select Purpose</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="SEND_DOC_DEPT">Department:</label>
                <select name="DOC_DIVISION" id="SEND_DOC_DEPT">
                    <option value="" disabled selected>Please Select Department</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="SEND_DOC_ADDRESSEE">Addressee:</label>
                <select name="DOC_ADDRESSEE" id="SEND_DOC_ADDRESSEE">
                    <option value="" disabled selected>Please Select Addressee</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="SEND_DOC_NOTES">Notes:</label>
                <input type="text" name="DOC_NOTES" id="SEND_DOC_NOTES">
            </div>

            <input type="text" name="DOC_ACTION" id="SEND_DOC_ACTION" value="3">
            <input type="text" name="DOC_LOCATION" id="SEND_DOC_LOCATION" value="">

            <input type="submit" value="Send">
        </form>
    </div>

    <div>
        <h2>ATTACHMENTS MODAL</h2>
    </div>
</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>