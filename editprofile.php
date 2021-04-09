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
  if($done)
  {
      header("Location: profile.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>Edit Profile | Namaste</title>
  <link rel="icon" href="img/n.jpg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
  * {
      font-family: 'Poppins', sans-serif;
  }
  h1,h2,h3,h4,h5,h6{
      font-weight: bold;
  }
  body {
      margin-top:20px;
      color: #1a202c;
      text-align: left;
      background-color: #e2e8f0;    
  }
  .card {
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
  }
  .profile-img{
      text-align: center;
  }
  .profile-img img{
      width: 200px;
      height: 210px;
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
  .fa-check-circle{
      position: absolute;
      top: 60%;
      right: 6%;
  }
  .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0,0,0,.125);
      border-radius: .25rem;
  }
  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
  } 
  .rounded-circle{
      width: 180px;
      height: 180px;
  }
  .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
  }
  .gutters-sm>.col, .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
  }
  .mb-3, .my-3 {
      margin-bottom: 1rem!important;
  }
  .bg-gray-300 {
      background-color: #e2e8f0;
  }
  .h-100 {
      height: 100%!important;
  }
  .shadow-none {
      box-shadow: none!important;
  }
  </style>
</head>
<body>
<div class="container">
  <div class="main-body">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
      </ol>
    </nav>
    
    <form method="POST" enctype="multipart/form-data">
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card h-100 pt-3">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
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
                  <input type="submit" class="btn btn-primary" name="upload" value="Upload">
                  <p><small><small><i>*Click upload to see changes. <br> *Max allowed size is 1 MB.</i></small></small></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center">
                  <h4>Update Your Profile</h4>
              </div>
              <div class="row">
                  <div class="col-md-6 mt-2"><label class="labels">First Name</label><input type="text" name="fn" class="form-control" placeholder="First Name" value="<?php echo $data['fn'];?>"></div>
                  <div class="col-md-6 mt-2"><label class="labels">Last Name</label><input type="text" name="ln" class="form-control" placeholder="Last Name" value="<?php echo $data['ln'];?>"></div>
                  <div class="col-md-12 mt-2"><label class="labels">Username</label><input type="text" readonly class="form-control" value="<?php echo $_SESSION['username'];?>"> <i class="fa text-success fa-check-circle"></i></div>
              </div>
              <div class="row">
                  <div class="col-md-12 mt-2"><label class="labels">Gender</label></div>
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
              <div class="row">
                  <div class="col-md-12 mt-2"><label class="labels">Date Of Birth</label><input type="date" name="dob" class="form-control" value="<?php echo $data['dob'];?>"></div>
                  <div class="col-md-12 mt-2"><label class="labels">Email</label><input type="text" readonly class="form-control" value="<?php echo $_SESSION['email'];?>"> <i class="fa text-success fa-check-circle"></i></div>
                  <div class="col-md-12 mt-2"><label class="labels">Mobile</label><input type="text" readonly class="form-control" value="<?php echo "+91 ".$_SESSION['mobile'];?>"> <i class="fa text-success fa-check-circle"></i></div>
                  <div class="col-md-12 mt-2"><label class="labels">Profession</label><input type="text" name="work" class="form-control" placeholder="Profession" value="<?php echo $data['work'];?>"></div>
                  <div class="col-md-12 mt-2"><label class="labels">Country</label><input type="text" name="country" class="form-control" placeholder="Country" value="<?php echo $data['country'];?>"></div>
                  <div class="col-md-6 mt-2"><label class="labels">State</label><input type="text" name="state" class="form-control" placeholder="State" value="<?php echo $data['state'];?>"></div>
                  <div class="col-md-6 mt-2"><label class="labels">City</label><input type="text" name="city" class="form-control" placeholder="City" value="<?php echo $data['city'];?>"></div>
                  <div class="col-md-12 mt-2"><label class="labels">Bio</label><textarea name="bio" class="form-control" rows="3"><?php echo $data['bio'];?></textarea></div>
              </div>
              <div class="mt-5 text-center">
                  <input type="submit" class="btn btn-success" value="Update" name="submit">
                  <input type="reset" class="btn btn-danger" value="Reset" name="submit">
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>