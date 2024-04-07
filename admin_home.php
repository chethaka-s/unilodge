<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   <?php include 'header.php'; ?>
   

   <div class="content-body">
      <p class="user-type">Hello, Admin</p>
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span> to your Admin Panel</h1>
      <p class="body-instru">This admin page let's you register Wardens,Students ,Landlords . </p>
      <p class="body-heading">Register a User/Warden or a Landlord</p>

      <div style="display: flex; flex-direction: row;">
      <a href="login_form.php" class="btn">login</a>
      <a href="admin_register_form.php" class="btn">register</a>
      
      <!-- <a href="logout.php" class="btn">logout</a> -->
      <br>
      <br>
      

      </div>
      <p class="body-heading">Write a Blog Article </p>
      <a href="write_blogs.php" class="btn" style="    width: 100px;">Write a Blog</a>
   </div>



</body>
</html>