class JsFunctions {

    /**
    * Updates the content of a table with new data.
    * @param {Element} table - The table element to update.
    * @param {Array} results - An array of objects containing the data to populate the table.
    * @param {Array} buttons - An array of objects representing buttons to include in each row.
    * @param {string} filter - A string used to filter rows based on their content.
    */
    static updateTable(table, results, buttons, filter) {
        const tbody = table.querySelector('tbody'); // Reference to the table body element
        const thead = table.querySelector('thead'); // Reference to the table header element

        tbody.innerHTML = ''; // Clear the table body
        thead.innerHTML = ''; // Clear the table header

        if (Object.keys(results).length == 0) {
            return; // If there are no results, exit the function
        }

        // Create table header row
        const theadrow = document.createElement('tr');
        if (buttons != undefined) {
            // If buttons are provided, create a header cell for them
            const buttonHeaderCell = document.createElement('th');
            theadrow.appendChild(buttonHeaderCell);
        }
        // Create header cells for each column in the results
        Object.entries(results[0]).forEach(([key, value]) => {
            if (key !== 'ID' && key !== 'DOC_NUM' && key !== 'ROUTE_NUM') {
                const headerCell = document.createElement('th');
                headerCell.textContent = key;
                theadrow.appendChild(headerCell);
            }
        });

        thead.appendChild(theadrow); // Add the header row to the table header

        // Loop through each result item and create table rows
        Object.entries(results).forEach(([key, item]) => {
            const row = document.createElement('tr'); // Create a table row for each result item
            var found = 0; // Variable to track if filter text is found in the row

            if (buttons != undefined) {
                // If buttons are provided, create a cell for them
                const buttonCell = document.createElement('td');
                const div = document.createElement('div');
                div.className = "btn_container";

                buttons.forEach(btn => {
                    // Create button element for each button provided
                    const button = document.createElement('button');
                    button.classList.add(btn.className); // Add CSS class to the button
                    button.title = btn.title; // Set the tooltip title for the button
                    button.dataset.i = item.ID;
                    button.dataset.d = item.DOC_NUM;
                    button.dataset.r = item.ROUTE_NUM;

                    // Add appropriate icon classes to the button based on its purpose
                    // (e.g., Send, Receive, Attach, Edit, Cancel, Tracking, Print)
                    if (btn.className == "btnS") {
                        button.classList.add('fa-regular', 'fa-paper-plane');
                    } else if (btn.className == "btnR") {
                        button.classList.add('fa-solid', 'fa-inbox');
                    } else if (btn.className == "btnA") {
                        button.classList.add('fa-solid', 'fa-paperclip');
                    } else if (btn.className == "btnE") {
                        button.classList.add('fa-solid', 'fa-pen-to-square');
                    } else if (btn.className == "btnCR" || btn.className == "btnCS") {
                        button.classList.add('fa-solid', 'fa-ban');
                    } else if (btn.className == "btnT") {
                        button.classList.add('fa-solid', 'fa-location-pin');
                    } else if (btn.className == "btnP") {
                        button.classList.add('fa-solid', 'fa-print');
                    }

                    // Set the button's dataset attributes and disable based on certain conditions
                    // (e.g., Disable buttons for specific actions)
                    if (item.Action == "RECEIVED" && btn.className == "btnR") {
                        button.disabled = true;
                    } else if (item.Action == "SENT" && btn.className == "btnCR") {
                        button.disabled = true;
                    } else if (item.Action == "RECEIVED" && btn.className == "btnCS") {
                        button.disabled = true;
                    } else if (item.Action == "CANCELLED") {
                        button.disabled = true;
                    }

                    div.appendChild(button); // Append the button to the button container
                });

                row.appendChild(div); // Add the button cell to the row
            }

            // Loop through each item property and create table cells
            Object.entries(item).forEach(([key, value]) => {
                if (key !== 'ID' && key !== 'DOC_NUM' && key !== 'ROUTE_NUM') {
                    const cell = document.createElement('td'); // Create a table cell
                    var fvalue = value; // Store the value to be displayed in the cell

                    // Customize cell styles based on the cell value (e.g., for different statuses)
                    if (fvalue == "RECEIVED") {
                        cell.style.backgroundColor = "#006eff";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    } else if (fvalue == "SENT") {
                        cell.style.backgroundColor = "#23d100";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    } else if (fvalue == "CANCELLED") {
                        cell.style.backgroundColor = "#ffa600";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    } else if (fvalue == "EDITED") {
                        cell.style.backgroundColor = "#e736ff";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    } else if (fvalue == "DUPLICATED") {
                        cell.style.backgroundColor = "#790000";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    }

                    cell.textContent = fvalue; // Set the cell text content
                    row.appendChild(cell); // Add the cell to the row

                    // Check if the cell text content matches the filter text
                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        found++; // Increment the found counter
                    }
                }
            });

            // Hide the row if no matches were found based on the filter text
            if (found == 0) {
                row.style.display = "none";
            }

            tbody.appendChild(row); // Add the row to the table body
        });

        thead.append(theadrow); // Add the header row to the table header
    }

    /**
    * Converts form data to a JSON object.
    * @param {HTMLFormElement} form - The HTML form element to convert.
    * @returns {Object} - The JSON object representing the form data.
    */
    static FormToJson(form) {
        // Create a FormData object from the form
        var formData = new FormData(form);

        // Initialize an empty object to store the form data
        var formDataObject = {};

        // Iterate through each entry in the FormData object
        formData.forEach(function (value, key) {
            // Assign each form field value to its corresponding key in the object
            formDataObject[key] = value;
        });

        // Return the JSON object containing the form data
        return formDataObject;
    }

    /**
    * Sets options for a <select> element.
    * @param {HTMLSelectElement} element - The <select> element to set options for.
    * @param {Object} options - An object containing key-value pairs representing option values and labels.
    */
    static setSelect(element, options) {
        // Iterate through each key-value pair in the options object
        for (var key in options) {
            // Create a new <option> element
            var option = document.createElement('option');

            // Set the value and text content of the <option> element
            option.value = key;
            option.textContent = options[key];

            // Append the <option> element to the <select> element
            element.appendChild(option);
        }
    }

    static checkIfEmpty(values) {
        var empty = false;
        for (let i = 0; i < values.length; i++) {
            if (values[i] == "" || values[i] == null) {
                empty = true;
                console.log(values[i]);
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