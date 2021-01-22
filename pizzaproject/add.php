<?php
	
	// database connection
	include('config/db_connect.php');

	$email = $title = $ingredients = '';
	$errors = array('email'=>'', 'title'=>'', 'ingredients'=>''); //array for logging errors

	if (isset($_POST['submit'])) {
		// check email
		if(empty($_POST['email'])) {
			$errors['email'] = 'An email address is required <br/>';
		} else {
			$email = $_POST['email'];
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //built-in php function for valid email
				$errors['email'] = 'Email must be a valid address';
			}
		}

		// check title
		if(empty($_POST['title'])) {
			 $errors['title'] = 'A Pizza Title is required <br/>';
		} else {
			$title = $_POST['title'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $title)) { //preg_match(pattern, subject)
				$errors['title'] = 'A Pizza Title must be letters and spaces only';
			}
		}

		// check ingredients 
		if(empty($_POST['ingredients'])) {
			$errors['ingredients'] = 'At least one ingredient is required <br/>';
		} else {
			$ingredients = $_POST['ingredients'];
			if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) { //preg_match(pattern, subject)
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

		//Check for errors --> true(errors) and false(no errors) --> save the database
		if (array_filter($errors)) {
			//echo 'Form contains error(s)';
		} else {
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn,  $_POST['ingredients']);

			// create sql insert into pizzas table values title, email, ingredients
			$sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

			// save to db and check
			if (mysqli_query($conn, $sql)) {
				// success
				header('Location: index.php');
			} else {
				// error
				echo 'Query error ' . mysqli_error($conn);
			}
		}
	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php') ?>

	<section class="container grey-text ">
		<h4 class="center">Order a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Pizza Title:</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>
			<label>Ingredients (comma separated):</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
			<div class="red-text"><?php echo $errors['ingredients']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php') ?>

</html>