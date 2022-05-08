<?php
    
    $email ='';
  include('db_connection.php');
    if (isset($_POST['submit'])){
        $email = $_POST['email'];
     //check if the account is already exist
    $sql = "SELECT email  FROM users WHERE email = '$email'" ;
    // transform $result to correct format
    $result = mysqli_query($conn , $sql);
    $exsit = mysqli_fetch_assoc($result);


    if (!empty($exsit)){
            $sql = "SELECT  id  FROM users WHERE email = '$email'" ;
            $result = mysqli_query($conn , $sql);
            $exsit = mysqli_fetch_assoc($result);
            session_start();
             $_SESSION['id'] = $exsit['id']; 

    mysqli_free_result($result);

    // close the connection 
    mysqli_close($conn);
                header('Location: index.php');
                     // if the emails exist send this emails to all pages

                }
            }
 
 ?>

<!DOCTYPE html>
<html>
    <?php include('Tamplates/Header.php');?>

<section class="php-form">
        <div class="container">
            <div class="container">
            <div class="error_login">
            <h6 >please login before using the site </h6>

            </div>
            </div>
<form action="login.php" method="POST">
    <label>Enter your Email:</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" >
    <input type="text" name="id" value="<?php echo $exsit['id'] ?>" hidden>
    <div class= "error" ></div>
     <?php if (empty($exsit)):?>
                    <a href="sign_up.php"><div class="error">please sign-up here *</div></a>
            <?php endif; ?>
  <div class="submit_data">
                    <input type="submit" name="submit" value="Login">
                </div>
                <!-- in case the email is not login show up sign up btn -->
               
</form>

</div>
</section>


    <?php include('Tamplates/Footer.php');?>
</html>
