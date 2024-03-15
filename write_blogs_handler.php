<?php session_start();
    // @include 'config.php';

    if(isset($_POST["btnevent"]))
    {
        $blogtitle = $_POST["title1"];
        $content = $_POST["content"];
        $date = $_POST["date"];
        $desc = $_POST["desc"];

        $image = "BlogUploads/".basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"],$image);

        $conn = mysqli_connect('localhost','root','','unilodge', '3308');

        if (!$conn)
        {
            die("Sorry!!! We are facing technical issue..");
        }

        $sql = "INSERT INTO `blogs` (`blogid`, `title`, `description`, `content`, `imagePath`, `date`, `email`) VALUES (NULL, '".$blogtitle."', '".$desc."', '".$content."', '".$image."', '".$date."', '".$_SESSION["admin_name"]."');";

        if (mysqli_query($conn, $sql) > 0)
        {
            header('Location:admin_home.php');
        }
        else
        {
            echo "Oops!! Something went wrong, please select the file again!";
        }
    }
?>
