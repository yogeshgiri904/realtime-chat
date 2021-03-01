<?php 
    include "conn.php";
    include "auth.php";
?>
<?php
    $id = $_GET['id'];
    echo $id;
    // $sql = "CREATE TABLE `epiz_27865341_user`.`$room` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL, `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = MyISAM;";
    $sql = "CREATE TABLE `user`.`$id` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL,  `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = InnoDB;";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $_SESSION['room'] = $id;
        header("Location: data.php");
    }
    else{
        $_SESSION['room'] = $id;
        header("Location: data.php");
    }

?>