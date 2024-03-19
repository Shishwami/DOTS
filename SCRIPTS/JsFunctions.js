class JsFunctions {

    static updateTable(table, results, buttons, filter) {
        const tbody = table.querySelector('tbody');
        const thead = table.querySelector('thead');

        tbody.innerHTML = '';
        thead.innerHTML = '';

        if (Object.keys(results).length == 0) {
            return;
        }

        const theadrow = document.createElement('tr');
        if (buttons != undefined) {
            const buttonHeaderCell = document.createElement('th');
            theadrow.appendChild(buttonHeaderCell);
        }
        Object.entries(results[0]).forEach(([key, value]) => {
            if (key !== 'ID' && key !== 'DOC_NUM' && key !== 'ROUTE_NUM') {
                const headerCell = document.createElement('th');
                headerCell.textContent = key;
                theadrow.appendChild(headerCell);
            }
        });

        thead.appendChild(theadrow);

        Object.entries(results).forEach(([key, item]) => {
            const row = document.createElement('tr');
            var found = 0;

            if (buttons != undefined) {
                const buttonCell = document.createElement('td');
                const div = document.createElement('div');
                div.className = "btn_container";

                buttons.forEach(btn => {
                    const button = document.createElement('button');
                    // button.innerText = btn.label;
                    button.classList.add(btn.className);
                    if (btn.className == "btnS") {
                        button.classList.add('fa-regular', 'fa-paper-plane');
                        button.title = "Send";
                    } if (btn.className == "btnR") {
                        button.classList.add('fa-solid', 'fa-inbox');
                        button.title = "Receive";
                    }
                    if (btn.className == "btnA") {
                        button.classList.add('fa-solid', 'fa-paperclip');
                        button.title = "Attach";
                    }
                    if (btn.className == "btnE") {
                        button.classList.add('fa-solid', 'fa-pen-to-square');
                        button.title = "Edit";
                    }
                    if (btn.className == "btnCR" || btn.className == "btnCS") {
                        button.classList.add('fa-solid', 'fa-ban');
                        button.title = "Cancel";
                    }
                    if (btn.className == "btnT") {
                        button.classList.add('fa-solid', 'fa-location-pin');
                        button.title = "Tracking";
                    }
                    if (btn.className == "btnP") {
                        button.classList.add('fa-solid', 'fa-print');
                        button.title = "Print Routing Slip";
                    }



                    // button.className = btn.className;
                    // button.id = `button-${item.ID}-${item.DOC_NUM}-${item.ROUTE_NUM}`;
                    button.dataset.i = item.ID;
                    button.dataset.d = item.DOC_NUM;
                    button.dataset.r = item.ROUTE_NUM;

                    if (item.Action == "RECEIVED" && btn.className == "btnR") {
                        button.disabled = true;
                        // button.style.visibility = 'hidden';
                    }
                    if (item.Action == "SENT" && btn.className == "btnCR") {
                        button.disabled = true;
                        // button.style.visibility = 'hidden';
                    }
                    if (item.Action == "RECEIVED" && btn.className == "btnCS") {
                        button.disabled = true;
                        // button.style.visibility = 'hidden';
                    }
                    if (item.Action == "CANCELLED") {
                        button.disabled = true;
                        // button.style.visibility = 'hidden';
                    }

                    div.appendChild(button);

                });

                row.appendChild(div);
            }

            Object.entries(item).forEach(([key, value]) => {
                if (key !== 'ID' && key !== 'DOC_NUM' && key !== 'ROUTE_NUM') {
                    const cell = document.createElement('td');
                    var fvalue = value;

                    if (fvalue == "RECEIVED") {
                        cell.style.backgroundColor = "#006eff";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    }

                    if (fvalue == "SENT") {
                        cell.style.backgroundColor = "#23d100";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    }

                    if (fvalue == "CANCELLED") {
                        cell.style.backgroundColor = "#ffa600";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                        // row.style.display = "none";
                    }

                    if (fvalue == "EDITED") {
                        cell.style.backgroundColor = "#e736ff";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    }

                    if (fvalue == "DUPLICATED") {
                        cell.style.backgroundColor = "#790000";
                        cell.style.color = "#ffffff";
                        cell.style.fontSize = "15px";
                    }

                    cell.textContent = fvalue;
                    row.appendChild(cell);

                    if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
                        found++;
                    }

                }
            });

            if (found == 0) {
                row.style.display = "none";
            }

            tbody.appendChild(row);
        });

        // for (const key in results) {
        //     if (results.hasOwnProperty(key)) {
        //         const item = results[key];
        //         for(const value in item){
        //             console.log(value);
        //         }
        //     }
        // }

        // const thead = table.querySelector('thead');
        // const tbody = table.querySelector('tbody');
        // const rows = tbody.querySelectorAll('tr');
        // for (var i = 0; i < rows.length; i++) {
        //     var td = rows[i].querySelectorAll("td");
        //     var found = false;
        //     for (var j = 0; j < td.length; j++) {
        //         if (td[j]) {
        //             var txtValue = td[j].textContent || td[j].innerText;
        //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                 found = true;
        //                 break;
        //             }
        //         }
        //     }
        //     if (found) {
        //         rows[i].style.display = "";
        //     } else {
        //         rows[i].style.display = "none";
        //     }
        // }

        thead.append(theadrow);

    }
    // static updateAttachments(mini, results, buttons) {
    //     console.log(results);
    //     mini.innerHTML = '';
    //     Object.entries(results).forEach(([key, item]) => {
    //         const doc = document.createElement("div");
    //         doc.innerText = item['DESCRIPTION'];
    //         doc.className = "atc_items";
    //         doc.addEventListener('click', function () {
    //             getData(_REQUEST.GET_ATTACHMENT, { ID: item.ID }, (result) => {
    //                 const url = "../../" + result;
    //                 window.open("../../RESOURCES/pdfJS/web/viewer.html?file=" + url, '_blank').focus();
    //             }, null);
    //         });

    //         // doc.addEventListener('mouseout', function () {
    //         //     preview.style.backgroundImage = "";
    //         // });
    //         mini.appendChild(doc);

    //     });
    // }
    static FormToJson(form) {
        var formData = new FormData(form);
        var formDataObject = {};
        formData.forEach(function (value, key) {
            formDataObject[key] = value;
        });
        return formDataObject;
    }

    static setSelect(element, options) {
        // console.log(options);
        // for (let i = 0; i < options.length; i++) {
        //     var option = document.createElement('option');
        //     var somedata = Object.values(options[i]);

        //     option.value = somedata[0];
        //     option.innerText = somedata[1];

        //     element.appendChild(option);
        // }

        for (var key in options) {
            var option = document.createElement('option');

            option.value = key;
            option.textContent = options[key];

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