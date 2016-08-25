<style> label { display: block; margin-bottom: 5px; } input, select { width: 100%; font: inherit; padding: 5px 7px; border: 1px solid #aaa; border-radius: 3px; } body { font-family: sans-serif; padding: 100px; max-width: 500px; line-height: 1.5; } table { margin-bottom: 20px; width: 100%; } th, td { padding: 10px; } th:first-child, td:first-child { width: 10%; text-align: center; } th:last-child, td:last-child { width: 45%; } </style>
<h2>Generate Oswald API Key</h2>
<?php
    if (isset($_GET["email"])) {
        echo "<p>
        <strong>Error: There is already an API key associated to that email address.</strong>
        </p>";
    }
?>
<p>
    Oswald Accessibility Widget is currently in beta and therefore free. After the beta is over, the following structure will be applicable:
</p>
<ul>
    <li><strong>Basic</strong> &middot; 1,000,000 pageviews &middot; 5 domains &middot; Free</li>
    <li><strong>Advance</strong> &middot; 10,000,000 pageviews &middot; 25 domains &middot; $9.99</li>
    <li><strong>Ultimate</strong> &middot; Unlimited pageviews &middot; Unlimited domains &middot; $99.99</li>
</ul>
<form action="generate-key.php" method="post">
    <p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter your full name" required autofocus>
    </p>
    <p>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email address" required>
    </p>
    <p>
        <label for="plan">Plan:</label>
        <select name="plan" id="plan" required>
            <option selected>1,000,000 pageviews (Free)</option>
            <option>10,000,000 pageviews (Free)</option>
            <option>Unlimited pageviews (Free)</option>
        </select>
    </p>
    <p>
        <input type="submit" value="Generate API Key">
    </p>
</form>
<script type="application/javascript">
    var host = "oswald.foundation";
    host == window.location.host && "https:" != window.location.protocol && (window.location.protocol="https");
</script>
