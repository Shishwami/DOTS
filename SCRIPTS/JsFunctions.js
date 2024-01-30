class JsFunctions {
    static disableFormDefault(e) {
        e.preventDefault();
    }

    static disableFormButton(element) {
        element.disabled = true;
    }
    static enableFormButton(element) {
        element.disabled = false;
    }

    static clearInputText(element) {
        element.value = "";
    }
    
    static updateTable(tableJSON, thead, tbody, filter) {
        thead.innerHTML = '';
        tbody.innerHTML = '';

        if(tableJSON[0]==null){
            return
        }

        const keys = Object.keys(tableJSON[0]);
        keys.forEach(key => {
            const th = document.createElement('th');
            th.textContent = _SUB_NAME[key];
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
}

export default JsFunctions;