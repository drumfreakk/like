<?php

$debugmode = true;

//	variables for the database
$servername = "localhost";
$username = "wobsite";
$password = "wachtwoord";
$dbname = "votes";

//create connection with db
$conn = new mysqli($servername, $username, $password, $dbname);
$e = $conn->connect_error;
if ($e) {
	logme("Connect Error: " . $e);
    die();
}


function sqlE($sql, $val){
	global $conn;

	$result = $conn->prepare($sql);
    $result->bind_param('s', $val);
    $e = $result->execute();
	$result->close();

	return $e;
}


//	make input safe for mysql and remove dots from ips
function safe($in){

	$in = str_replace(".","",$in);
	$in = str_replace("DROP","",$in);
	$in = str_replace("DELETE", "", $in);
	$in = str_replace("UPDATE", "", $in);
	$in = str_replace("INSERT", "", $in);
	$in = str_replace("TRUNCATE", "", $in);
	$in = str_replace("--", "", $in);
	return $in;

}


//	insert data into a table
//	db is the table
//	val is the value
function insert($db, $val){
	global $conn;	
	
	$sql = "INSERT INTO " . $db . " (ip) VALUES (?)";

	$e = sqlE($sql, $val);
	if (!($e === TRUE)) {
		logme("Insert Into Error: " . $e);
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


function logme($tekst) {
	global $debugmode;
	
	if($debugmode){
		global $conn;
		$sql = "INSERT INTO log (tekst) VALUES (?)";
        $result = $conn->prepare($sql);
        $result->bind_param('s', $tekst);
        $result->execute();
		$result->close(); 
	}
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
