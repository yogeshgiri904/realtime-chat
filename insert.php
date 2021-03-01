<?php
    include "conn.php";
    include "auth.php";
    print_r ($_POST);

    $folder = "asset/user.png";
    $selectSql="SELECT * FROM `dp` WHERE `username` = '$username';";
    $result = mysqli_query($conn, $selectSql);
    $data =mysqli_fetch_array($result);
    if($data) {
        $folder = $data['folder'];
    } 

    $room = $_SESSION['room'];
    $chat = $_POST['chat'];
    $sql = "INSERT INTO `$room` (`username`, `dp`, `msg`, `date`) VALUES ('$username', '$folder', '$chat', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        echo "Database Failure! Message not send";
    }
?>