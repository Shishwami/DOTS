
import MyAjax from "../../SCRIPTS/MyAjax.js"
import JsFunctions from "../../SCRIPTS/JsFunctions.js"

const FORM_LOGIN = document.getElementById("FORM_LOGIN");

FORM_LOGIN.addEventListener('submit', function (e) {
    e.preventDefault();

    var data = JsFunctions.FormToJson(FORM_LOGIN);

    var columns = [
        DOTS_ACCOUNT_INFO.HRIS_ID,
        DOTS_ACCOUNT_INFO.FULL_NAME,
        DOTS_ACCOUNT_INFO.INITIAL,
    ]

    data = {
        ...data,
        TABLE_NAME: DOTS_ACCOUNT_INFO.NAME,
        REQUEST: _REQUEST.SELECT,
        COLUMNS: columns
    };

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                delete response.VALID;
                createSession(response);
            }
        } else {
            alert(error);
        }
    }, data);
});

function createSession(response) {
    const object = Object.values(response)[0];

    var data = {
        REQUEST: _REQUEST.CREATE_SESSION,
    }
    Object.assign(data, object[0]);

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                location.href = "../DOC_RECEIVE/DOC_RECEIVE.php";
            }
        } else {
            alert(error);
        }
    }, data);

}
