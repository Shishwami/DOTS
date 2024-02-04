import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setTable("");

function setTable(filter) {
    var data = {
        TABLE_NAME: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                const results = Object.values(response)[0];console.log(DOC_VIEW_MAIN);
                JsFunctions.updateTable(results,DOC_VIEW_MAIN,filter);
            } else {
                console.log(response);
            }
        }
    }, data);
}