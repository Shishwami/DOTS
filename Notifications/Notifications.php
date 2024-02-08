<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Notifications.css">
    <link rel="stylesheet" href="..//FontAwesome/css/all.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>

<body>

<button id="danger">Show Danger</button>
<button id="success">Show Success</button>
<button id="info">Show Info</button>
<button id="warning">Show Warning</button>

    <div class="alert danger hide">
        <span class="fa-solid fa-circle-exclamation"></span>
        <span class="msg"><strong>Danger!</strong> OH NOOO!!! HIHI</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>

    <div class="alert success hide">
        <span class="fa-solid fa-circle-check"></span>
        <span class="msg"><strong>Success!</strong> YEY! KUHA MO PAAAREHH...</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>

    <div class="alert info hide">
        <span class="fa-solid fa-circle-info"></span>
        <span class="msg"><strong>Info!</strong> SOMETHING SOMETHING PAAREEEHH...</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>

    <div class="alert warning hide">
        <span class="fa-solid fa-triangle-exclamation"></span>
        <span class="msg"><strong>Warning!</strong> OOPPS!!! MAY SOMETHING MALI PAREEEHHH...</span>
        <div class="close-btn">
            <span class="fas fa-times"></span>
        </div>
    </div>

    <script>

        document.getElementById("danger").addEventListener('click',function(event)
            {
                document.querySelector(".danger").classList.add("show");
                document.querySelector(".danger").classList.remove("hide");
                document.querySelector(".danger").classList.add("showAlert");

                setTimeout(function() 
                {
                    document.querySelector(".danger").classList.remove("show");
                    document.querySelector(".danger").classList.add("hide");
                }, 3000);
            }
        );

        document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                // Remove classes
                document.querySelector('.danger').classList.remove("show");
                document.querySelector('.danger').classList.add("hide");
            });
        });
        
        document.getElementById("success").addEventListener('click',function(event)
            {
                document.querySelector(".success").classList.add("show");
                document.querySelector(".success").classList.remove("hide");
                document.querySelector(".success").classList.add("showAlert");

                setTimeout(function() 
                {
                    document.querySelector(".success").classList.remove("show");
                    document.querySelector(".success").classList.add("hide");
                }, 3000);
            }
        );

        document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                // Remove classes
                document.querySelector('.success').classList.remove("show");
                document.querySelector('.success').classList.add("hide");
            });
        });

        document.getElementById("info").addEventListener('click',function(event)
            {
                document.querySelector(".info").classList.add("show");
                document.querySelector(".info").classList.remove("hide");
                document.querySelector(".info").classList.add("showAlert");

                setTimeout(function() 
                {
                    document.querySelector(".info").classList.remove("show");
                    document.querySelector(".info").classList.add("hide");
                }, 3000);
            }
        );

        document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                // Remove classes
                document.querySelector('.info').classList.remove("show");
                document.querySelector('.info').classList.add("hide");
            });
        });

        document.getElementById("warning").addEventListener('click',function(event)
            {
                document.querySelector(".warning").classList.add("show");
                document.querySelector(".warning").classList.remove("hide");
                document.querySelector(".warning").classList.add("showAlert");

                setTimeout(function() 
                {
                    document.querySelector(".warning").classList.remove("show");
                    document.querySelector(".warning").classList.add("hide");
                }, 3000);
            }
        );

        document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
            closeBtn.addEventListener('click', function () {
                // Remove classes
                document.querySelector('.warning').classList.remove("show");
                document.querySelector('.warning').classList.add("hide");
            });
        });

    </script>