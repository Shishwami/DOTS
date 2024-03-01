const searchBar = document.getElementById("searchBar");

const DOC_VIEW_TRACKING = document.getElementById("DOC_VIEW_TRACKING");






function setTable(filter) {

    var data = {

    };

    MyAjax.createJSON((error, response) => {
        JsFunctions.updateTable(DOC_VIEW_TRACKING, response.RESULT, null, filter);
    }, data);

}


