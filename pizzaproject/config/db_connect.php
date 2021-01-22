<?php
	
	// connect to the database
	$conn = mysqli_connect('localhost', 'tomis', 'Sensei0455!', 'ninja_pizza');

	// check connection --> if connection fails show error
	if (!$conn) {	
		echo 'Connection error: ' . mysqli_connect_error();
	}

?>