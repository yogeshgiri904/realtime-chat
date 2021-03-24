<?php
    // $server = "sql113.epizy.com";
    // $username = "epiz_27865341";
    // $password = "AlZKpC1PMWTUEQ";
    // $database = "epiz_27865341_user";

    $server = "localhost";
    $username = "root";
    $password = "12345";
    $database = "user";

    $conn = mysqli_connect($server, $username, $password, $database);
    if(!$conn)
    {
        die("Error in connecting to mySQL: ".mysqli_connect_error());
    }
?>