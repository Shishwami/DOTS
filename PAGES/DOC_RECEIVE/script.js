import JsFunctions from "../../SCRIPTS/JsFunctions.js";
import MyAjax from "../../SCRIPTS/MyAjax.js";

setDOC_NUM();
setInterval(setDOC_NUM, _RESET_TIME);

setDOC_TYPE();
setDOC_OFFICE();

setRECEIVED_TIME();
setLETTER_DATE();

getSessionName();

FORM_RECEIVE.addEventListener('submit', function (e) {
    e.preventDefault();

    const data2 = {
        REQUEST: _REQUEST.GET_SESSION_ID,
    }
    var vals = JsFunctions.FormToJson(FORM_RECEIVE);
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

function setDOC_NUM() {

    const columns = [
        DOTS_DOCUMENT.DOC_NUM,
    ]

    var data = {
        TABLE: DOTS_DOCUMENT.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns,
    }

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                const doc_numbers = Object.values(response)[0];
                const last_obj = doc_numbers[doc_numbers.length - 1];
                const last_number = Object.values(last_obj)[0];
                const number_increased = Number(last_number) + 1;
                DOC_NUM.value = number_increased;
            } else {
                console.log(response);
                DOC_NUM.value = 0;
            }
        }
    }, data);
}

function setDOC_TYPE() {

    const columns = [
        DOTS_DOC_TYPE.ID,
        DOTS_DOC_TYPE.DOC_TYPE_NAME,
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
                JsFunctions.setSelect(DOC_TYPE, Object.values(response)[0]);
            } else {
                console.log(response);
            }
        }
    }, data);
}

function setDOC_OFFICE() {

    const columns = [
        DOTS_DOC_OFFICE.ID,
        DOTS_DOC_OFFICE.DOC_OFFICE_NAME,
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
                DATE_TIME_RECEIVED.value = Object.values(response)[0];
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
                LETTER_DATE.value = Object.values(response)[0];
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
    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {
            if (response.VALID) {
                delete response.VALID;
                FULLNAME.value = Object.values(response)[0];
            } else {
                console.log(response);
                //error message
            }
        }
    }, data);
}
