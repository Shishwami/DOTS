const searchBar = document.getElementById("searchBar");

const DOC_VIEW_TRACKING=document.getElementById("DOC_VIEW_TRACKING");






function setTable(filter){


    console.log(data);

    MyAjax.createJSON((error, response) => {
        if (error) {
            alert(error);
        } else {

        }
        JsFunctions.updateTable(DOC_VIEW_BASIC, response.RESULT, response.BUTTONS, filter);
        setButtons(DOC_VIEW_BASIC);
    }, data);

}


