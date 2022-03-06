<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "user";

    $conn = mysqli_connect($server, $username, $password, $database);
    if(!$conn)
    {
        die("Error in connecting to mySQL: ".mysqli_connect_error());
    }
?>
