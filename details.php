<?php 
	
	 include('db_connection.php');

	 session_start();
	  $id= $_SESSION['id'];

	// check the GET request 
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// double qoute 

		$sql = "SELECT * FROM pizzas WHERE id = $id";

		$result = mysqli_query($conn , $sql);

		$pizzas_daitels = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);
	}
	
 ?>




<!DOCTYPE html>
<html>
<?php include('Tamplates/Header.php');?>

	
			<div class="container">
				<div class="details">
				<?php if($pizzas_daitels): ?>
				<h4><?php echo htmlspecialchars($pizzas_daitels['title']); ?></h4>
				<!-- <p><?php echo htmlspecialchars($pizzas_daitels['email']); ?></p> -->
				<p> <?php echo date($pizzas_daitels['created_at']); ?></p>
				<h5>ingredients:</h5>
				<p><?php echo htmlspecialchars($pizzas_daitels['ingredients']); ?></p>
			</div>

		<?php else: ?>
			
			<h5>No Such Pizza exsit!!!</h5>

		<?php endif; ?>
</div>

<?php include('Tamplates/Footer.php');?>
</html>