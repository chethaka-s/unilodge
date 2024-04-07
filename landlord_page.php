<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['landlord_name'])){
   header('location:login_form.php');
}
if(isset($_SESSION['user_id'])) {
  
    $userId = $_SESSION['user_id'];
 
} else {

    echo "User ID not found in session.";
}

if(isset($_POST['submit'])) {
 
    $userId = $_SESSION['user_id'];

 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $contactNumber = $_POST['contact_number'];
    $rental = $_POST['rental'];
    $occupancy =$_POST['occupancy'];
    $status = $_POST['status'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    // $boarding_place_id = $_POST['boarding_place_id'];


  
    $uploadDir = 'uploads/';
    $fileName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $fileName;

    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      
        $sql = "INSERT INTO boarding_places (user_id, title, description, contact_number,rental,occupancy,status, image_path,latitude,longitude )
                VALUES ('$userId', '$title', '$description','$contactNumber', '$rental','$occupancy','$status', '$uploadFile',$latitude,$longitude)";
        
        if(mysqli_query($conn, $sql)) {
            echo "Boarding place uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }


    
        

}

        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM boarding_places WHERE user_id = $user_id";
        $result = $conn->query($sql);
      


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord</title>

 
    <link rel="stylesheet" href="css/style.css">


    <script>
       
        function loadGoogleMaps() {
            var script = document.createElement('script');
            script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBDypqYUWlG21UOjsC61YF-tA-Ydp5q96M&libraries=places&callback=initMap';
            script.defer = true;
            document.head.appendChild(script);
        }

       
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.8208936, lng: 80.0397229}, 
                zoom: 15 
            });

           
            var marker;
            map.addListener('click', function(event) {
                placeMarker(event.latLng);
            });

            function placeMarker(location) {
                if (marker) {
                    marker.setPosition(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                }

                document.getElementById('latitude').value = location.lat();
                document.getElementById('longitude').value = location.lng();
            }
        }
    </script>


</head>

<body onload="loadGoogleMaps()">
    <?php include 'header.php'; ?>

    <div class="container">

        <div class="content-body">
            <p class="user-type">Hello, Landlord</p>
            <h1>Welcome <span><?php echo $_SESSION['landlord_name'] ?></span> </h1>
            <p class="body-instru">Post your Boarding Place </p>

            <p class="body-heading">Add Your Place from Below</p>



            <form class="" id="myForm" method="post" onsubmit="return submitForm()" autocomplete="off"
                enctype="multipart/form-data">
                <label for="name">Title </label>
                <br>
                <input type="text" name="title" class="input-field-2" id="title" required value="" required> <br>
                <label for="name">Description </label>
                <br>
                <input type="text" name="description" class="input-field-2" id="description" required value="" required>
                <br>
                <label for="name">Occupancy </label>
                <br>
                <input type="text" name="occupancy" class="input-field-2" id="occupancy" required value="" required>
                <br>
                <label for="image">Contact Details </label>
                <br>

                <input type="text" name="contact_number" class="input-field-2" id="contact_no" required value=""
                    required> <br>
                <label for="name">Rental </label>
                <br>
                <input type="text" name="rental" class="input-field-2" id="rental" required value="" required> <br>


                <label for="name">Advertiesment Status </label>
                <select name="status" class="input-field" style="height:3rem;">
                    <option value="PROCESSING">Processing</option>
                </select>
                <br>
                <label for="image">Image : </label>
                <br>
                <input type="file" name="image" id="image" class="input-field-2" accept=".jpg, .jpeg, .png" value="">
                <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
                <br> <br>

 <div id="map" style="height: 400px; width:auto"></div>


                <button type="submit" class="btn" name="submit">Submit</button>
            </form>

            <p class="body-heading">My Places</p>
            
            
            <?php

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "Place Name: " . $row["title"]. "<br>";
        echo "Location: " . $row["status"]. "<br>";
        echo "Description: " . $row["rental"]. "<br><br>";
         echo '<a href="boarding_place/edit_boarding_place.php?boarding_place_id=' . $row["boarding_place_id"] . '">Edit</a>';
    }
} else {
    echo "No boarding places found for this user.";
    echo $user_id;
}



$conn->close();

?>


            <div style="display: flex; flex-direction: column;">
                <br>
                <br>


            </div>
                                  <!-- <a href="logout.php" class="btn">logout</a> -->
        </div>
    </div>



   </body>
    </html >