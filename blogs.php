<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blogs</title>
	<style>
		html {
		  box-sizing: border-box;
		}

		*, *:before, *:after {
		  box-sizing: inherit;
		}
		
		.column {
		  float: left;
		  width: 33.3%;
		  margin-bottom: 16px;
		  padding: 0 8px;
		}

		@media screen and (max-width: 650px) {
		  .column {
			width: 100%;
			display: block;
		  }
		}

		.card {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		}

		.container {
		  padding: 0 16px;
		}

		.container::after, .row::after {
		  content: "";
		  clear: both;
		  display: table;
		}
		
		.row{
		  box-sizing: border-box;
		  height: 550px;
		}
		
		.column{
		  box-sizing: border-box;
		  height: 550px;
		}
		
		.card{
		  box-sizing: border-box;
		  height: 550px;
		}
	</style>
</head>

<body>
	<?php
		// $conn = mysqli_connect('localhost','root','','unilodge', '3308');
		@include 'config.php';
		if (!$conn)
		{
			die("Sorry!!! We are facing technical issue..");
		}
	
		$sql = "SELECT * FROM `blogs`;";
	
		$result = mysqli_query($conn, $sql);
	
		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
	?>
	<div class="row">
	<div class="column">
		<div class="card">
		<p>
		  <img src="<?php echo $row["imagePath"]?>" style="width: 100%; height: 300px;">
		  <div class="container">
			<h2><?php echo $row["title"]?></h2>
			<p><?php echo $row["description"]?><a href="read_blog.php"> read more..</a></p>
			<p>Published by : <?php echo $row["email"]?> </p>
			<p>Date : <?php echo $row["date"]?> </p>
		<br>
		</div>
		</p>
	</div>
	</div>
	<?php
	  		}
		}
		mysqli_close($conn);
	?>
</body>
</html>
