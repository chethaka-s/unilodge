<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['landlord_name'])){
   header('location:login_form.php');
}
if(isset($_SESSION['user_id'])) {
    // "user_id" key is set, you can safely access it
    $userId = $_SESSION['user_id'];
      // echo "User ID is there";
    // Proceed with your code here
} else {
    // "user_id" key is not set, handle this case gracefully
    echo "User ID not found in session.";
}

if(isset($_POST['submit'])) {
 
    $userId = $_SESSION['user_id'];

    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $contactNumber = $_POST['contact_number'];

    // File upload handling
    $uploadDir = 'uploads/';
    $fileName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $fileName;

    // Move uploaded file to the uploads directory
    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // File uploaded successfully, insert data into the database
        // You should use prepared statements to prevent SQL injection
        $sql = "INSERT INTO boarding_places (user_id, title, description, contact_number, image_path)
                VALUES ('$userId', '$title', '$description', '$contactNumber', '$uploadFile')";
        
        if(mysqli_query($conn, $sql)) {
            echo "Boarding place uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
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
   
<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['landlord_name'] ?></span>         </h1>
      <p>this is a landlord page</p>
  
      <a href="logout.php" class="btn">logout</a>
   </div>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <label for="name">Title </label>
      <input type="text" name="title" id = "title" required value="" required> <br>
       <label for="name">Descrition </label>
      <input type="text" name="description" id = "description" required value="" required > <br>
       <label for="name">Occupancy </label>
      <input type="text" name="occupancy" id = "occupancy" required value="" required > <br>
      <label for="image">Contact Details </label>
      <input type="text" name="contact_number" id = "contact_no" required value="" required > <br>
      <label for="image">Image : </label>
      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      <button type = "submit" name = "submit">Submit</button>
    </form>

</div>

</body>
</html>