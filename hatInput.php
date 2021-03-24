<?php 
    include "conn.php";
    include "auth.php";
	if(isset($_SESSION['room']))
	{
        $room = $_SESSION['room'];
        // $findSql = "SHOW TABLES FROM epiz_27865341_user";
        $findSql = "SHOW TABLES FROM user";
        $result = mysqli_query($conn, $findSql);
        if(mysqli_num_rows($result)>0)
        { 
            while($data = mysqli_fetch_assoc($result))
            {
                // $table = $data['Tables_in_epiz_27865341_user'];
                $table = $data['Tables_in_user'];
                $removeMe = str_replace($username, "", $table);
                $ifMe = str_replace($removeMe, "", $table);
                $finalName = str_replace($username, "", $table);
                if($table != "login" && $table != "dp" && $table != "profile" && $table != "username" && $ifMe == $username)
                {                    
                    $last = "SELECT * FROM `$table` WHERE sn = ( SELECT MAX( sn ) FROM `$table` )";
                    $lastResult = mysqli_query($conn, $last);
                    if(mysqli_num_rows($lastResult)>0)
                    {
                        $lastData = mysqli_fetch_array($lastResult);
                        $readMsg = $lastData['msg'];
                    }
                    else{
                        if($finalName == "bot")
                        {
                            $readMsg = "How may I help you?";
                        }
                        else{
                            $readMsg = "You added $finalName";
                        }
                    }
                    $getImg ="SELECT * FROM `dp` WHERE `username` = '$finalName';";
                    $imgResult = mysqli_query($conn, $getImg);
                    if(mysqli_num_rows($imgResult)>0) {
                        $imgData = mysqli_fetch_array($imgResult);
                        $folder = $imgData['folder'];
                    }
                    else
                    {
                        $folder = "asset/user.png";
                    }
                echo "
                        <a href='hatDisplay.php?id=$table' style='text-decoration: none;'>
                            <li class='contact'>
                                <div class='wrap'>
                                    <span class='contact-status online'></span>
                                    <img src='$folder' alt='user'/>
                                    <div class='meta'>
                                        <p class='name'>$finalName</p>
                                        <p class='preview'>$readMsg</p>
                                    </div>
                                </div>
                            </li>
                        </a>";
                }
            }
        }
    }
    
?> 