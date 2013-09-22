// JavaScript Document

var isIE7
	
if(document.getElementById  && document.attachEvent)
{
	//IE
	isIE7 = ((navigator.userAgent.indexOf("MSIE 7.") != -1) && (navigator.userAgent.indexOf("Opera") == -1));
}
else if(!document.getElementById && document.attachEvent)
{
	//Bad IE
	window.location = "redirect.html";
}
else if(navigator.userAgent.indexOf("Mac") != -1 && document.all)
{
	//Mac IE
	window.location = "redirect.html";
}
else if(document.getElementById)
{
	///Modern browser///Not IE///
}
else
{
	//Really old browser
	window.location = "redirect.html";
}