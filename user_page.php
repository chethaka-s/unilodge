<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php'; ?>
   <br>
<div class="container">

   <div class="content">
      <h3>Hello, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>Welcome to the User Dashboard</p>
      <!-- <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a> -->
   </div>
<div class="grid">
   <?php
   
    $query = "SELECT * FROM boarding_places WHERE status = 'Accepted'";
    $result = mysqli_query($conn, $query);

     
    if (mysqli_num_rows($result) > 0) {
    
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            
            <div class="boarding-place-user">
                <h4 class="card-heading"><?php echo $row['title']; ?></h4>
                <hr>
                <img src="<?php echo $row['image_path']; ?>" class="card-user-img" alt="Boarding Place Image">
                <p>Description: <?php echo $row['description']; ?></p>
                <hr>
                <p><?php echo $row['contact_number']; ?></p>
                <p class="rental-rate"><?php echo $row['rental']; ?></p>
                <p class="occupancy-det">Occupancy: <?php echo $row['occupancy']; ?></p>
                <!-- <img src="<?php echo $row['image_path']; ?>" alt="Boarding Place Image"> -->
            </div>
            
            <?php
        }
    } else {
        echo "<p>No approved boarding places found.</p>";
    }
    
    ?>
    </div>

</div>

</body>
</html>