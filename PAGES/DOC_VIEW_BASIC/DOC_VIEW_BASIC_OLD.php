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

    <form action="submit" name="FORM_DOC_RECEIVE" id="FORM_DOC_RECEIVE">

        <h1>RECEIVE MODAL</h1>

        <div>
            <label for="RECEIVE_DATE_TIME_RECEIVED">Date Recevied:</label>
            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="RECEIVE_DATE_TIME_RECEIVED">
        </div>

        <input readonly type="text" name="ID" id="RECEIVE_DOC_ID">
        <input readonly type="text" name="ACTION_ID" id="RECEIVE_DOC_ACTION" value="2">
        <input readonly type="text" name="R_USER_ID" id="RECEIVE_R_USER_ID">
        <input readonly type="text" name="DOC_NUM" id="RECEIVE_DOC_NUM">
        <input readonly type="text" name="R_DEPT_ID" id="RECEIVE_R_DEPT_ID">
        <input readonly type="text" name="ROUTE_NUM" id="RECEIVE_ROUTE_NUM">

        <input type="submit" value="Receive">

    </form>

    <form action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
        <h1>SEND FORM</h1>
        <div>
            <label for="SEND_DOC_NUM">Document Number:</label>
            <input type="text" name="DOC_NUM" id="SEND_DOC_NUM" readonly>
        </div>
        <div>
            <label for="SEND_ROUTE_NUM">Document Number:</label>
            <input type="text" name="ROUTE_NUM" id="SEND_ROUTE_NUM" readonly>
        </div>
        <div>
            <label for="SEND_DATE_TIME_SEND">Date Sent:</label>
            <input type="datetime-local" name="DATE_TIME_SEND" id="SEND_DATE_TIME_SEND">
        </div>
        <div>
            <label for="SEND_DOC_PRPS">Document Purpose:</label>
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

        <input readonly type="text" name="ID" id="SEND_DOC_ID">
        <input readonly type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1">
        <input readonly type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="">
        <input readonly type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="">

        <input type="submit" value="Send">
    </form>

    <form action="submit" name="FORM_DOC_CANCEL_R" id="FORM_DOC_CANCEL_R">
        <h1>CANCELATION FORM for Receive</h1>

        <label for="CANCEL_R_NOTES">Notes:</label>
        <textarea name="CANCEL_R_NOTES" id="CANCEL_R_NOTES" cols="30" rows="3"></textarea>

        <label for="CANCEL_R_DEPT">
            <input type="checkbox" name="CANCEL_R_DEPT" id="CANCEL_R_DEPT">
            Check if the document was sent to the department
        </label>

        <input type="submit" value="CANCEL">
        <input type="text" name="CANCEL_R_ID" id="CANCEL_R_ID">
    </form>

    <form action="submit" name="FORM_DOC_CANCEL_S" id="FORM_DOC_CANCEL_S">
        <h1>CANCELATION FORM for send</h1>

        <label for="CANCEL_S_NOTES">Notes:</label>
        <textarea name="CANCEL_S_NOTES" id="CANCEL_S_NOTES" cols="30" rows="3"></textarea>

        <input type="submit" value="CANCEL">
        <input type="text" name="CANCEL_S_ID" id="CANCEL_S_ID">
    </form>

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
                <input type="file" name="ATTACH_FILE" id="ATTACH_FILE">
                <input type="submit" value="Submit">
                <input type="text" name="DOC_NUM" id="ATTACH_DOC_NUM">
                <input type="text" name="ROUTE_NUM" id="ATTACH_ROUTE_NUM">
            </form>

            <div>
                <!-- input preview -->
            </div>
        </div>

    </div>
</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>