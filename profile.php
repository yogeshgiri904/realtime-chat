<?php 
  include "conn.php";
  include "auth.php";
?>
<?php
  $selectSql="SELECT * FROM `dp` WHERE `username` = '$username';";
  $result = mysqli_query($conn, $selectSql);
  $data =mysqli_fetch_array($result);
  if ($data) {
  $folder = $data['folder'];
  }
  else
  {
  $folder = "asset/user.png";
  }

  $sql="SELECT * FROM `profile` WHERE `username` = '$username';";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($result);
  if($data)
  {
      $name = $data['fn']." ".$data['ln'];
      $work = $data['work'];
      $gender = $data['gender'];
      $dob = $data['dob'];
      $city = $data['city'];
      $state = $data['state'];
      $country = $data['country'];
      $address = $city.", ".$state.", ".$country;
      $bio = $data['bio'];
  }
  else
  {
      $name = $username;
      $work = "Add your work";
      $gender = "NA" ;
      $dob = "NA" ;
      $city = "NA" ;
      $state = "NA" ;
      $country = "Add your country" ;
      $address = "NA";
      $bio = "Add your beautiful description.";
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
  <title>Profile | Namaste</title>
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
  .button-link, .button-link:hover{
    text-decoration: none;
    color: white;
  }
  </style>
</head>
<body>
    <div class="container">
        <div class="main-body">
        
              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo $folder;?>" alt="Admin" class="rounded-circle">
                        <div class="mt-3">
                          <h4><?php echo $name;?> <i class="fa text-success fa-check-circle-o" aria-hidden="true"></i></h4>
                          <p class="text-secondary mb-1"><?php echo '<i class="fa fa-briefcase" aria-hidden="true"></i> '.$work;?></p>
                          <p class="text-muted font-size-sm"><?php echo '<i class="fa fa-map-marker" aria-hidden="true"></i> '.$country;?></p>
                          <?php
                            $sql = "SELECT * FROM `profile` WHERE `username` LIKE '$username' ";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_array($result);
                            $check = mysqli_num_rows($result);
                            if($check >= 1)
                            {
                                $sn = $data['sn'];
                                echo "<button class='btn btn-success'><a class='button-link' href='editprofile.php?id=$sn'>Edit Profile</a></button>";
                            }
                            else{
                                echo "<button class='btn btn-success'><a class='button-link' href='editprofile.php'>Edit Profile</a></button>";
                            }
                          ?>
                          <button class="btn btn-danger"><a class='button-link' href='sessionOut.php'>Sign Out</a></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="text-primary"><a href="home.php">Home</a></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="text-primary"><a href="find.php">Add Friend</a></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="text-primary"><a href="hatDisplay.php">My Inbox</a></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="text-primary"><a href="init.php">Create Group</a></span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <span class="text-primary"><a href="sessionOut.php">Sign Out</a></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <?php echo $_SESSION['username']; ?> <i class="fa text-success fa-check-circle" aria-hidden="true"></i>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $name; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Gender</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $gender; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Date of Birth</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $dob; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Profession</h6>
                        </div>
                        <div class="col-sm-6 text-secondary">
                        <?php echo $work; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $_SESSION['email']; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $_SESSION['mobile']; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Password</h6>
                        </div>
                        <div class="col-sm-6 text-secondary">
                        <?php echo $_SESSION['pass']; ?>
                        </div>
                        <div class="col-sm-3 text-secondary">
                        <a href="changepass.php">Change Password</a>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                        <?php echo $address; ?>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Bio</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" style="height: auto; min-height:85px;">
                         <?php echo $bio; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
</body>
</html>