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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>My Inbox</title>
</head>
<body>
<div class="p-4 pb-5">
    <div class="row rounded-lg shadow">
        <div class="col-md-12 px-0">
            <div class="bg-white">
                <div class="bg-gray px-4 py-2 bg-light">
                    <p class="h5 mb-0 py-1">
                    <a class="text-dark" href="home.php"><i>Home</i></a> / <i class="text-secondary">Inbox</i>
                    </p>
                </div>
                <div class="messages-box">
                <?php
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

                            if($table != "login" && $table != "dp" && $table != "profile" && $table != "username" && $ifMe == $username)
                            {
                                $last = "SELECT * FROM `$table` WHERE sn = ( SELECT MAX( sn ) FROM `$table` )";
                                $lastResult = mysqli_query($conn, $last);
                                if(mysqli_num_rows($lastResult)>0)
                                {
                                    $lastData = mysqli_fetch_array($lastResult);
                                    $readMsg = $lastData['msg'];
                                    $readDate = substr($lastData['date'],0,10);
                                    $readTime = substr($lastData['date'],11,5);
                                    if(substr($lastData['date'],11,2)<12)
                                    {
                                        $readMerd = "AM";
                                    }
                                    else
                                    {
                                        $readMerd = "PM";
                                    }
                                    date_default_timezone_set('Asia/Kolkata');
                                    $currentTime = date('Y-m-d H:i');
                                    $getDate = substr($lastData['date'],0,-3);
                                    if($currentTime == $getDate){
                                        $readDate = "NOW";
                                        $readTime = $readMerd = NULL;
                                        
                                    }
                                }
                                else{
                                    $readMsg = "Do your first message now.";
                                    $readDate = $readTime = $readMerd = $getDate = NULL;
                                }
                                $finalName = str_replace($username, "", $table);
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
                            <div class='list-group rounded-0'>
                                <a href='create.php?id=$table' class='list-group-item list-group-item-action rounded-0'>
                                <div class='media'>
                                    <img src='$folder' alt='friend' width='50' class='rounded-circle'>
                                    <div class='media-body ml-4'>
                                    <div class='d-flex align-items-center justify-content-between mb-1'>
                                        <h6 class='mb-0'>$finalName</h6>
                                        <small class='small font-weight-bold'>$readDate</small>
                                    </div>
                                    <div class='d-flex align-items-center justify-content-between mb-1'>
                                        <p class='font-italic mb-0 text-small'>$readMsg</p>
                                        <small class='small font-weight-bold'>$readTime $readMerd</small>
                                    </div>
                                    </div>
                                </div>
                                </a>
                            </div>";
                            }
                        }
                    }
                ?>         
                </div>
                <div class="bg-gray p-3 bg-light">
                    <p class="h5 mb-0 py-1 float-right">
                    <i class="fa fa-circle text-danger" aria-hidden="true"></i>
                    <i class="fa fa-circle text-warning" aria-hidden="true"></i>
                    <i class="fa fa-circle text-success" aria-hidden="true"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>


<!-- SHOW TABLES In user WHERE Tables_in_user= "login" -->