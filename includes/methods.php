<?php
    header("Access-Control-Allow-Origin: *");
    echo "Methods";
    if (isset($_GET["oswald_uniqueID"])) {
        echo " " . $_GET["oswald_uniqueID"];
    }
    // 1. Analytics
    // 2. Errors
?>
