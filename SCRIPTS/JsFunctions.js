class JsFunctions {

    static updateTable(table, filter) {

        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');
        const rows = tbody.querySelectorAll('tr');
        for (var i = 0; i < rows.length; i++) {
            var td = rows[i].querySelectorAll("td");
            var found = false;
            for (var j = 0; j < td.length; j++) {
              if (td[j]) {
                var txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  found = true;
                  break;
                }
              }
            }
            if (found) {
              rows[i].style.display = "";
            } else {
              rows[i].style.display = "none";
            }
          }
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