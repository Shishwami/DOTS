<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['DOTS_PRIV'])) {
    $privilegeLevel = $_SESSION['DOTS_PRIV'];
    if ($privilegeLevel < 1) {
        $css = '.btnCR, .btnCS, .btnA, .btnS, .btnR, #BTN_DOC_CREATE, .btnE, .btnT { opacity: 0;  pointer-events: none;}';
    } else if ($privilegeLevel < 2) {
        $css = '.btnCR, .btnCS, .btnA, .btnS, .btnR, #BTN_DOC_CREATE, .btnE { opacity: 0; pointer-events: none;}';
    } else if ($privilegeLevel < 3) {
        $css = '#BTN_DOC_CREATE, .btnE { opacity: 0; pointer-events: none;}';
    } else {
        $css = '';
    }
} else {
    $css = '';
}

echo "<style>\n";
echo $css;
echo "\n</style>";
?>