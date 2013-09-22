<?php
	$pageTitle = "Transformers 2 | Annotated CSS";
	$thisPage = "annotatedcss.php";
	include ('header.php');
?>
<style type="text/css">
<!--
/* Page Specific CSS */
#content {
	font-size: 10pt;
}
.description {
	font-weight: bold;
}
.myButton {
	background: #CCC;
	border: 2px solid #000;
}
.code {
	border: groove;
	padding: 5px;
	background: #FFF;
	margin-top: 5px;
	font-family: "Courier New", Courier, monospace;
}
-->
</style>
<script type="text/javascript">
//<![CDATA[
	
	function hideShow(what, whichButton)
	{
		
		if(document.getElementById(what).style.display == "none")
		{
			document.getElementById(what).style.display = "block";
			document.getElementById(whichButton.id).value = "Hide Code";
		}
		else if (document.getElementById(what).style.display == "block")
		{
			document.getElementById(what).style.display = "none";
			document.getElementById(whichButton.id).value = "Show Code";
		}
	}
	
//]]>
</script>
<?php
	$page = "css";
	include('nav.php');
?>
<div id="content">
    <h2>Annotated CSS</h2>
    <p class="description">
        New Stuff!
    </p>
    <ul>
        <li>PHP includes for the header, navigation, and footer.</li>
        <li>PHP variable that allows me to change the body onload for individual pages.</li>
        <li>A php switch statement that finds out what page you're on and displays it as so.</li>
        <li>New <a href="comment/comment.php">Site Comments</a> page.</li>
        <li style="list-style:none;">
            <ul>
                <li>Uses a database to save and insert new comments.</li>
                <li>Uses form validation to make sure that all the fields have been filled.</li>
                <li>Sends you off to a new page that writes to the database and then redirects you back to the comments page.</li>
                <li>If you've just commented on the page, the &quot;Please leave a comment&quot; and the forms don't show up.</li>
                <li>Nifty <span style="text-decoration: underline;">table</span> for comments.</li>
            </ul>
        </li>
        <li>DHTML component on the <a href="plot.php">Plot</a> page shows and hides the extra information that would normally go on a second page.</li>
        <li>Check out the JavaScript component that shows the code below!</li>
        <li>Using a session variable, I was able to have the background theme stay changed throughout the site. There are four different background available.</li>
        <li>Depending on which platform you're running (windows or mac) the <a href="plot.php">Plot</a> page's footer will adjust</li>
    </ul>
    <p class="description">
        <input type="button" id="button1" class="myButton" value="Show Code" onclick="hideShow('code1', this)"/>
        Resets default margins
    </p>
    <p id="code1" style="display: none;" class="code">
        p, body {
        margin: 0;
        padding: 0;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button2" class="myButton" value="Show Code" onclick="hideShow('code2', this)"/>
        Sets the background to black and defines the default font as Verdana
    </p>
    <p id="code2" style="display: none;" class="code">
        body {
        background: #000;
        font-family:Verdana, Geneva, sans-serif;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button3" class="myButton" value="Show Code" onclick="hideShow('code3', this)"/>
        Gives the container div a width of 900 pixels and centers it
    </p>
    <p id="code3" style="display: none;" class="code">
        #container {
        width: 900px;
        margin: auto;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button4" class="myButton" value="Show Code" onclick="hideShow('code4', this)"/>
        Gives the navigation bar a background, width, and height.
    </p>
    <p id="code4" style="display: none;" class="code">
        #nav {
        background: url(images/nav/navbg.gif) repeat-x;
        width: 900px;
        height: 50px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button5" class="myButton" value="Show Code" onclick="hideShow('code5', this)"/>
        Customized code from web monkey tutorial for drop down menus. Sets font size, takes away the bullets on the unordered list, adds padding and removes margins.
    </p>
    <p id="code5" style="display: none;" class="code">
        #nav ul {
        margin: 0;
        padding: 10px;
        list-style: none;
        font-size: 25pt;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button6" class="myButton" value="Show Code" onclick="hideShow('code6', this)"/>
        Positions the list items relatively, floats left, and gives it a margin to distribute the global nav evenly. Sets font color to black.
    </p>
    <p id="code6" style="display: none;" class="code">
        #nav ul li {
        position: relative;
        float: left;
        margin: 0 34px;
        color: #000;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button7" class="myButton" value="Show Code" onclick="hideShow('code7', this)"/>
        Positions the drop down lists absolutely and hides them.
    </p>
    <p id="code7" style="display: none;" class="code">
        #nav li ul {
        position: absolute;
        top: 30px;
        display: none;
        font-size: 13pt;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button8" class="myButton" value="Show Code" onclick="hideShow('code8', this)"/>
        Sets defualt styles for the local nav links.
    </p>
    <p id="code8" style="display: none;" class="code">
        #nav ul li a {
        display: block;
        text-decoration: none;
        line-height: 20px;
        color: #000;
        padding: 5px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button9" class="myButton" value="Show Code" onclick="hideShow('code9', this)"/>
        Repositions drop downs.
    </p>
    <p id="code9" style="display: none;" class="code">
        #nav ul li ul li {
        left: -43px;
        width: 125px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button10" class="myButton" value="Show Code" onclick="hideShow('code10', this)"/>
        Sets specific width for the home dropdown list.
    </p>
    <p id="code10" style="display: none;" class="code">
        #nav ul li ul#homelist li {
        width: 105px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button11" class="myButton" value="Show Code" onclick="hideShow('code11', this)"/>
        Sets specific width for the people dropdown list.
    </p>
    <p id="code11" style="display: none;" class="code">
        #nav ul li ul#peoplelist li {
        width: 120px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button12" class="myButton" value="Show Code" onclick="hideShow('code12', this)"/>
        Sets specific width for the production dropdown list.
    </p>
    <p id="code12" style="display: none;" class="code">
        #nav ul li ul#productionlist li {
        width: 185px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button13" class="myButton" value="Show Code" onclick="hideShow('code13', this)"/>
        Sets specific width for the movie dropdown list.
    </p>
    <p id="code13" style="display: none;" class="code">
        #nav ul li ul#movielist li {
        width: 180px;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button14" class="myButton" value="Show Code" onclick="hideShow('code14', this)"/>
        Sets background color for drop down lists, a 1 white pixel at 45% opacity.
    </p>
    <p id="code14" style="display: none;" class="code">
        #nav ul li ul li a {
        background: url(images/menubg.png) repeat;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button15" class="myButton" value="Show Code" onclick="hideShow('code15', this)"/>
        Nav hover color
    </p>
    <p id="code15" style="display: none;" class="code">
        #nav ul li a:hover {
        background: #666;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button16" class="myButton" value="Show Code" onclick="hideShow('code16', this)"/>
        Shows the drop downs on hover.
    </p>
    <p id="code16" style="display: none;" class="code">
        #nav li:hover ul {
        
        display: block;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button17" class="myButton" value="Show Code" onclick="hideShow('code17', this)"/>
        Gives the current page a border in the global nav.
    </p>
    <p id="code17" style="display: none;" class="code">
        .currentPage {
        border-bottom: solid #666;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button18" class="myButton" value="Show Code" onclick="hideShow('code18', this)"/>
        Positions the content div relatively over the decepticon image, adds padding, a background color, line spacing, and font size.
    </p>
    <p id="code18" style="display: none;" class="code">
        #content {
        position: relative;
        top: -80px;
        padding: 5px 20px;
        background: #CCC;
        line-height: 1.5;
        font-size: 11.5pt;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button19" class="myButton" value="Show Code" onclick="hideShow('code19', this)"/>
        Specifies defaults for the footer. Same as Content except for the font size and alignment to the right.
    </p>
    <p id="code19" style="display: none;" class="code">
        #footer {
        position: relative;
        top: -80px;
        background: #CCC;
        margin-top: 20px;
        padding: 5px 20px;
        font-size: 10pt;
        text-align: right;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button20" class="myButton" value="Show Code" onclick="hideShow('code20', this)"/>
        Class used for citing sources.
    </p>
    <p id="code20" style="display: none;" class="code">
        .small {
        font-size: 75%;
        font-style: italic;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button21" class="myButton" value="Show Code" onclick="hideShow('code21', this)"/>
        Default link style.
    </p>
    <p id="code21" style="display: none;" class="code">
        a:link {
        color:#003;
        text-decoration: none;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button22" class="myButton" value="Show Code" onclick="hideShow('code22', this)"/>
        Default visited link color.
    </p>
    <p id="code22" style="display: none;" class="code">
        a:visited {
        color: #333;
        text-decoration: underline;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button23" class="myButton" value="Show Code" onclick="hideShow('code23', this)"/>
        Default link hover color.
    </p>
    <p id="code23" style="display: none;" class="code">
        a:hover {
        color: #F30;
        text-decoration: underline;
        }
    </p>
    <br />
    <p class="description">
        <input type="button" id="button24" class="myButton" value="Show Code" onclick="hideShow('code24', this)"/>
        Class for quotes.
    </p>
    <p id="code24" style="display: none;" class="code">
        .quote {
        background: #333;
        border: solid #999;
        color: white;
        padding: 10px;
        margin: 5px;
        }
    </p>
</div>
<!-- End content -->
<?php
	include('footer.php');
?>