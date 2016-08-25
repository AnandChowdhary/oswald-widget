<?php
    date_default_timezone_set("Asia/Kolkata");
    require_once "../class.php";
    DB::$user = "classkwo_oswald";
    DB::$password = "anand01";
    DB::$dbName = "classkwo_oswald";
    $name = $_POST["name"];
    $email = $_POST["email"];
    DB::query("SELECT api_key FROM developers WHERE email=%s", $email);
    $results = DB::count();
    if ($results > 0) {
        header("Location: index.php?email=1");
    } else {
        $arr = explode(" ", trim($name));
        $firstName = $arr[0];
        $apiKey = md5(uniqid(rand(), true));
        DB::query("SELECT api_key FROM developers WHERE api_key=%s", $apiKey);
        $results = DB::count();
        if ($results > 0) {
            $apiKey = md5(uniqid(rand(), true));
        }
        function randomNumber($length) {
            $result = "";
            for($i = 0; $i < $length; $i++) {
                $result .= mt_rand(0, 9);
            }
            return $result;
        }
        $apiSecret = randomNumber(32);
        DB::insert("developers", array(
            "name" => $name,
            "email" => $email,
            "api_key" => $apiKey,
            "api_secret" => $apiSecret,
            "datetime" => date("Y-m-d H:i:s")
        ));
        $email_content = '<div style="background: #eee; padding: 20px; font-family: \'HelveticaNeue\', \'Helvetica Neue\', \'Helvetica\', sans-serif"> <div style="box-sizing: border-box; background: #fff; max-width: 600px; padding: 50px; margin: 0 auto; border-radius: 4px; border: 1px solid #ddd; box-shadow: 0 3px 3px #ddd;"> <div style="text-align: center; font-weight: bold; font-size: 110%; margin-bottom: 50px"> Oswald API Key </div><div style="line-height: 1.5"> <p> Hey Anand, it&rsquo;s great to meet you! </p><p> Thanks for registering for an API key and implementing accessibility features in your website. We&rsquo;d like to welcome you to the Oswald Developer Community. Your credentials are as follows: </p><p style="margin-top: 40px"> <strong style="display: inline-block; width: 20%; min-width: 150px; margin-bottom: 10px">API Key: </strong> <code style="background: #eee; padding: 5px; border: 1px solid #aaa; border-radius: 3px">' . $apiKey . '</code> </p><p style="margin-bottom: 35px"> <strong style="display: inline-block; width: 20%; min-width: 150px; margin-bottom: 10px">API Secret: </strong> <code style="background: #eee; padding: 5px; border: 1px solid #aaa; border-radius: 3px">' . $apiSecret . '</code> </p><p> The best part about the Oswald Accessibility Widget is how easy it is to implement in your products. Add the following code before the <code>&lt;/body&gt;</code> tag on your webpage: </p><pre style="background: #eee; padding: 5px; border: 1px solid #aaa; border-radius: 3px; color: #2980b9; white-space: normal"><span style="color: purple">&lt;script</span> <span style="color: #c33">src="</span>https://oswald.foundation/developers/widget?key=<strong>' . $apiKey . '</strong><span style="color: #c33">"</span><span style="color: purple">&gt;&lt;/script&gt;</span></pre> <p> Next, all you need to do is add a <code>data-oswald</code> attribute to an element, and Oswald will be triggered when a user clicks on it. </p><pre style="background: #eee; padding: 5px; border: 1px solid #aaa; border-radius: 3px; color: #2980b9; white-space: normal"><span style="color: purple">&lt;button</span> <span style="color: #c33">data-oswald</span><span style="color: purple">&gt;<span style="color: #555">Accessibility Options</span>&lt;/button&gt;</span></pre> <p> That&rsquo;s it! If you have any questions, feel free to head to the <a style="color: #2790f3" target="_blank" href="https://github.com/AnandChowdhary/oswald-api">API documentation</a> or send an email at <a style="color: #2790f3" target="_blank" href="mailto:hello@oswald.foundation">hello@oswald.foundation</a>. To view the analytics of your widget usage, including geolocation, you can <a style="color: #2790f3" target="_blank" href="https://oswald.foundation/developers">log in</a> to the Developer dashboard using your API credentials. </p><p style="margin-bottom: 0"> Oswald Foundation </p></div></div></div>';
        $to = $email;
        $subject = "Oswald API Credentials";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to, $subject, $email_content, $headers);
    }
?>
<style> .col { width: 25%; display: inline-block;} pre { white-space: normal; } pre, code {background: #eee; padding: 5px; border: 1px solid #aaa; border-radius: 3px} label { display: block; margin-bottom: 5px; } input, select { width: 100%; font: inherit; padding: 5px 7px; border: 1px solid #aaa; border-radius: 3px; } body { font-family: sans-serif; padding: 100px; max-width: 500px; line-height: 1.5; } table { margin-bottom: 20px; width: 100%; } th, td { padding: 10px; } th:first-child, td:first-child { width: 10%; text-align: center; } th:last-child, td:last-child { width: 45%; } </style>
<h2>Your Oswald API Key</h2>
<p>
    Thanks, <?php echo $firstName; ?>, your API key has been successfully generated. You may log into your account using your API Key and API Secret as your credentials. Please make sure to save this information.
</p>
<p>
    <strong class="col">API Key: </strong><code><?php echo $apiKey; ?></code>
</p>
<p>
    <strong class="col">API Secret: </strong><code><?php echo $apiSecret; ?></code>
</p>
<h3>Implementation</h3>
<p>
    The best part about the Oswald Accessibility Widget is how easy it is to implement. Add the following code before the <code style="color: purple">&lt;/body&gt;</code> tag on your webpage.
</p>
<pre style="color: #2980b9"><span style="color: purple">&lt;script</span> <span style="color: #c33">src="</span>https://oswald.foundation/developers/widget?key=<strong><?php echo $apiKey; ?></strong><span style="color: #c33">"</span><span style="color: purple">&gt;&lt;/script&gt;</span></pre>
<p>
    Next, all you need to do is add a <code>data-oswald</code> attribute in your accessibility settings button.
</p>
<script type="application/javascript">
    var host = "oswald.foundation";
    host == window.location.host && "https:" != window.location.protocol && (window.location.protocol="https");
</script>
