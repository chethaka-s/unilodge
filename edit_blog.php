<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Blog</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
	<style>
		.imagefit{
			background: url("uploads/blog.jpg") no-repeat center fixed;
			background-position: center;
			background-size: cover;
			display: block;
		}
		
		section{
			position: relative;
			height: 170vh;
			width: 100%;
			background-size: cover;
			background-position: center center;
		}
		
		.form-container{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3));
			width: 1000px;
			padding: 50px 30px;
			border-radius: 10px;
			box-shadow: 7px 7px 20px #000;
		}
		
		.header1{
			text-transform: uppercase;
			font-size: 2em;
			text-align: center;
			margin-bottom: 2em;
            color: white;
		}
		
		.control input{
			width: 100%;
			display: block;
			padding: 10px;
			color: #222;
			border: none;
			outline: none;
			margin: 1em 0;
		}
		
		input#btnevent{
			background-color: #102542;
			display: block;
			margin: 0px 0px 0px 10px;
			text-align: center;
			border-radius: 12px;
			border: thin;
			padding: 10px 40px;
			outline: none;
			color: white;
			cursor: pointer;
			transition: .5s;
			text-transform: uppercase;
			width: 170px;
			height: 40px;
		}

		input#btnevent:hover{
			background-color: white;
			color: #102542;
			font-weight: bold;
			text-align: center;
			transition: .5s;
			box-shadow: 0 1px 4px rgba(0,0,0,0.3), 0 0 40px rgba(0,0,0,0.1) inset;
		}
		
		input{
			border-radius: 8px;
			background-color: white;
		}
		
		input:focus{
			background-color: #d2d9dd;
		}
		
		textarea{
			border-radius: 8px;
			width: 100%;
			height: 300px;
			border: none;
			font-size: 14px;
			background-color: white;
			outline: none;
			display: block;
		}
		
		textarea:focus{
			background-color: #d2d9dd;
		}
		
		label#chkpublish{
			display: flex;
			
		}
		
		input[type=checkbox]{
			vertical-align: middle;
			
		}
		
		label{
			font-style: normal;
            color: white;
		}
		
		.form3{
			position: absolute;
			width: 100%;
			top: 135%;
		}
	</style>
</head>
<div class="imagefit">
    <?php
        $_SESSION["id"] = $_GET["id"];
            $con = mysqli_connect("localhost","root","","unilodge","3308");
            if (!$con)
            {
                die("Sorry!!! We are facing technical issue..");
            }
        
            $sql = "SELECT * FROM `blogs` WHERE `blogid` = ".$_GET["id"].";";
        
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
	?>
	<section>
		<div class="form-container">
			<h1 class="header1" style="font-family: Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', 'serif'">- Edit Blog -</h1>
			<form action="edit_blog_handler.php" method="post" enctype="multipart/form-data">
				<div class="control">
					<label style="font-size: 18px" for="title1">Title: </label>
					<input type="text" name="title1" id="title1" placeholder="Enter Blog Title.." value="<?php echo $row["title"]; ?>"><br>
				</div>
                <div class="control">
					<label style="font-size: 18px" for="desc">Description: </label><br><br>
					<input name="desc" id="desc" placeholder="Write Blog Description.." value="<?php echo $row["description"]; ?>"></input>
				</div>
				<div class="control">
					<label style="font-size: 18px" for="content">Content: </label><br><br>
					<textarea name="content" id="content" placeholder="Write Blog.."><?php echo $row["content"]; ?></textarea>
				</div>
				<div class="control">
					<br><label style="font-size: 18px" for="image">Image: </label>
					<input type="file" name="image" id="image" placeholder="Choose File">
				</div>
				<div class="control">
					<br><label style="font-size: 18px" for="dt" >Date: </label>
					<input type="date" name="date" id="date" value="<?php echo $row["date"]; ?>">
				</div>
				<div class="control"><br>
					<p align="center"><input type="submit" value="Edit Blog" id="btnevent" name="btnevent"></p>
				</div>
                <?php $_SESSION["image"]=$row["imagePath"]; ?>
			</form>
		</div>
	</section>
</div>
</body>
</html>
