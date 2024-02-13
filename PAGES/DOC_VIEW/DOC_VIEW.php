<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DOC_VIEW.css">
    <link rel="stylesheet" href="../../Modal/Modal.css">
    <link rel="stylesheet" href="../../DOTS_NAVBAR/DOTS_NAV.css">
    <title></title>
</head>
<body>
     <?php include '../../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="container">
        <h1>Document View</h1>
        <div class="main">

            <div class="grid">
                <input type="text" name="searchBar" class="search" id="searchBar" placeholder="Search Document">

                <div class="tbl_cont">
                    <table class="db_table" id="DOC_VIEW_MAIN" name="DOC_VIEW_MAIN">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="opt">
                    <button class="opt_btn" id="crt" name="BTN_DOC_CREATE" id="BTN_DOC_CREATE">Create</button>
                    <button class="opt_btn" id="snd" name="BTN_DOC_SEND" id="BTN_DOC_SEND">Send</button>
                    <button class="opt_btn" id="atc" name="BTN_DOC_ATTACHMENTS" id="BTN_DOC_ATTACHMENTS">Attachment</button>
                </div>
            </div>

            <div class="modal" id="crt_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="crt_close">&times;</span>
                        <h1>Create</h1>
                    </div>

                    <form class="form" action="submit" id="FORM_DOC_RECEIVE">
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

                        <input type="text" name="DOC_STATUS" id="CREATE_DOC_STATUS" value="1" hidden>
                        <input type="text" name="R_USER_ID" id="CREATE_R_USER_ID" hidden>
                        <input type="text" name="R_DEPT_ID" id="CREATE_R_DEPT_ID" hidden>

                        <input type="submit" value="Submit">

                    </form>
                </div>
            </div>


            <div class="modal" id="snd_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="snd_close">&times;</span>
                        <h1>Send</h1>
                    </div>

                    <form class="form" action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
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

                        <input type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="3">
                        <input type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="">

                        <input type="submit" value="Send">
                    </form>
                </div>
            </div>

            <div class="modal" id="atc_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="atc_close">&times;</span>
                        <h1>Attach</h1>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>

<script src="../../Modal/GenModal.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>