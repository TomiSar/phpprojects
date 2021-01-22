<?php

	// connect to the database
	$conn = mysqli_connect('localhost', 'tomis', 'Sensei0455!', 'ninja_pizza');

	// check connection --> if connection fails show error
	if (!$conn) {	
		echo 'Connection error: ' . mysqli_connect_error();
	}

	// write query for all pizzas title, ingredients, id rows from pizzas Table order by creation_time;
	$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';
	$result = mysqli_query($conn, $sql);			   // make query and get result mysqli_query(connection, sql_query);
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC); // fetch the resulting rows as an array
	mysqli_free_result($result); 					   // free result from memory
	mysqli_close($conn); 		 					   // close connection
	//explode(',', $pizzas[0]['ingredients']);
	//print_r($pizzas);
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($pizzas as $pizza): ?>
				
				<div class="col s6 md3">
				  <div class="card z-depth-0">
				 	<div class="card-content center">
				 		<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
				 		<ul>
				 			<?php foreach(explode(',', $pizza['ingredients']) as $ingredient): ?>
				 				<li><?php echo htmlspecialchars($ingredient); ?></li>
				 			<?php endforeach; ?>
				 		</ul>
				 	</div>
				 	<div class="card-action right-align">
				 		<a class="brand-text" href="#">More info</a>
				 	</div>
				  </div>					
				</div>

			<?php endforeach; ?>


			<?php if(count($pizzas) >= 3): ?>
				<p>There are three or more pizzas</p>
			<?php else: ?>
				<p>There are less than three pizzas</p>
			<?php endif; ?>

		</div>
	</div>
	<?php include('templates/footer.php'); ?>

</html>