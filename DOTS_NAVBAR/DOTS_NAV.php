<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="DOTS_NAV.css">
    <link rel="stylesheet" href="..//FontAwesome/css/all.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="..//FontAwesome/css/fontawesome.min.css">
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
</html>