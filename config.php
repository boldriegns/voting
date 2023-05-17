<?php

$conn = mysqli_connect('localhost','root','Bold38**','demo') or die('connection failed');

if($conn){
	echo 'database connection successfully';
}
else{
	echo 'database connection failed';
}



?>