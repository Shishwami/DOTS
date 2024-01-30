<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="DOTS_DOCS_RECEIVE.css">
    <link rel="stylesheet" href="../DOTS_NAVBAR/DOTS_NAV.css">
    <title>DOTS</title>
</head>


<body>
    <?php include '../DOTS_NAVBAR/DOTS_NAV.php';?>

    <div class="scrollbar"> <!-- Scroll Bar -->

    <div class="container" id="main"> <!-- Form Container -->

        <h1>Receiving</h1>

        <form class="form" action="submit" id="DOCS_ADD_0">

            <div class="row"> <!-- Header Input Group -->
                <div class="column">
                    <div class="head one">
                        <label for="DOC_DATE">Letter Date:</label>
                        <input type="date" name="DOC_DATE" id="DOC_DATE">
                    </div>
                    <div class="head two">
                        <label for="DOC_NUMBER">Document Number:</label>
                        <input type="number" name="DOC_NUMBER" id="DOC_NUMBER">
                    </div>
                </div>

                <div class="column">
                <div class="head one">
                        <label for="RECEIVED_DATE_TIME">Date | Time Received:</label>
                        <input type="datetime-local" name="RECEIVED_DATE_TIME" id="RECEIVED_DATE_TIME">
                    </div>
                    
                    <div class="head two">
                        <label for="DOC_SUBJECT">Subject:</label>
                        <input type="text" name="DOC_SUBJECT" id="DOC_SUBJECT">
                    </div>
                </div>
            </div>

            <div class="inputgroup"> <!-- Document Type Input Group -->
                
                <table class="table_one">
                    <tr>
                        <th><h2>Document Type</h2></th>
                    </tr>
                    <tr class="options">
                        <td class="">
                            <form action="" class="select">
                                    <div class="form_group">
                                        <select name="recepient" id="recepient" data-dropdown>
                                            <option value="">From DB</option>
                                        </select>
                                    </div>
                                </form>
                        </td>
                    </tr>

                </table>
                
            </div>

            

            <div class="submit">
                <input type="submit" value="SUBMIT">
            </div>

        </form>
    </div>
    <br>
    </div>
</body>
<script type="text/javascript">

    //Side Panel Function
    document.getElementById("main").addEventListener("click", closeSidePanel);

    //set date values to local machine time
    setDateValues();

    //set form submit function
    setFormDefault();

    function setDateValues() {

        const dt = new Date(Date.now());

        //separate date 
        let day = dt.getDate();
        let month = dt.getMonth() + 1;
        let year = dt.getFullYear();
        let hour = dt.getHours();
        let minute = dt.getMinutes();
        let weekday = dt.getDay();

        //day and month names, to be used?
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        if (month < 10) {
            month = "0" + month;
        }
        if (day < 10) {
            day = "0" + day;
        }
        if (hour < 10) {
            hour = "0" + hour;
        }
        if (minute < 10) {
            minute = "0" + minute;
        }

        //create date and time as string
        let date = year + "-" + month + "-" + day;
        let time = hour + ":" + minute + ":00";

        let RECEIVED_DATE = document.getElementById("RECEIVED_DATE_TIME");
        let DOC_DATE = document.getElementById("DOC_DATE");

        RECEIVED_DATE.value = date + "T" + time;

        DOC_DATE.value = date;
    }

    function setFormDefault() {
        let form = document.getElementById("DOCS_ADD_0");
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let DOC_NUMBER = document.getElementById("DOC_NUMBER");
            let RECEIVED_DATE_TIME = document.getElementById("RECEIVED_DATE_TIME");
            let DOC_TYPE = document.getElementsByName('DOC_TYPE');
            let DOC_OFFICE = document.getElementById('DOC_OFFICE');
            let DOC_DATE = document.getElementById("DOC_DATE");
            let DOC_SUBJECT = document.getElementById("DOC_SUBJECT");
            let SUBMIT =document.querySelector('input[type=submit]');

            SUBMIT.disabled = true;

            //GET SELECTED RADIO BUTTON FOR DOCUMENT TYPE
            let DOC_TYPE_SELECTED = "";
            for (i = 0; i < DOC_TYPE.length; i++) {
                if (DOC_TYPE[i].checked) {
                    DOC_TYPE_SELECTED = DOC_TYPE[i].value;
                }
            }


            console.log(DOC_NUMBER.value);
            console.log(RECEIVED_DATE_TIME.value);
            console.log(DOC_TYPE_SELECTED);
            console.log(DOC_OFFICE.value);
            console.log(DOC_DATE.value);
            console.log(DOC_SUBJECT.value);

        });
    }


</script>

</html>