<?php
include("config.php");
if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = md5($_POST['password']);
  $cpassword = md5($_POST['cpassword']);
  $user_type = $_POST['user_type'];

      $file=$_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];

    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));

    $allow=array('jpeg','jpg','png');

    if(in_array($fileActualExt,$allow)){
        $error[] = 'the type of photo uploaded is not acceptible';
        if($fileError===0){
            if($fileSize < 10000000){
                $fileNewName=uniqid('',true).".". $fileActualExt;
                $fileDestination='uploads/'.$fileNewName;
                move_uploaded_file($fileTmpName,$fileDestination);
            }
        }
    }

 $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

   	$error[] = 'user alredy exist!';

   }elseif($password !== $cpassword){
     $error[] = 'password not matched!';
   }else{
   	$insert = "INSERT INTO user_form(name, email, password,image, user_type) VALUES('$name','$email','$password','$fileDestination','$user_type')";
   	mysqli_query($conn, $insert);
   	header('location:login_form.php');
    }
   }



?>

<!DOCTYPE html>
<html>
<head>
	<title>register form</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="form-container">
		<form action="" method="post" enctype="multipart/form-data">
		<img width=40px height=40px src= "logo.jpeg" class="rounded-circle" alt="IEBC LOGO">
			<h3>register with us</h3>
			<?php
             if(isset($error)){
             	foreach($error as $error) {
             		echo '<span class="error-msg">'.$error.'</span';
             	}
             }

			 ?>
			<input type="text" name="name" required placeholder="Enter your name">
			<input type="email" name="email" required placeholder="Enter your email">
			<input type="password" name="password" required placeholder="Enter your password">
			<input type="password" name="cpassword" required placeholder="confirm your password">
			<input type="FILE" name="file">
			<select name="user_type">
				<option value="user">user</option>
				<option value="admin">admin</option>
			</select>
			<input type="submit" name="submit" value="register now" class="form-btn">
            <p><a href="forgot.php"><b><i><u>Forgot your password?<u></i></b></a></p>
			<p>Already have an account?<a href="login_form.php">login now</a></p>
	</div>

</body>
</html>