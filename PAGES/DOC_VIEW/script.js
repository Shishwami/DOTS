import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";


//Search Bar
const searchBar = document.getElementById("searchBar");
//Table
const DOC_VIEW_MAIN = document.getElementById("DOC_VIEW_MAIN");
//buttons
const BTN_DOC_CREATE = document.getElementById("BTN_DOC_CREATE");
const BTN_DOC_SEND = document.getElementById("BTN_DOC_SEND");
const BTN_DOC_ATTACHMENTS = document.getElementById("BTN_DOC_ATTACHMENTS");
//RECEIVE FORM
const FORM_DOC_RECEIVE = document.getElementById("FORM_DOC_RECEIVE");
const CREATE_DOC_NUM = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_NUM");
const CREATE_FULLNAME = FORM_DOC_RECEIVE.querySelector("#CREATE_FULLNAME");
const CREATE_DATE_TIME_RECEIVED = FORM_DOC_RECEIVE.querySelector("#CREATE_DATE_TIME_RECEIVED");
const CREATE_LETTER_DATE = FORM_DOC_RECEIVE.querySelector("#CREATE_LETTER_DATE");
const CREATE_DOC_TYPE = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_TYPE");
const CREATE_DOC_OFFICE = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_OFFICE");
const CREATE_DOC_SUBJECT = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_SUBJECT");
const CREATE_DOC_STATUS = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_STATUS");
const CREATE_R_USER_ID = FORM_DOC_RECEIVE.querySelector("#CREATE_R_USER_ID");
const CREATE_R_DEPT_ID = FORM_DOC_RECEIVE.querySelector("#CREATE_R_DEPT_ID");
//SEND FORM
const FORM_DOC_SEND = document.getElementById("FORM_DOC_SEND");
const SEND_DOC_NUM = FORM_DOC_SEND.querySelector("#SEND_DOC_NUM");
const SEND_ROUTE_NUM = FORM_DOC_SEND.querySelector("#SEND_ROUTE_NUM");
const SEND_DOC_PRPS = FORM_DOC_SEND.querySelector("#SEND_DOC_PRPS");
const SEND_R_DEPT_ID = FORM_DOC_SEND.querySelector("#SEND_R_DEPT_ID");
const SEND_DOC_ADDRESSEE = FORM_DOC_SEND.querySelector("#SEND_DOC_ADDRESSEE");
const SEND_DOC_NOTES = FORM_DOC_SEND.querySelector("#SEND_DOC_NOTES");
const SEND_DATE_TIME_RECEIVED = FORM_DOC_SEND.querySelector("#SEND_DATE_TIME_RECEIVED");
const SEND_ACTION_ID = FORM_DOC_SEND.querySelector("#SEND_ACTION_ID");
const SEND_S_USER_ID = FORM_DOC_SEND.querySelector("#SEND_S_USER_ID");
const SEND_S_DEPT_ID = FORM_DOC_SEND.querySelector("#SEND_S_DEPT_ID");

InitializePAGE();

function InitializePAGE() {

    //TODO too add in btn event listeners
    initializeSEND_FORM();
    initializeRECEIVE_FORM();
    getSessionDeptId();
    setTable("");

    // const TBODY = DOC_VIEW_MAIN.querySelector("tbody");
    // JsFunctions.tbodyEventListener(TBODY);

    searchBar.addEventListener('input', function () {
        setTable(searchBar.value.toUpperCase());
    });

    setInterval(function () {
        setTable(searchBar.value.toUpperCase());
    }, _RESET_TIME);


    setForms();
}
function initializeSEND_FORM() {
    setR_DEPT_ID();
    setDOC_PURPOSE();
    setDOC_LOCATION();
    setButtonEvents();
    setRECEIVED_TIME(SEND_DATE_TIME_RECEIVED);

}
function initializeRECEIVE_FORM() {
    setInterval(setDOC_NUM, 500);
    setDOC_NUM();
    setDOC_TYPE();
    setDOC_OFFICE();
    setRECEIVED_TIME(CREATE_DATE_TIME_RECEIVED);
    setLETTER_DATE();
    getSessionName();
    getSessionHrisId();
}
function setR_DEPT_ID() {
    SEND_R_DEPT_ID.addEventListener('change', function (e) {
        setADDRESSEE(this.value);
    });

    const data = {
        REQUEST: _REQUEST.GET_DEPT
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                SEND_R_DEPT_ID.innerHTML = object;
            } else {
                alert(error);
            }
        } else {
            alert(error);
        }
    }, data);
}
function setDOC_OFFICE() {

    var data = {
        REQUEST: _REQUEST.GET_DOC_OFFICE,
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            return alert(error);
        }
        if (response.VALID) {
            delete response.VALID;
            CREATE_DOC_OFFICE.innerHTML = Object.values(response)[0];
        }
    }, data);
}
function setDOC_NUM() {
    const data = {
        REQUEST: _REQUEST.GET_DOC_NUM
    }
    MyAjax.createJSON((error, response) => {
        if (!error && response.VALID) {
            delete response.VALID;
            const docNumber = Object.values(response)[0];
            CREATE_DOC_NUM.value = docNumber;
        } else {
            alert(error || "Error occurred while retrieving document number.");
        }
    }, data);
}
function setDOC_TYPE() {
    const data = {
        REQUEST: _REQUEST.GET_DOC_TYPE,
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else if (response.VALID) {
            delete response.VALID;
            CREATE_DOC_TYPE.innerHTML = Object.values(response)[0];
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
        } else if (response.VALID) {
            delete response.VALID;
            element.value = Object.values(response)[0];
        }
    }, data);

}
function setLETTER_DATE() {
    var data = {
        REQUEST: _REQUEST.GET_DATE,
        DATE: "DATE"
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                CREATE_LETTER_DATE.value = Object.values(response)[0];
            } else {
            }
        }
    }, data);
}
function getSessionName() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_NAME,
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID
            ) {
                delete response.VALID;
                var name = Object.values(response)[0];
                CREATE_FULLNAME.value = name;
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.FULL_NAME, name);
            } else {
                //error message
            }
        }
    }, data);
}
function getSessionHrisId() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_HRIS_ID,
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                var id = Object.values(response)[0];
                CREATE_R_USER_ID.value = id;
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.HRIS_ID, id);
            } else {
                //error message
            }
        }
    }, data);
}
function getSessionDeptId() {
    const data = {
        REQUEST: _REQUEST.GET_SESSION_DEPT_ID,
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            return alert(error);
        }

        if (response.VALID) {
            delete response.VALID;
            var dept_id = Object.values(response)[0];
            CREATE_R_DEPT_ID.value = dept_id;
            SEND_S_DEPT_ID.value = dept_id;
            sessionStorage.setItem(DOTS_ACCOUNT_INFO.DEPT_ID, dept_id);
        }
    }, data);
}
function setDOC_PURPOSE() {
    var data = {
        REQUEST: _REQUEST.GET_DOC_PRPS,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                SEND_DOC_PRPS.innerHTML = object;
            } else {
            }
        } else {

        }
    }, data);
}
function setDOC_LOCATION() {

    const data = {
        REQUEST: _REQUEST.GET_SESSION_HRIS_ID,
    }
    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                SEND_S_USER_ID.value = Object.values(response)[0];
            }
        } else {
            alert(error)
        }
    }, data);
}
function setButtonEvents() {

    BTN_DOC_SEND.addEventListener('click', function () {

        clearValues();
        resetAddressee();
        setRECEIVED_TIME(SEND_DATE_TIME_RECEIVED);
        var id = 0;
        var doc_num = 0;
        var route_num = 0;

        const TEMP_DATA = JSON.parse(sessionStorage.getItem("TEMP_DATA"));
        if (TEMP_DATA) {
            if (TEMP_DATA.DOC_NUM) {
                doc_num = TEMP_DATA.DOC_NUM;
            }
            if (TEMP_DATA.ID) {
                id = TEMP_DATA.ID;
            }
            if (TEMP_DATA.ROUTE_NUM) {
                route_num = TEMP_DATA.ROUTE_NUM;
            }
        }
        sessionStorage.clear("TEMP_DATA");

        if (id != 0) {
            SEND_DOC_NUM.value = doc_num;
            SEND_ROUTE_NUM.value = route_num;
        } else {
            alert("Please Select A Document");
        }
    });
}
function clearValues() {
    SEND_DOC_PRPS.value = "";
    SEND_R_DEPT_ID.value = "";
    SEND_DOC_NOTES.value = "";
    SEND_DOC_ADDRESSEE.value = "";
}
function setADDRESSEE(DEPT_ID) {

    resetAddressee();

    const data = {
        REQUEST: _REQUEST.GET_ADDRESSEE,
        DEPT_ID: DEPT_ID
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                SEND_DOC_ADDRESSEE.innerHTML = object;
            } else {
            }
        } else {
            alert(error);
        }
    }, data);

}
function resetAddressee() {
    const blankOption = document.createElement('option');
    blankOption.innerText = "Please Select Addressee";
    blankOption.disabled = true;
    blankOption.selected = true;
    blankOption.value = "";

    SEND_DOC_ADDRESSEE.innerHTML = "";
    SEND_DOC_ADDRESSEE.append(blankOption);
}
function setTable(filter) {

    const columns = [
        DOTS_DOCUMENT.NAME + '.' + DOTS_DOCUMENT.ID,
        " CASE " +
        "WHEN ROUTE_NUM = 0 THEN DOTS_DOCUMENT.DOC_NUM " +
        "ELSE CONCAT(DOTS_DOCUMENT.DOC_NUM,'-',ROUTE_NUM) " +
        "END AS `No.`",
        'DOC_NUM',
        'ROUTE_NUM',
        'DOC_SUBJECT',
        'DOC_NOTES',
        DOTS_DOC_TYPE.DOC_TYPE,
        'LETTER_DATE',

        // 'S_OFFICE.DOC_OFFICE AS Office1',
        // 'S_DEPT.DOC_DEPT AS Department',
        // 'S_FULL_NAME.FULL_NAME as sname',

        "CONCAT(" +
        "IF(S_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(S_OFFICE.DOC_OFFICE,'-'), ' '),' ', " +
        "IF(S_DEPT.DOC_DEPT IS NOT NULL,CONCAT(S_DEPT.DOC_DEPT,'-'), ' '), " +
        "IFNULL(S_FULL_NAME.FULL_NAME, ' ')) as 'Sent By'",

        // 'R_OFFICE.DOC_OFFICE AS Office2',
        // 'R_DEPT.DOC_DEPT AS Department2',
        // 'R_FULL_NAME.FULL_NAME',

        "CONCAT(" +
        "IF(R_OFFICE.DOC_OFFICE IS NOT NULL,CONCAT(R_OFFICE.DOC_OFFICE,'-'), ' '),' ', " +
        "IF(R_DEPT.DOC_DEPT IS NOT NULL,CONCAT(R_DEPT.DOC_DEPT,'-'), ' '), " +
        "IFNULL(R_FULL_NAME.FULL_NAME, ' ')) as 'Received By'",

        'DATE_TIME_RECEIVED',
        DOTS_DOC_STATUS.NAME + "." + DOTS_DOC_STATUS.DOC_STATUS,
        DOTS_DOC_ACTION.NAME + "." + DOTS_DOC_ACTION.DOC_ACTION,

    ];
    var data = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        JOIN: [
            {
                table: DOTS_DOC_TYPE.NAME,
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.DOC_TYPE_ID
                    + " = " + DOTS_DOC_TYPE.NAME + "." + DOTS_DOC_TYPE.ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_OFFICE.NAME + " S_OFFICE",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.S_OFFICE_ID +
                    " = " + "S_OFFICE." + DOTS_DOC_OFFICE.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_DOC_DEPT.NAME + " S_DEPT",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.S_DEPT_ID
                    + " = " + "S_DEPT." + DOTS_DOC_DEPT.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_ACCOUNT_INFO.NAME + " S_FULL_NAME",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.S_USER_ID
                    + " = " + "S_FULL_NAME." + DOTS_ACCOUNT_INFO.HRIS_ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_OFFICE.NAME + " R_OFFICE",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.R_OFFICE_ID
                    + " = " + "R_OFFICE." + DOTS_DOC_OFFICE.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_DOC_DEPT.NAME + " R_DEPT",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.R_DEPT_ID
                    + " = " + "R_DEPT." + DOTS_DOC_DEPT.ID],
                TYPE: 'LEFT'
            },
            {
                table: DOTS_ACCOUNT_INFO.NAME + " R_FULL_NAME",
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.R_USER_ID
                    + " = " + "R_FULL_NAME." + DOTS_ACCOUNT_INFO.HRIS_ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_STATUS.NAME,
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.DOC_STATUS
                    + " = " + DOTS_DOC_STATUS.NAME + "." + DOTS_DOC_STATUS.ID],
                TYPE: 'LEFT',
            },
            {
                table: DOTS_DOC_ACTION.NAME,
                ON: [DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.ACTION_ID
                    + " = " + DOTS_DOC_ACTION.NAME + "." + DOTS_DOC_ACTION.ID],
                TYPE: 'LEFT',
            }
        ],
        ORDER_BY: DOTS_DOCUMENT.DOC_NUM + ' DESC',
        // WHERE:{
        //     DOC_STATUS: 1
        // }
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
            JsFunctions.updateTable(results, DOC_VIEW_MAIN, filter);
        }
    }, data);
}
function setForms() {
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();
        setSendFormSubmit();
    });

    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();

        var data = {
            TABLE: DOTS_DOCUMENT.NAME,
            REQUEST: _REQUEST.INSERT,
            DATA: JsFunctions.FormToJson(FORM_DOC_RECEIVE),
        }

        // const dataValues = Object.values(data);
        // var empty = JsFunctions.checkIfEmpty(dataValues);
        createDoc(data);
    });

}
function setSendFormSubmit() {
    var data = JsFunctions.FormToJson(FORM_DOC_SEND);
    var insertData = {
        TABLE: DOTS_DOCUMENT_SUB.NAME,
        REQUEST: _REQUEST.INSERT,
        DATA: data,
    }

    var routedCheck = {
        // TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SEND_DOC_FORM,
        DATA:data,
        DOC_NUM: data.DOC_NUM,
        ROUTE_NUM: data.ROUTE_NUM,
        // COLUMNS: [
            // DOTS_DOCUMENT.ID,
            // DOTS_DOCUMENT.DOC_NUM,
            // DOTS_DOCUMENT.ROUTE_NUM,
            // DOTS_DOCUMENT.ROUTED,
        // ],
        // WHERE: {
            // AND: {
                // [DOTS_DOCUMENT.DOC_NUM]: data.DOC_NUM,
                // [DOTS_DOCUMENT.ROUTE_NUM]: data.ROUTE_NUM
            // }
        // }
        // ORDER_BY: DOTS_DOCUMENT.DOC_NUM + ' DESC
    }
    MyAjax.createJSON((error, response) => {

        // if (error) {
        //     return alert(error);
        // }

        // delete response.VALID;
        // var result = Object.values(response)[0][0];

        // if (result.ROUTED == 0) {
        //     sendDoc(insertData);
        // } else {
        //     resendDoc(insertData);
        // }
    }, routedCheck);
}
function sendDoc(data) {

    var updateData = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.UPDATE,
        DATA: {
            DOC_STATUS: 1,//  pending to on hand
            ROUTED: 1,//routed
        },
        WHERE: {
            [DOTS_DOCUMENT.DOC_NUM]: data["DATA"]["DOC_NUM"],
            [DOTS_DOCUMENT.ROUTE_NUM]: data["DATA"]["ROUTE_NUM"],
        }

    }
    console.log("SEND DOC", data);
    MyAjax.createJSON((error, response) => {

        if (error) {
            return alert(error);
        }

        if (!response.VALID) {
            return;
        }
        console.log("UdpATE DATA", updateData);
        updateDoc(updateData);

        delete response.VALID;
    }, data);

}
function updateDoc(data) {
    MyAjax.createJSON((error, response) => {

        if (error) {
            return alert(error);
        }

        if (!response.VALID) {
            return;
        }
        console.log('UPDATE DOC', response);

        delete response.VALID;
    }, data);

}
function resendDoc(data) {

    var doc_num = data['DATA']['DOC_NUM'];

    const jsonSelect = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        WHERE: {
            AND: {
                [DOTS_DOCUMENT.DOC_NUM]: doc_num,
            },
        },
        ORDER_BY: [DOTS_DOCUMENT.ROUTE_NUM] + " DESC"
    }

    MyAjax.createJSON((error, response) => {

        if (error) {
            return alert(error);
        }

        if (!response.VALID) {
            return;
        }

        delete response.VALID;
        var result = Object.values(response)[0][0];
        result.ROUTE_NUM = Number(result.ROUTE_NUM) + 1;
        delete result.ID;

        const data = {
            TABLE: DOTS_DOCUMENT.NAME,
            REQUEST: _REQUEST.INSERT,
            DATA: result,

        }
        createDoc(data);

        var sendForm = JsFunctions.FormToJson(FORM_DOC_SEND);
        sendForm.ROUTE_NUM = result.ROUTE_NUM;

        var insertData = {
            TABLE: DOTS_DOCUMENT_SUB.NAME,
            REQUEST: _REQUEST.INSERT,
            DATA: sendForm,
        }
        sendDoc(insertData);

    }, jsonSelect);
}
function createDoc(data) {

    MyAjax.createJSON((error, response) => {
        if (error) {
            return alert(error);
        }

        if (response.VALID) {
            alert("DOC CREATED");
        }
    }, data);
}