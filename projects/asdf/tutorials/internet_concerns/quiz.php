<h1>Internet Concerns Quiz</h1>
<ol>
	<li>When looking at the permissions of a file, what does the 
	first character mean?  (before the three permissions triplets)<br />
		<img id="iinternet11" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet1" id="internet11" value="false" /><label for="internet11">Date last modified</label><br />
		<img id="iinternet12" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet1" id="internet12" value="false" /><label for="internet12">You are the owner</label><br />
		<img id="iinternet13" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="internet1" id="internet13" value="true" /><label for="internet13">It's a directory or file</label><br />
		<img id="iinternet14" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet1" id="internet14" value="false" /><label for="internet14">The file is smaller than 1kb</label><br />
		<label class="checkButton" onclick="checkradio('internet', '1')">Check your answer</label>
		<span id="sinternet1" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=permissions">Permissions</a>)</span>
		<br />
	<br /><br />
	</li>

	<li>Which group(owner, group, other) is the only one that can read
	this file with permissions: --wxr-x--x?<br />
		<img id="iinternet21" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet2" id="internet21" value="false" /><label for="internet21">The onwer(u)</label><br />
		<img id="iinternet22" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="internet2" id="internet22" value="true" /><label for="internet22">The group(g)</label><br />
		<img id="iinternet23" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet2" id="internet23" value="false" /><label for="internet23">Other(o)</label><br />
		<img id="iinternet24" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet2" id="internet24" value="false" /><label for="internet24">Scooby Doo(sD)</label><br />
		<label class="checkButton" onclick="checkradio('internet', '2')">Check your answer</label>
		<span id="sinternet2" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=num_permissions">Numeric Permissions</a>)</span>
		<br />
	<br /><br />
	</li>
	<li>What are the numeric permissions for --wxr-x--x?<br />
	
		<img id="iinternet31" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="internet3" id="internet31" value="true" /><label for="internet31">351</label><br />
		<img id="iinternet32" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet3" id="internet32" value="false" /><label for="internet32">562</label><br />
		<img id="iinternet33" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet3" id="internet33" value="false" /><label for="internet33">434</label><br />
		<img id="iinternet34" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet3" id="internet34" value="false" /><label for="internet34">142</label><br />
		<label class="checkButton" onclick="checkradio('internet', '3')">Check your answer</label>
		<span id="sinternet3" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=num_permissions">Numeric Permissions</a>)</span>
		<br />
	<br /><br />
	</li>
	<li>Which command will list the permissions of the files
	and the directories in your current directory?<br />
		<img id="iinternet41" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet4" id="internet41" value="false" /><label for="internet41">ls</label><br />
		<img id="iinternet42" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet4" id="internet42" value="false" /><label for="internet42">ls -a</label><br />
		<img id="iinternet43" style="display:none;margin-right:6px;" src="../false.png" alt="false" /><input type="radio" name="internet4" id="internet43" value="false" /><label for="internet43">chmod</label><br />
		<img id="iinternet44" style="display:none;margin-right:6px;" src="../true.png" alt="true" /><input type="radio" name="internet4" id="internet44" value="true" /><label for="internet44">ls -l</label><br />
		<label class="checkButton" onclick="checkradio('internet', '4')">Check your answer</label>
		<span id="sinternet4" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=permissions">Permissions</a>)</span>
		<br />
	<br /><br />
	</li>

	<li>Check all of the following permissions that apply.  Which 
	will give write access to "other" (the rest of the world)?
	<img id="iinternet5t" style="display:none;" src="../true.png" alt="true" />
	<img id="iinternet5f" style="display:none;" src="../false.png" alt="false" /><br />
	
	<input type="checkbox" name="internet51" id="internet51" value="false" /><label for="internet51">755</label><br/>
	<input type="checkbox" name="internet52" id="internet52" value="false" /><label for="internet52">644</label><br/>
	<input type="checkbox" name="internet53" id="internet53" value="true" /><label for="internet53">666</label><br/>
	<input type="checkbox" name="internet54" id="internet54" value="true" /><label for="internet54">777</label><br/>
	<label class="checkButton" onclick="checkcheck('internet', '5')">Check your answer</label>
	<span id="sinternet5" class="brushuphint" style="display:none;">(brush up on this question - <a href="?section=num_permissions">Numeric Permissions</a>)</span>
	<br />
	</li>
</ol>
