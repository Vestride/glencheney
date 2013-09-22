<?php
	$pageTitle = "Transformers 2 | Home";
	$thisPage = "index.php";
	include ('header.php');
?>
<style type="text/css">
<!--
/* Page Specific CSS */
#content p {
	font-size: 12pt;
}
#themes {
	position: absolute;
	top: 60px;
	left: 720px;
}
-->
</style>
<script type="text/javascript">
//<![CDATA[
	
	
	
//]]>
</script>
<?php
	$page = "home";
	include('nav.php');
?>
<div id="content">
    <h1>Transformers: Revenge of the Fallen</h1>
    <h3>Movie Details:</h3>
    <p>
        <strong>Release Date:</strong> June 24th, 2009<br />
        <strong>Genres:</strong> Action, Adventure, Sci-Fi<br />
        <strong>Tagline:</strong> Revenge is coming<br />
        <strong>Runtime:</strong> 150 minutes<br />
        <strong>Rating:</strong> PG13<br />
        <strong>Language:</strong> English<br />
        <strong>Company:</strong> Dreamworks<br />
        <span class="small">Information obtained from <a href="http://www.imdb.com/title/tt1055369/">IMDb.com</a></span>
        <br /><br />
    </p> 
    <span style="position: absolute; left: 400px; top: 75px;">
    <img  src="images/poster.jpg" alt="transformers poster" />
    <br />
    <span class="small">Image obtained from <a href="http://en.wikipedia.org/wiki/Transformers_2">Wikipedia</a></span>
    </span>
    <div id="themes">
    	<p style="font-weight: bold;">Themes</p>
        <a href="<?php echo $path.$thisPage?>?change=decepticon"><img id="d" onmouseover="changeThat(this)" onmouseout="revert(this);" src="images/d.jpg" alt="Decepticon" /></a><br />
        <a href="<?php echo $path.$thisPage?>?change=bumblebee"><img id="bee" onmouseover="changeThat(this)" onmouseout="revert(this);" src="images/bee.jpg" alt="Bumblebee" /></a><br />
        <a href="<?php echo $path.$thisPage?>?change=optimus"><img id="op" onmouseover="changeThat(this)" onmouseout="revert(this);" src="images/op.jpg" alt="Optimus Prime Thumbnail" /></a><br />
        <a href="<?php echo $path.$thisPage?>?change=fox"><img id="fox" onmouseover="changeThat(this)" onmouseout="revert(this);" src="images/fox.jpg" alt="Megan Fox Thumbnail" /></a>
    </div>
</div>
    <!-- End content -->
<?php
	include('footer.php');
?>