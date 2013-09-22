<?php

/*
  This script is a helper class for using the databases specific to Project 3 A for
  4002-539 - Jeopardy Server
 */

require("config.inc.php");

class Database {

    private $server = ""; //database server
    private $user = ""; //database login name
    private $pass = ""; //database login password
    private $database = ""; //database name
    private $pre = ""; //table prefix
    private $mysqli;  //mysqli object
    private $error;    //error
//number of rows affected by SQL query
    private $affected_rows = 0;
//last insert id
    private $insert_id;
    private $results = array(); //results of query

#-#############################################
# desc: constructor
# usage: $db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
#             or $db = new Database(); and will using info from config file
    function Database($server=DB_SERVER, $user=DB_USER, $pass=DB_PASS, $database=DB_DATABASE) {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        //connect
        $this->mysqli = @new mysqli($server, $user, $pass, $database);

        if (mysqli_connect_errno ()) {
            $this->error = "Connect failed: " . mysqli_connect_error();
            echo $this->error;
            die();
        }
        else
            $this->error = "";
    }

#-#constructor()
#-#############################################
# desc: close the connection

    function close() {
        if (!@mysqli_close($this->mysqli)) {
            $this->error = "Connection close failed.";
        }
        else
            $this->error = "";
    }

#-#close()
#-############################################
# Desc: return some private attributes
#  returns last error

    function getError() {
        return $this->error;
    }

#returns the number of rows for select or affected rows for update/delete

    function getAffectedRows() {
        return $this->affected_rows;
    }

#returns last insert ID

    function getInsertId() {
        return $this->insert_id;
    }

#-#############################################
# Desc: executes SQL query to an open connection
# Param: (MySQL query) to execute: $query is query string with ?'s for variable replacement
# Param: $vars is an array whose elements are the values for the query, with one element for each ? 
#              in $query
# Param: $types is an array whose elements are the types for each value in $vars, one element for 
#             each element in $vars - Possible values are: "i" for All INT types, "d" for DOUBLE and FLOAT,
#             "b" for BLOBs andn "s" for All other types
#
# Sample usage:
#		$query = "select * from phonenumbers WHERE PersonID= ? ";
#      $results = $db->doQuery($query,array($id),array("i"));
#
#
#		$data = array("fax","222-1234","555",1,"fax","222-4321","555");
#		$db->doQuery("UPDATE  phonenumbers SET PhoneType = ?, PhoneNum= ?, AreaCode = ? Where ".
#						"PersonID = ? AND PhoneType = ? AND PhoneNum = ? AND AreaCode = ?",
#						$data,array("s","s","s","i","s","s","s"));		
#
# returns: error 

    function doQuery($query, $vars=array(), $types=array()) {
        //determine which type of query: select, insert, update, delete
        $select = false;
        $delete = false;
        $insert = false;
        $update = false;
        $this->results = null;
        //first get the command and convert to lower case
        $command = strtolower(substr(trim($query), 0, strpos($query, " ")));
        switch ($command) {
            case "select": $select = true;
                break;
            case "insert": $insert = true;
                break;
            case "update": $update = true;
                break;
            case "delete": $delete = true;
                break;
        }

        $this->results = array();
        $this->error = "";

        if (substr_count($query, "?") != count($vars) || count($vars) != count($types)) {
            $this->error = "Wrong number of parameters for query";
            return $this->error;
        } else if ($stmt = @$this->mysqli->prepare($query)) {
            if ($select) {
                //get the column information
                $meta = $stmt->result_metadata();
                $field_cnt = $meta->field_count;
                $col_names = array();
                while ($colinfo = $meta->fetch_field()) {
                    array_push($col_names, $colinfo->name);
                }
            }

            //call the bind_param function ?
            if (count($vars) > 0) {
                //declare and bind the parameters
                $list = array();
                //create the datatypes and array of values for query and binding params
                $i = 0;
                $bindtypes = "";
                foreach ($types as $type) {
                    $bindtypes.=$type;
                }
                foreach ($vars as $val) {
                    $bind_name = 'bind' . $i;       //give them an arbitrary name
                    $$bind_name = $val;            //add the parameter to the variable variable
                    $list[] = &$$bind_name;
                    $i++;
                }
                array_unshift($list, $bindtypes);
                //call the function bind_param with dynamic params
                //var_dump("<hr />",$query,$list,"<hr />");
                call_user_func_array(array($stmt, 'bind_param'), $list);
            } //bind params?
            if ($select) {
                //declare and bind the results
                $res = array_fill(0, $field_cnt, '');
                $bind_res[0] = $stmt;  //make the statement first element
                //add references to columns array to the parameter list
                for ($i = 0; $i < $field_cnt; $i++) {
                    $bind_res[] = &$res[$i];
                }

                //pass the array to the bind results function
                call_user_func_array("mysqli_stmt_bind_result", $bind_res);
            }

            //execute the statement
            $good = @$stmt->execute();
            @$stmt->store_result();
            //get the affected number of rows
            if ($insert || $update || $delete) {
                $this->affected_rows = @$stmt->affected_rows;
            } else {
                $this->affected_rows = @$stmt->num_rows;
            }

            if ($insert) {
                $this->insert_id = $stmt->insert_id;
            } else {
                $this->insert_id = null;
            }

            if ($select) {
                /* fetch values and make associative array */
                while ($stmt->fetch()) {
                    $row = array();
                    for ($i = 0; $i < $field_cnt; $i++) {
                        $row[$col_names[$i]] = $res[$i];
                    }
                    $this->results[] = $row;
                }
            }

            if ($good)
                $this->error = "";
            else
                $this->error = "Error with last statement execution";
            /* close statement */
            $stmt->close();
        }//prepare query
        else {
            if (isset($this->myslqi))
                $this->error = $this->mysqli->error;
        }

        return $this->error;
    }

//doQuery
#-#############################################
# desc: fetches and returns results one line at a time from last query
# param: $row is the row number to retrieve, defaults to the first row
# return: (array) fetched record(s)

    function fetch_array($row=0) {
        // retrieve row
        if (!is_null($this->results) && $row >= 0 && $row < count($this->results)) {
            $record = $this->results[$row];
        } else {
            $record = null;
        }

        return $record;
    }

#-#fetch_array()
#-#############################################
# desc: returns all the results (not one row) for the last query
# returns: assoc array of ALL fetched results

    function fetch_all_array() {
        return $this->results;
    }

#-#fetch_all_array()
#-#############################################
# desc: frees the resultset from last query
# 

    function free_result() {
        $this->error = "";

        if (!@$this->myslqi->free_result()) {
            $this->error("Results set could not be freed.");
        }
        return $this->error;
    }

#-#free_result()

    function getColNames($tableName) {
        $cols_return = array();
        $cols = $this->mysqli->query("SHOW COLUMNS FROM $tableName");

        if ($cols) {
            while ($col = $cols->fetch_assoc()) {
                $cols_return[] = $col['Field'];
            }
        }
        return $cols_return;
    }

}

//CLASS Database
###################################################################################################
?>