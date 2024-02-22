class MyAjax {
    
    static createJSON(callback,data) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', "../../SCRIPTS/DOTS_API.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    callback(null, response);
                } else {
                    callback(`Error: ${xhr.status}`);
                }
            }
        };

        const jsonData = JSON.stringify(data);
        xhr.send(jsonData);
    }
    
}
export default MyAjax;