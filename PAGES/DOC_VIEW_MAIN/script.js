import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setTable("");

function setTable(filter) {

    const joinCondition = "LEFT JOIN `" + DOC_STATUS.DOC_STATUS_NAME + "` ON `"
        + DOTS_DOCUMENT.NAME + "`.`" + DOTS_DOCUMENT.DOC_STATUS + "` = `"
        + DOC_STATUS.NAME + "`.`" + DOC_STATUS.ID + "` ";

    const columns = {
        DOC_NUM: 'DOC_NUM',
        DOC_SUBJECT: 'DOC_SUBJECT',
        LETTER_DATE: 'LETTER_DATE',
        DOC_TYPE: 'DOC_TYPE',
        DOC_LOCATION: 'DOC_LOCATION',
        DATE_TIME_RECEIVED: 'DATE_TIME_RECEIVED',
        DOC_STATUS: 'DOC_STATUS`.`DOC_STATUS_NAME',
    }

    console.log(joinCondition);
    var data = {
        TABLE_NAME: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        JOIN_CONDITION: joinCondition
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                const results = Object.values(response)[0]; console.log(DOC_VIEW_MAIN);
                JsFunctions.updateTable(results, DOC_VIEW_MAIN, filter);
            } else {
                console.log(response);
            }
        }
    }, data);
}