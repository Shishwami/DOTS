
import MyAjax from "../../SCRIPTS/MyAjax.js"
import JsFunctions from "../../SCRIPTS/JsFunctions.js"

const FORM_LOGIN = document.getElementById("FORM_LOGIN");

FORM_LOGIN.addEventListener('submit', function (e) {
    e.preventDefault();

    var data = JsFunctions.FormToJson(FORM_LOGIN);

    var data2 = {
        REQUEST: _REQUEST.USER_LOGIN,
        WHERE: data,
    };

    MyAjax.createJSON((error, response) => {
        if (!error) {
            if (response.VALID) {
                notify('success',response.MESSAGE);
            } else {
                notify('error',response.MESSAGE);
            }
        } else {
            alert(error);
        }

        console.log(response);

    }, data2);
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
