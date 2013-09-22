<?php
	$pageTitle = "Transformers 2 | Plot";
	$thisPage = "plot.php";
	include ('header.php');
?>
<style type="text/css">
<!--
/* Page Specific CSS */
#content {
	background: none;
}
#part1 {
	position: absolute;
	top: 0px;
	left: 0px;
	/*height: 780px;*/
	padding: 5px 20px 5px 20px;
	background: #CCC;
	line-height: 1.5;
	font-size: 11.5pt;
}
#part2 {
	position: absolute;
	top: 0px;
	left: 0px;
	/*height: 780px;*/
	padding: 5px 20px 5px 20px;
	background: #CCC;
	line-height: 1.5;
	font-size: 11.5pt;
	display: none;
}
#footer {
	<?php 
	if (strpos($_SERVER['HTTP_USER_AGENT'], "Windows"))
	{
		echo 'top: 935px;';
	}
	if (strpos($_SERVER['HTTP_USER_AGENT'], "Mac"))
	{
		echo 'top: 1005px;';
	}
	?>
}
-->
</style>
<script type="text/javascript">
//<![CDATA[
		   
	var onTop = "part1";
	var onBottom ="part2";
	
	function next(theCurrent)
	{
		onTop = theCurrent;
		document.getElementById(onTop).style.display = "none";
		document.getElementById(onBottom).style.display = "block";
		var newTop = onBottom;
		onBottom = onTop;
		onTop = newTop;
	}
//]]>
</script>
<?php
	$page = "plot";
	include('nav.php');
?>
<div id="content">
	<div id="part1">
    <a name="Plot"></a><h2>Plot</h2>
        <p>
            It is revealed that thousands of years ago there was a race of ancient Transformers who scoured the universe looking for energon sources. Known as the Dynasty of Primes, they used machines called Sun Harvesters to drain stars of their energy in order to convert it to energon and power Cybertron's AllSpark. The Primes agreed that life-bearing worlds would be spared, but in 17,000 BC, one brother, thereafter dubbed &quot;The Fallen&quot;, constructed a Sun Harvester on Earth. The remaining brothers thus sacrificed their bodies in order to hide the Matrix of Leadership&ndash;the key that activates the Sun Harvester&ndash;from The Fallen, who swore to seek revenge upon Earth.
        </p>
        <br />
        <p>
            In the present day, two years after the events of the previous film, Optimus Prime is seen leading NEST, a military organization consisting of human troops and his own team of Autobots (including newcomers Arcee, Chromia, Elita One, Sideswipe, Jolt, and the twins Skids and Mudflap) aimed at killing the remaining Decepticons on Earth. While on a mission in Shanghai, Optimus and his team destroy Decepticons Sideways and Demolishor, being given a warning by the latter that &quot;The Fallen will rise again&quot;. Back in the United States, Sam Witwicky finds a splinter of the destroyed AllSpark, and upon contact the splinter fills his mind with Cybertronian symbols. Deeming it dangerous, Sam gives the AllSpark splinter to his girlfriend Mikaela Banes for safe keeping, and leaves her and Bumblebee behind to go off to college. Upon arrival, Sam meets his college roommate Leo Spitz, who runs an alien conspiracy website, and Alice, a co-ed who makes sexual advances on him. Back home, Decepticon Wheelie tries to steal the shard, only to get captured by Mikaela. After having a mental breakdown, uncontrollably writing in Cybertronian language, Sam calls Mikaela, who immediately leaves to get to him.
        </p>
        <br />
        <p>
            Decepticon Soundwave hacks into a US satellite and learns the locations of the dead Decepticon leader Megatron and another piece of the AllSpark. The Decepticons retrieve the shard and use it to resurrect Megatron, who flies into space and is reunited with Starscream and his master, The Fallen. The Fallen instructs Megatron and Starscream to capture Sam in order to discover the location of the Matrix of Leadership. With Sam's outbreaks worsening, Mikaela arrives at campus just as Alice&ndash;revealed to be a Decepticon Pretender&ndash;attacks Sam. Mikaela, Sam, and his roommate Leo drive off, destroying Alice, but are seized by Decepticon Grindor. The Decepticon known as &quot;The Doctor&quot; prepares to remove Sam's brain, but Optimus and Bumblebee turn up and rescue him. In an ensuing fight, Optimus engages Megatron, Grindor and Starscream. Optimus manages to kill Grindor and rip off Starscream's arm, but he is eventually impaled through the chest by Megatron and dies.
        </p>
        <br />
        <p>
        <span class="small">Information obtained from <a href="http://en.wikipedia.org/wiki/Transformers_2#Plot">Wikipedia.org</a></span>
        <br />
        <a href="#plot2" onclick="next('part1');" style="text-align:right;">NEXT&gt;&gt;</a>
        </p>
    </div><!--End part1 -->
    <div id="part2">
        <a name="plot2"></a><h2>Plot &mdash; Continued</h2>
        <p>
            After Prime's death, The Fallen is freed from his captivity and Megatron orders a full-scale assault on the planet. The Fallen speaks to the world and demands they surrender Sam to the Decepticons or they will continue their attack. Sam, Mikaela, Leo, Bumblebee, the twins and Wheelie regroup, and Leo suggests his online rival &quot;RoboWarrior&quot; may be of assistance. &quot;RoboWarrior&quot; is revealed to be former Sector 7 agent Simmons, who informs the group that the symbols should be readable for a Decepticon. Mikaela then releases Wheelie, who can't read the language, but identifying it as that of the Primes, directs the group to a Decepticon seeker named Jetfire. They then find Jetfire at the F. Udvar-Hazy Center and reactivate him. After teleporting the group to Egypt, Jetfire explains that only a Prime can kill The Fallen, and translates the symbols, which contain a riddle that sets the location of the Matrix of Leadership somewhere in the surrounding desert. By following the clues, the group arrive at the tomb where they ultimately find the Matrix, but it crumbles to dust in Sam's hands. Believing the Matrix can still revive Optimus, Sam collects the dust and instructs Simmons to call Major William Lennox to bring the other Autobots and Optimus' body.
        </p>
        <br />
        <p>
            The military arrives with the Autobots, but so do the Decepticons, and a battle arises. During the fight, Decepticon Devastator is formed and unearths the Sun Harvester from inside one of the pyramids before being destroyed by the US military with the help of agent Simmons. Jetfire arrives and destroys Mixmaster, but is mortally wounded by Scorponok. The Air Force carpet bomb the Decepticons, but Megatron breaks through the offensive and kills Sam. In a vision, Sam meets with the other Primes, who tell him that the Matrix of Leadership is not found but earned, which Sam has done, and send him back, effectively reviving him. The Matrix is reassembled from the dust, and Sam uses it to revive Optimus. The Fallen then steals the Matrix and activates the Sun Harvester. In his final moments, Jetfire volunteers his parts and spark to Optimus. With enhanced capabilities, Optimus destroys the Sun Harvester and takes on Megatron and The Fallen, killing the latter. Sam then finally reciprocates Mikaela's love as Megatron and Starscream retreat and vow that their fight is not finished.
        </p>
        <br />
        <p>
            The film ends with Optimus sending a message into space saying that the humans and Transformers both share a common past.
       </p>
       <br />
       <p>
       <span class="small">Information obtained from <a href="http://en.wikipedia.org/wiki/Transformers_2#Plot">Wikipedia.org</a></span>
       <br />
       <a href="#plot" onclick="next('part2');">&lt;&lt;BACK</a>
       </p>
       
    </div><!--End part 2-->
</div>
    <!-- End content -->
<?php
	include('footer.php');
?>