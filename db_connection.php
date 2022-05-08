<?php 	
	// connect to database
	$conn = mysqli_connect('localhost' , 'bahaa' , 'test1234' , 'cool_pizzas');

	// check connection 
	if(!$conn){
		echo 'Connection error' . mysqli_connect_error();
	}
?>