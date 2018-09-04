<?php

/*
MIT License

Copyright (c) 2018 Kieran Houtgraaf

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

//TODO: add debugging mode


//	variables for the database
$servername = "localhost";
$username = "wobsite";
$password = "wachtwoord";
$dbname = "votes";

//create connection with db
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("There was an error");
}

//	make input safe for mysql and remove dots from ips
function safe($in){

	$in = str_replace(".","",$in);
	$in = str_replace("DROP","",$in);
	$in = str_replace("DELETE", "", $in);
	$in = str_replace("UPDATE", "", $in);
	$in = str_replace("INSERT", "", $in);
	$in = str_replace("TRUNCATE", "", $in);
	return $in;

}


//	insert data into a table
//	db is the table
//	val is the value
function insert($db, $val){
	global $conn;	
	
	$sql = 'INSERT INTO ' . $db . '(ip) VALUES (' . $val . ')';
			
	if (!($conn->query($sql) === TRUE)) {
		echo "There was an error.";
	}
}


//	select data from table with params,
//	db is the table
//	val is the value that it searches for
function selectW($db, $val){
	global $conn;
	$sql = "SELECT ip FROM " . $db . " WHERE ip = " . $val;
	return $conn->query($sql);
}


// select all data from a table
// db is the table
function select($db){
	global $conn;
	$sql = "SELECT ip FROM " . $db;
	return $conn->query($sql);

}


//	delete data from a table
//	db is the table
// 	val is the data to delete
function delete($db, $val){
	global $conn;
	$sql = "DELETE FROM " . $db . " WHERE ip=" . $val;
	return $conn->query($sql);
}


// 	get vote
$vote = $_POST['vt'];


//	get the clients ip, and make it safe for mysql
$ip = safe($_SERVER['REMOTE_ADDR']);

//	get the total votes in table
//	db is the table
function give($db){
	// 	current is amount of entries listed
	$current = 0;
	
	//	get the total entries of db
	$result = select($db);
	
	//	if there are more than one rows in the db
	if ($result->num_rows > 0) {
	    
		// and while it is not through all the rows
	    while($row = $result->fetch_assoc()) {
			//	add 1 to current			
			$current += 1;
	    }
	}
	
	// and return current
	return $current;
}

?>
