

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="NAV.css">
    <title></title>
</head>
<body>
     <header> <!-- Navigation Bar -->
        <div class="nav">

                <h1 class="logo">CHRMO - DOTS</h1>
           
            <!--<ul class="dots-link">
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="#"></a>Tracking</li>
                <li><a href="#">Routing</a></li>
                <li><a href="#">F</a></li>
                <li><a href="#">Account</a></li>
            </ul>-->

            <button class="bar" id="bar" onclick="openSidePanel()">&#9776;</button>
        </div>

        <!-- Side Panel -->
        <div class="side_menu" id="side_menu">
            <a href="javascript:void(0)" class="closebtn" onclick="closeSidePanel()" style="display: none;">&times;</a>
            <a class="mod" href="home"><object class="icon" data="../Resources/Icons/house-solid.svg" width="20" height="20"></object>Home</a>
            <a class="mod" href="contact"><object class="icon" data="../Resources/Icons/location-dot-solid.svg" width="20" height="20"></object>Tracking</a>
            <a class="mod" href="about"><object class="icon" data="../Resources/Icons/route-solid.svg" width="20" height="20"></object>Routing</a>
            <a class="mod" href="register"><object class="icon" data="../Resources/Icons/folder-open-solid.svg" width="20" height="20"></object>Filing</a>
            <a class="mod" href="login"><object class="icon" data="../Resources/Icons/user-solid.svg" width="20" height="20"></object>Kind of file</a>
            <a class="mod" href=""><object class="icon" data="../Resources/Icons/calendar-check-solid.svg" width="20" height="20"></object>Appointment</a>
            <a class="mod" href=""><object class="icon" data="../Resources/Icons/gear-solid.svg" width="20" height="20"></object>Setting</a>
        </div>
        
    </header>
    
    <script> // Side Panel Function
        
        function openSidePanel() {
            document.getElementById("side_menu").style.marginRight = "0rem";
            document.getElementById("bar").style.display = "none";
            document.getElementsByClassName("closebtn")[0].style.display = "block";
        }

        function closeSidePanel() {
            document.getElementById("side_menu").style.marginRight = "-20rem";
            document.getElementById("bar").style.display = "block";
            document.getElementsByClassName("closebtn")[0].style.display = "none";
        }
    </script>


    
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="NAV.css">
    <link rel="stylesheet" href="..//FontAwesome/css/all.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> 
</head>
<body>
  
    <div class="wrapper">
        <nav>
        <input type="checkbox" id="show-search">
        <input type="checkbox" id="show-menu">
        <label for="show-menu" class="menu-icon"><i class="fa-solid fa-bars"></i></label>
        <div class="content">
        <div class="logo"><a href="#">CHRMO - DOTS</a></div> 
            <ul class="links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Tracking</a></li>
            <li>
                <a href="#" class="desktop-link">Routing</a>
                <input type="checkbox" id="show-routing">
                <label for="show-routing">Routing</label>
                <ul>
                <li><a href="#">Drop Menu 1</a></li>
                <li><a href="#">Drop Menu 2</a></li>
                <li><a href="#">Drop Menu 3</a></li>
                <li><a href="#">Drop Menu 4</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="desktop-link">Filing</a>
                <input type="checkbox" id="show-filing">
                <label for="show-filing">Filing</label>
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
            </li>
            <li><a href="#">Appointment</a></li>
            <li><a href="#">Setting</a></li>
            </ul>
        </div>
        <label for="show-search" class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></label>
        <form action="#" class="search-box">
            <input type="text" placeholder="Type Something to Search..." required>
            <button type="submit" class="go-icon"><i class="fa-solid fa-right-long"></i></button>
        </form>
        </nav>
    </div>
</body>
</html> -->

