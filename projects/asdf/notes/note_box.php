<form action="" method="post">
<div id="notes_box" style="display:<?php 
if (!isset($_SESSION['show_notes']) || $_SESSION['show_notes'] == 'off'){
	echo "none";
}?>;"><span id="this_id_for_ie7">Notes
<span id="notes_not_saved" style="font-weight:bold;color:red;display:none"> - not saved</span></span>

<label class="checkButton save_button" onclick="trySubmit=true;document.forms[1].submit()">Save</label>

<textarea class="ie7_move_up" name="notes" style="height:150px;width:<?php

if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")) //internet explorer
	echo 194;
else if (strpos($_SERVER["HTTP_USER_AGENT"], "Chrome"))
	echo 194;
else 
	echo "198";

?>px;" rows="10" cols="5" onkeypress="notesChange();">
<?php 
	if (isset($_SESSION['notes'])){
		echo $_SESSION['notes'];
	} 
?>
</textarea><br />

<a href="javascript:trySubmit=true;document.forms[1].submit();printNotes();" style="float:right;" class="checkButton ie7_move_up">Print your notes</a>
</div>
<div style="display:inline;">
<?php include ("turn_on_off.php");?>
</div>
</form>