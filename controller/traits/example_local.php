<html>
<head><title>EMailqueue - PHP Inject class test</title></head>
<body>
<h1>EMailqueue - PHP Inject class test</h1>
<h2>An example on how to use the emailqueue_inject PHP class to inject email messages into Emailqueue when the Emailqueue installation is accessible in the same server as your code.</h2>
<hr>
<?php

	define("EMAILQUEUE_DIR", "./mail/"); // Set this to your Emailqueue's installation directory.

    
    if($result)
        echo "Message correctly injected.<br>";
    else
        echo "Error while queing message.<br>";

?>
</body>
</html>