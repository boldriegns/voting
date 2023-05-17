<?php 
@include 'config.php';
session_start();
if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = md5($_POST['password']);

 $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

   $row = mysqli_fetch_array($result);
   if($row['user_type'] == admin){

     $_SESSION['admin_name'] = $row['name'];
	 header('location:display.php');
   }
   elseif($row['user_type'] == user){

     $_SESSION['user_name'] = $row['name'];
	 header('location:user_page.php');
   }
   }else{
     $error[] = 'incorrect email or password';
   }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>login form</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="form-container">
		<form action="" method="post">
		<img width=40px height=40px src= "log.jpg" class="rounded-circle" alt="IEBC LOGO">
			<h3>login now</h3>
			<?php
             if(isset($error)){
             	foreach($error as $error) {
             		echo '<span class="error-msg">'.$error.'</span';
             	}
             }

			 ?>
			<input type="email" name="email" required placeholder="Enter your email">
			<input type="password" name="password" required placeholder="Enter your password">
			<input type="submit" name="submit" value="login now" class="form-btn">
			<p>Don't have an account?<a href="register_form.php">register now</a></p>
		</form>
	</div>

</body>
</html>