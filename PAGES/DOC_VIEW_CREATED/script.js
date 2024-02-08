import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setDOC_PURPOSE();
setDOC_DIVISION();
setDOC_LOCATION();
setButtonEvents();

setTable("");
searchBar.addEventListener('input', function (e) {
    setTable(searchBar.value.toUpperCase());
});

setInterval(function () {
    setTable(searchBar.value.toUpperCase());
}, _RESET_TIME);

const TBODY = DOC_VIEW_MAIN.querySelector("tbody");
JsFunctions.tbodyEventListener(TBODY);

FORM_DOC_SEND.addEventListener('submit', function (e) {
    e.preventDefault();

    var data = JsFunctions.FormToJson(this);
    data['DOC_DIVISION'] = DOC_DIVISION.value;
    data['DOC_ADDRESSEE'] = DOC_ADDRESSEE.value;

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

function setTable(filter) {

    const columns = [
        'DOC_NUM',
        'DOC_SUBJECT',
        'LETTER_DATE',
        'DOC_OFFICE',
        DOTS_DOC_TYPE.NAME + '.' + DOTS_DOC_TYPE.DOC_TYPE_NAME,
        DOTS_ACCOUNT_INFO.NAME + '.' + DOTS_ACCOUNT_INFO.FULL_NAME,
        'DATE_TIME_RECEIVED',
        DOTS_DOC_STATUS.NAME + '.' + DOTS_DOC_STATUS.DOC_STATUS_NAME,
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
                    DOTS_DOCUMENT.NAME + "." + DOTS_DOCUMENT.RECEIVED_BY
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
function setDOC_PURPOSE() {

    var columns = [
        DOTS_DOC_PRPS.ID,
        DOTS_DOC_PRPS.DOC_PRPS_NAME,
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
                JsFunctions.setSelect(DOC_PRPS, object);
            } else {
            }
        } else {

        }
    }, data);
}
function setDOC_DIVISION() {

    DOC_DIVISION.addEventListener('change', function (e) {
        setADDRESSEE(this.value);
    });

    var columns = [
        DOTS_DOC_DIVISION.ID,
        DOTS_DOC_DIVISION.DOC_DIVISION_NAME,
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
                JsFunctions.setSelect(DOC_DIVISION, object);
            } else {
                alert(error);
            }
        } else {
            alert(error);
        }
    }, data);
}
function setADDRESSEE(DIVISION_ID) {

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
            DIVISION: DIVISION_ID,
        },
    }

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                var object = Object.values(response)[0];
                JsFunctions.setSelect(DOC_ADDRESSEE, object);
            } else {
            }
        } else {
            alert(error);
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
                DOC_LOCATION.value = Object.values(response)[0];
            }
        } else {
            alert(error)
        }
    }, data);
}
function setButtonEvents() {
    DOC_SEND.addEventListener('click', function (e) {

        clearValues();
        resetAddressee();

        const doc_num = sessionStorage.getItem("TEMP_DATA");
        sessionStorage.clear("TEMP_DATA");

        if (doc_num != null) {
            DOC_NUM.value = doc_num;
        } else {
            alert("Please Select A Document");
        }
    });

    function clearValues() {
        DOC_PRPS.value = "";
        DOC_DIVISION.value = "";
        DOC_NOTES.value = "";
        DOC_ADDRESSEE.value = "";


    }
}
function resetAddressee() {
    const blankOption = document.createElement('option');
    blankOption.innerText = "Please Select Addressee";
    blankOption.disabled = true;
    blankOption.selected = true;
    blankOption.value = "";

    DOC_ADDRESSEE.innerHTML = "";
    DOC_ADDRESSEE.append(blankOption);
}

