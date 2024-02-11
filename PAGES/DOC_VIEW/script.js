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
const CREATE_DOC_DEPT = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_DEPT");
const CREATE_DOC_SUBJECT = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_SUBJECT");
const CREATE_DOC_STATUS = FORM_DOC_RECEIVE.querySelector("#CREATE_DOC_STATUS");
//SEND FORM
const FORM_DOC_SEND = document.getElementById("FORM_DOC_SEND");
const SEND_DOC_NUM = FORM_DOC_SEND.querySelector("#SEND_DOC_NUM");
const SEND_DOC_PRPS = FORM_DOC_SEND.querySelector("#SEND_DOC_PRPS");
const SEND_DOC_DEPT = FORM_DOC_SEND.querySelector("#SEND_DOC_DEPT");
const SEND_DOC_ADDRESSEE = FORM_DOC_SEND.querySelector("#SEND_DOC_ADDRESSEE");
const SEND_DOC_NOTES = FORM_DOC_SEND.querySelector("#SEND_DOC_NOTES");
const SEND_DOC_ACTION = FORM_DOC_SEND.querySelector("#SEND_DOC_ACTION");
const SEND_DOC_LOCATION = FORM_DOC_SEND.querySelector("#SEND_DOC_LOCATION");

console.log(SEND_DOC_NUM);

InitializePAGE();

function InitializePAGE() {
    initializeSEND_FORM();
    initializeRECEIVE_FORM();

    setTable("");

    const TBODY = DOC_VIEW_MAIN.querySelector("tbody");
    JsFunctions.tbodyEventListener(TBODY);

    searchBar.addEventListener('input', function () {
        setTable(searchBar.value.toUpperCase());
    });

    setInterval(function () {
        setTable(searchBar.value.toUpperCase());
    }, _RESET_TIME);


    setForms();
}
function initializeSEND_FORM() {
    setDOC_DEPT();
    setDOC_PURPOSE();
    setDOC_LOCATION();
    setButtonEvents();
}
function initializeRECEIVE_FORM() {
    setInterval(setDOC_NUM, _RESET_TIME);
    setDOC_NUM();
    setDOC_TYPE();
    setDOC_OFFICE();
    setRECEIVED_TIME();
    setLETTER_DATE();
    getSessionName();
}
function setDOC_DEPT() {
    SEND_DOC_DEPT.addEventListener('change', function (e) {
        setADDRESSEE(this.value);
    });

    var columns = [
        DOTS_DOC_DIVISION.ID,
        DOTS_DOC_DIVISION.DOC_DIVISION,
    ]

    var data = {
        TABLE: DOTS_DOC_DIVISION.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(SEND_DOC_DEPT, object);
            } else {
                alert(error);
            }
        } else {
            alert(error);
        }
    }, data);
}
function setDOC_OFFICE() {

    const columns = [
        DOTS_DOC_OFFICE.ID,
        DOTS_DOC_OFFICE.DOC_OFFICE,
    ]

    var data = {
        TABLE: DOTS_DOC_OFFICE.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                JsFunctions.setSelect(DOC_OFFICE, Object.values(response)[0]);
            } else {
                console.log(response);
            }
        }
    }, data);


}
function setDOC_NUM() {
    const columns = [
        DOTS_DOCUMENT.DOC_NUM
    ];
    const data = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    };
    MyAjax.createJSON((error, response) => {
        if (!error && response.VALID) {
            delete response.VALID;
            const docNumbers = Object.values(response)[0];
            const lastObj = docNumbers[docNumbers.length - 1];
            const lastNumber = Object.values(lastObj)[0];
            CREATE_DOC_NUM.value = Number(lastNumber) + 1;
        } else {
            alert(error || "Error occurred while retrieving document number.");
        }
    }, data);
}
function setDOC_TYPE() {
    const columns = [
        DOTS_DOC_TYPE.ID,
        DOTS_DOC_TYPE.DOC_TYPE,
    ]
    var data = {
        TABLE: DOTS_DOC_TYPE.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                JsFunctions.setSelect(CREATE_DOC_TYPE, Object.values(response)[0]);
            } else {
                console.log(response);
            }
        }
    }, data);
}
function setRECEIVED_TIME() {
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
                CREATE_DATE_TIME_RECEIVED.value = Object.values(response)[0];
            } else {
                console.log(response);
            }
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
                console.log(response);
            }
        }
    }, data);
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
                CREATE_FULLNAME.value = Object.values(response)[0];
            } else {
                console.log(response);
                //error message
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
function setDOC_LOCATION() {

    const data = {
        REQUEST: _REQUEST.GET_SESSION_ID,
    }
    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                SEND_DOC_LOCATION.value = Object.values(response)[0];
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

        const doc_num = sessionStorage.getItem("TEMP_DATA");
        sessionStorage.clear("TEMP_DATA");

        if (doc_num != null) {
            SEND_DOC_NUM.value = doc_num;
        } else {
            alert("Please Select A Document");
        }
    });
}
function clearValues() {
    SEND_DOC_PRPS.value = "";
    SEND_DOC_DEPT.value = "";
    SEND_DOC_NOTES.value = "";
    SEND_DOC_ADDRESSEE.value = "";
}
function setADDRESSEE(DEPT_ID) {

    resetAddressee();

    var columns = [
        DOTS_ACCOUNT_INFO.HRIS_ID,
        DOTS_ACCOUNT_INFO.FULL_NAME,
    ]

    var data = {
        TABLE: DOTS_ACCOUNT_INFO.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        WHERE: {
            DEPT_ID: DEPT_ID,
        },
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(SEND_DOC_ADDRESSEE, object);
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
        'DOC_NUM',
        'DOC_SUBJECT',
        'LETTER_DATE',
        'S_DEPT_ID',
        DOTS_DOC_TYPE.NAME + '.' + DOTS_DOC_TYPE.DOC_TYPE,
        DOTS_ACCOUNT_INFO.NAME + '.' + DOTS_ACCOUNT_INFO.FULL_NAME,
        'DATE_TIME_RECEIVED',
        DOTS_DOC_STATUS.NAME + '.' + DOTS_DOC_STATUS.DOC_STATUS,
    ]
    var data = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
        JOIN: [
            {
                table: DOTS_DOC_TYPE.NAME,
                ON: [
                    DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.DOC_TYPE
                    + " = " +
                    DOTS_DOC_TYPE.NAME + "." + DOTS_DOC_TYPE.ID
                ],
                TYPE: 'LEFT',
            }, {
                table: DOTS_ACCOUNT_INFO.NAME,
                ON: [
                    DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.R_USER_ID
                    + " = " +
                    DOTS_ACCOUNT_INFO.NAME + "." + DOTS_ACCOUNT_INFO.HRIS_ID
                ],
                TYPE: 'LEFT',
            }, {
                table: DOTS_DOC_STATUS.NAME,
                ON: [
                    DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.DOC_STATUS
                    + " = " +
                    DOTS_DOC_STATUS.NAME + "." + DOTS_DOC_STATUS.ID
                ],
                TYPE: 'LEFT',
            }
        ],
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

        var data = JsFunctions.FormToJson(this);
        data['DOC_DIVISION'] = document.getElementById('SEND_DOC_DIVISION').value;
        data['DOC_ADDRESSEE'] = document.getElementById('SEND_DOC_ADDRESSEE').value;

        var insertData = {
            TABLE: DOTS_OUTBOUND.NAME,
            REQUEST: _REQUEST.INSERT,
            DATA: data,
        }

        delete data.DOC_NOTES;
        const dataValues = Object.values(data);
        var empty = JsFunctions.checkIfEmpty(dataValues);
        data['DOC_NOTES'] = DOC_NOTES.value

        var updateData = {
            TABLE: DOTS_DOCUMENT.NAME,
            REQUEST: _REQUEST.UPDATE,
            DATA: {
                DOC_STATUS: 1,//sent
            },
            WHERE: {
                DOC_NUM: data[DOTS_DOCUMENT.DOC_NUM],
            }
        }

        console.log(updateData);
        if (!empty) {
            MyAjax.createJSON((error, response) => {
                if (error) {
                    alert(error);
                } else {
                    if (response.VALID) {
                        delete response.VALID;
                        alert("SENT");
                        //update status from received to pending
                        MyAjax.createJSON((error, response) => {
                            if (error) {
                                alert(error);
                            } else {
                                if (response.VALID) {
                                    console.log(response);
                                }
                            }
                        }, updateData);
                    }
                }
            }, insertData);
        } else {
            alert("CHECKINPUTS");
        }

    });

    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();

        const data2 = {
            REQUEST: _REQUEST.GET_SESSION_ID,
        }
        var vals = JsFunctions.FormToJson(FORM_DOC_RECEIVE);
        var data = {
            TABLE: DOTS_DOCUMENT.NAME,
            REQUEST: _REQUEST.INSERT,
            DATA: vals,
        }

        const dataValues = Object.values(data);
        var empty = JsFunctions.checkIfEmpty(dataValues);

        if (!empty) {
            MyAjax.createJSON((error, response) => {
                if (error) {
                    alert(error);
                } else {
                    if (response.VALID) {
                        delete response.VALID;
                        data["RECEIVED_BY"] = Object.values(response)[0];
                        MyAjax.createJSON((error, response) => {
                            if (!error) {
                                if (response.VALID) {
                                    console.log(response);
                                    alert("DOC CREsddssddsATED");
                                }
                            } else {
                                alert(error);
                            }
                        }, data);
                    } else {
                        console.log(response);
                        //error message
                    }
                }
            }, data2);
        } else {
            //validation
        }

    });
}
