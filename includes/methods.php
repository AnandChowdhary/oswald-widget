<?php
    header("Access-Control-Allow-Origin: *");
    if (isset($_GET["oswald_uniqueID"])) {
        $uid = $_GET["oswald_uniqueID"];
        $info = array(
            $uid,
            ".oswald-footer{font-size:80%;color:#aaa;margin-top:20px}.oswald-footer a {color:inherit;text-decoration:none}",
            "<div class='oswald-footer'><a href='https://oswald.foundation?compaign=poweredBy&type=jswidget&uid=" . $uid . "' target='_blank'>Powered by Oswald</a></div>",
            "<div class='oswald-content'>
                This is the main content
            </div>"
        );
    } else {
        $info = array(
            "Error: Missing Client ID"
        );
    }
    echo json_encode($info);
    // 1. Analytics
    // 2. Errors
?>
