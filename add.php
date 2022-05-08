<?php 
	
	include('db_connection.php');

 	 	session_start();

 	 	// put the id that come from in log in 
 	   $id= $_SESSION['id'];

 	    // return the email where id is belomg to email where is logged in 
 	   $sql = "SELECT email FROM users WHERE id = $id";

		$result = mysqli_query($conn , $sql);

		$email = mysqli_fetch_assoc($result);

	// declare var before press on submit btn 
	 $title = $ingredients = '';

	// store the error messages in array to show them later 
	$errors = array('title' => '' , 'ingredients' => '' );

	//grap all data from form using global array 
	 // START BLOCK HERE 
	// $email= $_SESSION['email'];
	if (isset($_POST['submit'])){

		//check title 
		if (empty($_POST['title'])){

			$errors['title'] = 'A title is required *';

		}else {
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only *';
			}
		}

		//check ingredients
		if (empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required *';
		}else {
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list *';
			}
		}

		//redirect the path if there no error
	if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

			// create sql
			$sql = "INSERT INTO pizzas(title ,ingredients , user_id) VALUES('$title','$ingredients' , $id)";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}

		}
	}
	// END BLOCK HERE 




 ?>

<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>
	<section class="php-form">
		<div class="container">
			<h4>Add A Pizza</h4>
			<form action="add.php" method="POST">
				<label>Your Email:</label>
				<input type="text" name="email" value="<?php print_r($email['email']); ?>">
				<label>Pizza title:</label>
				<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
				<div class="error"><?php echo $errors['title']; ?></div>
				<label>ingredients (comma separated):</label>
				<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
				<div class="error"><?php echo $errors['ingredients']; ?></div>
				<div class="submit_data">
					<input type="submit" name="submit" value="submit">
				</div>
			</form>
		</div>
	</section>		
	<?php include('Tamplates/Footer.php');?>
</html>