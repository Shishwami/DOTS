import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";


setTable("");
searchBar.addEventListener('input', function (e) {
    setTable(searchBar.value.toUpperCase());
});

setInterval(function () {
    setTable(searchBar.value.toUpperCase());
}, _RESET_TIME);

function setTable(filter) {

    const joinCondition = " LEFT JOIN `" + DOTS_DOC_TYPE.NAME + "`.`";

    const columns = [
    ]

    var data = {
        TABLE_NAME: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        // COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            var results = ""
            if (response.VALID) {
                delete response.VALID;
                results = Object.values(response)[0];
            } else {
                //response valid=false
            }
            JsFunctions.updateTable(results, DOC_VIEW_OUTBOUND, filter);
        }
    }, data);
}