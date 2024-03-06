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

    tbody tr:hover {
        background-color: coral;
    }

    .ATTACH_MINI {
        display: inline-block;
        width: 50px;
        height: 50px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 1px black solid;
    }

    #ATTACH_ZOOM {
        width: 500px;
        height: 500px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        border: 1px black solid;
    }
</style>

<body>

    <div>
        <input type="text" name="searchBar" id="searchBar">
        <button name="BTN_DOC_CREATE" id="BTN_DOC_CREATE">CREATE</button>
    </div>

    <table id="DOC_VIEW_MAIN" name="DOC_VIEW_MAIN">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div>
        <h1>CREATE MODAL</h1>
        <form action="submit" id="FORM_DOC_RECEIVE">
            <div>

                <label for="ACTION_ID_3">CREATE</label>
                <input type="radio" name=ACTION_ID value='3' id="ACTION_ID_3">
                <label for="ACTION_ID_2">RECEIVE</label>
                <input type="radio" name=ACTION_ID value='2' id="ACTION_ID_2" checked>
            </div>
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
                <select name="DOC_TYPE_ID" id="CREATE_DOC_TYPE">
                    <option value="" disabled selected> Select Type</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="CREATE_DOC_OFFICE">Office/Agency</label> <br>
                <select name="S_OFFICE_ID" id="CREATE_DOC_OFFICE">
                    <option value="" disabled selected> Select Office</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="CREATE_DOC_SUBJECT">Subject:</label> <br>
                <input type="text" name="DOC_SUBJECT" id="CREATE_DOC_SUBJECT">
            </div>

            <input type="text" name="DOC_STATUS" id="CREATE_DOC_STATUS" value="5" >
            <input type="text" name="R_USER_ID" id="CREATE_R_USER_ID" >
            <input type="text" name="R_DEPT_ID" id="CREATE_R_DEPT_ID" >

            <input type="submit" value="Submit">

        </form>
    </div>

    <div>
        <h2>edit modal</h2>
        <form action="" id="FORM_DOC_EDIT">
            <div>
                <div>
                    <label for="EDIT_ACTION_ID_3">CREATE</label>
                    <input type="radio" name=ACTION_ID value='3' id="EDIT_ACTION_ID_3">
                    <label for="EDIT_ACTION_ID_2">RECEIVE</label>
                    <input type="radio" name=ACTION_ID value='2' id="EDIT_ACTION_ID_2" checked>
                </div>
            </div>

            <div>
                <label for="EDIT_DATE_TIME_RECEIVED">Date Received:</label> <br>
                <input type="datetime-local" name="DATE_TIME_RECEIVED" id="EDIT_DATE_TIME_RECEIVED">
            </div>
            <div>
                <label for="EDIT_LETTER_DATE">Letter Date:</label> <br>
                <input type="date" name="LETTER_DATE" id="EDIT_LETTER_DATE">
            </div>
            <div>
                <label for="EDIT_DOC_TYPE">Document Type:</label> <br>
                <select name="DOC_TYPE_ID" id="EDIT_DOC_TYPE">
                    <option value="" disabled selected> Select Type</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="EDIT_DOC_OFFICE">Office/Agency</label> <br>
                <select name="S_OFFICE_ID" id="EDIT_DOC_OFFICE">
                    <option value="" disabled selected> Select Office</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="EDIT_DOC_SUBJECT">Subject:</label> <br>
                <input type="text" name="DOC_SUBJECT" id="EDIT_DOC_SUBJECT">
            </div>

            <input type="text" name="DOC_STATUS" id="EDIT_DOC_STATUS" value="5" >

            <input type="submit" value="Submit">
            <input type="text" name="ID" id="EDIT_DOC_ID">
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
                <label for="SEND_ROUTE_NUM">Routing Number:</label>
                <input type="text" name="ROUTE_NUM" id="SEND_ROUTE_NUM" readonly>
            </div>
            <div>
                <label for="SEND_DATE_TIME_SENT">Date Sent:</label>
                <input type="datetime-local" name="DATE_TIME_SEND" id="SEND_DATE_TIME_SENT">
            </div>
            <div>
                <label for="SEND_DOC_PRPS">Documnet Purpose:</label>
                <select name="PRPS_ID" id="SEND_DOC_PRPS">
                    <option value="" disabled selected> Select Purpose</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="SEND_R_DEPT_ID">Department:</label>
                <select name="R_DEPT_ID" id="SEND_R_DEPT_ID">
                    <option value="" disabled selected> Select Department</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="SEND_DOC_ADDRESSEE">Addressee:</label>
                <select name="R_USER_ID" id="SEND_DOC_ADDRESSEE">
                    <option value="" disabled selected> Select Addressee</option>
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
    </div>

    <div>
        <h2>ATTACHMENT MODAL</h2>
        <button id="BTN_ATTACH_ADD">Add Attachment</button>
        <!-- <table id="ATTACH_VIEW_MAIN">
            <th>
            </th>
            <tbody>
            </tbody>
        </table> -->
        <div id="ATTACH_RESULTS">

        </div>
        <div id="ATTACH_ZOOM">
            <!-- preview -->
        </div>
        <div>
            <h1>ADD ATTACHMENT MODAL</h1>
            <form action="submit" method="POST" id="FORM_ATTACH_ADD" enctype="multipart/form-data">
                <label for="ATTACH_DESCRIPTION">Description:</label>
                <input type="text" name="DESCRIPTION" id="ATTACH_DESCRIPTION">
                <input type="file" name="ATTACH_FILE[]" id="ATTACH_FILE" multiple>
                <input type="submit" value="Submit">
                <input type="text" name="DOC_NUM" id="ATTACH_DOC_NUM">
                <input type="text" name="ROUTE_NUM" id="ATTACH_ROUTE_NUM">
            </form>

            <div>
                <!-- input preview -->
            </div>
        </div>

    </div>

    <script src="../../SCRIPTS/Constants.js"></script>
    <script src="./script.js" type="module"></script>

</body>

</html>