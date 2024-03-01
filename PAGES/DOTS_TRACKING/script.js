import MyAjax from "../../SCRIPTS/MyAjax.js";
import JsFunctions from "../../SCRIPTS/JsFunctions.js";

const searchBar = document.getElementById("searchBar");
const DOC_VIEW_TRACKING = document.getElementById("DOC_VIEW_TRACKING");

setTable("");

function setTable(filter) {

    var data = {
        REQUEST: _REQUEST.GET_TABLE_TRACKING,
    };

    MyAjax.createJSON((error, response) => {
        JsFunctions.updateTable(DOC_VIEW_TRACKING, response.RESULT, null, filter);
    }, data);

}


