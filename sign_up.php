<?php 
	

		 include('db_connection.php');
		 session_start();
 
	// give the intail values to varibles 
	$email = $name='';
	$error = ['email' => '' ,'name' => '' ];


if (isset($_POST['submit'])) {
	if (empty($_POST['email'])){
		 $error['email']  = 'An email is required *';
	}else{
		 $_SESSION['email'] = $email = $_POST['email'];
			if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
				$error['email'] = 'Email must be a valid email address *';
			}
	}

	if (empty($_POST['name'])){
		 $error['name']  = 'An name is required *';
	}else{
		$name = $_POST['name'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
				$errors['name'] = 'name must be a name contain the leeters and spaces only *';
			}

			if(array_filter($error)){
			//echo 'errors in form';
		} else {

			$sql = "SELECT email  FROM users WHERE email = '$email'" ;
			$result = mysqli_query($conn , $sql);
			$exsit = mysqli_fetch_assoc($result);
			

			if (empty($exsit)){
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);

			// create sql
			$sql = "INSERT INTO users(email , name) VALUES('$email', '$name')";
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				mysqli_free_result($result);
				mysqli_close($conn);
				header('Location: login.php');
			}else{
				echo 'query error: '. mysqli_error($conn);
			}
		}else{
			echo 'the user email is already exsit';
		}

		}
	
	}
}



 ?>


<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>


	<form action="sign_up.php" method="POST">
		<label>please enter your email:</label>
		<input type="text" name="email" value="">
		<div class="error"><?php echo $error['email']; ?></div>
		<label>please enter your name:</label>
		<input type="text" name="name" value="">
		<div class="error"><?php echo $error['name']; ?></div>
		<input type="text" name="id" hidden>
		<div class="submit_data">
			<input type="submit" name="submit" value="SIGN-UP">
		</div>
	</form>


		<?php include('Tamplates/Footer.php');?>
</html>