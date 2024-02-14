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
            if (key == 'ID') {
                th.style.display = "none";
            }

            thead.appendChild(th);
        });

        tableJSON.forEach(item => {
            const row = document.createElement('tr');
            var found = 0;
            var rowID = {};

            Object.entries(item).forEach(([key, value]) => {
                const cell = document.createElement('td');
                var final_value = value;

                // cell.dataset.keys = key;
                // cell.dataset.value = value;

                row.appendChild(cell);
                if (key == 'DATE_TIME_RECEIVED') {
                    const date = new Date(value);
                    final_value = this.formatDateTime(date);
                }
                if (key == 'LETTER_DATE') {
                    const date = new Date(value);
                    final_value = this.formatDate(date);
                }
                if (key == 'DOC_NUM') {
                    rowID[key] = value;
                }
                if (key == 'ID') {
                    rowID[key] = value;
                    cell.style.display = "none";
                }
                if (final_value == null) {
                    final_value = "";
                }
                if (final_value.toUpperCase().indexOf(filter) > -1) {
                    found++;
                }

                cell.textContent = final_value;

            });

            row.addEventListener('click', function () {
                const STRINGrowID = JSON.stringify(rowID);
                console.log(rowID);
                sessionStorage.setItem('TEMP_DATA', STRINGrowID);
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
            if (values[i] == "" || values[i] == null) {
                empty = true;
            }
        }
        return empty;
    }

    static formatDateTime(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
    }

    static formatDate(date) {
        return (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
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