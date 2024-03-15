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
    <link rel="stylesheet" href="../../CSS/DOC_VIEW.css">
    <link rel="stylesheet" href="../../CSS/Modal.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/Notifications.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>
<?php
include "../../SCRIPTS/checkPrivilage.php";
?>

<body>
    <?php include '../../DOTS_NAVBAR/DOTS_NAV.php'; ?>

    <div class="container">
        <h1>Document View</h1>
        <div class="main">

            <div class="grid">
                <div class="header">
                    <input type="text" class="search" name="searchBar" id="searchBar" placeholder="Search Document">
                    <div class="opt">
                        <button class="opt_btn crt" name="BTN_DOC_CREATE" id="BTN_DOC_CREATE">Create</button>
                    </div>
                </div>

                <div class="tbl_cont">
                    <table class="db_table" id="DOC_VIEW_MAIN" name="DOC_VIEW_MAIN">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal" id="crt_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="crt_close">&times;</span>
                        <h1>Create</h1>
                    </div>

                    <form class="form" action="submit" id="FORM_DOC_RECEIVE">
                        <div class="radio_btn">
                            <div class="btn1">
                                <label class="radio_cnt" for="ACTION_ID_3">CREATE
                                    <input type="radio" name=ACTION_ID value='3' id="ACTION_ID_3">
                                    <span class="r_btn one"></span></label>
                            </div>

                            <div class="btn2">
                                <label class="radio_cnt" for="ACTION_ID_2">RECEIVE
                                    <input type="radio" name=ACTION_ID value='2' id="ACTION_ID_2" checked>
                                    <span class="r_btn two"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form_content">
                            <div class="box content_one">
                                <div class="cnt1">
                                    <label for="CREATE_DOC_NUM">Document Number:</label>
                                    <input type="text" name="DOC_NUM" id="CREATE_DOC_NUM" disabled>
                                </div>
                                <div class="cnt2">
                                    <label for="CREATE_FULLNAME">Received By:</label>
                                    <input type="text" name="FULLNAME" id="CREATE_FULLNAME" disabled>
                                </div>
                            </div>

                            <div class=" box content_two">
                                <div class="cnt1">
                                    <label for="CREATE_DATE_TIME_RECEIVED">Date Received:</label>
                                    <input type="datetime-local" name="DATE_TIME_RECEIVED"
                                        id="CREATE_DATE_TIME_RECEIVED">
                                </div>
                                <div class="cnt2">
                                    <label for="CREATE_LETTER_DATE">Letter Date:</label>
                                    <input type="date" name="LETTER_DATE" id="CREATE_LETTER_DATE">
                                </div>
                            </div>

                            <div class="box content_three">
                                <div>
                                    <label for="CREATE_DOC_TYPE">Document Type:</label>
                                    <select name="DOC_TYPE_ID" id="CREATE_DOC_TYPE">
                                        <option value="" disabled selected> Select Type</option>
                                        <!-- to be filled using database -->
                                    </select>
                                </div>
                                <div>
                                    <label for="CREATE_DOC_OFFICE">Office/Agency</label>
                                    <select name="S_OFFICE_ID" id="CREATE_DOC_OFFICE">
                                        <option value="" disabled selected> Select Office</option>
                                        <!-- to be filled using database -->
                                    </select>
                                </div>
                                <div>
                                    <label for="CREATE_DOC_SUBJECT">Subject:</label>
                                    <textarea name="DOC_SUBJECT" id="CREATE_DOC_SUBJECT" cols="20" rows="5"></textarea>
                                </div>


                                <input type="text" name="DOC_STATUS" id="CREATE_DOC_STATUS" value="5" hidden>
                                <input type="text" name="R_USER_ID" id="CREATE_R_USER_ID" hidden>
                                <input type="text" name="R_DEPT_ID" id="CREATE_R_DEPT_ID" hidden>
                            </div>
                        </div>

                        <div class="submit">
                            <input type="submit" value="Submit">
                        </div>

                    </form>
                </div>
            </div>

            <div class="modal" id="edt_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="edt_close">&times;</span>
                        <h1>Edit</h1>
                    </div>

                    <!-- <div>
                        <div>
                            <label for="EDIT_ACTION_ID_3">CREATE</label>
                            <input type="radio" name=ACTION_ID value='3' id="EDIT_ACTION_ID_3">
                            <label for="EDIT_ACTION_ID_2">RECEIVE</label>
                            <input type="radio" name=ACTION_ID value='2' id="EDIT_ACTION_ID_2" checked>
                        </div>
                    </div> -->

                    <form class="form" action="" id="FORM_DOC_EDIT">

                        <div>
                            <div>
                                <label for="EDIT_ACTION_ID_3">CREATE</label>
                                <input type="radio" name=ACTION_ID value='3' id="EDIT_ACTION_ID_3">
                                <label for="EDIT_ACTION_ID_2">RECEIVE</label>
                                <input type="radio" name=ACTION_ID value='2' id="EDIT_ACTION_ID_2" checked>
                            </div>
                        </div>

                        <div class="content_one">
                            <div class="head">
                                <label for="EDIT_DATE_TIME_RECEIVED">Date Received:</label>
                                <input type="datetime-local" name="DATE_TIME_RECEIVED" id="EDIT_DATE_TIME_RECEIVED">
                            </div>
                            <div class="head">
                                <label for="EDIT_LETTER_DATE">Letter Date:</label>
                                <input type="date" name="LETTER_DATE" id="EDIT_LETTER_DATE">
                            </div>
                        </div>

                        <div class="content_two">
                            <div class="body">
                                <label for="EDIT_DOC_TYPE">Document Type:</label>
                                <select name="DOC_TYPE_ID" id="EDIT_DOC_TYPE">
                                    <option value="" disabled selected> Select Type</option>
                                    <!-- to be filled using database -->
                                </select>
                            </div>
                            <div class="body">
                                <label for="EDIT_DOC_OFFICE">Office/Agency</label>
                                <select name="S_OFFICE_ID" id="EDIT_DOC_OFFICE">
                                    <option value="" disabled selected> Select Office</option>
                                    <!-- to be filled using database -->
                                </select>
                            </div>
                            <div class="body">
                                <label for="EDIT_DOC_SUBJECT">Subject:</label>
                                <textarea name="DOC_SUBJECT" id="EDIT_DOC_SUBJECT" cols="20" rows="5"></textarea>
                                <!-- <input type="text" name="DOC_SUBJECT" id="EDIT_DOC_SUBJECT"> -->
                            </div>
                        </div>

                        <div class="content_three">
                            <input type="submit" value="Submit">
                            <input type="text" name="ID" id="EDIT_DOC_ID" hidden>
                        </div>
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
                        <div class="form_content">
                            <div class="box content_one">
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
                            </div>

                            <div class="box content_two">
                                <div>
                                    <label for="SEND_DOC_PRPS">Document Purpose:</label>
                                    <select name="PRPS_ID" id="SEND_DOC_PRPS">
                                        <option value="" disabled selected>Select Purpose</option>
                                        <!-- to be filled using database -->
                                    </select>
                                </div>
                                <div>
                                    <label for="SEND_R_DEPT_ID">Department:</label>
                                    <select name="R_DEPT_ID" id="SEND_R_DEPT_ID">
                                        <option value="" disabled selected>Select Department</option>
                                        <!-- to be filled using database -->
                                    </select>
                                </div>
                                <div>
                                    <label for="SEND_DOC_ADDRESSEE">Addressee:</label>
                                    <select name="R_USER_ID" id="SEND_DOC_ADDRESSEE">
                                        <option value="" disabled selected>Select Addressee</option>
                                        <!-- to be filled using database -->
                                    </select>
                                </div>
                            </div>

                            <div class="box content_three">
                                <div>
                                    <label for="SEND_DOC_NOTES">Notes:</label>
                                    <textarea name="DOC_NOTES" id="SEND_DOC_NOTES" cols="20" rows="5"></textarea>
                                </div>
                            </div>

                            <input type="text" name="ACTION_ID" id="SEND_DOC_ACTION" value="1" readonly hidden>
                            <input type="text" name="S_DEPT_ID" id="SEND_S_DEPT_ID" value="" readonly hidden>
                            <input type="text" name="S_USER_ID" id="SEND_S_USER_ID" value="" readonly hidden>
                        </div>

                        <div class="submit">
                            <input type="submit" value="Send">
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal" id="atc_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="atc_close">&times;</span>
                        <h1>View Attachment</h1>
                    </div>

                    <div class="spacer">
                        <button type="button" class="atc_btn" id="BTN_ATTACH_ADD">Add Attachment</button>

                        <div class="attachments">
                            <div class="descript">
                                <div class="preview">
                                    <div id="ATTACH_RESULTS">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal" id="atc_submodal">
                            <div class="modal_content">
                                <div class="modal_banner">
                                    <span class="atc_sub_close">&times;</span>
                                    <h1>Attach</h1>
                                </div>

                                <div class="spacer">
                                    <form class="atc_submodal" action="submit" method="POST" id="FORM_ATTACH_ADD"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="desc">
                                                <label for="ATTACH_DESCRIPTION">Description:</label>
                                                <textarea name="DESCRIPTION" id="ATTACH_DESCRIPTION" cols="20"
                                                    rows="3"></textarea>
                                            </div>
                                            <!-- <input type="text" name="DESCRIPTION" id="ATTACH_DESCRIPTION"> -->
                                            <!-- <input type="file" name="ATTACH_FILE" id="ATTACH_FILE"> -->

                                            <div class="imgbox">
                                                <input type="file" name="ATTACH_FILE" id="ATTACH_FILE"
                                                    accept="application/pdf">
                                            </div>
                                        </div>

                                        <div class="submit">
                                            <input type="submit" value="Submit">
                                        </div>
                                        <input type="text" name="ID" id="ATTACH_ID" readonly>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- input preview -->
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

            <div class="modal" id="route_modal">
                <div class="modal_content">
                    <div class="modal_banner">
                        <span class="route_close">&times;</span>
                        <h1>Routing Slip</h1>
                    </div>

                    <?php include "../DOC_ROUTING/DOC_ROUTING.php"?>

                </div>
            </div>

        </div>
    </div>
    <?php
    include "../Notifications/Notifications.php";
    ?>
</body>

<script src="../../Modal/GenModal.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>
<script src="inspect.js"></script>

</html>