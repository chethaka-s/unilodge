<?php session_start();
	$con = mysqli_connect("localhost","root","","unilodge","3308");
	if (!$con)
		{
			die("Sorry!!! We are facing technical issue..");
		}
	$sql = "DELETE FROM `blogs` WHERE `blogs`.`blogid` = ".$_GET["id"];

	if (mysqli_query($con, $sql))
	{
		header('Location:admin_blogs.php');
	}
?>
