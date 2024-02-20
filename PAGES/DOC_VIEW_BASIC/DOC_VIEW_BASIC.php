<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/DOC_VIEW_BASIC.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>
<body>

    <?php include "../../DOTS_NAVBAR/DOTS_NAV.php"?>

    <div class="container">
        <h1>Document View</h1>

        <div class="main">

            <div class="grid">

                <div class="header">
                    <div class="radio_btn">
                        <div class="btn1">
                            <label class="radio_cnt" for="RADIO_RECEIVE">Receive
                                <input type="radio" name="ACTION_TYPE" id="RADIO_RECEIVE" value="receive" checked>
                                <span class="r_btn one"></span>
                            </label>
                        </div>
                        <div class="btn2">
                            <label class="radio_cnt" for="RADIO_SEND">Send
                                <input type="radio" name="ACTION_TYPE" id="RADIO_SEND" value="send">
                                <span class="r_btn two"></span>
                            </label>
                        </div>
                    </div>
                    <input type="text" name="searchBar" id="searchBar" placeholder="Search Document">
                </div>

                <div class="tbl_content">
                    <table class="db_table" id="DOC_VIEW_BASIC" name="DOC_VIEW_BASIC">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="tbl_btn">
                    <button type="button" id="R_BTN">Receive</button>
                    <button type="button" id="S_BTN">SEND</button>
                </div>

                <form class="tbl_form" action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
                    <div class="form_head">
                        <div>
                            <label for="SEND_DOC_NUM">Document Number:</label>
                            <input type="text" name="DOC_NUM" id="SEND_DOC_NUM" readonly>
                        </div>
                        <div>
                            <label for="SEND_DATE_TIME_RECEIVED">Date Received:</label>
                            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="SEND_DATE_TIME_RECEIVED">
                        </div>
                    </div>
                    <div class="form_body">
                        <div class="form_opt">
                            <label for="SEND_DOC_PRPS">Document Purpose:</label>
                            <select name="PRPS_ID" id="SEND_DOC_PRPS">
                                <option value="" disabled selected>Please Select Purpose</option>
                                <!-- to be filled using database -->
                            </select>
                        </div>
                        <div class="form_opt">
                            <label for="SEND_R_DEPT_ID">Department:</label>
                            <select name="R_DEPT_ID" id="SEND_R_DEPT_ID">
                                <option value="" disabled selected>Please Select Department</option>
                                <!-- to be filled using database -->
                            </select>
                        </div>
                        <div class="form_opt">
                            <label for="SEND_DOC_ADDRESSEE">Addressee:</label>
                            <select name="R_USER_ID" id="SEND_DOC_ADDRESSEE">
                                <option value="" disabled selected>Please Select Addressee</option>
                                <!-- to be filled using database -->
                            </select>
                        </div>
                        <div class="form_opt">
                            <label for="SEND_DOC_NOTES">Notes:</label>
                            <textarea name="DOC_NOTES" id="SEND_DOC_NOTES" cols="20" rows="5"></textarea>
                            <!-- <input type="text" name="DOC_NOTES" id="SEND_DOC_NOTES"> -->
                        </div>
                    </div>

                    <div class="form_footer">
                        <input type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1" readonly hidden>
                        <input type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="" readonly hidden>
                        <input type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="" readonly hidden>
                    </div>

                    <div class="form_sub">
                        <input type="submit" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

<!-- <script>
    var form_head = document.getElementsByClassName("form_head");
    var form_body = document.getElementsByClassName("form_body");
    var form_footer = document.getElementsByClassName("form_footer");

    var open_btn = document.getElementById("RADIO_SEND");

    open_btn.add
</script> -->

</html>