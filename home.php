<?php 
  include "conn.php";
  include "auth.php";
?>
<?php
  $selectSql="SELECT * FROM `dp` WHERE `username` = '$username';";
  $result = mysqli_query($conn, $selectSql);
  $data =mysqli_fetch_array($result);
  if($data) {
    $folder = $data['folder'];
  }
  else
  {
    $folder = "asset/user.png";
  }

  $sql="SELECT * FROM `profile` WHERE `username` = '$username';";
  $userResult = mysqli_query($conn, $sql);
  $userData = mysqli_fetch_array($userResult);
  if($userData)
  {
    $name = $userData['fn']." ".$userData['ln'];
  }
  else
  {
    $name = NULL;
  }
  $_SESSION['folder']=$folder;
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <title>Home | Namaste</title>
  <link rel="icon" href="img/n.jpg" type="image/x-icon">
  <style>
    * {
        font-family: 'Poppins', sans-serif;
      }
    h1,h2,h3,h4,h5,h6{
        font-weight: bold;
      }
    html {
      scroll-behavior: smooth;
    }
    .carousel-item {
      height: 100vh;
      min-height: 350px;
      background: no-repeat center center scroll;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      }
  </style>
</head>
<body>

<!-- fixed navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
<div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="img/n.jpg" class="rounded-circle" width="40" height="40" class="d-inline-block align-top" alt="Logo">
      <b>Namaste Messenger</b> 
    </a>

    <ul class="navbar-nav ml-auto">
      <!-- Avatar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo $folder; ?>" class="rounded-circle" height="32" alt="user" loading="lazy"/>
          <div class="text-dark d-none d-lg-block d-print-block">&nbsp;
          <?php 
            if($name == NULL)
            {
              echo $username;
            }
            else{
              echo $name;
            }
          ?>&nbsp;</div>
        </a>
        <ul class="dropdown-menu mt-2 dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;My Profile</a>
          <a class="dropdown-item" href="find.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Friends</a>
          <a class="dropdown-item" href="init.php"><i class="fa fa-comments" aria-hidden="true"></i>&nbsp;&nbsp;Messenger</a>
          <?php
            $sql = "SELECT * FROM `profile` WHERE `username` LIKE '$username' ";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            $check = mysqli_num_rows($result);
            if($check >= 1)
            {
              $sn = $data['sn'];
              echo "<a class='dropdown-item' href='editprofile.php?id=$sn'><i class='fas fa-pencil-alt' aria-hidden='true'></i>&nbsp;&nbsp;Edit Profile</a>";
            }
            else{
              echo "<a class='dropdown-item' href='editprofile.php'><i class='fas fa-pencil-alt' aria-hidden='true'></i>&nbsp;&nbsp;Edit Profile</a>";
            }
          ?>
          <a class="dropdown-item" href="hatDisplay.php"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;My Inbox</a>
          <a class="dropdown-item" href="changepass.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i>&nbsp;&nbsp;Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="sessionOut.php">Sign Out&nbsp;&nbsp;<i class="fa fa-sign-out-alt" aria-hidden="true"></i></a>
        </ul>
      </li>
    </ul>
  </div>
</nav>

  <header>
    <!--Carousel Wrapper-->
  <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-2" data-slide-to="1"></li>
      <li data-target="#carousel-example-2" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <div class="view">
          <img class="d-block bg-image" src="https://source.unsplash.com/szFUQoyvrxM/1920x1080" alt="First slide">
          <div class="mask rgba-black-light"></div>
        </div>
        <div class="carousel-caption">
            <div class="container">
            <h2 class="h2-responsive">Namaste Messenger</h2>
            <p>This beautiful website is created by Yogesh Giri.</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block bg-image" src="https://source.unsplash.com/bF2vsubyHcQ/1920x1080" alt="Second slide">
          <div class="mask rgba-black-strong"></div>
        </div>
        <div class="carousel-caption">
          <h2 class="h2-responsive">User Profile Creation</h2>
          <p>Create your beautiful profile.</p>
        </div>
      </div>
      <div class="carousel-item">
        <!--Mask color-->
        <div class="view">
          <img class="d-block bg-image" src="https://source.unsplash.com/LAaSoL0LrYs/1920x1080" alt="Third slide">
          <div class="mask rgba-black-slight"></div>
        </div>
        <div class="carousel-caption">
          <h2 class="h2-responsive">Real Time Group Chatting</h2>
          <p>Use realtime and instant chatting feature with numbers of friends.</p>
        </div>
      </div>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->
  </header>
   
            
  <!-- Page Content -->
  <div class="container pt-5">
  <div class="card w-100">
    <div class=" p-4 shadow">
    <h5 class="card-title">Introducing,</h5>
      <h2 class="card-title text-primary">Namaste Messenger</h2>
      <p class="card-text">
        <ul style="list-style-type: katakana;">
        <li> First of all, Setup your beautiful profile by uploading a beautiful picture of yours.</li>
        <li> Find your friends here and start chatting with them, also make numbers of new friend here.</li>
        <li> There is a option to create group also, if you want to chat with more than one friend simultaneously.</ol>
        </ul>
      </p> 
      <?php
        if($check >= 1)
        {
          $sn = $data['sn'];
          echo "<a href='editprofile.php?id=$sn' class='btn btn-primary'>Update Profile</a>";
        }
        else{
          echo "<a href='editprofile.php' class='btn btn-primary'>Update Profile</a>";
        }
      ?>
    </div>
  </div>
</div>

  <div class="container">
  <div class="row">
  <div class="col-sm-6 pt-4">
    <div class="card">
      <div class=" p-4 shadow">
        <h5 class="card-title">Visit your profile</h5>
        <p class="card-text">
          Visit your beautiful profile. Upload profile picture, edit your details, change password and many more.
        </p>
        <a href="profile.php" class="btn btn-danger">My Profile</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 pt-4">
    <div class="card">
      <div class=" p-4 shadow">
        <h5 class="card-title">Find your friends here</h5>
        <p class="card-text">
          Visit your beautiful profile. Upload profile picture, edit your details, change password and many more.
        </p>
        <a href="find.php" class="btn btn-success">Find Friends</a>
      </div>
    </div>
  </div>
  
</div>
</div>

<div class="container">
  <div class="row">
  <div class="col-sm-6 pt-4">
    <div class="card">
      <div class=" p-4 shadow">
        <h5 class="card-title">Check your Messages</h5>
        <p class="card-text">
         Create a new group now and use realtime and instant chatting feature with any numbers of friends.
        </p>
        <a href="hatDisplay.php" class="btn btn-warning">My Inbox</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 pt-4">
    <div class="card">
      <div class=" p-4 shadow">
        <h5 class="card-title">Create a chat group</h5>
        <p class="card-text">
         Create a new group now and use realtime and instant chatting feature with any numbers of friends.
        </p>
        <a href="init.php" class="btn btn-secondary">Create Group</a>
      </div>
    </div>
  </div>
</div>
</div>

<div class="container p-3 pt-4 pb-5">
  <div class="card p-4 shadow">
  <h3 class="text-center">About Us</h3>
    <div class="row mt-3">
      <div class="col-md-6 col-lg-5 ml-auto mr-auto d-flex align-items-center mt-4 mt-md-0">
        <div>
          <img alt="developer" style="clip-path: circle(45%);" class="col-md-7 col-lg-6 ml-auto mr-auto d-flex align-items-center" src="img/n.jpg"  />
        </div>
      </div>
      <div class="col-md-6 col-lg-5 ml-auto mr-auto d-flex align-items-center mt-4 mt-md-0">
        <div class="pl-3 pr-2">
          <h5 class="card-title">Namaste Messenger</h5>
          <p class="text-muted">Setup your beautiful profile. Find your friends here and start chatting with them, also make numbers of new friend here. There is a option to create group also, if you want to chat with more than one friend simultaneously.</p>
          <a href="profile.php" class="btn btn-success mt-2 mr-2">My Profile</a>
          <a href="find.php" class="btn mt-2 mr-2 btn-danger">Find Friends</a>
        </div>
      </div>
    </div>

    <div class="row mt-5 mb-4">
      <div class="col-md-6 col-lg-5 ml-auto mr-auto d-flex align-items-center mt-4 mt-md-0">
        <div>
        <div class="pl-3 pr-2">
          <h5 class="card-title">Yogesh Giri</h5>
          <p class="text-muted">Developer - NAMASTE MESSENGER</p>
          <p class="card-text">Hey, This beautiful chatting website is created by me. I am an enthusiastic full stack web developer from India. Always passionate about my work because I love what I do.</p>
          <a href="https://yogeshgiri904.github.io/my-portfolio/" class="btn btn-success mt-2 mr-2">About Me</a>
          <a href="https://github.com/yogeshgiri904" class="btn mt-2 mr-2 btn-danger">Projects</a>
        </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-5 ml-auto mr-auto d-flex align-items-center mt-4 mt-md-0">
      <img alt="developer" style="clip-path: circle(45%);" class="col-md-7 col-lg-6 ml-auto mr-auto d-flex align-items-center" src="img/MyPic4.jpg"  />

      </div>
    </div>
  </div>
</div>


<!-- Footer -->
<footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4">

    <!-- Section: Text -->
    <section class="mb-4">
      <h4>
      NAMASTE CHATTING APPLICATION
      </h4>
      <p>You will find your friends here and start chatting with them, also make numbers of new friend here. There is a option to create group also, if you want to chat with more than one friend simultaneously.</p>
    </section>

        <!-- Section: Form -->
        <section class="">
      <form action="">
        <!--Grid row-->
        <div class="row d-flex justify-content-center">
          <!--Grid column-->
          <div class="col-auto">
            <p class="pt-2">
              <strong>For email updates</strong>
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-5 col-12">
            <!-- Email input -->
            <div class="form-outline form-white mb-4">
              <input type="email" id="form5Example2" class="form-control" />
              <label class="form-label" for="form5Example2">Email address</label>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-auto">
            <!-- Submit button -->
            <button type="submit" class="btn btn-danger mb-4">
              Subscribe
            </button>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </form>
    </section>
    <!-- Section: Form -->

        <!-- Section: Social media -->
        <section class="">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="profile.php" role="button"
        ><i class="fa fa-user"></i
      ></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="find.php" role="button"
        ><i class="fa fa-coffee"></i
      ></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="init.php" role="button"
        ><i class="fa fa-comments"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="find2.php" role="button"
        ><i class="fa fa-envelope"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="changepass.php" role="button"
        ><i class="fa fa-unlock-alt"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1 p-2" href="sessionOut.php" role="button"
        ><i class="fa fa-sign-out-alt"></i
      ></a>
    </section>
    <!-- Section: Social media -->
</div>

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2020 Copyright |
    <a class="text-white" href="https://github.com/yogeshgiri904">Yogesh Giri</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

</body>
</html>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>