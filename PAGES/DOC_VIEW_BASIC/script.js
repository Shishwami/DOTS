import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

const searchBar = document.getElementById("searchBar");

const DOC_VIEW_BASIC = document.getElementById("DOC_VIEW_BASIC");

setSession();

setTable("");
searchBar.addEventListener('input', function () {
    setTable(searchBar.value.toUpperCase());
});
setInterval(function () {
    setTable(searchBar.value.toUpperCase());
}, _RESET_TIME);



function setTable(filter) {



    const columns = [
        'DOC_NUM',
        DOTS_DOCUMENT_SUB.NAME + "." + DOTS_DOCUMENT_SUB.ID,
        'DOC_NOTES',
        DOTS_DOC_PRPS.DOC_PRPS,
        // 'S_OFFICE.DOC_OFFICE AS Office1',
        // 'S_DEPT.DOC_DEPT AS Department',
        // 'S_FULL_NAME.FULL_NAME as sname',

        "CONCAT(" +
        "IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', " +
        "IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), " +
        "IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sender'",

        // 'R_OFFICE.DOC_OFFICE AS Office2',
        // 'R_DEPT.DOC_DEPT AS Department2',
        // 'R_FULL_NAME.FULL_NAME',

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
            OR: {}
        }
    }

    var hrisId = sessionStorage.getItem(DOTS_ACCOUNT_INFO.HRIS_ID);
    data['WHERE']['OR']['DOTS_DOCUMENT_SUB.R_USER_ID'] = hrisId;
    // data['WHERE']['OR']['DOTS_DOCUMENT_SUB.S_USER_ID'] = hrisId;

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