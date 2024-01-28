<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tbody>

        </tbody>
    </table>

    <form action="submit" id="DOC_TYPE_ADD">
        <div>
            <label for="DOC_TYPE_ADD_NAME">Document Type:</label>
            <br>
            <input type="text" name="DOC_TYPE_ADD_NAME" id="DOC_TYPE_ADD_NAME">
        </div>
        <div>
            <label for="DOC_TYPE_ADD_CODE">Document Code:</label>
            <br>
            <input type="text" name="DOC_TYPE_ADD_CODE" id="DOC_TYPE_ADD_CODE">
        </div>
        <input type="submit" value="Add">
    </form>

    <form action="submit" id="DOC_TYPE_EDIT">
        <div>
            <label for="DOC_TYPE_EDIT_NAME">Document Type:</label>
            <br>
            <input type="text" name="DOC_TYPE_EDIT_NAME" id="DOC_TYPE_EDIT_NAME">
        </div>
        <div>
            <label for="DOC_TYPE_EDIT_CODE">Document Code:</label>
            <br>
            <input type="text" name="DOC_TYPE_EDIT_CODE" id="DOC_TYPE_EDIT_CODE">
        </div>
        <input type="button" value="Delete">
        <input type="submit" value="Edit">
    </form>

</body>

</html>

<script type="module" src="../SCRIPTS/JsFunctions.js">

    import MyAjax from "./MyAjax.js";

    const DOC_TYPE_ADD = document.getElementById("DOC_TYPE_ADD");

    DOC_TYPE_ADD.addEventListener('submit', function (e) {
        const DOC_TYPE_NAME = DOC_TYPE_ADD.querySelector('#');
    });



</script>