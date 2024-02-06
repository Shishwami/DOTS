import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setDOC_PURPOSE();
setDOC_DIVISION();

setButtonEvents();

setTable("");
searchBar.addEventListener('input', function (e) {
    setTable(searchBar.value.toUpperCase());
});

const TBODY = DOC_VIEW_MAIN.querySelector("tbody");
JsFunctions.tbodyEventListener(TBODY);



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
                const results = Object.values(response)[0];
                JsFunctions.updateTable(results, DOC_VIEW_MAIN, filter);
            } else {
            }
        }
    }, data);
}

function setDOC_PURPOSE() {

    var columns = [
        DOTS_DOC_PRPS.ID,
        DOTS_DOC_PRPS.DOC_PRPS_NAME,
    ]

    var data = {
        TABLE_NAME: DOTS_DOC_PRPS.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(DOC_PRPS, object);
            } else {
            }
        } else {

        }
    }, data);
}

function setDOC_DIVISION() {

    DOC_DIVISION.addEventListener('change', function (e) {
        setADDRESSEE(this.value);
    });

    var columns = [
        DOTS_DOC_DIVISION.ID,
        DOTS_DOC_DIVISION.DOC_DIVISION_NAME,
    ]

    var data = {
        TABLE_NAME: DOTS_DOC_DIVISION.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(DOC_DIVISION, object);
            } else {
                alert(error);
            }
        } else {
            alert(error);
        }
    }, data);
}

function setADDRESSEE(DIVISION_ID) {
    var columns = [
        DOTS_ACCOUNT_INFO.DIVISION,
        DOTS_ACCOUNT_INFO.FULL_NAME,
    ]

    var data = {
        TABLE_NAME: DOTS_ACCOUNT_INFO.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        DIVISION: DIVISION_ID,

    }
    DOC_ADDRESSEE.innerHTML = "";
    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(DOC_ADDRESSEE, object);
            } else {
            }
        } else {
            alert(error);
        }
    }, data);

}

function setButtonEvents() {
    DOC_SEND.addEventListener('click', function (e) {
        DOC_NUM.value = sessionStorage.getItem("TEMP_DATA");
    });
}