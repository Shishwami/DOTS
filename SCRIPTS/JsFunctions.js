

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
    static updateTable(tableJSON, thead, tbody) {
        thead.innerHTML = '';
        tbody.innerHTML = '';

        const keys = Object.keys(tableJSON[0]);
        keys.forEach(key => {
            const th = document.createElement('th');
            th.textContent = _SUB_NAME[key];
            thead.appendChild(th);
        });
        tableJSON.forEach(item => {
            // Create a new row
            const row = document.createElement('tr');

            // Populate the row with data from each object
            Object.entries(item).forEach(([key, value]) => {
                const cell = document.createElement('td');
                cell.textContent = value;
                cell.dataset.keys = key; // Set dataset key
                cell.dataset.value = value; // Set dataset value
                row.appendChild(cell);
            });

            // Append the row to the table body
            tbody.appendChild(row);
        });
    }
}

export default JsFunctions;