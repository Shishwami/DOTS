<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/DOC_VIEW.css">
    <link rel="stylesheet" href="../../CSS/Modal.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>
<body>
    <?php include '../../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="container">
        <h1>Document View</h1>
        <div class="main">

            <div class="grid">
                <div class="header">
                    <input type="text"  class="search" name="searchBar" id="searchBar" placeholder="Search Document">
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
                                    <input type="datetime-local" name="DATE_TIME_RECEIVED" id="CREATE_DATE_TIME_RECEIVED">
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
                        <h1>Attach</h1>
                    </div>

                    <button id="BTN_ATTACH_ADD">Add Attachment</button>

                    <div id="ATTACH_RESULTS">

                    </div>

                    <div id="ATTACH_ZOOM">
                        <!-- preview -->
                    </div>

                    <div class="atc_submodal" id="atc_submodal">
                        <form action="submit" method="POST" id="FORM_ATTACH_ADD" enctype="multipart/form-data">
                            <label for="ATTACH_DESCRIPTION">Description:</label>
                            <input type="text" name="DESCRIPTION" id="ATTACH_DESCRIPTION">
                            <input type="file" name="ATTACH_FILE" id="ATTACH_FILE">
                            <input type="submit" value="Submit">
                            <input type="text" name="DOC_NUM" id="ATTACH_DOC_NUM">
                            <input type="text" name="ROUTE_NUM" id="ATTACH_ROUTE_NUM">
                        </form>
                    </div>
                            
                    <div>
                        <!-- input preview -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <br>
</body>

<script src="../../Modal/GenModal.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>