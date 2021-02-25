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
            if($data['username']!=$username)
            {
                echo "<li class='bot'>
                <div class='cui__bubble'>
                    <div class='inner__bubble'>
                        <img src=".$data['dp']." alt='friend'>
                        <h4>".$data['username']." :&nbsp;</h4>
                        <p>".$data['msg']."</p>
                    </div>
                </div>
                </li>"; 
            }
            else
            {
                $folder = "asset/user.png";
                $data['username']="You";
                echo "<li class='human'>
                <div class='cui__bubble'>
                    <div class='inner__bubble'>
                        <h4>".$data['username']." :&nbsp;</h4>
                        <p>".$data['msg']."</p>
                        <img src=".$data['dp']." alt='you'>
                    </div>
                </div>
                </li>";
            }
            
        }
    }
?>
</body>
</html>

