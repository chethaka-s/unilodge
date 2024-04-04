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
    $rental = $_POST['rental'];
    $occupancy =$_POST['occupancy'];
    $status = $_POST['status'];

    // File upload handling
    $uploadDir = 'uploads/';
    $fileName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $fileName;

    // Move uploaded file to the uploads directory
    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // File uploaded successfully, insert data into the database
        // You should use prepared statements to prevent SQL injection
        $sql = "INSERT INTO boarding_places (user_id, title, description, contact_number,rental,occupancy,status, image_path)
                VALUES ('$userId', '$title', '$description','$contactNumber', '$rental','$occupancy','$status', '$uploadFile')";
        
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
   <title>Landlord</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php include 'header.php'; ?>
   
<div class="container">

   <div class="content-body">
         <p class="user-type">Hello, Landlord</p>
      <h1>Welcome <span><?php echo $_SESSION['landlord_name'] ?></span>         </h1>
      <p class="body-instru">Post your Boarding Place </p>

      <p class="body-heading">Add Your Place from Below</p>
  
    
   
    <form class="" action="" method="post"  autocomplete="off" enctype="multipart/form-data">
      <label for="name">Title </label>
      <br>
      <input type="text" name="title" class="input-field-2" id = "title" required value="" required> <br>
       <label for="name">Descrition </label>
       <br>
      <input type="text" name="description" class="input-field-2" id = "description" required value="" required > <br>
       <label for="name">Occupancy </label>
       <br>
      <input type="text" name="occupancy" class="input-field-2" id = "occupancy" required value="" required > <br>
      <label for="image">Contact Details </label>
      <br>
      
      <input type="text" name="contact_number" class="input-field-2" id = "contact_no" required value="" required > <br>
      <label for="name">Rental </label>
       <br>
      <input type="text" name="rental" class="input-field-2" id = "rental" required value="" required > <br>

       
        <label for="name">Advertiesment Status </label>
      <select name="status" class="input-field" style="height:3rem;"  >
         <option value="PROCESSING">Processing</option>
      </select>
      <br>
      <label for="image">Image : </label>
     <br>
      <input type="file" name="image" id = "image" class="input-field-2" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      <button type = "submit"  class="btn"name = "submit">Submit</button>
    </form>

     <p class="body-heading">My Places</p>


       <div style="display: flex; flex-direction: row;">
      <a href="logout.php" class="btn">logout</a>
      <br>
      <br>
      

      </div>

</div>
</div>

</body>
</html>
