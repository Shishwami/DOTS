<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['DOTS_PRIV'])) {
    //pages
    $priv = $_SESSION['DOTS_PRIV'];

    if ($priv >= 3) {
        header("Location: ./PAGES/DOC_VIEW/DOC_VIEW2.php");
        exit();
    } else {
        header("Location: ./PAGES/DOC_VIEW/DOC_VIEW2.php");
        exit();
    }

} else {
    //login
    header("Location: ./PAGES/DOTS_LOGIN/DOTS_LOGIN.php");
    exit();
}



?>