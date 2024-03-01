const searchBar = document.getElementById("searchBar");

const DOC_VIEW_TRACKING=document.getElementById("DOC_VIEW_TRACKING");






function setTable(filter){
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


