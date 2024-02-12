import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

const searchBar = document.getElementById("searchBar");

const DOC_VIEW_BASIC = document.getElementById("DOC_VIEW_BASIC");


setTable("");



function setTable(filter) {
    var data = {
        TABLE: DOTS_DOCUMENT_SUB.NAME,
        REQUEST: _REQUEST.SELECT,
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
            JsFunctions.updateTable(results, DOC_VIEW_BASIC, filter);
        }
    }, data);
}