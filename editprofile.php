<?php 
    include "conn.php";
    include "auth.php";
?>
<?php
    $done = false;
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `profile` WHERE `sn` = $id";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);
    }
    else
    {
        $data['fn'] = NULL;
        $data['ln'] = NULL;
        $data['gender'] = NULL;
        $data['dob'] = NULL;
        $data['work'] = NULL;
        $data['city'] = NULL;
        $data['state'] = NULL;
        $data['country'] = NULL;
        $data['bio'] = NULL;
    }

?>
<?php     
    if(isset($_POST['submit']))
    {
        $fn = $_POST['fn'];
        $ln = $_POST['ln'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $work = $_POST['work'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $bio = $_POST['bio'];
        if(isset($_GET['id']))
        {
            $sql = "UPDATE `profile` SET `fn` = '$fn', `ln` = '$ln', `gender` = '$gender', `dob` = '$dob', `work` = '$work', `city` = '$city', `state` = '$state', `country` = '$country', `bio` = '$bio' WHERE `profile`.`sn` = $id;";
           $result = mysqli_query($conn, $sql);
           if($result)
           {
                $done = true;
            }
           else
           {
               echo "Error in editing this note.";
           }
        }
        else
        {
            $sql="INSERT INTO `profile` (`username`, `fn`, `ln`, `gender`, `dob`, `work`, `city`, `state`, `country`, `bio`, `date`) 
            VALUES ('$username', '$fn', '$ln', '$gender', '$dob', '$work', '$city', '$state', '$country', '$bio', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            $sql = "SELECT * FROM `profile` WHERE `username` = '$username'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            $done = true;
        }

    }
?>
<?php
    $selectSql="SELECT * FROM `dp` WHERE `username` = '$username';";
    $result = mysqli_query($conn, $selectSql);
    $imgdata =mysqli_fetch_array($result);
    if ($imgdata) {
        $folder = $imgdata['folder'];
        $sn = $imgdata['sn'];
    }
    else
    {
        $folder = "asset/user.png";
    }

    if(isset($_POST['upload']))
    {
        $fileName = $_FILES['userimg']['name'];
        $fileType = $_FILES['userimg']['type'];
        $fileTemp = $_FILES['userimg']['tmp_name'];
        $fileSize = $_FILES['userimg']['size'];
        $folder = "asset/$fileName";
        move_uploaded_file($fileTemp, $folder);

        if($fileSize==NULL)
        {
            echo '<div class="alert alert-danger" role="alert">
            Select another image from gallary first.</div>';
            if($imgdata) {
                $folder = $imgdata['folder'];
            }
            else{
                $folder = "asset/user.png";
            }
        
        }
        else{
            if($imgdata) {
                unlink($imgdata['folder']);
                $sql = "UPDATE `dp` SET `name` = '$fileName', `size` = '$fileSize', `folder` = '$folder' WHERE `dp`.`sn` = $sn;";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success! </strong>Profile picture has been updated.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                }
                    else{
                    echo "Profile picture has not been updated. ERROR!!!";
                }
            }
            else{
                $sql="INSERT INTO `dp` (`username`, `name`, `size`, `folder`, `date`) VALUES ('$username', '$fileName', '$fileSize', '$folder', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success! </strong>Profile picture has been uploaded.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                }
                    else{
                    echo "Profile picture has not been uploaded. ERROR!!!";
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Edit Profile</title>
    <style>
    body {
        background-color: white;
    }
    .profile-img{
        text-align: center;
    }
    .profile-img img{
        width: 200px;
        height: 200px;
    }
    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -68px;
        height: 40px;
        width: 200px;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }
    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: -80px;
        top: 0;
    }
    .labels {
        font-size: 14px;
        font-weight:600;
    }
    .text-p
    {
        color: #0062cc;
        font-weight:600;
    }
    </style>
</head>
<body>
<?php

    if($done)
    {
        header("Location: profile.php");
    }
 
?>
    <form method="POST" enctype="multipart/form-data">
    <div class="container bg-white mt-2">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="p-box col-md-4">
                        <div class="d-flex align-center justify-content-center">
                            <div class="profile-img">
                                <img src="<?php echo $folder;?>" alt="user"/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="userimg"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" name="upload" value="Upload">
                    <br>
                    <span style="font-size: 25px;"> <?php echo $_SESSION['username'];?> <i class="fa text-success fa-check-circle"></i></span>
                    <span class="text-p"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $_SESSION['email'];?></span>
                    <span class="text-p"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $_SESSION['mobile'];?></span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Update Your Profile</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label><input type="text" name="fn" class="form-control" placeholder="First Name" value="<?php echo $data['fn'];?>"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label><input type="text" name="ln" class="form-control" placeholder="Last Name" value="<?php echo $data['ln'];?>"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Gender</label></div>
                        <div class="col-md-12">                            
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male" checked>
                            <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female">
                            <label class="form-check-label" for="Female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Date Of Birth</label><input type="date" name="dob" class="form-control" value="<?php echo $data['dob'];?>"></div>
                        <div class="col-md-12"><label class="labels">Profession</label><input type="text" name="work" class="form-control" placeholder="Profession" value="<?php echo $data['work'];?>"></div>
                        <div class="col-md-12"><label class="labels">Country</label><input type="text" name="country" class="form-control" placeholder="Country" value="<?php echo $data['country'];?>"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">State</label><input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $data['state'];?>"></div>
                        <div class="col-md-6"><label class="labels">City</label><input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $data['city'];?>"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Bio</label><textarea name="bio" class="form-control" rows="3"><?php echo $data['bio'];?></textarea></div>
                    </div>
                    <div class="mt-5 text-center"><input type="submit" class="btn btn-primary" value="Save Profile" name="submit"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>
</body>
</html>
