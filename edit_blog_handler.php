<?php session_start();
        $title = $_POST["title1"];
        $description = $_POST["desc"];
        $content = $_POST["content"];
        $date = $_POST["date"];
        
        if (!file_exists($_FILES['image']['tmp_name']) ||
            !is_uploaded_file($_FILES['image']['tmp_name'])) {
            $image = $_SESSION["image"];
        } else {
            $image = "BlogUploads/".basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"],$image);
        }
		
		$con = mysqli_connect("localhost","root","","unilodge","3308");
		
		if (!$con) {
			die("Sorry!!! We are facing technical issue..");
		}
		
		$sql = "UPDATE `blogs` SET `title`='".$title."',`description`= '".$description."', `content`= '".$content."', `imagePath`= '".$image."',`date`= '".$date."' WHERE `blogid`= ".$_SESSION["id"].";";
		
		if (mysqli_query($con, $sql) ) {
				header('Location:admin_blogs.php');
		} else {
			echo "Sorry!! We are facing a technical issue! try again later!";
		}
		
?>
