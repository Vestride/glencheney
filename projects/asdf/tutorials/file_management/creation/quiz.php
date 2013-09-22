<h1>File Creation Quiz</h1>


<ol>
	<li>The "~" symbol refers to:<br />
		<img id="icreate11" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create1" id="create11" value="false" /><label for="create11">Your current directory</label><br />
		<img id="icreate12" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="create1" id="create12" value="true" /><label for="create12">Your home directory</label><br />
		<img id="icreate13" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create1" id="create13" value="false" /><label for="create13">The directory above the current one</label><br />
		<img id="icreate14" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create1" id="create14" value="false" /><label for="create14">Your neighbor directory</label><br />
		<label class="checkButton" onclick="checkradio('create', '1')">Check your answer</label>
		<span id="screate1" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=navigate_directories">Navigating Directories</a>)</span>
	<br /><br />
	</li>
	<li>"ls -a" will show you the permissions for your files.
		<img id="icreate2t" style="display:none;" src="../true.png" alt="true" />
		<img id="icreate2f" style="display:none;" src="../false.png" alt="false" />
		<select id="create2" name="create2">
			<option value=""> - </option>
			<option value="false">True</option><!-- value=false so that quiz javascript works. IT IS THE TRUENESS OF CHOOSING THAT ANSWER -->
			<option value="true">False</option>
		</select><br />
		<label class="checkButton" onclick="checkselect('create', '2')">Check your answer</label>
		<span id="screate2" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=create_directories">Creating Directories</a>)</span>
	<br /><br />
	</li>
	<li>What is the command to make a new directory?<br />
		<img id="icreate31" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create3" id="create31" value="false" /><label for="create31">makedir</label><br />
		<img id="icreate32" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="create3" id="create32" value="true" /><label for="create32">mkdir</label><br />
		<img id="icreate33" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create3" id="create33" value="false" /><label for="create33">md</label><br />
		<img id="icreate34" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create3" id="create34" value="false" /><label for="create34">mkdirectory</label><br />
		<label class="checkButton" onclick="checkradio('create', '3')">Check your answer</label>
		<span id="screate3" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=create_directories">Creating Directories</a>)</span>
	<br /><br />
	</li>
	<li>"cat" lets you manipulate _____<br />
		<img id="icreate41" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create4" id="create41" value="false" /><label for="create41">directories</label><br />
		<img id="icreate42" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create4" id="create42" value="false" /><label for="create42">permissions</label><br />
		<img id="icreate43" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="create4" id="create43" value="true" /><label for="create43">files</label><br />
		<img id="icreate44" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create4" id="create44" value="false" /><label for="create44">kittens</label><br />
		<label class="checkButton" onclick="checkradio('create', '4')">Check your answer</label>
		<span id="screate4" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=create_files">Creating Files</a>)</span>
	<br /><br />
	</li>
	<li>Directory and file names must be a single word.
		<img id="icreate5t" style="display:none;" src="../true.png" alt="true" />
		<img id="icreate5f" style="display:none;" src="../false.png" alt="false" />
		<select id="create5" name="create5">
			<option value=""> - </option>
			<option value="true">True</option>
			<option value="false">False</option>
		</select><br />
		<label class="checkButton" onclick="checkselect('create', '5')">Check your answer</label>
		<span id="screate5" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=create_files">Creating Files</a>)</span>
	<br /><br />
	</li>
	<li>The symbol for your parent directory is:<br />
		<img id="icreate61" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create6" id="create61" value="false" /><label for="create61"> . </label><br />
		<img id="icreate62" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="create6" id="create62" value="true" /><label for="create62"> .. </label><br />
		<img id="icreate63" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create6" id="create63" value="false" /><label for="create63">cd</label><br />
		<img id="icreate64" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create6" id="create64" value="false" /><label for="create64"> ... </label><br />
		<label class="checkButton" onclick="checkradio('create', '6')">Check your answer</label>
		<span id="screate6" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=navigate_directories">Navigating Directories</a>)</span>
	<br /><br />
	</li>
	<li>What is the save command in pico?<br />
		<img id="icreate71" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create7" id="create71" value="false" /><label for="create71">^S</label><br />
		<img id="icreate72" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create7" id="create72" value="false" /><label for="create72">^T</label><br />
		<img id="icreate73" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="create7" id="create73" value="true" /><label for="create73">^O</label><br />
		<img id="icreate74" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="create7" id="create74" value="false" /><label for="create74">^R</label><br />
		<label class="checkButton" onclick="checkradio('create', '7')">Check your answer</label>
		<span id="screate7" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=edit_files">Editing Files</a>)</span>
	<br /><br />
	</li>

	<li>pico allows you to edit files.
		<img id="icreate8t" style="display:none;" src="../true.png" alt="true" />
		<img id="icreate8f" style="display:none;" src="../false.png" alt="false" />
		<select id="create8" name="create8">
			<option value=""> - </option>
			<option value="true">True</option>
			<option value="false">False</option>
		</select><br />
		<label class="checkButton" onclick="checkselect('create', '8')">Check your answer</label>
		<span id="screate8" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=edit_files">Editing Files</a>)</span>
	</li>
</ol>

