<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="TEST.css">
    <link rel="stylesheet" href="../../CSS/Modal.css">
    <link rel="stylesheet" href="../../CSS/DOTS_NAV.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.css">
    <link rel="stylesheet" href="../../CSS/FontAwesome/css/fontawesome.min.css">
    <title></title>
</head>
<body>

    <div class="img-zoom-container">
    <img id="myimage" src="../CSS/Resources/1120291.png" width="300" height="240">
    <div id="myresult" class="img-zoom-result"></div>
    </div>

</body>

<script src="script.js"></script>

<script>
// Initiate zoom effect:
imageZoom("myimage", "myresult");
</script>
</html>