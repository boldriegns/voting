<?php

session_start();

if(!isset($_SESSION['user_name'])){
	header('location:login_form.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>user page</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<div class="container">
	<div class="content">
		<h3>hi,<span>user</span></h3>
		<h1>welcome <span><?php echo $_SESSION['user_name']?></span></h1>
		<p>this is user dashboard</p>
		<a href="login_form.php" class="btn">login</a>
		<a href="register_form.php" class="btn">register</a>
		<a href="logout.php" class="btn">logout</a>
		
	</div>
	
</div>	

</body>
</html>