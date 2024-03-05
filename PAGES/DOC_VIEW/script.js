import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";


//Search Bar
const searchBar = document.getElementById("searchBar");
//Table
const DOC_VIEW_MAIN = document.getElementById("DOC_VIEW_MAIN");
const ATTACH_VIEW_MAIN = document.getElementById("ATTACH_VIEW_MAIN");
//buttons
const BTN_DOC_CREATE = document.getElementById("BTN_DOC_CREATE");
const BTN_ATTACH_ADD = document.getElementById("BTN_ATTACH_ADD");
const BTN_ATTACH_INS = document.getElementById("BTN_ATTACH_INS");
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
//edit form
const FORM_DOC_EDIT = document.getElementById("FORM_DOC_EDIT");
const EDIT_DATE_TIME_RECEIVED = FORM_DOC_EDIT.querySelector("#EDIT_DATE_TIME_RECEIVED");
const EDIT_DOC_ID = FORM_DOC_EDIT.querySelector("#EDIT_DOC_ID");
const EDIT_LETTER_DATE = FORM_DOC_EDIT.querySelector("#EDIT_LETTER_DATE");
const EDIT_DOC_TYPE = FORM_DOC_EDIT.querySelector("#EDIT_DOC_TYPE");
const EDIT_DOC_OFFICE = FORM_DOC_EDIT.querySelector("#EDIT_DOC_OFFICE");
const EDIT_DOC_SUBJECT = FORM_DOC_EDIT.querySelector("#EDIT_DOC_SUBJECT");
const EDIT_DOC_STATUS = FORM_DOC_EDIT.querySelector("#EDIT_DOC_STATUS");
const EDIT_R_USER_ID = FORM_DOC_EDIT.querySelector("#EDIT_R_USER_ID");
const EDIT_R_DEPT_ID = FORM_DOC_EDIT.querySelector("#EDIT_R_DEPT_ID");
const EDIT_ACTION_ID_2 = FORM_DOC_EDIT.querySelector("#EDIT_ACTION_ID_2");
const EDIT_ACTION_ID_3 = FORM_DOC_EDIT.querySelector("#EDIT_ACTION_ID_3");
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

const FORM_ATTACH_ADD = document.getElementById("FORM_ATTACH_ADD");
const ATTACH_DOC_NUM = FORM_ATTACH_ADD.querySelector('#ATTACH_DOC_NUM');
const ATTACH_ROUTE_NUM = FORM_ATTACH_ADD.querySelector('#ATTACH_ROUTE_NUM');
const ATTACH_FILE = document.getElementById("ATTACH_FILE");
const ATTACH_RESULTS = document.getElementById("ATTACH_RESULTS");
const ATTACH_ZOOM = document.getElementById("ATTACH_ZOOM");

const snd_modal = document.getElementById("snd_modal");
const atc_modal = document.getElementById("atc_modal");
const edt_modal = document.getElementById("edt_modal");

InitializePAGE();

function InitializePAGE() {

    //TODO too add in btn event listeners
    initializeSEND_FORM();
    initializeRECEIVE_FORM();
    // getSessionDeptId();
    setCreateBtn();
    setTable("");

    searchBar.addEventListener('input', function () {
        setTable(searchBar.value.toUpperCase());
    });

    setInterval(function () {
        setTable(searchBar.value.toUpperCase());
    }, _RESET_TIME);


    setForms();

    BTN_ATTACH_ADD.addEventListener("click", function () {
        ATTACH_FILE.value = null;
        console.log("ASDADSADSADS");
    });

    //TO BE REMOVED
    if (BTN_ATTACH_INS)
        BTN_ATTACH_INS.addEventListener("click", function () {

            console.log("ASDADSADSADS");
        });
}

function initializeSEND_FORM() {
    // setR_DEPT_ID();
    getData(_REQUEST.GET_DEPT, null, (result) => {
        JsFunctions.setSelect(SEND_R_DEPT_ID, result);
        SEND_R_DEPT_ID.addEventListener('change', () => {
            getData(_REQUEST.GET_ADDRESSEE, { "DEPT_ID": SEND_R_DEPT_ID.value }, (result2) => {
                SEND_DOC_ADDRESSEE.innerHTML = '<option disabled selected>Select Addressee</option>';
                JsFunctions.setSelect(SEND_DOC_ADDRESSEE, result2);
            }, null);
        });
    }, null);
    // setDOC_PURPOSE();
    getData(_REQUEST.GET_DOC_PRPS, null, (result) => {
        JsFunctions.setSelect(SEND_DOC_PRPS, result);
    }, null);
    // setDOC_LOCATION();
    // setRECEIVED_TIME(SEND_DATE_TIME_SENT);
}

function initializeRECEIVE_FORM() {

    setInterval(() => {
        getData(_REQUEST.GET_DOC_NUM, null, (result) => {
            CREATE_DOC_NUM.value = result;
        }, null);
    }, 1000);

    getData(_REQUEST.GET_DOC_TYPE, null, (result) => {
        JsFunctions.setSelect(CREATE_DOC_TYPE, result);
        JsFunctions.setSelect(EDIT_DOC_TYPE, result);
    }, null);
    getData(_REQUEST.GET_DOC_OFFICE, null, (result) => {
        JsFunctions.setSelect(CREATE_DOC_OFFICE, result);
        JsFunctions.setSelect(EDIT_DOC_OFFICE, result);
    }, null);
    getData(_REQUEST.GET_SESSION_NAME, null, (result) => {
        CREATE_FULLNAME.value = result;
    }, null);
    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        CREATE_R_USER_ID.value = result;
    }, null);
    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result) => {
        CREATE_R_DEPT_ID.value = result;
    }, null);

}
// function setR_DEPT_ID() {
//     SEND_R_DEPT_ID.addEventListener('change', function (e) {
//         setADDRESSEE(this.value);
//     });

//     const data = {
//         REQUEST: _REQUEST.GET_DEPT
//     }

//     MyAjax.createJSON((error, response) => {
//         if (!error) {
//             if (response.VALID) {
//                 delete response.VALID;
//                 var object = Object.values(response)[0];
//                 SEND_R_DEPT_ID.innerHTML = object;
//             } else {
//                 alert(error);
//             }
//         } else {
//             alert(error);
//         }
//     }, data);
// }
// function setDOC_OFFICE() {

//     var data = {
//         REQUEST: _REQUEST.GET_DOC_OFFICE,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             return alert(error);
//         }
//         if (response.VALID) {
//             delete response.VALID;
//             CREATE_DOC_OFFICE.innerHTML = Object.values(response)[0];
//         }
//     }, data);
// }
// function setDOC_NUM() {
//     const data = {
//         REQUEST: _REQUEST.GET_DOC_NUM
//     }
//     MyAjax.createJSON((error, response) => {
//         if (!error && response.VALID) {
//             delete response.VALID;
//             const docNumber = Object.values(response)[0];
//             CREATE_DOC_NUM.value = docNumber;
//         } else {
//             alert(error || "Error occurred while retrieving document number.");
//         }
//     }, data);
// }
// function setDOC_TYPE() {
//     const data = {
//         REQUEST: _REQUEST.GET_DOC_TYPE,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else if (response.VALID) {
//             delete response.VALID;
//             CREATE_DOC_TYPE.innerHTML = Object.values(response)[0];
//         }
//     }, data);
// }
// function setRECEIVED_TIME(element) {
//     var data = {
//         REQUEST: _REQUEST.GET_DATE,
//         DATE: "DATE_TIME"
//     }

//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else if (response.VALID) {
//             delete response.VALID;
//             element.value = Object.values(response)[0];
//         }
//     }, data);

// }
// function setLETTER_DATE() {
//     var data = {
//         REQUEST: _REQUEST.GET_DATE,
//         DATE: "DATE"
//     }

//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else {
//             if (response.VALID) {
//                 delete response.VALID;
//                 CREATE_LETTER_DATE.value = Object.values(response)[0];
//             } else {
//             }
//         }
//     }, data);
// }
// function getSessionName() {
//     const data = {
//         REQUEST: _REQUEST.GET_SESSION_NAME,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else {
//             if (response.VALID
//             ) {
//                 delete response.VALID;
//                 var name = Object.values(response)[0];
//                 CREATE_FULLNAME.value = name;
//                 sessionStorage.setItem(DOTS_ACCOUNT_INFO.FULL_NAME, name);
//             } else {
//                 //error message
//             }
//         }
//     }, data);
// }
// function getSessionHrisId() {
//     const data = {
//         REQUEST: _REQUEST.GET_SESSION_HRIS_ID,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             alert(error);
//         } else {
//             if (response.VALID) {
//                 delete response.VALID;
//                 var id = Object.values(response)[0];
//                 CREATE_R_USER_ID.value = id;
//                 sessionStorage.setItem(DOTS_ACCOUNT_INFO.HRIS_ID, id);
//             } else {
//                 //error message
//             }
//         }
//     }, data);
// }
// function getSessionDeptId() {
//     const data = {
//         REQUEST: _REQUEST.GET_SESSION_DEPT_ID,
//     }
//     MyAjax.createJSON((error, response) => {
//         if (error) {
//             return alert(error);
//         }

//         if (response.VALID) {
//             delete response.VALID;
//             var dept_id = Object.values(response)[0];
//             CREATE_R_DEPT_ID.value = dept_id;
//             SEND_S_DEPT_ID.value = dept_id;
//             sessionStorage.setItem(DOTS_ACCOUNT_INFO.DEPT_ID, dept_id);
//         }
//     }, data);
// }
// function setDOC_PURPOSE() {
//     var data = {
//         REQUEST: _REQUEST.GET_DOC_PRPS,
//     }

//     MyAjax.createJSON((error, response) => {
//         if (!error) {
//             if (response.VALID) {
//                 delete response.VALID;
//                 var object = Object.values(response)[0];
//                 SEND_DOC_PRPS.innerHTML = object;
//             } else {
//             }
//         } else {

//         }
//     }, data);
// }
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
                // console.log(response);
                // Handle error response
            }
        }
    }, data);
}
function setCreateBtn() {
    BTN_DOC_CREATE.addEventListener('click', function (event) {

        getData(_REQUEST.GET_DATE, { 'DATE': 'DATE' }, (result) => {
            CREATE_LETTER_DATE.value = result;
        }, null);

        getData(_REQUEST.GET_DATE, { 'DATE': 'DATE_TIME' }, (result) => {
            CREATE_DATE_TIME_RECEIVED.value = result;
        }, null);

        CREATE_DOC_SUBJECT.value = '';
        CREATE_DOC_TYPE.value = '';
        CREATE_DOC_OFFICE.value = '';
    });
}
function sendBtnEvent(id, doc_num, route_num) {

    clearValues();

    SEND_DOC_ADDRESSEE.innerHTML = "<option disabled selected>Select Addressee</option>";

    getData(_REQUEST.GET_DATE, { 'DATE': 'DATE_TIME' }, (result) => {
        SEND_DATE_TIME_SENT.value = result;
    }, null);

    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result) => {
        SEND_S_DEPT_ID.value = result;
    }, null);

    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        SEND_S_USER_ID.value = result;
    }, null);

    SEND_DOC_NUM.value = doc_num;
    SEND_ROUTE_NUM.value = route_num;

    if (snd_modal)
        snd_modal.style.display = "block";
}
function clearValues() {
    SEND_DOC_PRPS.value = "";
    SEND_R_DEPT_ID.value = "";
    SEND_DOC_NOTES.value = "";
    SEND_DOC_ADDRESSEE.value = "";
}
function setEditBtn(id, doc_num, route_num) {
    const data = {
        'REQUEST': _REQUEST.GET_DOCUMENT,
        'DATA': {
            'ID': id,
            'DOC_NUM': doc_num,
            'ROUTE_NUM': route_num,
        }
    };

    if (edt_modal)
        edt_modal.style.display = "block";

    MyAjax.createJSON((error, response) => {
        EDIT_DOC_ID.value = response['ID'];
        EDIT_DATE_TIME_RECEIVED.value = response['DATE_TIME_RECEIVED'];
        EDIT_LETTER_DATE.value = response['LETTER_DATE'];
        EDIT_DOC_TYPE.value = response['DOC_TYPE_ID'];
        EDIT_DOC_OFFICE.value = response['S_OFFICE_ID'];
        EDIT_DOC_SUBJECT.value = response['DOC_SUBJECT'];


        if (response['ACTION_ID'] == 2) {
            EDIT_ACTION_ID_2.checked = true;
        } else if (response['ACTION_ID'] == 3) {
            EDIT_ACTION_ID_3.checked = true;
        }

    }, data);
}
function setAttachBtn(id, doc_num, route_num) {
    ATTACH_DOC_NUM.value = doc_num;
    ATTACH_ROUTE_NUM.value = route_num;

    //update tbl
    setTableAttachment();

    //open attachment modal
    if (atc_modal)
        atc_modal.style.display = "block";

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
            const prev = document.querySelector(".preview");
            if (prev) {
                if (response.VALID) {
                    prev.style.visibility = "visible";

                } else {
                    prev.style.visibility = "hidden";

                }
            }
            console.log(response);
            JsFunctions.updateAttachments(ATTACH_RESULTS, response.RESULT, null, ATTACH_ZOOM);
            // JsFunctions.updateTable(ATTACH_VIEW_MAIN, response.RESULT, response.BUTTONS, '');
        }
    }, data);
}
// function setADDRESSEE(DEPT_ID) {

//     resetAddressee();

//     const data = {
//         REQUEST: _REQUEST.GET_ADDRESSEE,
//         DEPT_ID: DEPT_ID
//     }

//     MyAjax.createJSON((error, response) => {
//         if (!error) {
//             if (response.VALID) {
//                 delete response.VALID;
//                 var object = Object.values(response)[0];
//                 SEND_DOC_ADDRESSEE.innerHTML = object;
//             } else {
//             }
//         } else {
//             alert(error);
//         }
//     }, data);

// }
// function resetAddressee() {
//     SEND_DOC_ADDRESSEE.innerHTML = "<option disabled selected>Select Addressee</option>";
// }
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
            // const thead = DOC_VIEW_MAIN.querySelector('thead');
            // const tbody = DOC_VIEW_MAIN.querySelector('tbody');
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
            JsFunctions.updateTable(DOC_VIEW_MAIN, response.RESULT, response.BUTTONS, filter);
            setButtons(DOC_VIEW_MAIN);

        }
    }, data2);
}
function setButtons(table) {
    table.querySelectorAll('.btnS').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            sendBtnEvent(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });

    table.querySelectorAll('.btnE').forEach(function (button) {
        button.addEventListener('click', function () {
            setEditBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });

    table.querySelectorAll('.btnA').forEach(function (button) {
        button.addEventListener('click', function () {
            setAttachBtn(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
}
function setForms() {
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = JsFunctions.FormToJson(FORM_DOC_SEND);
        var routedCheck = {
            REQUEST: _REQUEST.SEND_DOC_FORM,
            DATA: data,
        }
        MyAjax.createJSON((error, response) => {
            console.log(response);
            setTable(searchBar.value.toUpperCase());
        }, routedCheck);
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
            setTable(searchBar.value.toUpperCase());
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

    FORM_DOC_EDIT.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = {
            REQUEST: _REQUEST.EDIT_DOCUMENT,
            DATA: JsFunctions.FormToJson(FORM_DOC_EDIT),
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
            setTable(searchBar.value.toUpperCase());
        }, data);
    });

}