<?php

//	get connection to db, functions and params
include "funcs.php";

//	if it was vote not get, do this
if ($vote == 'yes') {
	//	if the current ip is in the up db, remove it from there
	$query = selectW("up", $ip);
	if (($query !== FALSE) && ($query->num_rows > 0)) {
		delete("up", "'" . $ip . "'");	

	} else {
		//	otherwise, insert it into the up db
		insert("up", $ip);

		delete("down", "'" . $ip . "'");
	}

}

//	echo the upvotes, m, and then the downvotes
echo give("up") . "m" . give("down");
	
//	close the connection to the database
$conn->close();
?>
