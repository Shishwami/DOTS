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
setDOC_PURPOSEselect();
setRECEIVED_TIME(SEND_DATE_TIME_RECEIVED);
setDOC_LOCATION();
getSessionDeptId();

setTable("", action_type);
searchBar.addEventListener('input', function () {
    setTable(searchBar.value.toUpperCase(), action_type);
});
setInterval(function () {
    setTable(searchBar.value.toUpperCase(), action_type);
}, _RESET_TIME);

RADIO_SEND.addEventListener('change', function () {
    setACTION_TYPE(this);

});
RADIO_RECEIVE.addEventListener('change', function () {
    setACTION_TYPE(this);

});
function setACTION_TYPE(element) {
    action_type = element.value;
    setTable(searchBar.value.toUpperCase(), action_type);

}

function setTable(filter, action_type) {
    var data = {};
    if (action_type == 'receive') {
        data['REQUEST'] = _REQUEST.GET_TABLE_INBOUND;
    }
    if (action_type == 'send') {
        data['REQUEST'] = _REQUEST.GET_TABLE_OUTBOUND;
    }
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
            } else {
            }
            const thead = DOC_VIEW_BASIC.querySelector('thead');
            const tbody = DOC_VIEW_BASIC.querySelector('tbody');
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
            setButtons(DOC_VIEW_BASIC);
            JsFunctions.updateTable(DOC_VIEW_BASIC, filter);
        }
    }, data);
}

function setButtons(table) {
    table.querySelectorAll('.btnR').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            var itemId = this.getAttribute('data-i');
            setReceiveBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
}

function setReceiveBtn(id, doc_num, route_num) {
    console.log("btnpressed");

    //updateform
}
function setSendBtn(id, doc_num, route_num) {

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
function setDOC_PURPOSEselect() {

    var data = {
        REQUEST: _REQUEST.GET_DOC_PRPS,
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                SEND_DOC_PRPS.innerHTML = Object.values(response)[0];
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
                SEND_S_DEPT_ID.value = dept_id;
                sessionStorage.setItem(DOTS_ACCOUNT_INFO.DEPT_ID, dept_id);
            } else {
                console.log(response);
                //error message
            }
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
