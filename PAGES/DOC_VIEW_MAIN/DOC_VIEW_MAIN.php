<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <button name="DOC_EDIT" id="DOC_EDIT">EDIT</button>
        <button name="DOC_TRACK" id="DOC_TRACK">TRACK</button>
        <button name="DOC_ATTACHMENTS" id="DOC_ATTACHMENTS">ATTACHMENTS</button>
        <button name="DOC_DELETE" id="DOC_DELETE">DELETE</button>
    </div>

    <form action="submit" name="FORM_DOC_SEND" id="FORM_DOC_SEND">
        <div>
            <label for="DOC_NUMBER">Document Number:</label>
            <input type="text" name="DOC_NUMBER" id="DOC_NUMBER" disabled>
        </div>
        <div>
            <label for="DOC_PRPS">Documnet Purpose:</label>
            <select name="DOC_PRPS" id="DOC_PRPS">

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
                <!-- to be filled using database -->
            </select>
        </div>
        <div>
            <label for="DOC_NOTES">Notes:</label>
            <input type="text" name="DOC_NOTES" id="DOC_NOTES">
        </div>

        <hidden style="display:block">
            <input type="text" value = "Sending">
        </hidden>
        <input type="submit" value="Send">
    </form>
</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>