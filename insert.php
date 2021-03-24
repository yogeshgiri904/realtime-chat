<?php
    include "conn.php";
    include "auth.php";
	if(isset($_SESSION['room']))
	{
		$room = $_SESSION['room'];
        if(isset($_SESSION['folder']))
        {
            $folder = $_SESSION['folder'];
        }
        else{
            $folder = "asset/user.png";
        }
        $room = $_SESSION['room'];
        $chat = $_POST['chat'];
        $sql = "INSERT INTO `$room` (`username`, `dp`, `msg`, `date`) VALUES ('$username', '$folder', '$chat', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
            echo "Database Failure! Message not send";
        }
    }
    
    if(!isset($_SESSION['room']) || $_SESSION['room']== $username."bot")
	{
		$room = $_SESSION['room'];
        $folder = "img/boss.jpg";
        $botChat = "OOPS, I am under maintainence. Sorry for the inconvenience.";
        $botSql = "INSERT INTO `$room` (`username`, `dp`, `msg`, `date`) VALUES ('bot', '$folder', '$botChat', current_timestamp());";
        $botResult = mysqli_query($conn, $botSql);
        if(!$botResult)
        {
            echo "Database Failure! Message not send";
        }
        
    }
    
?>