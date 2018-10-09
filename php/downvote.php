<?php


//	get connection to db, functions and params
include "funcs.php";

//	if it was vote not get, do this
if ($vote == 'yes') {

	//	if the current ip is in the down db, remove it from there
	$query = selectW("down", $ip);
	if (($query !== FALSE) && ($query->num_rows > 0)) {
		delete("down", "'" . $ip . "'");	

	} else {
		//	otherwise, insert it into the down db
		insert("down", $ip);
			
		delete("up", "'" . $ip . "'");	
	}

}

//	echo the downvotes, m, and then the upvotes
echo give("down") . "m" . give("up");

//	close the connection to the database
$conn->close();
?>
