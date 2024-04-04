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
<title>New Blog</title>
	
	<link rel="stylesheet" href="css/style.css" type="text/css">

	
</head>

	<div class="blogfit">
		<div class="blog-box">
			<h1>New Blog</h1>
			<form action="write_blogs_handler.php" method="post" enctype="multipart/form-data">
				<div class="control">
					<label  for="title1">Title: </label>
					<input type="text" class="input-field-blog" name="title1" id="title1" placeholder="Enter Blog Title.."><br>
				</div>
                <div class="control">
					<label style="font-size: 18px" for="desc">Description: </label><br><br>
					<input name="desc" id="desc" class="input-field-blog"placeholder="Write Blog Description.."></input>
				</div>
				<div class="control">
					<label style="font-size: 18px" for="content">Content: </label><br><br>
					<textarea name="content" style="height:300px"; class="input-field-blog" id="content" placeholder="Write Blog.."></textarea>
				</div>
				<div class="control">
					<br><label style="font-size: 18px" for="img">Image: </label>
					<input type="file"  class="input-field-blog" name="image" id="image" placeholder="Choose File">
				</div>
				<div class="control">
					<br><label style="font-size: 18px" for="dt">Date: </label>
					<input type="date" name="date" id="date">
				</div>
				<div class="control"><br>
					<p ><input type="submit" class="blog-submit" value="Post Blog" id="btnevent" name="btnevent"></p>
				</div>
			</form>
		</div>
</div>

</body>
</html>