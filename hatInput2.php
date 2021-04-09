<?php 
    include "conn.php";
    include "auth.php";
    if(isset($_SESSION['room']))
	{
		$room = $_SESSION['room'];
        $readSql = "SELECT * FROM `$room`";
        $readResult = mysqli_query($conn, $readSql);
        if(mysqli_num_rows($readResult)>0)
        {
            while($data = mysqli_fetch_assoc($readResult))
            {
                $getUsername = $data['username'];
                $getDate = substr($data['date'],0,-3);
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
                    echo "
                    <li class='sent'>
                    <img src='$folder' alt='friend' />
                    <p>".$data['msg']."</p>
                    </li>
                    <p class='timestamp'>".$getDate."</p>";
                }
                else
                {
                    $getUsername ="You";
                    echo "
                    <li class='replies'>
                    <img src='$folder' alt='friend' />
                    <p>".$data['msg']."</p>
                    </li>
                    <p class='right-timestamp'>".$getDate."</p>";
                    
                }
                
            }
        }
    }
?>