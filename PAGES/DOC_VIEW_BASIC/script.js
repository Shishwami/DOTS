import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

const searchBar = document.getElementById("searchBar");

const DOC_VIEW_BASIC = document.getElementById("DOC_VIEW_BASIC");

const FORM_DOC_SEND = document.getElementById('FORM_DOC_SEND');
const SEND_DATE_TIME_RECEIVED = FORM_DOC_SEND.querySelector("#SEND_DATE_TIME_RECEIVED");
const SEND_DOC_PRPS = FORM_DOC_SEND.querySelector("#SEND_DOC_PRPS");

const RADIO_SEND = document.getElementById("RADIO_SEND");
const RADIO_RECEIVE = document.getElementById("RADIO_RECEIVE");

const R_BTN = document.getElementById('R_BTN');
const S_BTN = document.getElementById('S_BTN');

const hrisId = sessionStorage.getItem(DOTS_ACCOUNT_INFO.HRIS_ID);
let action_type = "receive";

setSession();
setDOC_PURPOSE();
setRECEIVED_TIME(SEND_DATE_TIME_RECEIVED);



setTable("", action_type);
searchBar.addEventListener('input', function () {
    setTable(searchBar.value.toUpperCase(), action_type);
});
setInterval(function () {
    setTable(searchBar.value.toUpperCase(), action_type);
}, _RESET_TIME);
S_BTN.disabled = true;

RADIO_SEND.addEventListener('change', function () {
    setACTION_TYPE(this);
    S_BTN.disabled = false;
    R_BTN.disabled = true;
});

RADIO_RECEIVE.addEventListener('change', function () {
    setACTION_TYPE(this);
    S_BTN.disabled = true;
    R_BTN.disabled = false;
});

R_BTN.addEventListener('click', function () {
    const json = JSON.parse(sessionStorage.getItem('TEMP_DATA'));
    let id = 0;

    if (!json) {
        alert('no_id');
        return;
    }

    id = json.ID;
    console.log(id);
    sessionStorage.removeItem('TEMP_DATA');

    //confirm

    var data = {
        TABLE: DOTS_DOCUMENT_SUB.NAME,
        REQUEST: _REQUEST.UPDATE,
        DATA: {
            ACTION_ID: 2,
            R_USER_ID: hrisId,
        },
        WHERE: {
            ID: id,
        }
    }

    MyAjax.createJSON((error, response) => {
        console.log(response);
    }, data);

});
S_BTN.addEventListener('click', function () {

    console.log('send');
});

function setACTION_TYPE(element) {
    action_type = element.value;
    setTable(searchBar.value.toUpperCase(), action_type);
}

function setTable(filter, action_type) {
    const columns = [
        'DOC_NUM',
        DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.ID,
        'DOC_NOTES',
        DOTS_DOC_PRPS.DOC_PRPS,

        "CONCAT(" +
        "IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', " +
        "IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), " +
        "IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sender'",

        "CONCAT(" +
        "IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ', " +
        "IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), " +
        "IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Receiver'",

        'DATE_TIME_RECEIVED',
        DOTS_DOC_ACTION.DOC_ACTION
    ];
    var data = {
        TABLE: DOTS_DOCUMENT_SUB.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        JOIN: [
            {
                table: DOTS_DOC_PRPS.NAME,
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.PRPS_ID
                    + " = " + DOTS_DOC_PRPS.NAME + "." + DOTS_DOC_PRPS.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_DOC_OFFICE.NAME + " S_OFFICE",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.S_OFFICE_ID +
                    " = " + "S_OFFICE." + DOTS_DOC_OFFICE.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_DOC_DEPT.NAME + " S_DEPT",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.S_DEPT_ID
                    + " = " + "S_DEPT." + DOTS_DOC_DEPT.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_ACCOUNT_INFO.NAME + " S_FULL_NAME",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.S_USER_ID
                    + " = " + "S_FULL_NAME." + DOTS_ACCOUNT_INFO.HRIS_ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_OFFICE.NAME + " R_OFFICE",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.R_OFFICE_ID
                    + " = " + "R_OFFICE." + DOTS_DOC_OFFICE.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_DOC_DEPT.NAME + " R_DEPT",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.R_DEPT_ID
                    + " = " + "R_DEPT." + DOTS_DOC_DEPT.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_ACCOUNT_INFO.NAME + " R_FULL_NAME",
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.R_USER_ID
                    + " = " + "R_FULL_NAME." + DOTS_ACCOUNT_INFO.HRIS_ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_ACTION.NAME,
                ON: [DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.ACTION_ID
                    + " = " + DOTS_DOC_ACTION.NAME + "." + DOTS_DOC_ACTION.ID],
                TYPE: 'LEFT',
            },

        ],
        ORDER_BY: DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.ID + ' DESC',
        WHERE: {
            AND: {}
        }
    }
    if (action_type == 'receive') {
        data['WHERE']['AND']['DOTS_DOCUMENT_SUB.R_USER_ID'] = hrisId;
        data['WHERE']['AND']['DOTS_DOCUMENT_SUB.ACTION_ID'] = 1;
    }
    if (action_type == 'send') {
        data['WHERE']['AND']['DOTS_DOCUMENT_SUB.R_USER_ID'] = hrisId;
        data['WHERE']['AND']['DOTS_DOCUMENT_SUB.ACTION_ID'] = 2;
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

function setRECEIVED_TIME(element) {
    var data = {
        REQUEST: _REQUEST.GET_DATE,
        DATE: "DATE_TIME"
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                element.value = Object.values(response)[0];
            } else {
                console.log(response);
            }
        }
    }, data);
}
function setDOC_PURPOSE() {
    const SEND_DOC_PRPS = document.getElementById("SEND_DOC_PRPS")
    var columns = [
        DOTS_DOC_PRPS.ID,
        DOTS_DOC_PRPS.DOC_PRPS,
    ]

    var data = {
        TABLE: DOTS_DOC_PRPS.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(SEND_DOC_PRPS, object);
            } else {
            }
        } else {

        }
    }, data);
}
function setSession() {
    getSessionDeptId();
    getSessionHrisId();
    getSessionName();
}
function getSessionName() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_NAME,
    }
    console.log(data);
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                var name = Object.values(response)[0];
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.FULL_NAME, name);
            } else {
                console.log(response);
                //error message
            }
        }
    }, data);
}
function getSessionHrisId() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_HRIS_ID,
    }
    console.log(data);
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                var id = Object.values(response)[0];
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.HRIS_ID, id);
            } else {
                console.log(response);
                //error message
            }
        }
    }, data);
}
function getSessionDeptId() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_DEPT_ID,
    }
    console.log(data);
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                var dept_id = Object.values(response)[0];
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.DEPT_ID, dept_id);
            } else {
                console.log(response);
                //error message
            }
        }
    }, data);
}