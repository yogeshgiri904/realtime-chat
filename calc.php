<?php 
    include "conn.php";
    include "auth.php";
?>
<?php
$i = 0;
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
                $i++;                
            }
        }
    }
    echo $i;
?>