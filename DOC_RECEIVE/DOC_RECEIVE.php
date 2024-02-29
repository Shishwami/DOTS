<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Modal.css">
    <link rel="stylesheet" href="../CSS/Dropdown.css">
    <link rel="stylesheet" href="../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../CSS/DOC_RECEIVE.css">
    <title></title>
</head>

<body>
    <?php include '../DOTS_NAVBAR/DOTS_NAV.php';?>


    <div class="container" id="main">
        <h1>Receive</h1>

        <div class="main">

            <form class="page_form" action="submit" id="FORM_RECEIVE">
                <div class="box header">
                    <div class="header1">
                        <div class="subheader1">
                            <label for="DOC_NUM">Document Number:</label>
                            <input type="text" name="DOC_NUM" id="DOC_NUM" disabled>
                        </div>
                        <div class="subheader2">
                            <label for="FULLNAME">Received By:</label>
                            <input type="text" name="FULLNAME" id="FULLNAME" disabled>
                        </div>
                    </div>
                        
                    <div class="header2">
                        <div class="subheader3">
                            <label for="DATE_TIME_RECEIVED">Date Received:</label>
                            <input type="datetime-local" name="DATE_TIME_RECEIVED" id="DATE_TIME_RECEIVED">
                        </div>
                        <div class="subheader4">
                            <label for="LETTER_DATE">Letter Date:</label>
                            <input type="date" name="LETTER_DATE" id="LETTER_DATE">
                        </div>
                    </div>
                </div>

                <div class="box form_content">
                    <div class="content1">
                        <label for="DOC_TYPE">Document Type:</label>
                        <?php include "../Dropdown Function/Dropdown.php"; ?>
                        <!-- <select name="DOC_TYPE" id="DOC_TYPE">
                            <option value="" disabled selected>Please Select Type</option>
                        </select> -->
                    </div>
                    <div class="content2">
                        <label for="DOC_OFFICE">Office/Agency</label>
                        <?php include "../Dropdown Function/Dropdown.php"; ?>
                        <!-- <select name="DOC_OFFICE" id="DOC_OFFICE">
                            <option value="" disabled selected>Please Select Office</option>
                        </select> -->
                    </div>
                    <div class="content3">
                        <label for="DOC_SUBJECT">Subject:</label>
                        <textarea name="DOC_SUBJECT" id="DOC_SUBJECT" cols="20" rows="5"></textarea>
                    </div>
                </div>

                <div class="box footer">
                    <input class="submit" type="submit" value="Submit">
                </div>

                

            </form>
            
        </div>
    </div>

</body>

<script src="../Dropdown Function/Dropdown.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>