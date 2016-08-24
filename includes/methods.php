<?php
    header("Access-Control-Allow-Origin: *");
    $modes = array(
        "Dyslexia-friendly Mode" => "hello world",
        "High Contrast Mode" => "new info",
        "Night Reading Mode" => "potato"
    );
    if (isset($_GET["oswald_uniqueID"])) {
        $uid = $_GET["oswald_uniqueID"];
        $info = array(
            $uid,
            ".oswald-footer{font-size:80%;color:#aaa;margin-top:20px}.oswald-footer a {color:inherit;text-decoration:none}.oswald-heading{font-weight:bold;font-size:110%;margin-bottom:20px}.oswald-button{display:block;padding:8px 12px;margin:5px auto}.oswald-button:first-of-type{margin-top:20px}",
            "<div class='oswald-footer'><a href='https://oswald.foundation?compaign=poweredBy&type=jswidget&uid=" . $uid . "' target='_blank'>Oswald Accessibility Widget 0.1</a></div>",
            "<div class='oswald-content'>
                <div class='oswald-heading'>Accessibility Settings</div>
                This is the main content
            </div>",
            $modes
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
