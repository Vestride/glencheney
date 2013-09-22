//var isGecko = (document.getElementById && !document.all) ? 1 : 0;
var oldY = 0;
var offsetY = 75;
var nodeCount = 0;
var zCount = 10;

var perk1 = '';
var perk2 = '';
var perk3 = '';
var weapon = '';
var attachment = '';
var secondaryWeapon = '';
var equipment = '';

var myValue = new Object();

var data = new Array();
data['start'] = ["Which perk to start with?", "Stopping Power","Cold-blooded","Lightweight","Danger Close"];

//Tier 2
data['Stopping Power'] = ["What are you?","Sniper","Rambo","Camper"];
data['Cold-blooded'] = ["Why Coldblooded?","I'm Stealthy","To destroy air support"];
data['Lightweight'] = ["You're going to?","Run and Gun","Use a LMG"];
data['Danger Close'] = ["Are you a jerk?","Yep","No!"];

//Tier 3
data['Sniper'] = ["Select your accuracy?","Precise","Mediocre","Wild"];
data['Rambo'] = ["How Ninja are you?","Ninja","Not ninja"];
data['Camper'] = ["What do you prefer?","Claymores","C4"];
data["I'm Stealthy"] = ["Stealthy as in campy?","Yeah I camp","Nope I love flanking people"]; 
data['Run and Gun'] = ["What's your tool of destruction?","Stealth","Knife"];
data['Yep'] = ["What do you prefer?","Grenade Launcher","RPG"];
data['No!'] = ["Trying to get a nuke?","Nuke!","No I just like suped up killstreaks"]; 

//Tier 4
data['Nope I love flanking people'] = ["Short or long range?","Short","Long"];

	function construct(which)
	{
		if(which == 'start')
		{
			var formElement = document.createElement('form');
			formElement.setAttribute('method', 'post');
			if(isIE7)
				formElement.setAttribute('onsubmit', function(){return Validate();});
			else
				formElement.setAttribute('onsubmit', 'return Validate()');
			$$('body',0).appendChild(formElement);
			myValue = 'start';
		}
		else
		{
			while(which.parentNode != which.parentNode.parentNode.lastChild)
			{
				which.parentNode.parentNode.removeChild(which.parentNode.parentNode.lastChild);
				oldY -= offsetY;
				nodeCount--;
				zCount++;
			}
			myValue =  which.value;
		}
		
		//If there's data for the selected value
		if(data[myValue])
		{
			nodeCount++;
			
			//Create a select and give it attributes
			var selectElement = document.createElement('select');
			selectElement.setAttribute('class', 'selectEl');
			if(isIE7)
				selectElement.setAttribute('onchange', function(){construct(this);});
			else
				selectElement.setAttribute('onchange', 'construct(this)');
			
			//Loop through the length of the values in the data and create an option for each one.
			for(var i = 0; i < data[myValue].length; i++)
			{
				var optionElement = document.createElement('option');
				optionElement.setAttribute('value', data[myValue][i]);
				optionElement.appendChild(document.createTextNode(data[myValue][i]));
				selectElement.appendChild(optionElement);
			}
			
			//Append the select to the end of the form
			var divElement = document.createElement('div');
			divElement.setAttribute('class', 'selectDiv');
			zCount--;
			divElement.setAttribute('style', "z-index:" + zCount)
			//For IE7 style fix
			divElement.setAttribute('id', 'node' + nodeCount);
			
			divElement.appendChild(selectElement);
			$$('form', 0).appendChild(divElement);
			
			//For IE7 style fix
			if(isIE7)
			{
				$('node' + nodeCount).style.zIndex = zCount;
				$('node' + nodeCount).style.position = "absolute";
				$('node' + nodeCount).style.margin = "10px 0px 10px 0px";
				$('node' + nodeCount).style.padding = "20px 10px 20px 10px";
				$('node' + nodeCount).style.width = "400px";
				$('node' + nodeCount).style.height = "30px";
				$('node' + nodeCount).style.backgroundColor = "#141414";
				$('node' + nodeCount).style.left = "0px";
				$('node' + nodeCount).style.top = "0px";
				$('node' + nodeCount).style.border = "2px solid #7BB352";
			}
			
			
			//ANIMATE
			if(myValue == 'start')
			{
				$$('form', 0).lastChild.style.top = '-30px';
				var newY = 10;
			}
			else
			{
				$$('form', 0).lastChild.style.top = oldY + 'px';
				var newY = oldY + offsetY;
			}
			
			$$('form', 0).lastChild.style.left = '10px';
			
			slideDown($$('form', 0).lastChild, newY);
			oldY = newY;
		}
		else
		{
			//make sure they didn't select the question
			if(myValue.indexOf("?") == -1)
			{					
				//we're done here - create the final div and animate it
				var divElement = document.createElement('div')
				divElement.setAttribute('id', 'endDiv');
				zCount--;
				divElement.setAttribute('style', "z-index:" + zCount);
				
				var headerElement = document.createElement('h3');
				headerElement.appendChild(document.createTextNode('Your Custom Class'));
				headerElement.setAttribute('style', 'position: relative; left: 200px');
				headerElement.setAttribute('id', 'headEl');
				divElement.appendChild(headerElement);
				
				var weaponHeader = document.createElement('h4');
				weaponHeader.appendChild(document.createTextNode('Your tools of destruction'));
				divElement.appendChild(weaponHeader);
				
				var perkHeader = document.createElement('h4');
				perkHeader.appendChild(document.createTextNode('Your preferred perks'));
				perkHeader.setAttribute('style', 'position: absolute; left: 350px; top: 50px');
				perkHeader.setAttribute('id', 'perkEl');
				divElement.appendChild(perkHeader);
				
				
				
				for(var j = 0; j < buildClass().length; j++)
				{
					//The last three items are always perks
					var notPerks = buildClass().length - 3
					if(j < notPerks)
					{
						var currentItem = buildClass()[j];
						var pTag = document.createElement('p');
						var pText = document.createTextNode(currentItem);
						pTag.appendChild(pText);
						var theImg = document.createElement('img');
						theImg.setAttribute('src', 'media/' + currentItem + '.jpg');
						theImg.setAttribute('alt', currentItem);
						divElement.appendChild(pTag);
						divElement.appendChild(theImg);
					}
					//Perks are positioned to the right
					else
					{
						var offset = j - notPerks;
						var currentItem = buildClass()[j];
						var pTag = document.createElement('p');
						pTag.setAttribute('style', 'position: absolute; left: 420px; top: ' + (offset*100 + 120) + 'px');
						pTag.setAttribute('id', 'perk' + offset + 'P');
						var pText = document.createTextNode(currentItem);
						pTag.appendChild(pText);
						var theImg = document.createElement('img');
						theImg.setAttribute('src', 'media/' + currentItem + '.jpg');
						theImg.setAttribute('alt', currentItem);
						theImg.setAttribute('style', 'position: absolute; left: 350px; top: ' + (offset*100 + 120) + 'px');
						theImg.setAttribute('id', 'perk' + offset + 'Img');
						divElement.appendChild(pTag);
						divElement.appendChild(theImg);
					}
				}
				$$('form', 0).appendChild(divElement);
				
				$('endDiv').style.left = '200px';
				$('endDiv').style.top = '20px';
				slideRight($('endDiv'),450);
				
				oldY += offsetY;
				nodeCount++;
				
				zCount--;
				var divForm = document.createElement('div');
				divForm.setAttribute('id', 'inputDiv');
				
				//TITLE
				var headEl = document.createElement('h4');
				headEl.appendChild(document.createTextNode('Send your custom class to yourself!'));
				divForm.appendChild(headEl);
				
				//NAME
				var pElement = document.createElement('p');
				var ptagText = document.createTextNode('Your name:');
				pElement.appendChild(ptagText);
				divForm.appendChild(pElement);
				
				var nameBox = document.createElement('input');
				nameBox.setAttribute('type', 'text');
				nameBox.setAttribute('name', 'name');
				divForm.appendChild(nameBox);
				
				var starName = document.createElement('span');
				starName.appendChild(document.createTextNode('*Required'));
				starName.setAttribute('style', 'color: red; display: none;');
				starName.setAttribute('id', 'nameStar');
				divForm.appendChild(starName);
				
				//EMAIL
				var pElement2 = document.createElement('p');
				pElement2.appendChild(document.createTextNode('Your email:'));
				divForm.appendChild(pElement2);
				
				var emailBox = document.createElement('input');
				emailBox.setAttribute('type', 'text');
				emailBox.setAttribute('name', 'email');
				divForm.appendChild(emailBox);
				
				var starEmail = document.createElement('span');
				starEmail.appendChild(document.createTextNode('*Required'));
				starEmail.setAttribute('style', 'color: red; display: none;');
				starEmail.setAttribute('id', 'emailStar');
				divForm.appendChild(starEmail);
				
				//COMMENT
				var pElement3 = document.createElement('p');
				pElement3.appendChild(document.createTextNode('Your comment:'));
				divForm.appendChild(pElement3);
				
				var commentBox = document.createElement('textarea');
				commentBox.setAttribute('name', 'msg');
				divForm.appendChild(commentBox);
				
				//BREAK
				var myBreak = document.createElement('br');
				divForm.appendChild(myBreak);
				
				//CHECKBOX
				var checkBox = document.createElement('input');
				checkBox.setAttribute('type', 'checkbox');
				if(isIE7)
					checkBox.setAttribute('onclick', function(){makeCookies(this);});
				else
					checkBox.setAttribute('onchange', 'makeCookies(this);');
				divForm.appendChild(checkBox);
				
				//LABEL FOR CHECKBOX
				var myLabel = document.createElement('span');
				myLabel.appendChild(document.createTextNode('Save info?'));
				divForm.appendChild(myLabel);
				
				//BREAK
				var myBreak2 = document.createElement('br');
				divForm.appendChild(myBreak2);
				
				//SUBMIT
				var mySubmit = document.createElement('input');
				mySubmit.setAttribute('type', 'submit');
				mySubmit.setAttribute('value', 'Send!');
				divForm.appendChild(mySubmit);
				
				//RESET
				var myReset = document.createElement('input');
				myReset.setAttribute('type', 'reset');
				myReset.setAttribute('value', 'Reset!');
				divForm.appendChild(myReset);
				
				$$('form',0).appendChild(divForm);
				
				
				$('inputDiv').style.left = '-400px';
				$('inputDiv').style.top = ((nodeCount*offsetY)-40) + 'px';
				slideRight($('inputDiv'), 10);
				
				oldY += offsetY;
				nodeCount++;
				
				//If there are already cookies, set them and change the checkbox to reflect that
				if(GetCookie('name') != null)
				{
					document.forms[0].elements[document.forms[0].elements.length - 6].value = GetCookie('name');
				}
				if(GetCookie('email') != null)
				{
					document.forms[0].elements[document.forms[0].elements.length - 5].value = GetCookie('email');
				}
				
				if(GetCookie('name') != null || GetCookie('email') != null)
				{
					document.forms[0].elements[document.forms[0].elements.length - 3].checked = true;
				}
				else
				{
					document.forms[0].elements[document.forms[0].elements.length - 3].checked = false;
				}
				
				//IE7 styles fix
				if(isIE7)
				{
					$('headEl').style.position = "relative";
					$('headEl').style.left = "200px";
					$('perkEl').style.position = "absolute";
					$('perkEl').style.left = "350px";
					$('perkEl').style.top = "50px";
					$('nameStar').style.display = "none";
					$('nameStar').style.color = "red";
					$('emailStar').style.display = "none";
					$('emailStar').style.color = "red";
					for(var p = 0; p < 3; p++)
					{
						$('perk' + p + 'P').style.position = "absolute"
						$('perk' + p + 'P').style.left = "420px";
						$('perk' + p + 'P').style.top = (p*100 + 120) + 'px';
						$('perk' + p + 'Img').style.position = "absolute"
						$('perk' + p + 'Img').style.left = "350px";
						$('perk' + p + 'Img').style.top = (p*100 + 120) + 'px';
					}
				}
			}
		}
	}
	
function slideDown(element, toY)
{
	if(parseInt(element.style.top) < toY)
	{
		element.style.top = parseInt(element.style.top) + 5 + 'px';
		setTimeout(function(){ slideDown(element, toY); }, 30);
	}
}
function slideRight(element, toX)
{
	if(parseInt(element.style.left) < toX)
	{
		element.style.left = parseInt(element.style.left) + 5 + 'px';
		setTimeout(function(){ slideRight(element, toX); }, 25);
	}
}
function slideLeft(element, toX)
{
	if(parseInt(element.style.left) > toX)
	{
		element.style.left = parseInt(element.style.left) - 5 + 'px';
		setTimeout(function(){ slideLeft(element, toX); }, 25);
	}
}


function buildClass()
{
	var items = new Array();
	var numSelects = document.forms[0].elements.length;
	
	switch(document.forms[0].elements[numSelects-1].value)
	{
		case 'Precise':
			weapon = "Intervention";
			attachment = "FMJ";
			perk1 = "Sleight of Hand Pro";
			perk2 = "Stopping Power Pro"
			perk3 = "Ninja Pro"
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Mediocre':
			weapon = "Barret .50cal";
			attachment = "FMJ";
			perk1 = "Sleight of Hand Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Steady Aim Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Wild':
			weapon = "M21 EBR";
			attachment = "FMJ";
			perk1 = "Sleight of Hand Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Steady Aim Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Ninja':
			weapon = "Mini-uzi";
			attachment = "Silencer";
			perk1 = "Marathon Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Not ninja':
			weapon = "M4 Carbine";
			attachment = "Red Dot";
			perk1 = "Sleight of Hand Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Steady Aim Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Claymores':
			weapon = "ACR";
			attachment = "Silencer";
			equipment = "Claymore";
			perk1 = "Scavenger Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, equipment, perk1, perk2, perk3];
			break;
		case 'C4':
			weapon = "UMP";
			attachment = "Red Dot";
			equipment = "Claymore";
			perk1 = "Scavenger Pro";
			perk2 = "Stopping Power Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, equipment, perk1, perk2, perk3];
			break;
		case 'Yeah I camp':
			weapon = "FAMAS";
			attachment = "Heartbeat Sensor"
			var attachment2 =  "Silencer";
			perk1 = "Bling Pro";
			perk2 = "Coldblooded Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, attachment2, perk1, perk2, perk3];
			break;
		case 'Short':
			weapon = "UMP";
			attachment = "Silencer"
			perk1 = "Marathon Pro";
			perk2 = "Coldblooded Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Long':
			weapon = "Barret .50cal";
			attachment = "FMJ"
			perk1 = "Sleight of Hand Pro";
			perk2 = "Coldblooded Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'To destroy air support':
			weapon = "Tar";
			attachment = "Silencer"
			secondaryWeapon =  "Stinger";
			equipment = "Semtex";
			perk1 = "Sleight of Hand Pro";
			perk2 = "Coldblooded Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, secondaryWeapon, equipment, perk1, perk2, perk3];
			break;
		case 'Knife':
			secondaryWeapon = "Tac Knife";
			equipment = "Throwing Knife";
			perk1 = "Marathon Pro";
			perk2 = "Lightweight Pro";
			perk3 = "Commando Pro";
			items = [secondaryWeapon, equipment, perk1, perk2, perk3];
			break;
		case 'Stealth':
			weapon = "UMP";
			attachment = "Silencer"
			perk1 = "Marathon Pro";
			perk2 = "Lightweight Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Use a LMG':
			weapon = "RPD";
			attachment = "Grip"
			perk1 = "Sleight of Hand Pro";
			perk2 = "Lightweight Pro";
			perk3 = "Steady Aim Pro";
			items = [weapon, attachment, perk1, perk2, perk3];
			break;
		case 'Grenade Launcher':
			weapon = "M4 Carbine";
			attachment = "Grenade Launcher"
			secondaryWeapon =  "Thumper";
			equipment = "C4";
			perk1 = "Scavenger Pro";
			perk2 = "Danger Close Pro";
			perk3 = "Commando Pro";
			items = [weapon, attachment, secondaryWeapon, equipment, perk1, perk2, perk3];
			break;
		case 'RPG':
			weapon = "M4 Carbine";
			attachment = "Red Dot"
			secondaryWeapon =  "RPG";
			equipment = "C4";
			perk1 = "Scavenger Pro";
			perk2 = "Danger Close Pro";
			perk3 = "Commando Pro";
			items = [weapon, attachment, secondaryWeapon, equipment, perk1, perk2, perk3];
			break;
		case 'Nuke!':
			weapon = "ACR";
			attachment = "Red Dot"
			equipment = "Claymore";
			perk1 = "One Man Army Pro";
			perk2 = "Danger Close Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, equipment, perk1, perk2, perk3];
			break;
		case 'No I just like suped up killstreaks':
			weapon = "M16";
			attachment = "Red Dot"
			secondaryWeapon =  "RPG";
			equipment = "C4";
			perk1 = "Scavenger Pro";
			perk2 = "Danger Close Pro";
			perk3 = "Ninja Pro";
			items = [weapon, attachment, secondaryWeapon, equipment, perk1, perk2, perk3];
			break;
	}
	return items;
	//http://www.modernwarfare247.com/weapons
}

function Validate()
{
	var value = true;
	var numElements = document.forms[0].elements.length;
	
	if(document.forms[0].elements[numElements - 6].value == '')
	{
		value = false
		document.forms[0].elements[numElements - 6].nextSibling.style.display = '';
	}
	else
	{
		document.forms[0].elements[numElements - 6].nextSibling.style.display = 'none';
	}
	
	if(document.forms[0].elements[numElements - 5].value == '')
	{
		value = false
		document.forms[0].elements[numElements - 5].nextSibling.style.display = '';
	}
	else
	{
		document.forms[0].elements[numElements - 5].nextSibling.style.display = 'none';
	}
	
	return value;
}
function makeCookies()
{
	//if it's checked, set cookies, otherwise, delete them
	if(document.forms[0].elements[document.forms[0].elements.length - 3].checked == true)
	{
		SetCookie('name', document.forms[0].elements[document.forms[0].elements.length - 6].value);
		SetCookie('email', document.forms[0].elements[document.forms[0].elements.length - 5].value);
	}
	else
	{
		DeleteCookie('name');
		DeleteCookie('email');
	}
}

function $(which)
{
	return document.getElementById(which);
}
function $$(tag, whichIndex)
{
	return document.getElementsByTagName(tag)[whichIndex];
}