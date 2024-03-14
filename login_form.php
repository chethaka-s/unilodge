<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   // $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
   // $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   // $cpass = md5($_POST['cpassword']);
   // $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['f_name'];
         header('location:admin_home.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['f_name'];
         header('location:usser_page.php');

       }

      elseif($row['user_type'] == 'warden'){

         $_SESSION['warden_name'] = $row['f_name'];
         header('location:warden_page.php');

      }elseif($row['user_type'] == 'landlord'){

          $_SESSION['user_id'] = $row['user_id'];
         $_SESSION['landlord_name'] = $row['f_name'];
         header('location:landlord_page.php');

      }

   }else{
      $error[] = 'incorrect email or password!';

   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <div style="display: flex;
   
    justify-content: center;
    align-items: center;">
<div class="form-container">

   <form action="" method="post">
      <h3>LOGIN NOW</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <div class="form-fields">
      <input type="email" class="input-field" name="email" required placeholder="enter your email">
      <input type="password" class="input-field" name="password" required placeholder="enter your password">
      <input type="submit" name="submit"  class="button-form"value="Login" class="form-btn">
      <br>
      <p>don't have an account? <a href="register.php">register now</a></p>
   </div>
   </form>

</div>

   </div>

</body>
</html>