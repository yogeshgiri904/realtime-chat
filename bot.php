<?php
    include "conn.php";
    include "auth.php";

    if(!isset($_SESSION['room']) || $_SESSION['room'] == $username."bot")
	{
		$room = $_SESSION['room'];
        $getImg ="SELECT * FROM `dp` WHERE `username` = 'bot';";
        $imgResult = mysqli_query($conn, $getImg);
        if(mysqli_num_rows($imgResult)>0) 
        {
            $imgData = mysqli_fetch_array($imgResult);
            $botImg = $imgData['folder'];
        }
        else{
            $botImg = "asset/boss.jpg";
        }
        $chat0 = "Namaste! Mr. $username";
        $chat1 = "I am your helper bot, THE BOSS BABY.";
        $chat2 = "Choose any chat from the left chatbar.";
        $chat3 = "If you do not have any chat. Then, please go to the Add friend option below and make new friends.";
        $chat4 = "You can approch me anytime, whenever you need some help.";

        $sql = "INSERT INTO `$room` (`username`, `dp`, `msg`, `date`) VALUES ('bot', '$botImg', '$chat0', current_timestamp()),
        ('bot', '$botImg', '$chat1', current_timestamp()),
        ('bot', '$botImg', '$chat2', current_timestamp()),
        ('bot', '$botImg', '$chat3', current_timestamp()),
        ('bot', '$botImg', '$chat4', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
            echo "Database Failure! Bot initialization failed.";
        }
        
    }
    header("Location: hatDisplay.php");
?>