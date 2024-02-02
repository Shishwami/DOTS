class JsFunctions {
    static disableFormDefault(e) {
        e.preventDefault();
    }

    static disableElement(element) {
        element.disabled = true;
    }
    static enableElement(element) {
        element.disabled = false;
    }

    static clearInputText(element) {
        element.value = "";
    }

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
        form.addEventListener("submit", function (event) {
            event.preventDefault(); 
            var formData = new FormData(form); 
            var formDataObject = {};
            formData.forEach(function (value, key) {
                formDataObject[key] = value;
            });

            var jsonData = JSON.stringify(formDataObject); 

            console.log(jsonData); 
        });
    }
}

export default JsFunctions;