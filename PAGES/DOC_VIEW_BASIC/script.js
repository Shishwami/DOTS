import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

const searchBar = document.getElementById("searchBar");

const DOC_VIEW_BASIC = document.getElementById("DOC_VIEW_BASIC");

const FORM_DOC_RECEIVE = document.getElementById('FORM_DOC_RECEIVE');
const RECEIVE_DATE_TIME_RECEIVED = FORM_DOC_RECEIVE.querySelector("#RECEIVE_DATE_TIME_RECEIVED");
const RECEIVE_DOC_ID = FORM_DOC_RECEIVE.querySelector('#RECEIVE_DOC_ID');
const RECEIVE_R_USER_ID = FORM_DOC_RECEIVE.querySelector('#RECEIVE_R_USER_ID');
const RECEIVE_DOC_NUM = FORM_DOC_RECEIVE.querySelector('#RECEIVE_DOC_NUM');
const RECEIVE_ROUTE_NUM = FORM_DOC_RECEIVE.querySelector('#RECEIVE_ROUTE_NUM');
const RECEIVE_R_DEPT_ID = FORM_DOC_RECEIVE.querySelector('#RECEIVE_R_DEPT_ID');

const FORM_DOC_SEND = document.getElementById('FORM_DOC_SEND');
const SEND_DATE_TIME_SEND = FORM_DOC_SEND.querySelector("#SEND_DATE_TIME_SEND");
const SEND_DOC_PRPS = FORM_DOC_SEND.querySelector("#SEND_DOC_PRPS");
const SEND_DOC_ID = FORM_DOC_SEND.querySelector('#SEND_DOC_ID');
const SEND_S_USER_ID = FORM_DOC_SEND.querySelector('#SEND_S_USER_ID');
const SEND_S_DEPT_ID = FORM_DOC_SEND.querySelector('#SEND_S_DEPT_ID');
const SEND_R_DEPT_ID = FORM_DOC_SEND.querySelector('#SEND_R_DEPT_ID');

const FORM_DOC_CANCEL_R = document.getElementById("FORM_DOC_CANCEL_R");
const CANCEL_R_NOTES = FORM_DOC_CANCEL_R.querySelector("#CANCEL_R_NOTES");
const CANCEL_R_DEPT = FORM_DOC_CANCEL_R.querySelector("CANCEL_R_DEPT");
const CANCEL_R_ID = FORM_DOC_CANCEL_R.querySelector("#CANCEL_R_ID");

const FORM_DOC_CANCEL_S = document.getElementById("FORM_DOC_CANCEL_S");
const CANCEL_S_NOTES = FORM_DOC_CANCEL_S.querySelector("#CANCEL_S_NOTES");
const CANCEL_S_ID = FORM_DOC_CANCEL_S.querySelector("#CANCEL_S_ID");

const RADIO_SEND = document.getElementById("RADIO_SEND");
const RADIO_RECEIVE = document.getElementById("RADIO_RECEIVE");

const R_BTN = document.getElementById('R_BTN');
const S_BTN = document.getElementById('S_BTN');

const hrisId = sessionStorage.getItem(DOTS_ACCOUNT_INFO.HRIS_ID);
let action_type = "receive";

const FORM_ATTACH_ADD = document.getElementById("FORM_ATTACH_ADD");
const ATTACH_DOC_NUM = FORM_ATTACH_ADD.querySelector('#ATTACH_DOC_NUM');
const ATTACH_ROUTE_NUM = FORM_ATTACH_ADD.querySelector('#ATTACH_ROUTE_NUM');
const ATTACH_FILE = document.getElementById("ATTACH_FILE");
const ATTACH_RESULTS = document.getElementById("ATTACH_RESULTS");
const ATTACH_ZOOM = document.getElementById("ATTACH_ZOOM");

const track_modal = document.getElementById("track_modal");

setSession();
setFormEvents();

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

if (BTN_ATTACH_INS) {
    BTN_ATTACH_INS.addEventListener("click", function () {
        var elements = document.getElementsByClassName('img-zoom-lens');
        var elementsArray = Array.from(elements);

        elementsArray.forEach(function (element) {
            element.parentNode.removeChild(element);
        });

        imageZoom("myimage", "myresult");
    });
}

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

    console.log(data);

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {

        }
        // const thead = DOC_VIEW_BASIC.querySelector('thead');
        // const tbody = DOC_VIEW_BASIC.querySelector('tbody');
        // if (response.THEAD) {
        //     thead.innerHTML = response.THEAD;
        // } else {
        //     thead.innerHTML = '';
        // }
        // if (response.TBODY) {
        //     tbody.innerHTML = response.TBODY;
        // } else {
        //     tbody.innerHTML = '';
        // }
        JsFunctions.updateTable(DOC_VIEW_BASIC, response.RESULT, response.BUTTONS, filter);
        setButtons(DOC_VIEW_BASIC);
    }, data);

}

function setButtons(table) {
    table.querySelectorAll('.btnR').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setReceiveBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
    table.querySelectorAll('.btnS').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setSendBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
    table.querySelectorAll('.btnA').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setAttachBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
    table.querySelectorAll('.btnCR').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setCancelReceive(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
    table.querySelectorAll('.btnCS').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setCancelSend(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
    table.querySelectorAll('.btnT').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setTrackingTable(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
}

function setReceiveBtn(id, doc_num, route_num) {
    console.log("btnpressed");

    //updateform
    RECEIVE_DOC_ID.value = id;
    RECEIVE_DOC_NUM.value = doc_num;
    RECEIVE_ROUTE_NUM.value = route_num;

    getData(_REQUEST.GET_DATE, { DATE: "DATE_TIME" }, (result) => {
        RECEIVE_DATE_TIME_RECEIVED.value = result;
        RECEIVE_DATE_TIME_RECEIVED.focus();
    });
    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        RECEIVE_R_USER_ID.value = result;
    });
    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result) => {
        RECEIVE_R_DEPT_ID.value = result;
    });
    //open modal
    document.getElementById("rec_modal").style.display = "block";


}
function setSendBtn(id, doc_num, route_num) {
    //updateform
    SEND_DOC_ID.value = id;
    SEND_DOC_NUM.value = doc_num;
    SEND_ROUTE_NUM.value = route_num;
    SEND_DOC_NOTES.value = "";
    SEND_DOC_ADDRESSEE.innerHTML = "<select name=R_USER_ID id=END_DOC_ADDRESSEE><option disabled selected>Select Addressee</option></select>";

    getData(_REQUEST.GET_DATE, { DATE: "DATE_TIME" }, (result) => {
        SEND_DATE_TIME_SEND.value = result;
    });
    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        SEND_S_USER_ID.value = result;
    });

    getData(_REQUEST.GET_DOC_PRPS, null, (result) => {
        // SEND_DOC_PRPS.innerHTML = result;
        SEND_DOC_PRPS.innerHTML = "<option disabled selected>Select Purpose</option>";;
        JsFunctions.setSelect(SEND_DOC_PRPS, result);
    });
    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result => {
        SEND_S_DEPT_ID.value = result;
    }));
    getData(_REQUEST.GET_DEPT, null, (result) => {
        SEND_R_DEPT_ID.innerHTML = "<option disabled selected>Select Department</option>";
        JsFunctions.setSelect(SEND_R_DEPT_ID, result);
        SEND_R_DEPT_ID.addEventListener('change', function () {
            getData(_REQUEST.GET_ADDRESSEE, { DEPT_ID: this.value }, (result2) => {
                SEND_DOC_ADDRESSEE.innerHTML = "<option disabled selected>Select Addressee</option>";
                JsFunctions.setSelect(SEND_DOC_ADDRESSEE, result2);
            });
        });
    });

    FORM_DOC_SEND.querySelector('input[type=submit]').disabled = false;
    document.getElementById("sent_modal").style.display = "block";

}

function setCancelReceive(id, doc_num, route_num) {
    CANCEL_R_ID.value = id;
    CANCEL_R_NOTES.value = "";
    FORM_DOC_CANCEL_R.querySelector('input[type=submit]').disabled = false;
    document.getElementById("r_cnl_modal").style.display = "block";

}

function setCancelSend(id, doc_num, route_num) {
    CANCEL_S_ID.value = id;
    CANCEL_S_NOTES.value = "";

    document.getElementById("s_cnl_modal").style.display = "block";
    FORM_DOC_CANCEL_S.querySelector("input[type=submit]").disabled = false;
}
function setTrackingTable(id, doc_num, route_num) {
    const data = {
        REQUEST: _REQUEST.GET_TABLE_TRACKING,
        DATA:{
            DOC_NUM: doc_num,
            ROUTE_NUM: route_num
        }
    };

    MyAjax.createJSON((error, response) => {
        track_modal.style.display = "block";

        if (response.VALID) {
        } else {

        }
        JsFunctions.updateTable(DOC_VIEW_TRACKING,response.RESULT,null,searchBar.value.toUpperCase());
        setTable(searchBar.value.toUpperCase(), action_type);
    }, data);

}

function setFormEvents() {
    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
            REQUEST: _REQUEST.RECEIVE_DOC_USER,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            if (response.VALID) {
                notify('success', response.MESSAGE);
                if (rec_modal) {
                    rec_modal.style.display = "none";
                }
            } else {
                notify('error', response.MESSAGE);
            }
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector('input[type=submit]').disabled = true;

        const data = {
            REQUEST: _REQUEST.SEND_DOC_USER,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            console.log(response);
            if (response.VALID) {
                if (sent_modal != undefined) {
                    sent_modal.style.display = "none";
                }
                DOC_VIEW_BASIC.focus();
                notify("success", response.MESSAGE);

            } else {
                notify("error", response.MESSAGE);
                this.querySelector('input[type=submit]').disabled = false;
            }
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });

    FORM_DOC_CANCEL_R.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector("input[type=submit]").disabled = true;

        const data = {
            REQUEST: _REQUEST.CANCEL_RECEIVE,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            if (response.VALID) {
                DOC_VIEW_BASIC.focus();
                notify('success', response.MESSAGE);
                if (r_cnl_modal != undefined) {
                    r_cnl_modal.style.display = "none";
                }
            } else {
                notify('error', response.MESSAGE);
                this.querySelector("input[type=submit]").disabled = false;

            }
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });
    FORM_DOC_CANCEL_S.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector("input[type=submit]").disabled = true;
        const data = {
            REQUEST: _REQUEST.CANCEL_SEND,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            if (response.VALID) {
                DOC_VIEW_BASIC.focus();
                notify('success', response.MESSAGE);
                if (s_cnl_modal != undefined) {
                    s_cnl_modal.style.display = "none";
                }
            } else {
                notify('error', response.MESSAGE);
                this.querySelector("input[type=submit]").disabled = false;

            }
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });
    FORM_ATTACH_ADD.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector('input[type=submit]').disabled = true;

        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../SCRIPTS/FILE_UPLOAD.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.VALID) {
                    if (atc_submodal != undefined) {
                        atc_submodal.style.display = "none";
                        DOC_VIEW_BASIC.focus();
                        notify("success", response.MESSAGE);
                    }
                } else {
                    FORM_ATTACH_ADD.querySelector('input[type=submit]').disabled = false;
                }
                setTableAttachment();
            }
        };
        xhr.send(formData);
    });
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
// function setDOC_LOCATION() {

//     const data = {
//         REQUEST: _REQUEST.GET_SESSION_HRIS_ID,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (!error) {
//             if (response.VALID) {
//                 delete response.VALID;
//                 SEND_S_USER_ID.value = Object.values(response)[0];
//             }
//         } else {
//             alert(error)
//         }
//     }, data);
// }

function setAttachBtn(id, doc_num, route_num) {
    //set hidden inputs 
    ATTACH_DOC_NUM.value = doc_num;
    ATTACH_ROUTE_NUM.value = route_num;

    //update tbl
    setTableAttachment();

    //open attachment modal
    document.getElementById("atc_modal").style.display = "block";

}

function setTableAttachment() {
    const data = {
        REQUEST: _REQUEST.GET_TABLE_ATTACHMENT,
        WHERE: {
            AND: [
                { DOC_NUM: ATTACH_DOC_NUM.value },
                { ROUTE_NUM: ATTACH_ROUTE_NUM.value },
            ],
        }
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
            } else {
            }
            console.log(response);
            JsFunctions.updateAttachments(ATTACH_RESULTS, response.RESULT, null, ATTACH_ZOOM);
            // JsFunctions.updateTable(ATTACH_VIEW_MAIN, response.RESULT, response.BUTTONS, '');
        }
    }, data);
}

function getData(requestType, additionalData, successCallback, failureCallback) {
    const data = {
        REQUEST: requestType,
        ...additionalData
    };

    MyAjax.createJSON((error, response) => {
        if (error) {
            if (failureCallback) failureCallback(error);
            else alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                if (successCallback) successCallback(Object.values(response)[0]);
            } else {
                console.log(response);
                // Handle error response
            }
        }
    }, data);
}