<?php

    header("Access-Control-Allow-Origin: *");
    date_default_timezone_set("Asia/Kolkata");
    require_once "../class.php";

    if ($_SERVER["REMOTE_ADDR"] == "::1") {
        $ip = "122.176.246.247";
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    $url = "http://ip-api.com/json/" . $ip;
    $data = json_decode(file_get_contents($url));
    $isp = $data -> isp;
    $city = $data -> city;
    $country = $data -> country;
    $countryCode = $data -> countryCode;
    $lat = $data -> lat;
    $lon = $data -> lon;
    $region = $data -> region;
    $regionName = $data -> regionName;

    if (isset($_GET["client_id"]) && isset($_GET["event_info"])) {
        DB::$user = "root";
        DB::$password = "";
        DB::$dbName = "oswald";
        DB::insert("analytics", array(
            "ip_address" => $ip,
            "datetime" => date("Y-m-d H:i:s"),
            "client_id" => $_GET["client_id"],
            "event" => $_GET["event_info"],
            "browser" => $_SERVER["HTTP_USER_AGENT"],
            "isp" => $isp,
            "city" => $city,
            "country" => $country,
            "countryCode" => $countryCode,
            "lat" => $lat,
            "lon" => $lon,
            "region" => $region,
            "regionName" => $regionName
        ));
        echo "Analytics request sent";
    } else {
        echo "Error";
    }

?>
