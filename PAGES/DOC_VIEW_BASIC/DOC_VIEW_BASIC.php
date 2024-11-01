<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['HRIS_ID'])) {
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/Modal.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/DOC_VIEW_BASIC.css">
    <link rel="stylesheet" href="../../CSS/Notifications.css">
    <!-- <link rel="stylesheet" href="../../CSS/test.css"> -->
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>
<?php
include "../../SCRIPTS/checkPrivilage.php";
?>

<body>

    <?php include "../../DOTS_NAVBAR/DOTS_NAV.php";
    ?>

    <div class="container">
        <h1>Document View</h1>

        <div class="main">

            <div class="grid">

                <div class="header">

                    <input type="text" name="searchBar" id="searchBar" placeholder="Search Document">
                    <select name="YEAR_FILTER" id="YEAR_FILTER"></select>

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
                </div>

                <div class="tbl_cont">
                    <table class="db_table" id="DOC_VIEW_BASIC" name="DOC_VIEW_BASIC">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <!-- <div class="tbl_btn">
                    <button type="button" id="R_BTN">Receive</button>
                    <button type="button" id="S_BTN">SEND</button>
                </div> -->

                <div class="modal" id="rec_modal">
                    <div class="modal_content">
                        <div class="modal_banner">
                            <span class="rec_close">&times;</span>
                            <h1>Receive</h1>
                        </div>

                        <form class="tbl_form" action="submit" name="FORM_DOC_RECEIVE" id="FORM_DOC_RECEIVE">
                            <div class="form_head">
                                <div>
                                    <label for="RECEIVE_DATE_TIME_RECEIVED">Date Received:</label>
                                    <input type="datetime-local" name="DATE_TIME_RECEIVED"
                                        id="RECEIVE_DATE_TIME_RECEIVED">
                                </div>
                            </div>

                            <div class="form_body">
                                <!-- <input type="text" name="ID" id="RECEIVE_DOC_ID" hidden>
                                <input type="text" name="ACTION_ID" id="RECEIVE_DOC_ACTION" value="2" hidden>
                                <input type="text" name="R_USER_ID" id="RECEIVE_R_USER_ID" hidden> -->

                                <input hidden readonly type="text" name="ID" id="RECEIVE_DOC_ID">
                                <input hidden readonly type="text" name="ACTION_ID" id="RECEIVE_DOC_ACTION" value="2">
                                <input hidden readonly type="text" name="R_USER_ID" id="RECEIVE_R_USER_ID">
                                <input hidden readonly type="text" name="DOC_NUM" id="RECEIVE_DOC_NUM">
                                <input hidden readonly type="text" name="R_DEPT_ID" id="RECEIVE_R_DEPT_ID">
                                <input hidden readonly type="text" name="ROUTE_NUM" id="RECEIVE_ROUTE_NUM">
                            </div>

                            <div class="form_sub">
                                <input type="submit" value="Receive">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal" id="sent_modal">
                    <div class="modal_content">
                        <div class="modal_banner">
                            <span class="sent_close">&times;</span>
                            <h1>Send</h1>
                        </div>

                        <form class="tbl_form" action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
                            <div class="form_head">
                                <div class="head1">
                                    <label for="SEND_DOC_NUM">Document Number:</label>
                                    <input type="text" name="DOC_NUM" id="SEND_DOC_NUM" readonly>
                                </div>
                                <div class="head2">
                                    <label for="SEND_ROUTE_NUM">Document Number:</label>
                                    <input type="text" name="ROUTE_NUM" id="SEND_ROUTE_NUM" readonly>
                                </div>
                                <div class="head3">
                                    <label for="SEND_DATE_TIME_SEND">Date Sent:</label>
                                    <input type="datetime-local" name="DATE_TIME_SEND" id="SEND_DATE_TIME_SEND">
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
                            </div>

                            <div class="form_notes">
                                <label for="SEND_DOC_NOTES">Notes:</label>
                                <textarea name="DOC_NOTES" id="SEND_DOC_NOTES" cols="30" rows="5"></textarea>
                                <!-- <input type="text" name="DOC_NOTES" id="SEND_DOC_NOTES"> -->
                            </div>

                            <div class="form_footer">
                                <!-- <input type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1" readonly hidden>
                            <input type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="" readonly hidden>
                            <input type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="" readonly hidden> -->

                                <input hidden readonly type="text" name="ID" id="SEND_DOC_ID">
                                <input hidden readonly type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1">
                                <input hidden readonly type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="">
                                <input hidden readonly type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="">
                            </div>

                            <div class="form_sub">
                                <input type="submit" value="Send">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal" id="r_cnl_modal">
                    <div class="modal_content">
                        <div class="modal_banner">
                            <span class="r_cnl_close">&times;</span>
                            <h1>Cancellation Form</h1>
                        </div>

                        <form class="form" action="submit" name="FORM_DOC_CANCEL_R" id="FORM_DOC_CANCEL_R">

                            <div class="content_one">
                                <label for="CANCEL_R_NOTES">Notes:</label>
                                <textarea name="CANCEL_R_NOTES" id="CANCEL_R_NOTES" cols="20" rows="5"></textarea>
                            </div>

                            <div class="content_two">
                                <label for="CANCEL_R_DEPT">
                                    <input type="checkbox" name="CANCEL_R_DEPT" id="CANCEL_R_DEPT">
                                    Check if the document was sent to the department
                                </label>
                            </div>

                            <div class="content_three">
                                <input type="submit" value="CANCEL">
                                <input hidden type="text" name="CANCEL_R_ID" id="CANCEL_R_ID">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal" id="s_cnl_modal">
                    <div class="modal_content">
                        <div class="modal_banner">
                            <span class="s_cnl_close">&times;</span>
                            <h1>Cancellation Form</h1>
                        </div>

                        <form class="form" action="submit" name="FORM_DOC_CANCEL_S" id="FORM_DOC_CANCEL_S">

                            <div class="content_one">
                                <label for="CANCEL_S_NOTES">Notes:</label>
                                <textarea name="CANCEL_S_NOTES" id="CANCEL_S_NOTES" cols="20" rows="5"></textarea>
                            </div>

                            <div class="content_two">
                                <div>
                                    <input type="submit" value="CANCEL">
                                </div>
                                <input hidden type="text" name="CANCEL_S_ID" id="CANCEL_S_ID">
                            </div>
                        </form>
                    </div>
                </div>

                            <!-- <h1>ADD ATTACHMENT MODAL</h1>
                                <form action="submit" method="POST" id="FORM_ATTACH_ADD" enctype="multipart/form-data">
                                    <label for="ATTACH_DESCRIPTION">Description:</label>
                                    <input type="text" name="DESCRIPTION" id="ATTACH_DESCRIPTION">
                                    <input type="file" name="ATTACH_FILE" id="ATTACH_FILE">
                                    <input type="submit" value="Submit">
                                    <input type="text" name="DOC_NUM" id="ATTACH_DOC_NUM">
                                    <input type="text" name="ROUTE_NUM" id="ATTACH_ROUTE_NUM">
                                </form> -->

                            <div>
                                <!-- input preview -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal" id="track_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="track_close">&times;</span>
                        <h1>Document Tracking</h1>
                    </div>

                    <div class="form">
                        <div class="track">
                            <table class="track_table" id="DOC_VIEW_TRACKING">
                                <thead>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <?php
    include "../Notifications/Notifications.php";
    ?>
</body>

<script src="../../Modal/Vbasic.js"></script>
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