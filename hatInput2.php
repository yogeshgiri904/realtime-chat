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
    // else
    // {
    //     echo "
    // <li class='sent'>
    // <img src='img/3.jpg' alt='bot' />
    // <p>Hello! $username</p>
    // </li>";
    // echo "
    // <li class='sent'>
    // <img src='img/boss.jpg' alt='bot' />
    // <p>I think you already know me. I am your helper the Boss Baby.</p>
    // </li>";
    // echo "
    // <li class='sent'>
    // <img src='img/5.jpg' alt='bot' />
    // <p>I am the Boss Baby. TEN TE DENNN</p>
    // </li>";
    // echo "
    // <li class='sent'>
    // <img src='img/1.jpg' alt='bot' />
    // <p>Choose any chat from the left chatbar.</p>
    // </li>";
    // echo "
    // <li class='sent'>
    // <img src='img/2.jpg' alt='bot' />
    // <p>If you don't have any chat then no problem. Go to the Add friend option below and make new friends.</p>
    // </li>";
    // echo "
    // <li class='sent'>
    // <img src='img/4.jpg' alt='bot' />
    // <p>Then, come here again. Tb tk me thoda aram kr leta hu</p>
    // </li>";
    // }
?>