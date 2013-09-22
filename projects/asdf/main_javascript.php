<?php
header("Content-Type: text/javascript");
?>
var notesChanged = false;
window.onbeforeunload=saveNotes;
var trySubmit = false;
function searchStay(action){
	if (action == "stay"){
		document.getElementById("searchul").style.display="block";
	}else if (action == "go"){
		document.getElementById("searchul").style.display="";
	}
}

function notesChange(){
	document.getElementById("notes_not_saved").style.display="";
	notesChanged = true;
}

function printNotes(){
	open("http://nova.it.rit.edu/~409Dan-asdf/notes/print_notes.php", "notes", "status=0,toolbar=0,location=0,height=400,width=400");
}

function saveNotes(){
	<?php
	if (strpos($_SERVER["HTTP_USER_AGENT"], "Firefox/3")){
		echo "if (trySubmit === false && notesChanged === true){
		document.forms[1].submit();
		trySubmit=true;
		}";
	}else {
		echo 'if (notesChanged === true && trySubmit === false) return "You\'re notes are not saved. If you navigate away from this page your changes will be lost";';
	}
	?>
}
/*Permissions activity*/
	function clearAll(){
		$("text").value="000";
		clearBoxes();
		
	}
	
	function clearBoxes(){
		for(var x=0;x<3;x++){
			for(var y=0;y<3;y++){
				$("perm"+x+y).checked=false;
			}	
		}
	}
	
	function changeText(){
		var permission="";
		var value;
		for(var x=0;x<3;x++){
			var num=8;
			value=0;
			for(var y=0;y<3;y++){
				num=num/2;
				if ($("perm"+y+x).checked==true){
					value+=num;
				}
			}	
			permission+=value.toString();
		}
		$("text").value=permission;
	}
	
	function changeBoxes(){
		var perm=document.getElementById("text").value;
		if (perm.length>3){
			$("error").innerHTML="Too long, you need 3 numbers.";
			$("error").style.display="block";
		}else if(perm.length<3){
			$("error").innerHTML="Too short, you need 3 numbers.";
			$("error").style.display="block";
		}else{
			var bool=false;
			for(var x=0;x<3;x++){
				var position=perm.charAt(x);
				switch(position){
				case "0":
						$("perm0"+x).checked=false;
						$("perm1"+x).checked=false;
						$("perm2"+x).checked=false;
						break;
				case "1":
						$("perm0"+x).checked=false;
						$("perm1"+x).checked=false;
						$("perm2"+x).checked=true;
						break;
				case "2":
						$("perm0"+x).checked=false;
						$("perm1"+x).checked=true;
						$("perm2"+x).checked=false;
						break;
				case "3":
						$("perm0"+x).checked=false;
						$("perm1"+x).checked=true;
						$("perm2"+x).checked=true;
						break;
				case "4":
						$("perm0"+x).checked=true;
						$("perm1"+x).checked=false;
						$("perm2"+x).checked=false;
						break;
				case "5":
						$("perm0"+x).checked=true;
						$("perm1"+x).checked=false;
						$("perm2"+x).checked=true;
						break;
				case "6":
						$("perm0"+x).checked=true;
						$("perm1"+x).checked=true;
						$("perm2"+x).checked=false;
						break;
				case "7":
						$("perm0"+x).checked=true;
						$("perm1"+x).checked=true;
						$("perm2"+x).checked=true;
						break;
				default:
					$("error").innerHTML="only numbers 0-7 are allowed";
					$("error").style.display="block";
					bool=true;
			}
			}
			if (bool){//incorrect letters
				clearBoxes();
			}else{
				$("error").style.display="none";
			}
		}
	}
	
	function $(element){
		return document.getElementById(element);
	}