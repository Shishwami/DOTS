import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setTable("");
searchBar.addEventListener('input', function (e) {
    setTable(searchBar.value.toUpperCase());
});

function setTable(filter) {

    const joinCondition =
        "LEFT JOIN `" + DOTS_DOC_STATUS.NAME + "` ON `" +
        DOTS_DOCUMENT.NAME + "`.`" + DOTS_DOCUMENT.DOC_STATUS + "` = `" +
        DOTS_DOC_STATUS.NAME + "`.`" + DOTS_DOC_STATUS.ID + "` " +

        " LEFT JOIN `" + DOTS_DOC_TYPE.NAME + "` ON `" +
        DOTS_DOCUMENT.NAME + "`.`" + DOTS_DOCUMENT.DOC_TYPE + "` = `" +
        DOTS_DOC_TYPE.NAME + '`.`' + DOTS_DOC_TYPE.ID + "` " +

        " LEFT JOIN `" + DOTS_ACCOUNT_INFO.NAME + "` ON `" +
        DOTS_DOCUMENT.NAME + "`.`" + DOTS_DOCUMENT.RECEIVED_BY + "` = `" +
        DOTS_ACCOUNT_INFO.NAME + '`.`' + DOTS_ACCOUNT_INFO.HRIS_ID + "` ";

    const columns = [
        'DOC_NUM',
        'DOC_SUBJECT',
        'LETTER_DATE',
        DOTS_DOC_TYPE.NAME + '`.`' + DOTS_DOC_TYPE.DOC_TYPE_NAME,
        DOTS_ACCOUNT_INFO.NAME + '`.`' + DOTS_ACCOUNT_INFO.FULL_NAME,
        'DATE_TIME_RECEIVED',
        DOTS_DOC_STATUS.NAME + '`.`' + DOTS_DOC_STATUS.DOC_STATUS_NAME,
    ]

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
                console.log(response);

            } else {
                console.log(response);
            }
        }
    }, data);
}