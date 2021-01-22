<?php

	// connect to the database
	$conn = mysqli_connect('localhost', 'tomis', 'Sensei0455!', 'ninja_pizza');

	// check connection --> if connection fails show error
	if (!$conn) {	
		echo 'Connection error: ' . mysqli_connect_error();
	}

	// write query for all pizzas title, ingredients, id rows from pizzas Table
	$sql = 'SELECT title, ingredients, id FROM pizzas';
	$result = mysqli_query($conn, $sql);			   // make query and get result mysqli_query(connection, sql_query);
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC); // fetch the resulting rows as an array
	mysqli_free_result($result); 					   // free result from memory
	mysqli_close($conn); 		 					   // close connection

	print_r($pizzas);
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>
	<?php include('templates/footer.php') ?>

<body>

</body>
</html>