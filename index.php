<?php 
	 
	 include('db_connection.php');
	 $id = '';
// this session come from login
session_start();
	// add the value come from the login and put it in id 

if ($_SESSION['id']){
    $id= $_SESSION['id'];

	$id = mysqli_real_escape_string($conn,$_SESSION['id']);

	// return all info where the user id 
	$sql = "SELECT id ,title , ingredients FROM pizzas WHERE user_id = $id " ;

	// make a query 

	$result = mysqli_query($conn , $sql);

	// transform $result to correct format

	// in piizas there is all pizzas 

	$pizzas = mysqli_fetch_all($result , MYSQLI_ASSOC);

	// free result from the memory

	mysqli_free_result($result);

	// close the connection 

	mysqli_close($conn);
}else{
	header('Location: login.php');
}


 ?>

<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>
			
			<h4 class='title'>Pizzas!</h4>

	<div class="container">
		<?php if ($id): ?>
		<div class="cards">
			 
			<?php foreach($pizzas as $pizza): ?>

				<div class="card">
					<img src="img/pizza.svg"class="pizza">
						<div class="card-content">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul>
								<?php foreach( explode(',' , $pizza['ingredients']) as $ing): ?>

									<li><?php echo htmlspecialchars($ing); ?></li>

								<?php endforeach; ?>	
							</ul>
						</div>
						<div class="card-action">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['id']; ?>">more info</a>
						</div>
				</div>
				<?php endforeach; ?>
				</div>

			
		<?php else: ?>

<div class="container">
			<div class="error_login">
			<h6 >please login before using the site</h6>

			</div>
			</div>

		<?php endif; ?>


		
	</div>

	<?php include('Tamplates/Footer.php');?>
</html>











