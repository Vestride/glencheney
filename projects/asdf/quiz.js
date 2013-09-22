function checkradio(quiz, number){
	var checked;
	for (i=1;i<=4;i++){
		if (document.getElementById(quiz+number+i).checked){
			document.getElementById("i"+quiz+number+i).style.display="";
			document.getElementById(quiz+number+i).style.display="none";
			checked=document.getElementById(quiz+number+i).value;
		}
	}
	if (checked == "false"){
		document.getElementById("s"+quiz+number).style.display="";
	}
}

function checkselect(quiz, number){
	document.getElementById("i"+quiz+number+"t").style.display="none";
	document.getElementById("i"+quiz+number+"f").style.display="none";
	if (document.getElementById(quiz+number).value == "true"){
		document.getElementById("i"+quiz+number+"t").style.display="";
	}else if (document.getElementById(quiz+number).value == "false"){
		document.getElementById("i"+quiz+number+"f").style.display="";
		if (quiz == "log_in" && number=="3"){
			document.getElementById("s"+quiz+"2").style.display=""; //because there are 2 questions  with one clue box
		}else {
			document.getElementById("s"+quiz+number).style.display="";
		}
	}
}

function checkcheck(quiz, number){
	var verify = "true";
	document.getElementById("i"+quiz+number+"t").style.display = "none";
	document.getElementById("i"+quiz+number+"f").style.display = "none";
	
	for (i=1;i<=4;i++){
		if ((document.getElementById(quiz+number+i).checked && document.getElementById(quiz+number+i).value!="true")
			||
			(!document.getElementById(quiz+number+i).checked && document.getElementById(quiz+number+i).value=="true")){
			verify="false";
		}
	}
	if (verify == "false"){
		document.getElementById("i"+quiz+number+"f").style.display = "";
		document.getElementById("s"+quiz+number).style.display="";
	}else if (verify == "true"){
		document.getElementById("i"+quiz+number+"t").style.display = "";
	}
}