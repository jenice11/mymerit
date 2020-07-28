<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//Database name = MyDB
$conn = mysqli_connect("localhost", "root", "", "mymerit");

// Check connection
if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>