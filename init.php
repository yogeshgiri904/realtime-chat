<?php 
    include "conn.php";
    include "auth.php";
?>
<?php
    $showConfirm = false;
    if(isset($_POST['submit']))
    {
        $room = $_POST['room'];
        // $sql = "CREATE TABLE `epiz_27865341_user`.`$room` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL , `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = MyISAM;";
        $sql = "CREATE TABLE `user`.`$room` ( `sn` INT(128) NOT NULL AUTO_INCREMENT , `username` VARCHAR(128) NOT NULL , `dp` VARCHAR(128) NOT NULL , `msg` VARCHAR(128) NOT NULL , `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sn`)) ENGINE = InnoDB;";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $_SESSION['room'] = $room;
            header("Location: data.php");
        }
        else{
            $_SESSION['room'] = $room;
            $showConfirm = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/init.css">
    <title>Create Room | Namaste</title>
    <link rel="icon" href="img/n.jpg" type="image/x-icon">    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
            * {
        font-family: 'Poppins', sans-serif;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: bold;
      }
    </style>
</head>
<body>
<div class="wrapper fadeInDown">
<?php
if($showConfirm)
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Already a room available with the same name. Do you want to <strong><a href='data.php'>Join Room</a></strong>?
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
?>
  <div id="formContent">
  <div class="container pt-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Group</li>
    </ol>
    </nav>
    <!-- /Breadcrumb -->
    <div class="fadeIn first">
      <img src="img/n.jpg" id="icon" alt="User Icon" />
    </div>
    <form method="POST">
      <input type="text" id="login" class="fadeIn second" name="room" required placeholder="Enter Room Name"><br>
      <input type="submit" name="submit" class="fadeIn fourth" value="Start Chat">
    </form>
  </div>
</div>
</body>
</html>
<script>
    $('.alert').alert()
</script>