<?php
session_start();
//$url = "http://nova.it.rit.edu/~gec5190/pfw/project3/A/";
$url = "http://www.glencheney.com/projects/jeopardy/admin/";
//$action = "http://people.rit.edu/gec5190/pfw/project3/B/index.php";
$action = $_SERVER['PHP_SELF'];

if(isset($_POST['gameover'])) {
    session_unset();
    session_destroy();
}

//User has just chosen a round to play
if(isset($_POST['currentRound'])) {
    $_SESSION['currentRound'] = $_POST['currentRound'];
    $_SESSION['roundId'] = $_POST[$_POST['currentRound']];
}
//No round selected - give them the available rounds
else if(!isset($_SESSION['currentRound'])){
    $rounds = new SimpleXMLElement($url.'get_available_rounds.php', null, true);
    $availableRounds = array();
    foreach($rounds as $round) {
        $id = (int)$round['id'];
        $availableRounds[$id] = (string)$round['title'];
    }

    $content = "<div id='container' style='positin:relative'>\n";
    $content .= Functions::nav();
    $content .= "<div id='availableRounds'>\n";
    $content .= "<h2>Choose a round</h2>";
    $content .= '<form action="'.$action.'" method="post">';
    foreach($availableRounds as $id => $round) {
        $content .= "<input type='submit' name='currentRound' value='$round' />\n";
        $content .= "<input type='hidden' name='$round' value='$id' />\n";
    }
    $content .= "</form>\n";
    $content .= "</div>\n";
    $content .= "</div>\n";
    $page = new Page('Jeopardy', 'styles.css', $content);
    echo $page->toString();
}

//Final question has been answered
if(isset($_POST['finalBet'])) {
    $safeScore = $_SESSION['points'] - $_POST['finalBet'];
    $bet = $_POST['finalBet'];
    if(isset($_POST['correct']))
        $reward = $bet*2;
    else if (isset($_POST['incorrect']))
        $reward = 0;
    $finalScore = $safeScore + $reward;

    $content = '';
    $content .= "<div id='container' style='position: relative;'>\n";

    //Score and links
    $content .= Functions::nav();

    $content .= "<h1 style='text-align:center;margin-top:150px;'>Your final score is: $finalScore</h1>";
    
    $content .= "<div style='width:150px; margin: auto;'>\n";
    $content .= Functions::newRoundButton($action);
    $content .= "</div>\n";

    $content .= "</div>\n"; //#container
    $page = new Page('Jeopardy', 'styles.css', $content);
    echo $page->toString();

}
//Else there are still questions left
else if(isset($_SESSION['currentRound'])) {
    //Instantiate points if it isn't already
    if(!isset($_SESSION['points']))
        $_SESSION['points'] = 0;

    //User submitted an answer
    if(isset($_POST['correct']) || isset($_POST['incorrect'])) {
        //Add or subtract points
        if(isset($_POST['correct']))
            $_SESSION['points'] += $_POST['points'];
        else if(isset($_POST['incorrect']))
            $_SESSION['points'] -= $_POST['points'];
        
        //Mark that question 'answered'
        $i_j = $_POST['i'].'_'.$_POST['j'];
        $_SESSION[$i_j] = $i_j;
    }

    //Grab the wholte round's xml
    $categories = new SimpleXMLElement($url.'get_round.php?round='.$_SESSION['roundId'], null, true);
    $content = '';
    $content .= "<div id='container' style='position: relative;'>\n";

    //Popop for questions
    $content .= "<div id='popup'>\n";
    $content .= "<p class='box_question'>Something in the box</p><br />\n";
    $content .= "<p class='box_answer' style='display: none;'>Answer</p><br />\n";
    $content .= "<button onclick='showAnswer();' class='answerButton'>Show Answer</button><br /><br />\n";
    $content .= '<form action="'.$action.'" method="post">';
    $content .= "<input type='hidden' name='points' value='' />\n";
    $content .= "<input type='hidden' name='i' value='' />\n";
    $content .= "<input type='hidden' name='j' value='' />\n";
    $content .= "\t<input type='submit' name='correct' value='Correct!' />\n";
    $content .= "\t<input type='submit' name='incorrect' value='Incorrect' />\n";
    $content .= "</form>\n";
    $content .= "<a href='#' onclick='closeQuestion(); return false;'>Close</a>\n";
    $content .= "</div>\n";

    //Score and links
    $content .= Functions::nav();

    $content .= "<div id='game'>\n";
    $table = "<table>\n";

    $ordered = array();
    $unsorted = new stdClass();
    $titles = array();
    $numCategories = 5;

    //Table headers
    $table .= "<tr>\n";
    foreach($categories->category_set->category as $category) {
        $title = (string) $category['title'];
        $titles[] = $title;
        $table .= "<th>$title</th>\n";
    }
    $table .= "</tr>\n";

    //Sort questions by value
    foreach($categories->category_set->category as $category) {
        $title = (string) $category['title'];
        $i = 0;
        foreach($category as $question) {
            $unsorted->$i->value = (int)$question['value'];
            $unsorted->$i->question = (string)$question->q;
            $unsorted->$i->answer = (string)$question->a;
            $i++;
        }
        //Convert our object to an array
        $unsortedObjectArray = objectToArray($unsorted);

        //Sort array based on value
        usort($unsortedObjectArray,'Functions::compareValue');

        //Add sorted array to our 'total' array
        $ordered[$title] = $unsortedObjectArray;
    }

    //Build table
    for($i = 0; $i < $numCategories; $i++) {
        $table .= "<tr>\n";
        for($j = 0; $j < $numCategories; $j++) {
            $cleanQuestion = Functions::cleanUpQuotes($ordered[$titles[$j]][$i]['question']);
            $value = $ordered[$titles[$j]][$i]['value'];
            $answer = $ordered[$titles[$j]][$i]['answer'];
            
            
            $i_j = $i.'_'.$j;
            if(isset($_SESSION[$i_j])) {
                $table .= "<td>&nbsp;</td>\n";
                continue;
            }
            $table .= "<td>\n";
            $table .= "\t<a href='#' onclick='displayQuestion(this); return false;'>$value</a>\n";
            $table .= "\t<input type='hidden' class='points' value='$value' />";
            $table .= "\t<input type='hidden' class='question' value='$cleanQuestion' />";
            $table .= "\t<input type='hidden' class='answer' value='$answer' />\n";
            $table .= "\t<input type='hidden' class='i' value='$i' />\n";
            $table .= "\t<input type='hidden' class='j' value='$j' />\n";
            $table .= "</td>\n";
        }
        $table .= "</tr>\n";
    }
    $table .= "</table>\n";
    $content .= $table;

    //Check to see if all the questions have been answered
    $allAnswered = true;
    for($i = 0; $i < $numCategories; $i++) {
        for($j = 0; $j < $numCategories; $j++) {
            $i_j = $i.'_'.$j;
            if(!isset($_SESSION[$i_j])) {
                $allAnswered = false;
            }
        }
    }

    if($allAnswered) {
        $cleanQuestion = Functions::cleanUpQuotes($categories->category_set->final_question->q);
        $content .= "<a href='#' onclick='showFinalQuestion(); return false;' style='color: blue; text-align: center;'><h1>Final Question</h1></a>\n";
        $content .= "<input type='hidden' class='finalQuestion' value='".$cleanQuestion."' />";
        $content .= "<input type='hidden' class='finalAnswer' value='".$categories->category_set->final_question->a."' />\n";
    }

    $content .= "</div>\n"; //#game
    $content .= "</div>\n"; //#container
    $page = new Page('Jeopardy', 'styles.css', $content);
    echo $page->toString();
}
function objectToArray($object) {
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    if (is_object($object)) {
        $object = get_object_vars($object);
    }
    return array_map('objectToArray', $object);
}
function __autoload($className) {
    require_once $className . '.class.php';
}
?>
