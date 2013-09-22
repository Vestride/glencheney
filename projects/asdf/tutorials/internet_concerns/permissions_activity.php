<h1>Try it out!</h1>


<ul style="float:left;">
<li>Owner</li>
<li><input type="checkbox" name="perm00" id="perm00" onclick="changeText()" /><label for="perm00">read</label></li>
<li><input type="checkbox" name="perm10" id="perm10" onclick="changeText()" /><label for="perm10">write</label></li>
<li><input type="checkbox" name="perm20" id="perm20" onclick="changeText()" /><label for="perm20">execute</label></li>
</ul>
<ul style="float:left;">
<li>Group</li>
<li><input type="checkbox" name="perm01" id="perm01" onclick="changeText()" /><label for="perm01">read</label></li>
<li><input type="checkbox" name="perm11" id="perm11" onclick="changeText()" /><label for="perm11">write</label></li>
<li><input type="checkbox" name="perm21" id="perm21" onclick="changeText()" /><label for="perm21">execute</label></li>
</ul>
<ul style="float:left; clear:right;">
<li>Other</li>
<li><input type="checkbox" name="perm02" id="perm02" onclick="changeText()" /><label for="perm02">read</label></li>
<li><input type="checkbox" name="perm12" id="perm12" onclick="changeText()" /><label for="perm12">write</label></li>
<li><input type="checkbox" name="perm22" id="perm22" onclick="changeText()" /><label for="perm22">execute</label></li>
</ul>
<h2 style="clear:both; padding-top:1em;">Result:</h2>
<input type="text" name="text" id="text" value="000" onchange="changeBoxes()" style="clear:both;" />
<input type="button" id="reset" name="reset" onclick="clearAll()" value="Reset" style="clear:both;" />
<div id="error" style="display:none clear:both;" ></div>



