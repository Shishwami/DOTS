import MyAjax from "../../SCRIPTS/MyAjax.js";
import JsFunctions from "../../SCRIPTS/JsFunctions.js";

const searchBar = document.getElementById("searchBar");
const DOC_VIEW_TRACKING = document.getElementById("DOC_VIEW_TRACKING");

setTable("");

setInterval(() => {
    setTable(searchBar.value.toUpperCase());
}, 5000);

searchBar.addEventListener('input', function () {
    setTable(searchBar.value.toUpperCase());
});

function setTable(filter) {

    var data = {
        REQUEST: _REQUEST.GET_TABLE_TRACKING,
    };

    MyAjax.createJSON((error, response) => {
        console.log(response);
        JsFunctions.updateTable(DOC_VIEW_TRACKING, response.RESULT, null, filter);
    }, data);

}


