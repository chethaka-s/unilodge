<?php


@include 'config.php';
session_start();


if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit;
}


if (!isset($_GET['boarding_place_id'])) {
    echo "Boarding place ID not provided!";
    exit;
}

$boarding_place_id = $_GET['boarding_place_id'];


$sql = "SELECT * FROM boarding_places WHERE boarding_place_id = $boarding_place_id";
$result = $conn->query($sql);


if (!$result) {
    echo "Error executing the query: " . $conn->error;
    exit;
}


if ($result->num_rows == 0) {
    echo "Boarding place not found!";
    exit;
}


$boarding_place = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated data from the form
    $updated_place_name = $_POST['title'];
    $updated_description = $_POST['description'];
    $updated_contactNumber = $_POST['contact_number'];
    $updated_rental = $_POST['rental'];
    $updated_occupancy =$_POST['occupancy'];
    // $updated_location = $_POST['location'];

   
    $update_sql = "UPDATE boarding_places SET 
    title='$updated_place_name', 
    description='$updated_description', 
    contact_number='$updated_contactNumber',
    rental=' $updated_rental',
    occupancy =' $updated_occupancy'
    WHERE boarding_place_id=$boarding_place_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Boarding place updated successfully!";
       
        // header("Location: ../landlord_page.php");
        exit;
    } else {
        echo "Error updating boarding place: " . $conn->error;
        // echo $boarding_place_id;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Boarding Place</title>

</head>
<body>
<div class="blogfit">
    <div class="blog-box">
<h2>Edit Boarding Place</h2>

<form method="post">
<div class="control">
    <label for="place_name">Title</label><br>
    <input type="text" class="input-field-blog" id="title1" name="updated_place_name" value="<?php echo $boarding_place['title']; ?>"><br><br>
</div>

<div class="control">
    <label for="description">Description:</label><br>
    <textarea id="desc" class="input-field-blog" name="updated_description"><?php echo $boarding_place['description']; ?></textarea><br><br>
</div>   

<div class="control">
    <label for="place_name">Contact Number:</label><br>
    <input type="text" id="content" class="input-field-blog" name="updated_contactNumber" value="<?php echo $boarding_place['contact_number']; ?>"><br><br>
</div>  

<div class="control">
    <label for="place_name">Rental</label><br>
    <input type="text" id="place_name" class="input-field-blog" name="updated_rental" value="<?php echo $boarding_place['rental']; ?>"><br><br>
</div>   

<div class="control">
    <label for="place_name">Occupancy</label><br>
    <input type="text" id="place_name" class="input-field-blog" name="updated_occupancy" value="<?php echo $boarding_place['occupancy']; ?>"><br><br>
</div>    

        
    <input type="submit" id="btnevent" class="blog-submit" value="Update">
</form>

</div>
</div>

</body>
</html>

<?php
$conn->close();
?>