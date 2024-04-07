<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['warden_name'])){
   header('location:login_form.php');
}

$stmt = mysqli_prepare($conn, "SELECT boarding_place_id,title,status ,description,image_path ,latitude, longitude FROM boarding_places");
mysqli_stmt_execute($stmt);


mysqli_stmt_bind_result($stmt, $boarding_place_id ,$title, $status,$description,$image_path ,$latitude, $longitude);
$places = array();
while (mysqli_stmt_fetch($stmt)) {
    $places[] = array('boarding_place_id' => $boarding_place_id,'title' => $title, 'status'=> $status,'description'=>$description,'image_path'=>$image_path ,'latitude' => $latitude, 'longitude' => $longitude);
}
mysqli_stmt_close($stmt);


?>

<html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Warden Page</title>


   <link rel="stylesheet" href="css/style.css">

   <script>
          function initMap() {

            //   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDypqYUWlG21UOjsC61YF-tA-Ydp5q96M&callback=initMap" 
            var map = new google.maps.Map(document.getElementById('map'), {
                center:{lat: 6.8208936, lng: 80.0397229},
                //centerd to nsbm green university 
                zoom: 15
            });

         
            <?php foreach ($places as $place): ?>
                var marker = new google.maps.Marker({
                    position: {lat: <?php echo $place['latitude']; ?>, lng: <?php echo $place['longitude']; ?>},
                    map: map,
                    title: '<?php echo $place['title']; ?>'
                    
                });
            <?php endforeach; ?>

              google.maps.event.addListenerOnce(map, 'idle', function() {
        console.log('Map loaded successfully.');
    });

    google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
        console.log('All tiles loaded.');
    });

    google.maps.event.addListener(map, 'projection_changed', function() {
        console.log('Projection changed.');
    });

    google.maps.event.addListener(map, 'error', function() {
        console.log('An error occurred while loading the map.');
    });
        }
    </script>

</head>
<body onload="initMap()" >
  <?php include 'header.php'; ?>
   
<div class="container">
    <div class="content-body">

   <div class="content">
      <br>
      <h3>Hi, <span>Warden</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['warden_name'] ?></span></h1>
      <p>this is an Warden page</p>
          <div id="map" style="height: 400px;"></div>

          <h2>Places</h2>
    <ul>
        <?php foreach ($places as $place): ?>

            <li class="map-list">
               <div class="map-cards">
                  <h4>
               <?php echo $place['title']; ?>
        </h4>
               <div class="status-display">
               <?php echo $place['status'];?>
               <!-- <?php echo $place['boarding_place_id'];?> -->
                 </div>
               <a href="read_more_ab_places.php?boarding_place_id=<?php echo $place['boarding_place_id']; ?>">

                <button  class="read-m-button">Read More</button>
        </a>

            
            
            </li>
               </div>
        <?php endforeach; ?>
    </ul>


      <!-- <a href="logout.php" class="btn">logout</a> -->
   </div>
        </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDypqYUWlG21UOjsC61YF-tA-Ydp5q96M&callback=initMap" async defer></script>
</body>
</html>