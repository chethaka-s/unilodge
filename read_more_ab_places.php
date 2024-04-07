<?php

@include 'config.php';

session_start();

if (isset($_GET['boarding_place_id'])) {
   
    $boarding_place_id = $_GET['boarding_place_id'];


    $query = "SELECT * FROM boarding_places WHERE boarding_place_id = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, 'i', $boarding_place_id);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $boarding_place = mysqli_fetch_assoc($result);


}

     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
      
        $status = $_POST['status'];

         $update_query = "UPDATE boarding_places SET status = ? WHERE boarding_place_id = ?";
        $update_statement = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_statement, 'si', $status, $boarding_place_id);
        mysqli_stmt_execute($update_statement);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding Place Details</title>
    <link rel=stylesheet href="css/style.css">
</head>
<body>
      <div class="container">
        <div class="content-body poster">
    <?php if(isset($boarding_place)): ?>
        <h1 class='place-heading'><?php echo $boarding_place['title']; ?></h1>
        <img src="<?php echo $boarding_place['image_path']; ?>" alt="Boarding Place Image" class="poster-image">
        <p class="poster-description"><?php echo $boarding_place['description']; ?></p>
       
        <p class="poster-contact">Call :<?php echo $boarding_place['contact_number']; ?></p>
       
        <p class="poster-rental">Rental: <?php echo $boarding_place['rental']; ?></p>
        <p>Occupancy: <?php echo $boarding_place['occupancy']; ?></p>
        
        
        
        <iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/view?key=AIzaSyBDypqYUWlG21UOjsC61YF-tA-Ydp5q96M&center=<?php echo $boarding_place['latitude']; ?>,<?php echo $boarding_place['longitude']; ?>&zoom=15" allowfullscreen></iframe>
        
      
        <form action="" method="POST">
            <div class="status">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="ACCEPTED">Accepted</option>
                <option value="REJECTED">Rejected</option>
            </select>
            <input type="hidden" name="boarding_place_id" value="<?php echo $boarding_place_id; ?>">
            <button type="submit" class="read-m-button">Update Status</button>
        </form>
        </div>
        </div>
        </div>
    <?php else: ?>
        <p>No boarding place found with the provided ID.</p>
    <?php endif; ?>
</body>
</html>
