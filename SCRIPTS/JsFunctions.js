class JsFunctions {

    static updateTable(tableJSON, table, filter) {

        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');

        thead.innerHTML = '';
        tbody.innerHTML = '';

        if (tableJSON[0] == null) {
            return
        }

        const keys = Object.keys(tableJSON[0]);
        keys.forEach(key => {
            const th = document.createElement('th');
            if (_SUB_NAME[key] == null) {
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

                if (value != null) {
                    value = "NULL";
                }

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

        for (let i = 0; i < options.length; i++) {
            var option = document.createElement('option');
            var somedata = Object.values(options[i]);

            option.value = somedata[0];
            option.innerText = somedata[1];

            element.appendChild(option);
        }
    }
    static checkIfEmpty(values) {
        var empty = false;
        for (let i = 0; i < values.length; i++) {
            if (values[i] == "") {
                empty = true;
            }
        }
        return empty;
    }

    static tbodyEventListener(tbody) {
        tbody.addEventListener('click', function (e) {
            var target = e.target.closest('tr');

            if (target != null) {
                var firstTdValue = target.querySelector('td:first-child').dataset.value;
                sessionStorage.setItem("TEMP_DATA", firstTdValue);
            }

        });
    }
}

export default JsFunctions;