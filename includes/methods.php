<?php
    header("Access-Control-Allow-Origin: *");
    $modes = array(
        "Dyslexia-friendly Mode" => "*{background:yellow}",
        "Large Font Size" => "body{font-size:20px !important}",
        "Dark Mode" => "*{background:#000;color:#fff}"
    );
    if (isset($_GET["oswald_uniqueID"])) {
        $uid = $_GET["oswald_uniqueID"];
        $info = array(
            $uid,
            ".oswald-footer{font-size:70%;color:#aaa;margin-top:20px}.oswald-footer a {color:inherit;text-decoration:none}.oswald-footer a:hover{color:#666}.oswald-heading{font-weight:bold;font-size:110%;margin-bottom:20px}.oswald-button{color: inherit; text-decoration: none; width: 100%; box-sizing: border-box; margin-top: 10px; font-weight: bold; outline: none; border: none; border-radius: 5px; cursor: pointer; background: #ddd; display: block; height: 40px; line-height: 40px;}.oswald-button:first-of-type{margin-top:20px}.oswald-button-active{background: #2792f3;color: white;}",
            "<div class='oswald-footer'><a href='https://oswald.foundation?compaign=poweredBy&type=jswidget&uid=" . $uid . "' target='_blank' title='Oswald Accessibility Widget 0.1'>Powered by Oswald</a></div>",
            "<div class='oswald-content'>
                <div class='oswald-heading'>Accessibility Settings</div>
                <p>
                    Click on any one of the following settings to enable:
                </p>
            </div>
            <button data-button-id='-1' onclick='oswald.css(\"\", \"Default\", \"-1\");' class='oswald-button oswald-button-active'>Default</button>",
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
