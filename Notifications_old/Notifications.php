<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../CSS/Notifications.css">
    <!-- <link rel="stylesheet" href="../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../CSS/FontAwesome/css/fontawesome.min.css"> -->
    <title></title>
</head>

<body>

    <div class="buttons">
        <h1>Notifications</h1>
        <button onclick="notifySuccess()">
            Success
        </button>
        <button onclick="notifyError()">
            Error
        </button>
        <button onclick="notifyInfo()">
            Info
        </button>
        <button onclick="notifyWarning()">
            Warning
        </button>
        <button onclick="something('success','hahsidfhadshfsduifhs')">Something</button>
        <button onclick="something('success','haha mimi')">Something 3</button>
    </div>

    <div id="notification-area">
    </div>

    <script>
        function notify(type, message) {
            (() => {
                let notif = document.createElement("div");
                let id = Math.random().toString(36).substr(2, 10);
                notif.setAttribute("id", id);
                notif.classList.add("notification", type);

                let msg = document.createElement("div");
                msg.classList.add("msg");

                msg.innerText = message;

                let strong = document.createElement("strong");

                let x_btn = document.createElement("div");
                x_btn.classList.add("close_btn");
                let x_btn_icon = document.createElement("span");
                x_btn_icon.classList.add("fa-brands", "fa-x-twitter");


                let icon = document.createElement("span");
                if (type == "success") {
                    icon.classList.add("fa-solid", "fa-circle-check");
                    strong.innerText = "SUCCESS";
                } else if (type == "error") {
                    icon.classList.add("fa-solid", "fa-circle-exclamation");
                    strong.innerText = "ERROR";
                } else if (type == "info") {
                    icon.classList.add("fa-solid", "fa-circle-info");
                    strong.innerText = "INFO";
                } else if (type == "warning") {
                    icon.classList.add("fa-solid", "fa-triangle-exclamation");
                    strong.innerText = "WARNING";
                }

                x_btn.addEventListener('click', function () {
                    notif.remove();
                });

                notif.append(icon);
                notif.append(x_btn);
                x_btn.append(x_btn_icon);
                notif.append(strong);
                notif.append(msg);

                document.getElementById("notification-area").appendChild(notif);
                setTimeout(() => {
                    var notifications = document.getElementById("notification-area").getElementsByClassName("notification");
                    for (let i = 0; i < notifications.length; i++) {
                        if (notifications[i].getAttribute("id") == id) {
                            notifications[i].remove();
                            break;
                        }
                    }
                }, 5000);
            })();
        }

        function notifySuccess() {
            notify("success", "This is demo success notification message");
        }

        function notifyError() {
            notify("error", "This is demo error notification message");
        }

        function notifyInfo() {
            notify("info", "This is demo info notification message");
        }

        function notifyWarning() {
            notify("warning", "Sheseeeseese")
        }

        function something(type, message) {
            notify(type, message);
        }
    </script>

</body>

</html>