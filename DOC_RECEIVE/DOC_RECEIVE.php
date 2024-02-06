<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Modal/Modal.css">
    <link rel="stylesheet" href="../Dropdown Function/Dropdown.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <link rel="stylesheet" href="DOC_RECEIVE.css">
    <title></title>
</head>

<body>
    <?php include '../DOTS_NAVBAR/DOTS_NAV.php';?>


    <div class="container" id="main">
        <h1>Receive</h1>

        <div class="main">

            <form class="page_form" action="submit" id="FORM_RECEIVE">
                <div class="header info1">
                    <div class="docnum">
                        <label for="DOC_NUM">Document Number:</label>
                        <input type="text" name="DOC_NUM" id="DOC_NUM" disabled>
                    </div>
                    <div class="receive">
                        <label for="FULLNAME">Received By:</label>
                        <input type="text" name="FULLNAME" id="FULLNAME" disabled>
                    </div>
                </div>
                    
                <div class="header info2">
                    <div>
                        <label for="DATE_TIME_RECEIVED">Date Received:</label>
                        <input type="datetime-local" name="DATE_TIME_RECEIVED" id="DATE_TIME_RECEIVED">
                    </div>
                    <div>
                        <label for="LETTER_DATE">Letter Date:</label>
                        <input type="date" name="LETTER_DATE" id="LETTER_DATE">
                    </div>
                </div>

                <div class="form_content">
                    <div class="content">
                        <label for="DOC_TYPE">Document Type:</label>
                        <select name="DOC_TYPE" id="DOC_TYPE">
                            <option value="" disabled selected>Please Select Type</option>
                        </select>
                    </div>
                    <div class="content">
                        <label for="DOC_OFFICE">Office/Agency</label>
                        <select name="DOC_OFFICE" id="DOC_OFFICE">
                            <option value="" disabled selected>Please Select Office</option>
                        </select>
                    </div>
                    <div class="content">
                        <label for="DOC_SUBJECT">Subject:</label>
                        <textarea name="DOC_SUBJECT" id="DOC_SUBJECT" cols="20" rows="5"></textarea>
                    </div>
                </div>

                <div class="submit">
                    <input type="submit" value="Submit">
                </div>

                <?php include "../Dropdown Function/Dropdown.php"; ?>

            </form>
            
        </div>
    </div>
</body>

<script src="../Dropdown Function/Dropdown.js"></script>
<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>