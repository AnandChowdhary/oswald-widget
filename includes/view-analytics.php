<style>
    body {
        font-family: sans-serif;
        padding: 100px;
        max-width: 650px;
    }
    table {
        margin-bottom: 20px;
        width: 100%;
    }
    th, td {
        padding: 10px;
    }
    th:first-child, td:first-child {
        width: 10%;
        text-align: center;
    }
    th:last-child, td:last-child {
        width: 45%;
    }
</style>
<h2>Analytics</h2>
<?php
    date_default_timezone_set("Asia/Kolkata");
    require_once "../class.php";
    DB::$user = "classkwo_oswald";
    DB::$password = "anand01";
    DB::$dbName = "classkwo_oswald";
    if (!isset($_GET["client_id"])) {
        echo "<p>
            Please choose a client ID to view analytics:
        </p>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Client ID
                    </th>
                    <th>
                        View Analytics
                    </th>
                </tr>
            </thead>
            <tbody>
                ";
                $results = DB::query("SELECT client_id, id FROM analytics GROUP BY client_id");
                $i = 0;
                foreach ($results as $key) {
                    echo "<tr>
                        <td>
                            " . ++$i . "
                        </td>
                        <td>
                            " . $key["client_id"] . "
                        </td>
                        <td>
                            <a href='?client_id=" . $key["client_id"] . "'>View Analytics</a>
                        </td>
                    </tr>";
                }
            echo "
            </tbody>
        </table>
        ";
    } else {
        DB::query("SELECT id FROM analytics WHERE client_id=%s", $_GET["client_id"]);
        $total_o = DB::count();
        DB::query("SELECT id FROM analytics WHERE client_id=%s GROUP BY ip_address", $_GET["client_id"]);
        $total_ip = DB::count();
        DB::query("SELECT id FROM analytics WHERE client_id=%s GROUP BY event", $_GET["client_id"]);
        $total_event = DB::count();
        DB::query("SELECT id FROM analytics WHERE client_id=%s GROUP BY country", $_GET["client_id"]);
        $total_country = DB::count();
        DB::query("SELECT id FROM analytics WHERE client_id=%s GROUP BY city", $_GET["client_id"]);
        $total_city = DB::count();
        DB::query("SELECT id FROM analytics WHERE client_id=%s GROUP BY regionName", $_GET["client_id"]);
        $total_regionName = DB::count();
        $i=0;
        echo "<p>
            Showing most recent records for Client ID " . $_GET["client_id"] . ":
        </p>
        <h3>General</h3>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <td>
                        #
                    </td>
                    <th>
                        Record
                    </th>
                    <th>
                        Occurances
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Instances of usage
                    </td>
                    <td>
                        " . $total_o . "
                    </td>
                </tr>
                <tr>
                    <td>
                        2
                    </td>
                    <td>
                        <a href='#users'>Unique users by IP</a>
                    </td>
                    <td>
                        " . $total_ip . "
                    </td>
                </tr>
                <tr>
                    <td>
                        3
                    </td>
                    <td>
                        <a href='#modes'>Different modes</a>
                    </td>
                    <td>
                        " . $total_event . "
                    </td>
                </tr>
                <tr>
                    <td>
                        4
                    </td>
                    <td>
                        <a href='#geolocation'>Geolocation</a>
                    </td>
                    <td>
                        " . $total_country . " countries, " . $total_regionName . " regions, " . $total_city . " cities
                    </td>
                </tr>
            </tbody>
        </table>
        <h3 id='users'>Users</h3>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        IP Address
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(ip_address) AS counter, ip_address from analytics WHERE client_id=%s GROUP BY ip_address ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["ip_address"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Internet Service Provider
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(isp) AS counter, isp from analytics WHERE client_id=%s GROUP BY isp ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["isp"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Web Browser
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(browser) AS counter, browser from analytics WHERE client_id=%s GROUP BY browser ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["browser"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <h3 id='geolocation'>Geolocation</h3>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Country
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(country) AS counter, country from analytics WHERE client_id=%s GROUP BY country ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["country"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Region
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(regionName) AS counter, regionName from analytics WHERE client_id=%s GROUP BY regionName ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["regionName"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        City
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(city) AS counter, city from analytics WHERE client_id=%s GROUP BY city ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["city"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        <h3 id='modes'>Modes</h3>
        <table border=1 cellspacing=0>
            <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Mode
                    </th>
                    <th>
                        Sessions
                    </th>
                </tr>
            </thead>
            <tbody>";
            $results = DB::query("SELECT count(event) AS counter, event from analytics WHERE client_id=%s GROUP BY event ORDER BY counter DESC", $_GET["client_id"]);
            $i = 0;
            foreach ($results as $key) {
                echo "<tr>
                    <td>
                        " . ++$i . "
                    </td>
                    <td>
                        " . $key["event"] . "
                    </td>
                    <td>
                        " . $key["counter"] . "
                    </td>
                </tr>";
            }
            echo "</tbody>
        </table>
        ";
    }
?>
<script type="application/javascript">
    var host = "oswald.foundation";
    host == window.location.host && "https:" != window.location.protocol && (window.location.protocol="https");
</script>
