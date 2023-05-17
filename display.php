<?php
include("config.php");
$query = mysqli_query($conn,"SELECT * FROM user_form");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display your data</title>
    <style>
        img{
            width: 75px;
        }
            table{
      border-radius:5px;
      width: 70%;
      color: blue;
      font-family: monospace;
      font-size: 15px;
      text-align: left;
      	min-height: 100vh;
	    display:flex;
	  padding: 20px;
	   padding-bottom: 60px;

    }th{
      background-color: #eb4034;
      color: white;
    }td{
        background:blue;
        color:crimson;
        width=30px;
    }
    tr:nth-child(even){
      background-color: #ededed;
    }
    </style>
</head>
    <table>
  <thead>
    <tr>
       </button>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">password</th>
      <th scope="col">image</th>
      <th scope="col">user_type</th>
      <th scope="col">operations</th>
       <th scope="col"><button><a href="register_form.php">Add a User</a></th>
    </tr>
    <?php 
        while($voter = mysqli_fetch_assoc($query)){
     ?>
      <tr>
        <td><?php echo($voter['id']); ?></td>
        <td><?php echo($voter['name']); ?></td>
        <td><?php echo($voter['email']); ?></td>
        <td><?php echo($voter['password']); ?></td>
        <td><?php echo("<img src=\"{$voter['image']}\" />"); ?></td>
        <td><?php echo($voter['user_type']); ?></td>
         <td>
          <button><a href="update_form.php?updateid=<?php echo($voter['id']); ?>">Update</a></button>
          <button><a href="delete.php?deleteid=<?php echo($voter['id']); ?>">Delete</a></button>
       
      </td>
      </tr>
      <?php 
}
?>
   
  </thead>
  <tbody>
   
  

  </tbody>
</table>  
</body>
</html>
