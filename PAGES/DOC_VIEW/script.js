import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";


//Search Bar
const searchBar = document.getElementById("searchBar");
//Table
const DOC_VIEW_MAIN = document.getElementById("DOC_VIEW_MAIN");
//buttons
const BTN_DOC_CREATE = document.getElementById("BTN_DOC_CREATE");
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
const SEND_DATE_TIME_SENT = FORM_DOC_SEND.querySelector("#SEND_DATE_TIME_SENT");
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
    setRECEIVED_TIME(SEND_DATE_TIME_SENT);

}
function initializeRECEIVE_FORM() {
    setInterval(setDOC_NUM, 1000);
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

function sendBtnEvent(id, doc_num, route_num) {

    clearValues();
    resetAddressee();
    setRECEIVED_TIME(SEND_DATE_TIME_SENT);

    if (id != 0) {
        SEND_DOC_NUM.value = doc_num;
        SEND_ROUTE_NUM.value = route_num;
    } else {
        alert("Please Select A Document");
    }
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

    const data2 = {
        REQUEST: _REQUEST.GET_TABLE_MAIN,
    };

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
            } else {
            }
            const thead = DOC_VIEW_MAIN.querySelector('thead');
            const tbody = DOC_VIEW_MAIN.querySelector('tbody');
            if (response.THEAD) {
                thead.innerHTML = response.THEAD;
            } else {
                thead.innerHTML = '';
            }
            if (response.TBODY) {
                tbody.innerHTML = response.TBODY;
            } else {
                tbody.innerHTML = '';
            }
            setButtons(DOC_VIEW_MAIN);
            JsFunctions.updateTable(DOC_VIEW_MAIN, filter);
        }
    }, data2);
}
function setButtons(table) {
    table.querySelectorAll('.btnS').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            var itemId = this.getAttribute('data-i');
            sendBtnEvent(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });

    table.querySelectorAll('.btnE').forEach(function (button) {
        button.addEventListener('click', function () {
            var itemId = this.getAttribute('data-i');
            alert('Edit item with ID: ' + this.dataset.i);
        });
    });

    table.querySelectorAll('.btnA').forEach(function (button) {
        button.addEventListener('click', function () {
            var itemId = this.getAttribute('data-i');
            alert('Delete item with ID: ' + itemId);
        });
    });
}
function setForms() {
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();
        setSendFormSubmit();
    });

    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = {
            REQUEST: _REQUEST.RECEIVE_DOC,
            DATA: JsFunctions.FormToJson(FORM_DOC_RECEIVE),
        }


        MyAjax.createJSON((error, response) => {
            if (error) {
                alert(error);
            } else {
                var results = ""
                if (response.VALID) {
                    delete response.VALID;
                } else {
                    //response valid=false
                }
            }
        }, data);
    });

}
function setSendFormSubmit() {
    var data = JsFunctions.FormToJson(FORM_DOC_SEND);
    var routedCheck = {
        REQUEST: _REQUEST.SEND_DOC_FORM,
        DATA: data,
    }
    MyAjax.createJSON((error, response) => {
        console.log(response);
    }, routedCheck);
}
