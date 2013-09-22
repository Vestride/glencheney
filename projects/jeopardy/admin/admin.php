<?php
session_start();
if(isset($_SESSION['auth_user']) && $_SESSION['auth_user'] === true) {
    $db = new Database();
    if ((isset($_POST['edit']) || isset($_POST['delete'])) && isset($_POST['selected']) && count($_POST['selected']) > 0) {
        foreach($_POST['selected'] as $selectedIndex) {
            if(isset($_POST['edit'])) {
                //Put old records in array and get table name
                $oldRecords = explode("|", $_POST['old'][$selectedIndex]);
                $table = array_shift($oldRecords);
                $newRecords = array();
                //Go through each of the col post arrays and get the values
                for($i = 0; $i < count($oldRecords); $i++) {
                    $col = "col".$i;
                    $newRecords[] = $_POST[$col][$selectedIndex];
                }
                $msg = updateEntry($table, $oldRecords, $newRecords);
            }
            else if(isset($_POST['delete'])) {
                //Put old records in array and get table name
                $oldRecords = explode("|", $_POST['old'][$selectedIndex]);
                $table = array_shift($oldRecords);
                $msg = deleteEntry($table, $oldRecords);
            }
        } // for each checked row
        main($msg);
    }
    else if(isset($_POST['add'])) {
        $name = $_POST['tableName'];
        main('', $name);
    }
    else if(isset($_POST['confirm'])) {
        $name = $_POST['tableName'];
        /*$clean = array();
        //The PHP directive magic_quotes_gpc is on by default, and it essentially runs addslashes() on all GET, POST, and COOKIE data.
        foreach($_POST['new'] as $new) {
            $clean[] = sanitizeString($new);
        }*/
        $msg = addEntry($name, $_POST['new']);
        main($msg);
    }
    else {
        main();
    }
}
else {
    header("Location:login.php");
}

function main($msg = '', $extraRow = '') {
    global $db;

    $tableNames = array(
        'j_category'=>"j_category Table",
        'j_category_set'=>"j_category_set Table",
        'j_final_question'=>"j_final_question Table",
        'j_question'=>"j__question Table",
        'j_user'=>"j_user Table"
    );
    
    // SUPERGLOBAL variables
    $f_tableName = trim($_REQUEST['f_tableName']);
    if (!array_key_exists($f_tableName, $tableNames))
        $f_tableName = 'j_category_set';

    //$db = new Database();
    $content = "";

    // Navigation Section
    $content .= Page::get_navigation();
    $content .= "<div id='container'>\n";

    // View Database Tables Section
    $content .= "<h1>View Database Tables</h1>\n";
    if($msg != '')
        $content .= "<h3 style=\"color: #00B2C2;\">$msg</h3>";
    $content .= get_select_form($tableName = $tableNames, $name = 'f_tableName');
    $content .= get_table($values = $f_tableName, false, true);
    $content .= "<hr />\n";


    // Edit Category Section
    $content .= "<div class='table'>\n";
    $content .= "<h1><em>Category</em></h1>\n";
    if($extraRow == 'j_category')
        $content .= get_table($values = 'j_category', true);
    else
        $content .= get_table($values = 'j_category');
    $content .= "</div>\n";
    $content .= "<hr />\n";

    // Edit Category Set Section
    $content .= "<div class='table'>\n";
    $content .= "<h1><em>Category Set</em></h1>\n";
    if($extraRow == 'j_category_set')
        $content .= get_table($values = 'j_category_set', true);
    else
        $content .= get_table($values = 'j_category_set');
    $content .= "</div>\n";
    $content .= "<hr />\n";

    // Edit Question Section
    $content .= "<div class='table'>\n";
    $content .= "<h1><em>Question</em></h1>\n";
    if($extraRow == 'j_question')
        $content .= get_table($values = 'j_question', true);
    else
        $content .= get_table($values = 'j_question');
    $content .= "</div>\n";
    $content .= "<hr />\n";

    // Edit Final Question Section
    $content .= "<div class='table'>\n";
    $content .= "<h1><em>Final Question</em></h1>\n";
    if($extraRow == 'j_final_question')
        $content .= get_table($values = 'j_final_question', true);
    else
        $content .= get_table($values = 'j_final_question');
    $content .= "</div>\n";
    $content .= "<hr />\n";

    // Edit User Section
    $content .= "<div class='table'>\n";
    $content .= "<h1><em>User</em></h1>\n";
    if($extraRow == 'j_user')
        $content .= get_table($values = 'j_user', true);
    else
        $content .= get_table($values = 'j_user');
    $content .= "</div>\n";
    $content .= "<hr />\n";
    $content .= "</div>";

    $page = new Page($title = 'Admin Page', $stylesheet = '../styles.css', $content = $content);
    echo $page->toString();
}

function get_select_form($values=array('value1' => "text1"), $name='select_1') {
    $string = <<<END
		<h2 style = "display:inline">Choose a table to view: </h2>
		
		<form action="" method="post">
		
		<select id="$name" name="$name">\n
END;
    foreach ($values as $k => $v) {
        $string .= "<option value =\"$k\">$v</option>\n";
    }
    $string .= <<<END
		</select>
		
		<button type="submit" id="button" value="submit">View Table</button>
		</form>\n\n
END;
    return $string;
}

function get_table($tableName, $extraRow = false, $noAdd = false) {
    $db = new Database();
    $db->doQuery("SELECT * FROM $tableName");
    $results = $db->fetch_all_array();
    $numRows = count($results);
    $string = '';
    if ($numRows > 0) {
        // How many records?
        $string .= "<h2>$numRows records found in $tableName</h2>\n";
        $string .= "<form action='".$_SERVER['PHP_SELF']."' method='post'>\n";
        //  Start building table
        $string .= "<table border='1'>\n";
        $string .= "<tr>";
        $string .= "<th></th>";
        // Get the field names and build the top row
        foreach ($results[0] as $k => $v) {
            $string .= "<th>$k</th>";
        }
        $string .= "</tr>\n";
        // Get the records
        
        $counter = 0;
        foreach ($results as $record) {
            $oldRecord = $tableName;
            foreach($record as $result) {
                $result = htmlentities(stripslashes($result), ENT_QUOTES);
                $oldRecord .= '|'.$result;
            }

            $string .= "<tr>\n";
            $string .= "<td><input type='hidden' name='old[]' value='$oldRecord' /><input type='checkbox' name='selected[]' value='$counter' /></td>";
            
            $count = 0;
            foreach($record as $key => $result) {
                $result = htmlentities(stripslashes($result), ENT_QUOTES);
                $string .= "<td><input type='text' name='col".$count."[]' value=\"$result\" ";
                if($key == 'id')
                    $string .= 'readonly';
                $string .= "/></td>";
                $count++;
            }
            $string .= "</tr>\n";
            $counter++;
        }

        //Add an extra row for a new entry
        $add = '';
        if($extraRow) {
            $add = "<input type='submit' name='confirm' value='Confirm New Entry' /> ";
            $string .= "<tr>\n";
            $string .= "<td></td>";
            $numCols = count($results[0]);
            foreach($results[0] as $field => $record) {
                $placeholder = $field;
                $string .= "<td><input type='text' name='new[]' placeholder='$placeholder' /></td>";
            }
            $string .= "</tr>\n";
        }
        else if(!$noAdd) {
            $add = "<input type='submit' name='add' value='Add Entry' /> ";
        }


        $string .= "</table>\n";
        $string .= "<br />\n";
        $string .= "<input type='hidden' name='tableName' value='$tableName' />";
        $string .= "<input type='submit' name='edit' value='Modify Selected' /> ";
        $string .= "<input type='submit' name='delete' value='Delete Selected' onclick='return confirm(\"Really delete?\");' /> ";
        $string .= $add;

        $string .= "</form>\n";
        return $string;
    }
}

function updateEntry($table, $oldValues, $newValues) {
    global $db;
    
    //Based on column names, build the sql query
    $colNames = $db->getColNames($table);
    $sql = "UPDATE $table SET ";

    //New values
    for($k = 0; $k < count($colNames); $k++) {
        if($k < (count($colNames) - 1))
            $sql .= $colNames[$k].' = ?, ';
        else
            $sql .= $colNames[$k].' = ? ';
    }
    $sql .= ' WHERE ';

    //Old values
    for($h = 0; $h < count($colNames); $h++) {
        if($h < (count($colNames) - 1))
            $sql .= $colNames[$h].' = ? AND ';
        else
            $sql .= $colNames[$h].' = ? ';
    }

    //Put new values and old values into an array along with their types
    $vars = array();
    $types = array();
    foreach($newValues as $record) {
        $vars[] = $record;
    }
    foreach($oldValues as &$record) {
        $record = html_entity_decode($record);
        $vars[] = $record;
    }
    for($j = 0; $j < count($oldValues)*2; $j++) {
        $types[] = "s";
    }
    //Run the query
    if($db->doQuery($sql, $vars, $types) == '')
        return "Update to $table successful";
    else
        return "Sorry there was a problem. Try again.";
}

function addEntry($table, $newValues) {
    global $db;

    //Build the sql query
    $colNames = $db->getColNames($table);
    $sql = "INSERT INTO $table VALUES(";

    //New values
    for($k = 0; $k < count($newValues); $k++) {
        //Not the last value
        if($k < (count($newValues) - 1))
            $sql .= '?, ';
        else
            $sql .= '?';
    }
    $sql .= ')';

    //Put new values into an array along with their types
    $vars = array();
    $types = array();
    foreach($newValues as $record) {
        $vars[] = $record;
    }
    for($j = 0; $j < count($newValues); $j++) {
        $types[] = "s";
    }
    
    //Check for duplicates
    $db->doQuery("SELECT * FROM $table WHERE {$colNames[0]} = ?", array($newValues[0]), array('s'));
    if($db->getAffectedRows() == 0) {
        //Run the query
        $db->doQuery($sql, $vars, $types);
        return "Entry successful for $table";
    }
    else
        return "Your entry is not unique to $table, try again.";
}

function deleteEntry($table, $oldValues) {
    global $db;

    $colNames = $db->getColNames($table);
    $sql = "DELETE FROM $table WHERE ";

    for($h = 0; $h < count($colNames); $h++) {
        //Not the last value
        if($h < (count($colNames) - 1))
            $sql .= $colNames[$h].' = ? AND ';
        else
            $sql .= $colNames[$h].' = ?';
    }

    $vars = array();
    $types = array();
    foreach($oldValues as $record) {
        $vars[] = $record;
        $types[] = "s";
    }

    if($db->doQuery($sql, $vars, $types) == '')
        return "Delete from $table successful";
    else
        return "Sorry there was a problem. Try again.";
}

function sanitizeString($str) {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlentities($str, ENT_QUOTES);
    $str = strip_tags($str);
    return $str;
}

function __autoload($className) {
    require_once $className . '.class.php';
}

?>