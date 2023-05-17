<?php
include("config.php");
echo "<br>";
$id=$_GET['updateid'];
$sql = "SELECT * FROM user_form WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo '<span style="color:blue">'."update row ".$row['name'].'</span>';
$name = $row['name'];
$email = $row['email'];
$password = $row['password'];
$file = $row['image'];
$user_type = $row['user_type'];
if(isset($_POST['update'])){
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$user_type = $_POST['user_type'];
 $file = $_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];

    $fileExt=explode('.',$fileName);
    $fileActualExt=strtolower(end($fileExt));

    $allow=array('jpeg','jpg','png');

    if(in_array($fileActualExt,$allow)){
        if($fileError===0){
            if($fileSize < 10000000){
                $fileNewName=uniqid('',true).".". $fileActualExt;
                $fileDestination='uploads/'.$fileNewName;
				move_uploaded_file($fileTmpName,$fileDestination);
			

$sql = "UPDATE user_form SET name='$name',email='$email',password='$password',image='$fileDestination',user_type='$user_type' WHERE id='$id'";
$result = mysqli_query($conn,$sql);
if($result){
	echo "updated successfully";
	header("location:display.php");
}else{
	echo "something went wrong!";
   }
  
}
}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>update form</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="form-container">
		<form action="" method="post" enctype="multipart/form-data">
		<img width=40px height=40px src= "logo.jpeg" class="rounded-circle" alt="IEBC LOGO">
			<h3>update your details</h3>
			<input type="text" name="name" required placeholder="Enter your name" autocomplete="on">
			<input type="email" name="email" required placeholder="Enter your email" autocomplete="on">
			<input type="password" name="password" required placeholder="Enter your password" autocomplete="on">
			<input type="password" name="cpassword" required placeholder="confirm your password" autocomplete="on">
			<input type="file" name="file">
			<select name="user_type">
				<option value="user">user</option>
				<option value="admin">admin</option>
			</select>

			<input type="submit" name="update" value="update your details" class="form-btn">
			<p>Already have an account?<a href="login_form.php">login now</a></p>
		</form>
	</div>

</body>
</html>