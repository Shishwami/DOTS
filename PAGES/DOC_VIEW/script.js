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

console.log(EDIT_ACTION_ID_2);
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
const ATTACH_ID = FORM_ATTACH_ADD.querySelector('#ATTACH_ID');
const ATTACH_FILE = document.getElementById("ATTACH_FILE");
const ATTACH_RESULTS = document.getElementById("ATTACH_RESULTS");
const ATTACH_DESC = FORM_ATTACH_ADD.querySelector("#ATTACH_DESCRIPTION");

const snd_modal = document.getElementById("snd_modal");
const atc_modal = document.getElementById("atc_modal");
const edt_modal = document.getElementById("edt_modal");
const crt_modal = document.getElementById("crt_modal");
const atc_submodal = document.getElementById("atc_submodal");

InitializePAGE();

function InitializePAGE() {

    //TODO too add in btn event listeners
    initializeSEND_FORM();
    initializeRECEIVE_FORM();
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

        if (document.getElementById("upload_preview") != undefined) {
            document.getElementById("upload_preview").remove();
        }

        //reset inputs
        ATTACH_DESC.value = "";
        FORM_ATTACH_ADD.querySelector('input[type=submit]').disabled = false;


        console.log("ASDADSADSADS");
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

}

function initializeSEND_FORM() {
    getData(_REQUEST.GET_DEPT, null, (result) => {
        JsFunctions.setSelect(SEND_R_DEPT_ID, result);
        SEND_R_DEPT_ID.addEventListener('change', () => {
            getData(_REQUEST.GET_ADDRESSEE, { "DEPT_ID": SEND_R_DEPT_ID.value }, (result2) => {
                SEND_DOC_ADDRESSEE.innerHTML = '<option disabled selected>Select Addressee</option>';
                JsFunctions.setSelect(SEND_DOC_ADDRESSEE, result2);
            }, null);
        });
    }, null);
    getData(_REQUEST.GET_DOC_PRPS, null, (result) => {
        JsFunctions.setSelect(SEND_DOC_PRPS, result);
    }, null);
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


}
function getData(requestType, additionalData, successCallback, failureCallback) {
    const data = {
        REQUEST: requestType,
        ...additionalData
    };

    MyAjax.createJSON((error, response) => {
        if (error) {
            if (failureCallback) failureCallback(error);
            else {
                // alert(error);
            }
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
            CREATE_DATE_TIME_RECEIVED.focus();
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
        CREATE_DOC_SUBJECT.value = '';
        CREATE_DOC_TYPE.value = '';
        CREATE_DOC_OFFICE.value = '';

        FORM_DOC_RECEIVE.querySelector('input[type=submit]').disabled = false;
    });
}
function sendBtnEvent(id, doc_num, route_num) {

    SEND_DOC_NUM.value = doc_num;
    SEND_ROUTE_NUM.value = route_num;

    // clearValues();
    SEND_DOC_ADDRESSEE.innerHTML = "<option disabled selected>Select Addressee</option>";

    getData(_REQUEST.GET_DATE, { 'DATE': 'DATE_TIME' }, (result) => {
        SEND_DATE_TIME_SENT.value = result;
        SEND_DATE_TIME_SENT.focus();
    }, null);

    getData(_REQUEST.GET_SESSION_DEPT_ID, null, (result) => {
        SEND_S_DEPT_ID.value = result;
    }, null);

    getData(_REQUEST.GET_SESSION_HRIS_ID, null, (result) => {
        SEND_S_USER_ID.value = result;
    }, null);



    if (snd_modal) {
        snd_modal.style.display = "block";
    }
    FORM_DOC_SEND.querySelector('input[type=submit]').disabled = false;
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
        FORM_DOC_EDIT.querySelector('input[type=submit]').disabled = false;

        if (edt_modal)
            edt_modal.style.display = "block";
        EDIT_DATE_TIME_RECEIVED.focus();

    }, data);
}
function setAttachBtn(id, doc_num, route_num) {
    ATTACH_ID.value = id;

    //update tbl
    setTableAttachment();

    //open attachment modal
    if (atc_modal)
        atc_modal.style.display = "block";

}

function setTrackingTable(id, doc_num, route_num) {
    const data = {
        REQUEST: _REQUEST.GET_TABLE_TRACKING,
        DATA: {
            DOC_NUM: doc_num,
            ROUTE_NUM: route_num
        }
    };

    MyAjax.createJSON((error, response) => {
        track_modal.style.display = "block";

        if (response.VALID) {
        } else {

        }
        JsFunctions.updateTable(DOC_VIEW_TRACKING, response.RESULT, null, searchBar.value.toUpperCase());
        setTable(searchBar.value.toUpperCase(), action_type);
    }, data);

}

function setTableAttachment() {
    const data = {
        REQUEST: _REQUEST.GET_TABLE_ATTACHMENT,
        DATA: {
            ID: ATTACH_ID.value
        }
    }

    MyAjax.createJSON((error, response) => {
        if (error) {

        } else {
            const prev = document.querySelector(".preview");
            if (prev) {
                if (response.VALID) {
                    prev.style.visibility = "visible";
                } else {
                    prev.style.visibility = "hidden";
                }
            }
            updateAttachments(ATTACH_RESULTS, response.RESULT, null, null);
        }
    }, data);
}
function setTable(filter) {

    const data2 = {
        REQUEST: _REQUEST.GET_TABLE_MAIN,
    };

    MyAjax.createJSON((error, response) => {
        if (error) {
        } else {
            if (response.VALID) {
            } else {
            }
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
    table.querySelectorAll('.btnT').forEach(function (button) {
        button.addEventListener('mousedown', function () {
            setTrackingTable(this.dataset.i, this.dataset.d, this.dataset.r);
        });
    });
}
function setForms() {
    FORM_DOC_SEND.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector('input[type=submit]').disabled = true;

        var data = JsFunctions.FormToJson(FORM_DOC_SEND);
        var routedCheck = {
            REQUEST: _REQUEST.SEND_DOC_FORM,
            DATA: data,
        }
        MyAjax.createJSON((error, response) => {
            if (error) {
                notify("error", "SERVER CONNECTION ERROR");

            } else {
                if (response.VALID) {
                    FORM_DOC_SEND.reset();
                    if (snd_modal != undefined) {
                        snd_modal.style.display = "none";
                    }
                    DOC_VIEW_MAIN.focus();
                    notify("success", response.MESSAGE);

                } else {
                    notify("error", response.MESSAGE);
                    this.querySelector('input[type=submit]').disabled = false;
                }
            }
            setTable(searchBar.value.toUpperCase());
        }, routedCheck);
    });

    FORM_DOC_RECEIVE.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector('input[type=submit]').disabled = true;

        var data = {
            REQUEST: _REQUEST.RECEIVE_DOC,
            DATA: JsFunctions.FormToJson(FORM_DOC_RECEIVE),
        }

        MyAjax.createJSON((error, response) => {
            if (error) {
                notify("error", "SERVER CONNECTION ERROR");
            } else {
                if (response.VALID) {
                    FORM_DOC_RECEIVE.reset();
                    if (crt_modal != undefined) {
                        crt_modal.style.display = "none";
                    }
                    notify("success", response.MESSAGE);

                } else {
                    notify("error", response.MESSAGE);
                    this.querySelector('input[type=submit]').disabled = false;
                }
            }
            setTable(searchBar.value.toUpperCase());
        }, data);
    });
    FORM_DOC_EDIT.addEventListener('submit', function (e) {
        e.preventDefault();
        this.querySelector('input[type=submit]').disabled = true;

        var data = {
            REQUEST: _REQUEST.EDIT_DOCUMENT,
            DATA: JsFunctions.FormToJson(FORM_DOC_EDIT),
        }

        console.log(data);

        MyAjax.createJSON((error, response) => {
            if (error) {
                notify("error", "SERVER CONNECTION ERROR");
            } else {
                if (response.VALID) {
                    FORM_DOC_EDIT.reset();
                    if (edt_modal != undefined) {
                        edt_modal.style.display = "none";
                        DOC_VIEW_MAIN.focus();
                        notify("success", response.MESSAGE);
                    }
                } else {
                    notify("error", response.MESSAGE);
                    FORM_DOC_EDIT.querySelector('input[type=submit]').disabled = false;
                }
            }
            setTable(searchBar.value.toUpperCase());
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
                        DOC_VIEW_MAIN.focus();
                        notify("success", response.MESSAGE);
                    }
                } else {
                    notify("error", response.MESSAGE);
                    FORM_ATTACH_ADD.querySelector('input[type=submit]').disabled = false;
                }
                setTableAttachment();
            }
        };
        xhr.send(formData);
    });
}

function updateAttachments(mini, results, buttons) {
    console.log(results);
    mini.innerHTML = '';
    Object.entries(results).forEach(([key, item]) => {
        const doc = document.createElement("div");
        doc.innerText = item['DESCRIPTION'];
        doc.className = "ATTACH_MINI";
        doc.addEventListener('click', function () {
            console.log(item.ID);
            getData(_REQUEST.GET_ATTACHMENT, { ID: item.ID }, (result) => {
                const url = "../../"+result;
                window.location.href = "../../RESOURCES/pdfJS/web/viewer.html?file="+url;
            }, null);
            // const fileLoc = "";
        });

        // doc.addEventListener('mouseout', function () {
        //     preview.style.backgroundImage = "";
        // });
        mini.appendChild(doc);
    });
}