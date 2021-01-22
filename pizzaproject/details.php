<?php 
	
	include('config/db_connect.php');

	// check GET request id param
	if (isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		$sql = "SELECT * FROM pizzas WHERE id = $id"; // make sql
		$result = mysqli_query($conn, $sql);		  // get the query result
		$pizza = mysqli_fetch_assoc($result); 		  // fetch result in array fromat
		mysqli_free_result($result); 		 	      // free result from memory
		mysqli_close($conn); 		 				  // close connection
		//print_r($pizza);	
	}

 ?>

 <!DOCTYPE html>
 <html>

  <?php include('templates/header.php') ?>

  <div class="container center">
  	<?php if($pizza): ?>

  		<h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
  		<p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
  		<p><?php echo date($pizza['created_at']); ?> </p>
  		<h5>Ingredients:</h5> 
  		<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

  	<?php else: ?>
  		<h5>Pizza with this id doesn't exists!!</h5>
  	<?php endif; ?>
  </div>
  
  <?php include('templates/footer.php'); ?>
 
 </html>