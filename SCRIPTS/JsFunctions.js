class JsFunctions {

    static updateTable(tableJSON, thead, tbody, filter) {
        thead.innerHTML = '';
        tbody.innerHTML = '';

        if (tableJSON[0] == null) {
            return
        }

        const keys = Object.keys(tableJSON[0]);
        keys.forEach(key => {
            const th = document.createElement('th');


            if (_SUB_NAME[key] == "") {
                th.textContent = key;
            } else {
                th.textContent = _SUB_NAME[key];
            }

            thead.appendChild(th);
        });

        tableJSON.forEach(item => {
            const row = document.createElement('tr');
            let found = 0;

            Object.entries(item).forEach(([key, value]) => {
                const cell = document.createElement('td');
                cell.textContent = value;
                cell.dataset.keys = key;
                cell.dataset.value = value;
                row.appendChild(cell);

                if (value.toUpperCase().indexOf(filter) > -1) {
                    found++;
                }
            });

            if (found == 0) {
                row.style.display = "none";
            }

            tbody.appendChild(row);
        });
    }

    static FormToJson(form) {
        var formData = new FormData(form);
        var formDataObject = {};
        formData.forEach(function (value, key) {
            formDataObject[key] = value;
        });

        // console.log(formDataObject); 
        return formDataObject;
    }

    static setSelect(element, options) {

        options.forEach(function (item) {
            var option = document.createElement('option');

            Object.keys(item).forEach(function (key) {
                option.value = item[key];
                option.innerText = item[key];
            });

            element.appendChild(option);
        });
    }
}

export default JsFunctions;