

class JsFunctions {
    static disableFormDefault(e) {
        e.preventDefault();
    }

    static disableFormButton(element) {
        element.disabled = true;
    }
    static updateTable(tableJSON, thead, tbody) {


        const keys = Object.keys(tableJSON[0]);
        keys.forEach(key => {
            const th = document.createElement('th');
            th.textContent = key;
            thead.appendChild(th);
        });
        tableJSON.forEach(item => {
            // Create a new row
            const row = document.createElement('tr');

            // Populate the row with data from each object
            Object.values(item).forEach(value => {
                const cell = document.createElement('td');
                cell.textContent = value;
                row.appendChild(cell);
            });

            // Append the row to the table body
            tbody.appendChild(row);
        });
    }
}

export default JsFunctions;