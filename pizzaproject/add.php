<?php
	
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

		//Check for errors --> true(errors) and false(no errors) --> redirect index.php!!
		if (array_filter($errors)) {
			//echo 'Form contains error(s)';
		} else {
			//echo 'Form is valid';
			header('Location: index.php');
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