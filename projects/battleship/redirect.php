<?php
require_once('./bizLayer/utils.php');
$browser = getBrowserInfo();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Your browser sucks</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            a#<?php echo str_replace(" ", '_', $browser->name); ?> {border-bottom: 2px solid red;}
        </style>
    </head>
    <body id="redirect">
        <div id="container">
            <div id="newBrowser">
                <h2>Please download a new browser!</h2>
                <p>Click on one of the images to the right</p>
                <p>You were redirected here because your version of <?php echo $browser->name; ?><br /> is incapable  of supporting this application</p>
                <div id="browsers">
                    <a id="Chrome" title="Google Chrome" href="http://www.google.com/chrome">
                        <img src="images/Chrome.png" alt="Google Chrome" />
                    </a>
                    <a id="Firefox" title="Mozilla Firefox" href="http://www.mozilla.com/en-US/firefox/personal.html">
                        <img src="images/Firefox.png" alt="Mozilla Firefox" />
                    </a>
                    <a id="Safari" title="Apple Safari" href="http://www.apple.com/safari/download/">
                        <img src="images/Safari.png" alt="Apple Safari" />
                    </a>
                    <a id="Internet_Explorer" title="Microsoft Internet Explorer" href="http://windows.microsoft.com/en-US/internet-explorer/products/ie-9/home">
                        <img src="images/IE9.png" alt="Internet Explorer" />
                    </a>
                    <a id="Opera" title="Opera" href="http://www.opera.com/browser/">
                        <img src="images/Opera.png" alt="Opera" />
                    </a>
                </div>
            </div>
            <div id="footer" style="color: white; padding: 25px;">
                <?php echo "<h3>You're browsing using $browser->name $browser->version on $browser->os $browser->os_version. Your ip address is $browser->ip</h3>"; ?>
            </div>
        </div>
    </body>
</html>
