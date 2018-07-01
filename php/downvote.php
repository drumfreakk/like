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

//	get connection to db, functions and params
include "funcs.php";

//	if it was vote not get, do this
if ($vote == 'yes') {

	//	if the current ip is in the down db, remove it from there
	if (selectW("down", $ip)->num_rows > 0) {
		delete("down", "'" . $ip . "'");	

	} else {
		//	otherwise, insert it into the down db
		insert("down", $ip);
		
		// and if it is in the up db, remove it from there
		if (selectW("up", $ip)->num_rows > 0){
			delete("up", "'" . $ip . "'");
		}	
	}

}

//	echo the downvotes, m, and then the upvotes
echo give("down") . "m" . give("up");

//	close the connection to the database
$conn->close();
?>
