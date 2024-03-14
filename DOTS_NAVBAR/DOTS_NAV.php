<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <!-- <link rel="stylesheet" href="../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../CSS/FontAwesome/css/fontawesome.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> -->
</head>

<body>
    <!-- Navigation Bar Container -->
    <div class="wrapper">
        <nav>
            <input type="checkbox" id="show-search">
            <input type="checkbox" id="show-menu">
            <label for="show-menu" class="menu-icon"><i class="fa-solid fa-bars"></i></label>

            <div class="content">
                <img src="../CSS/Resources/City-of-Baguio-Logo Fill.png" alt="">

                <div class="logo"><a href="#">CHRMO - DOTS</a></div>

                <ul class="links">
                    <li><a href="#">Dashboard</a></li> <!--  specific to sir joseph -->
                    <li><a href="#">Routing</a></li> <!--  for most users -->
                    <!-- <li><a href="#">Tracking</a></li> -->
                    <!-- <li>
                            <a href="#" class="desktop-link">Process</a>
                            <input type="checkbox" id="show-process">
                            <label for="show-process">Process</label>
                            <ul>
                            <li><a href="#">Routing</a></li>
                            <li><a href="#">Tracking</a></li>
                            <li><a href="#">Drop Menu 3</a></li>
                            <li><a href="#">Drop Menu 4</a></li>
                            </ul>
                        </li> -->
                    <!-- <li>
                            <a href="#" class="desktop-link">Routing</a>
                            <input type="checkbox" id="show-routing">
                            <label for="show-routing">Routing</label>
                            <ul>
                            <li><a href="#">Drop Menu 1</a></li>
                            <li><a href="#">Drop Menu 2</a></li>
                            <li><a href="#">Drop Menu 3</a></li>
                            <li>
                                <a href="#" class="desktop-link">More Items</a>
                                <input type="checkbox" id="show-items">
                                <label for="show-items">More Items</label>
                                <ul>
                                <li><a href="#">Sub Menu 1</a></li>
                                <li><a href="#">Sub Menu 2</a></li>
                                <li><a href="#">Sub Menu 3</a></li>
                                </ul>
                            </li>
                            </ul>
                        </li> -->
                    <!-- <li><a href="#">Appointment</a></li> -->
                    <!-- <li>
                            <a href="#" class="desktop-link">Setting</a>
                            <input type="checkbox" id="show-setting">
                            <label for="show-setting">Setting</label>
                            <ul>
                                <li><a href="#">Division</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Status</a></li>
                                <li><a href="#">Purpose</a></li>
                                <li><a href="#">Doc Type</a></li>
                            </ul>
                        </li> -->
                </ul>
            </div>

            <!-- <label for="show-search" class="search-icon"><i class="fa-solid fa-magnifying-glass" title="Search"></i></label>

            <form action="#" class="search-box">
                <input type="text" placeholder="Type Something to Search..." required>
                <button type="submit" class="go-icon"><i class="fa-solid fa-right-long"></i></button>
            </form> -->

            <div class="logout">
                <button class="fa-solid fa-right-from-bracket logout_btn" id="BTN_LOGOUT" title="Logout"></button>
            </div>

            <script>
                const BTN_LOGOUT = document.getElementById("BTN_LOGOUT");
                BTN_LOGOUT.addEventListener('click', function () {
                    console.log("ASDDSADAS");
                    window.location.href = "../../SCRIPTS/logout.php";
                });
            </script>
        </nav>
    </div>
</body>

</html>