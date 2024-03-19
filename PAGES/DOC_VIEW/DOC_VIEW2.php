<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset ($_SESSION['HRIS_ID'])) {
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
                        <div class="attachments">
                            <button type="button" class="atc_btn" id="BTN_ATTACH_ADD">Add Attachment</button>

                            <div class="atc_list">
                                <div id="ATTACH_RESULTS">

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
                        <h1 style='font-family:"Orbitron", sans-serif !important;'>Routing Slip</h1>
                    </div>

                    <div class="route_cont">

                        <?php include "../DOC_ROUTING/DOC_ROUTING.php"?>
                     
                        <input  type="button" value="Convert to PDF" onclick="convertHTMLtoPDF()">

                        <div class="pdf_cont">
                            <canvas id="divID">

                                <h1>Routing Slip / Action Slip</h1>

                                <div class="doc_details">
                                    <input type="text" class="routingnum" name="routingnum" id="routingnum">

                                    <div class="flex_cont">
                                        <label for="date_received">Date|Time Received: </label>
                                        <input type="text" name="date_received" id="date_received">
                                    </div>

                                    <div class="flex_cont">
                                        <label for="received_by">Received By: </label>
                                        <input type="text" name="received_by" id="received_by">
                                    </div>

                                    <div class="flex_cont">
                                        <label for="doc_type">Document Type: </label>
                                        <input type="text" name="doc_type" id="doc_type">
                                    </div>

                                    <div class="flex_cont">
                                        <label for="office">Office/Agency: </label>
                                        <input type="text" name="office" id="office">
                                    </div>

                                    <div class="flex_cont">
                                        <label for="letter_date">Letter Date: </label>
                                        <input type="text" name="letter_date" id="letter_date">
                                    </div>

                                    <div class="flex_cont">
                                        <label for="subject">Subject: </label>
                                        <textarea name="subject" id="subject" cols="45" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="doc_data">
                                    <div class="banner"><span>DOC DATA</span></div>

                                    <div class="flex_box">
                                        <label for="initial">Initial: </label>
                                        <input type="text" name="initial" id="" value="APL III" readonly>
                                        <label class="ini_date" for="ini_date">Date | Time: </label>
                                        <input type="text" name="ini_date" id="">
                                    </div>

                                    <div class="flex_box">
                                        <label for="initial">Initial: </label>
                                        <input type="text" name="initial" id="" value="EBD" readonly>
                                        <label class="ini_date" for="ini_date">Date | Time: </label>
                                        <input type="text" name="ini_date" id="">
                                    </div>

                                    <div class="division_box">
                                        <label for="div_all"><input type="checkbox" name="div_all" id=""
                                                disabled>ALL</label>
                                        <label for="div_ard"><input type="checkbox" name="div_ard" id=""
                                                disabled>ARD</label>
                                        <label for="div_lnd"><input type="checkbox" name="div_lnd" id=""
                                                disabled>L&D</label>
                                        <label for="div_piad"><input type="checkbox" name="div_piad" id=""
                                                disabled>PIAD</label>
                                        <label for="div_admin"><input type="checkbox" name="div_admin" id=""
                                                disabled>ADMIN</label>
                                        <label for="div_psych"><input type="checkbox" name="div_psych" id=""
                                                disabled>PSYCH</label>
                                    </div>

                                    <h3>For: </h3>
                                    <div class="doc_purp" id="doc_purp">

                                    </div>

                                    <div class="doc_purp_notes">
                                        <label for="notes">
                                            <h3>Notes: </h3>
                                        </label>
                                        <textarea name="notes" id="" cols="50" rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="doc_hr">
                                    <div class="banner">For HR Divisions</div>

                                    <label for="comply">Complied By: </label>
                                    <textarea name="comply" id="" cols="20" rows="1"></textarea>

                                    <label for="dt_rec">Date|Time Received: </label>
                                    <textarea name="dt_rec" id="" cols="20" rows="1"></textarea>

                                    <label for="notes">Notes: </label>
                                    <textarea name="notes" id="" cols="20" rows="1"></textarea>
                                </div>

                                <div class="doc_dept">
                                    <div class="banner">For Mayor's Office & Other Departments</div>

                                    <label for="to">To: </label>
                                    <textarea name="to" id="" cols="30" rows="1"></textarea>

                                    <label for="position">Position: </label>
                                    <textarea name="position" id="" cols="30" rows="1"></textarea>

                                    <label for="office">Office: </label>
                                    <textarea name="office" id="" cols="30" rows="1"></textarea>

                                    <label for="dt_rec">Date|Time Received: </label>
                                    <textarea name="dt_rec" id="" cols="30" rows="1"></textarea>

                                    <label for="rec_by">Received By: </label>
                                    <textarea name="rec_by" id="" cols="30" rows="1"></textarea>

                                    <h4>For:</h4>
                                    <label for="for_rev"><input type="checkbox" name="for_rev" id="">Review</label>
                                    <label for="for_comm"><input type="checkbox" name="for_comm"
                                            id="">Comment/Observation</label>
                                    <label for="for_sign"><input type="checkbox" name="for_sign"
                                            id="">Initial/Signature</label>
                                    <label for="for_approv"><input type="checkbox" name="for_approv"
                                            id="">Approval</label>
                                    <label for="for_urge"><input type="checkbox" name="for_urge" id="">URGENT
                                        ACTION</label>
                                    <label for="for_impl"><input type="checkbox" name="for_impl"
                                            id="">Implementation</label>
                                    <label for="for_info"><input type="checkbox" name="for_info" id="">Info &
                                        Guidance</label>

                                    <h3>Remarks: </h3>
                                </div>

                                <div class="doc_route">
                                    <div class="banner">For Further Routing</div>

                                    <table>
                                        <thead>
                                            <tr>
                                                <th>TO/FOR</th>
                                                <th>ADDRESSEE</th>
                                                <th>DATE</th>
                                                <th>INITIAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>some</td>
                                                <td>jaja</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <h3>Remarks: </h3>
                                </div>

                                <div class="doc_retslip">
                                    <div class="banner">Return Slip</div>

                                    <label for="dt_rec">Date|Time Received: </label>
                                    <textarea name="dt_rec" id="" cols="30" rows="1"></textarea>

                                    <label for="received">Received By: </label>
                                    <textarea name="received" id="" cols="30" rows="1"></textarea>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

        </div>
    </div>
    <?php
    include "../Notifications/Notifications.php";
    ?>
</body>

<script>
    // function convertHTMLtoPDF() {
    //     const { jsPDF } = window.jspdf;

    //     // Create a new jsPDF object with A4 dimensions (210mm x 297mm)
    //     const doc = new jsPDF('p', 'pt', 'a4');

    //     // Select the HTML element containing the content you want to convert
    //     const pdfjs = document.querySelector('#divID');

        // Convert the HTML content to PDF
        doc.html(pdfjs, {
            callback: function (doc) {
                // Save the PDF with the specified filename
                doc.save("newpdf.pdf");
            },
            margin: 5, // Optional: Set page margin
            onePage: true, // Generate a single-page PDF
            // scale: 0.8 // Adjust the scale (0.8 reduces the content size)
        });
    }
</script>

<script src="../../Modal/GenModal.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>
<script src="inspect.js"></script>

</html>