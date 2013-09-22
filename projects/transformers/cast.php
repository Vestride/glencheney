<?php
	$pageTitle = "Transformers 2 | Cast";
	$thisPage = "cast.php";
	include ('header.php');
?>
<style type="text/css">
<!--
/* Page Specific CSS */
#content p {
	font-size: 12pt;
}
#content ul {
	list-style-type: none;
}
#description {
	position: absolute;
	top: 35px;
	left: 200px;
	background: #888;
	width: 330px;
	height: 226px;
	border: solid #333;
	padding: 10px;
}
#photo {
	position: absolute;
	top: 35px;
	left: 635px;
}
#content {
	height: 300px;
}
#content a:link {
	color:#003;
	text-decoration: none;
}
#content a:visited {
	color: #003;
	text-decoration: none;
}
#content a:hover {
	color: #F30;
	text-decoration: underline;
}
-->
</style>
<script type="text/javascript">
//<![CDATA[
	var imgArr = ['images/shia.jpg', 'images/meganFox.jpg', 'images/optimus.jpg', 'images/bumblebee.jpg', 'images/megatron.jpg'];
	//array to hold all of the preloaded images
	var imgHolder = new Array();
	// array to hold all of the descriptions
	var desc = new Array();
	desc['shia'] = "Shia LaBeouf plays Sam Witwicky, the teenager who killed Megatron. Sam is trying to live a normal life and overcome his world-savior status and the overprotection from his parents and Bumblebee.";
	desc['meganFox'] = 'Megan Fox plays Mikaela Banes, Sam\'s girlfriend, who cannot afford to attend college with him. She works alongside her father, Cal, at a motorcycle repair shop.';
	desc['optimus'] = 'Peter Cullen voices Optimus Prime, the Autobot leader. He retains his alternate mode of a blue Peterbilt truck with red flame decals.';
	desc['bumblebee'] = 'Bumblebee, the Autobot who befriended Sam and disguises himself as his fifth-generation Chevrolet Camaro. Despite being repaired at the end of the 2007 film, Bumblebee\'s voice is malfunctioning again, so he still uses radio soundbites to communicate.';
	desc['megatron'] = 'Hugo Weaving voices Megatron, the Decepticon leader. Despite <a href="bay.php" style="color: #CCC;">Michael Bay\'s<\/a> initial claims of him not returning after he was killed and thrown into the Laurentian Abyss in the 2007 film, Megatron is resurrected by the Decepticons with an AllSpark shard as a Cybertronian winged tank.';
	desc['start'] = 'A description of the character will show up here when you click on one. <br \/><span class="small">All information obtained from <a href="http://en.wikipedia.org/wiki/Transformers_2">Wikipedia.org<\/a><\/span>';
	
	function start()
	{
		document.getElementById("description").innerHTML = desc['start'];
		for(i=0; i < imgArr.length; i++)
		{
			imgHolder[i] = new Image();
			imgHolder[i].src = imgArr[i];
		}
	}	   
	function changeTo(which)
	{
		//for the image swap
		document.getElementById('photo').src = "images/" + which.id + ".jpg";
		//which.src = "images/" + which.id + ".jpg";
		//for the text swap
		document.getElementById("description").innerHTML = desc[which.id];
	}
	function changeBack(which)
	{
		which.src = "images/" + which.id + ".jpg";
		document.getElementById("description").innerHTML = desc['start'];
	}
	
	
//]]>
</script>
<?php
	$page = "cast";
	$doneFunc = ', start();';
	include('nav.php');
?>
<div id="content">
	<h2>Cast</h2>
        <a href="#" onclick="changeTo(this);" id="shia">Sam Witwicky</a><br />
        <a href="#" onclick="changeTo(this);" id="meganFox">Mikaela Banes</a><br />
        <a href="#" onclick="changeTo(this);" id="bumblebee">Bumblebee</a><br />
        <a href="#" onclick="changeTo(this);" id="optimus">Optimus Prime</a><br />
        <a href="#" onclick="changeTo(this);" id="megatron">Megatron</a><br />
    <div id="description">
        <!--Empty description div -->
    </div><!-- end description -->
    <img src="images/poster.jpg" alt="description" id="photo" />
</div>
    <!-- End content -->
<?php
	include('footer.php');
?>