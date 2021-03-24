<?php 
    include "conn.php";
    include "auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $room = $_SESSION['room'];
    $readSql = "SELECT * FROM `$room`";
    $readResult = mysqli_query($conn, $readSql);
    if(mysqli_num_rows($readResult)>0)
    {
        while($data = mysqli_fetch_assoc($readResult))
        {
            $getUsername = $data['username'];
            $getImg ="SELECT * FROM `dp` WHERE `username` = '$getUsername';";
            $imgResult = mysqli_query($conn, $getImg);
            if(mysqli_num_rows($imgResult)>0) {
              $imgData = mysqli_fetch_array($imgResult);
              $folder = $imgData['folder'];
            }
            else
            {
              $folder = "asset/user.png";
            }
            if($getUsername != $username)
            {
                echo "<li class='bot'>
                <div class='cui__bubble'>
                    <div class='inner__bubble'>
                        <img src=".$folder." alt='friend'>
                        <h4>".$getUsername ." :&nbsp;</h4>
                        <p>".$data['msg']."</p>
                    </div>
                </div>
                </li>"; 
            }
            else
            {
                $folder = "asset/user.png";
                $getUsername ="You";
                echo "<li class='human'>
                <div class='cui__bubble'>
                    <div class='inner__bubble'>
                        <h4>".$data['username']." :&nbsp;</h4>
                        <p>".$data['msg']."</p>
                        <img src=".$folder." alt='you'>
                    </div>
                </div>
                </li>";
            }
            
        }
    }
?>
</body>
</html>

