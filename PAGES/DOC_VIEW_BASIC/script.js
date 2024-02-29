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


setSession();
setFormEvents();
// setDOC_PURPOSEselect();
// setRECEIVED_TIME(SEND_DATE_TIME_SEND); move to send
// setDOC_LOCATION();
// getSessionDeptId();

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
}

function setReceiveBtn(id, doc_num, route_num) {
    console.log("btnpressed");

    //updateform
    RECEIVE_DOC_ID.value = id;
    RECEIVE_DOC_NUM.value = doc_num;
    RECEIVE_ROUTE_NUM.value = route_num;

    getData(_REQUEST.GET_DATE, { DATE: "DATE_TIME" }, (result) => {
        RECEIVE_DATE_TIME_RECEIVED.value = result;
    });
    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        RECEIVE_R_USER_ID.value = result;
    });
    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result) => {
        RECEIVE_R_DEPT_ID.value = result;
    });


    //open modal

}
function setSendBtn(id, doc_num, route_num) {
    //updateform
    SEND_DOC_ID.value = id;
    SEND_DOC_NUM.value = doc_num;
    SEND_ROUTE_NUM.value = route_num;


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

}
function setFormEvents() {
    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
            REQUEST: _REQUEST.RECEIVE_DOC_USER,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            console.log(response);
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
            REQUEST: _REQUEST.SEND_DOC_USER,
            DATA: JsFunctions.FormToJson(this),
        }

        MyAjax.createJSON((error, response) => {
            console.log(response);
            setTable(searchBar.value.toUpperCase(), action_type);
        }, data);

    });
    FORM_ATTACH_ADD.addEventListener('submit', function (e) {
        e.preventDefault();
        // var data = {
        //     REQUEST: _REQUEST.ATTACH_ADD,
        //     // ...JsFunctions.FormToJson(FORM_ATTACH_ADD),
        // }

        // var file = ATTACH_FILE.files[0];
        // var formData = new FormData();
        // formData.append('ATTACH_FILE', file);
        // console.log(ATTACH_FILE.value);
        // data['DATA'] = new FormData(this);
        // data['DATA'] = JSON.stringify(data['DATA']);
        // console.log(data);

        // MyAjax.createJSON((error, response) => {
        //     if (error) {
        //         alert(error);
        //     } else {
        //         if (response.VALID) {
        //         } else {
        //             //response valid=false
        //         }
        //     }
        // }, data);

        var file = ATTACH_FILE.files[0];
        var formData = new FormData(this);
        // formData.append('file', file);
        // formData.append('DOC_NUM', ATTACH_DOC_NUM.value);
        // formData.append('ROUTE_NUM', ATTACH_ROUTE_NUM.value);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../../SCRIPTS/FILE_UPLOAD.php', true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                setTableAttachment();
            }
        };
        xhr.send(formData);
    });

}
// function setRECEIVED_TIME(element) {
//     var data = {
//         REQUEST: _REQUEST.GET_DATE,
//         DATE: "DATE_TIME"
//     }

//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else {
//             if (response.VALID) {
//                 delete response.VALID;
//                 element.value = Object.values(response)[0];
//             } else {
//                 console.log(response);
//             }
//         }
//     }, data);
// }
// function setDOC_PURPOSEselect() {

//     var data = {
//         REQUEST: _REQUEST.GET_DOC_PRPS,
//     }

//     MyAjax.createJSON((error, response) => {
//         if (!error) {
//             if (response.VALID) {
//                 delete response.VALID;
//                 SEND_DOC_PRPS.innerHTML = Object.values(response)[0];
//             } else {
//             }
//         } else {

//         }
//     }, data);
// }
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
    ATTACH_DOC_NUM.value = doc_num;
    ATTACH_ROUTE_NUM.value = route_num;

    //update tbl
    setTableAttachment();

    //open attachment modal


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