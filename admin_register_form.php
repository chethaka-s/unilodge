<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
   $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);
   $cpassword = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$password' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($password != $cpassword){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(f_name,l_name, email, password, user_type) VALUES('$f_name','$l_name','$email','$password','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="f_name" required placeholder="Enter Your First Name">
      <input type="text" name="l_name" required placeholder="Enter Your  Second Name">
      <input type="email" name="email" required placeholder="enter Your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">User</option>
         <option value="admin">Admin</option>
         <option value="warden">Warden</option>
         <option value="user">Landlord</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
     
   </form>

</div>

</body>
</html>