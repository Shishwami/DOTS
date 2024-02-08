<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <link rel="stylesheet" href="DOC_VIEW_CREATED.css">
    <title></title>
</head>

<body>
    <input type="text" name="searchBar" id="searchBar">
    <table id="DOC_VIEW_MAIN" name="DOC_VIEW_MAIN">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div>
        <button name="DOC_SEND" id="DOC_SEND">SEND</button>
        <button name="DOC_ATTACHMENTS" id="DOC_ATTACHMENTS">ATTACHMENTS</button>
    </div>

    <div>
        <h1>SEND MODAL</h1>
        <form action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
            <div>
                <label for="DOC_NUM">Document Number:</label>
                <input type="text" name="DOC_NUM" id="DOC_NUM" readonly>
            </div>
            <div>
                <label for="DOC_PRPS">Documnet Purpose:</label>
                <select name="DOC_PRPS" id="DOC_PRPS">
                    <option value="" disabled selected>Please Select Purpose</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="DOC_DIVISION">Division:</label>
                <select name="DOC_DIVISION" id="DOC_DIVISION">
                    <option value="" disabled selected>Please Select Division</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="DOC_ADDRESSEE">Addressee:</label>
                <select name="DOC_ADDRESSEE" id="DOC_ADDRESSEE">
                    <option value="" disabled selected>Please Select Addressee</option>
                    <!-- to be filled using database -->
                </select>
            </div>
            <div>
                <label for="DOC_NOTES">Notes:</label>
                <input type="text" name="DOC_NOTES" id="DOC_NOTES">
            </div>

            <hidden style="display:block">
                <input type="text" name="DOC_ACTION" id="DOC_ACTION" value="3">
                <input type="text" name="DOC_LOCATION" id="DOC_LOCATION" value="">
            </hidden>
            <input type="submit" value="Send">
        </form>
    </div>

    <div>
        <h2>ATTACHMENTS MODAL</h2>
    </div>
</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>