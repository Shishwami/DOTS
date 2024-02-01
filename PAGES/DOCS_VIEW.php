<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <label for="searchBar">Search:</label>
        <input type="text" name="searchBar" id="searchBar" placeholder="Search">
    </div>
    <table id="DOC_VIEW_TBL">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</body>
<script src="../SCRIPTS/Constants.js"></script>
<script type="module">

    import MyAjax from "../SCRIPTS/MyAjax.js";
    import JsFunctions from "../SCRIPTS/JsFunctions.js";

    const DOC_VIEW_TBL = document.getElementById("DOC_VIEW_TBL");

    getTable("");
    setInterval(function () {
        getTable("");
    }, _RESET_TIME);


    function getTable(filter) {
        filter = "";
        const tHead = DOC_VIEW_TBL.querySelector('thead');
        const tBody = DOC_VIEW_TBL.querySelector('tbody');

        const data = {
            TABLE_NAME: _TABLE.DOTS_DOC.NAME,
            REQUEST: _REQUEST.SELECT,
        }
        MyAjax.createJSON((error, response) => {
            if (!error) {
                if (response.VALID) {
                    const results = response.RESULT;
                    JsFunctions.updateTable(results, tHead, tBody, filter);
                } else {
                    //no data taken
                }
            } else {
                alert(error);
            }
        }, data);
    }

</script>

</html>