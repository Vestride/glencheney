<?php

//start to display "Turn on/off notes"
echo '<a class="checkButton ie7_move_up';

if (!isset($_SESSION['show_notes']) || $_SESSION['show_notes'] == 'off') echo " ie7_on_button_move";//adds a class to move down the "turn on notes" button for ie7

echo '" style="float:left;" href="'; //echo first part of link
echo "?";//begin $_GET variables
if (isset($_GET)){//if there already are get variables on this page
$i=0; //counts number of $_GET elements 
	foreach ($_GET as $index => $foo){//loop through them, put them in the link so they aren't lost when the link is clicked
		if($index != "notes"){//if the $_GET variable is a previous notes variable, don't print it
			if ($i != 0) echo "&amp;";//echo an ampersand if this isn't the first time through the loop
			$i++; //increase count
			echo $index."=".$foo;//echo the $_GET variable into the link url
		}
	}
	if ($i!=0)echo "&amp;";//echo and ampersand if any $_GET variables were put into the link url
}
echo 'notes='; //echo the first part of the notes variable
if ($_SESSION['show_notes'] == 'on') echo "off"; //if notes are on, variable shuts them off
else if (!isset($_SESSION['show_notes']) || $_SESSION['show_notes'] == 'off') echo "on";//if notes are off, variable turns them on
echo '">Turn ';//start echoing link text
if ($_SESSION['show_notes'] == 'on') echo "off";//if notes are on, text says to turn them off
else if (!isset($_SESSION['show_notes']) || $_SESSION['show_notes'] == 'off') echo "on";//if notes are off, text says to turn them on
echo' Notes</a>';//finish echoing the link
//end display "Turn on/off notes"

?>