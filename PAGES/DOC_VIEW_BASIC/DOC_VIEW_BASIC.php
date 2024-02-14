<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid;
    }

    table {
        border-collapse: collapse;
    }

    table tr {
        margin: 0;
        padding: 0;
    }

    tr:hover {
        background-color: coral;
    }
</style>

<body>

    <div>
        <input type="text" name="searchBar" id="searchBar">
        <label for="RADIO_RECEIVE">Receive</label>
        <input type="radio" name="ACTION_TYPE" id="RADIO_RECEIVE" value="receive" checked>
        <label for="RADIO_SEND">Send</label>
        <input type="radio" name="ACTION_TYPE" id="RADIO_SEND" value="send">
    </div>

    <table id="DOC_VIEW_BASIC" name="DOC_VIEW_BASIC">
        <thead>
            <tr></tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <button type="button" id="R_BTN">Receive</button>
    <button type="button" id="S_BTN">SEND</button>

</body>

<script src="../../SCRIPTS/Constants.js"></script>
<script src="./script.js" type="module"></script>

</html>