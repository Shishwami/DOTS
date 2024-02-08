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


    var columns = [
       DOTS_OUTBOUND.DOC_NUM,
       DOTS_OUTBOUND.ID,
       DOTS_OUTBOUND.DOC_PRPS,
       DOTS_OUTBOUND.DOC_ADDRESSEE,
       DOTS_OUTBOUND.DOC_NOTES,
       DOTS_OUTBOUND.DOC_ACTION,
       DOTS_OUTBOUND.DOC_LOCATION,
       DOTS_OUTBOUND.DOC_DIVISION,
    ];

    var join = {

    };

    var data = {
        TABLE: DOTS_OUTBOUND.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        // JOIN: join,

    };

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            var results = "";
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