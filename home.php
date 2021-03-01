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
    <title>Namaste - Home</title>
    <style>
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
.footer-widget p {
    margin-bottom: 27px;
}
.dk-footer p {
    font-family: 'Nunito', sans-serif;
    font-size: 16px;
  color:white;
    line-height: 28px;
}

   .animate-border {
  position: relative;
  display: block;
  width: 115px;
  height: 3px;
  background: #007bff; }

.animate-border:after {
  position: absolute;
  content: "";
  width: 35px;
  height: 3px;
  left: 0;
  bottom: 0;
  border-left: 10px solid #fff;
  border-right: 10px solid #fff;
  -webkit-animation: animborder 2s linear infinite;
  animation: animborder 2s linear infinite; 
  }

.dk-footer {
  padding: 75px 0 0;
  background-color: #151414;
  position: relative;
  z-index: 2; }
  .dk-footer .contact-us {
    margin-top: 0;
    margin-bottom: 30px;
    padding-left: 80px; }
    .dk-footer .contact-us .contact-info {
      margin-left: 50px; }
    .dk-footer .contact-us.contact-us-last {
      margin-left: -80px; }
  .dk-footer .contact-icon i {
    font-size: 24px;
    top: -15px;
    position: relative;
    color:#007bff; }

.dk-footer-box-info {
  position: absolute;
  top: -122px;
  background: #202020;
  padding: 40px;
  z-index: 2; }
  .dk-footer-box-info .footer-social-link h3 {
    color: #fff;
    font-size: 24px;
    margin-bottom: 25px; }
  .dk-footer-box-info .footer-social-link ul {
    list-style-type: none;
    padding: 0;
    margin: 0; }
  .dk-footer-box-info .footer-social-link li {
    display: inline-block; }
  .dk-footer-box-info .footer-social-link a i {
    display: block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    text-align: center;
    line-height: 40px;
    background: #000;
    margin-right: 5px;
    color: #fff; }
    .dk-footer-box-info .footer-social-link a i.fa-facebook {
      background-color: #3B5998; }
    .dk-footer-box-info .footer-social-link a i.fa-twitter {
      background-color: #55ACEE; }
    .dk-footer-box-info .footer-social-link a i.fa-google-plus {
      background-color: #DD4B39; }
    .dk-footer-box-info .footer-social-link a i.fa-linkedin {
      background-color: #0976B4; }
    .dk-footer-box-info .footer-social-link a i.fa-instagram {
      background-color: #B7242A; }

.footer-awarad {
  margin-top: 285px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-flex: 0;
  -webkit-flex: 0 0 100%;
  -moz-box-flex: 0;
  -ms-flex: 0 0 100%;
  flex: 0 0 100%;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -moz-box-align: center;
  -ms-flex-align: center;
  align-items: center; }
  .footer-awarad p {
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    margin-left: 20px;
    padding-top: 15px; }

.footer-info-text {
  margin: 26px 0 32px; }

.footer-left-widget {
  padding-left: 80px; }

.footer-widget .section-heading {
  margin-bottom: 35px; }

.footer-widget h3 {
  font-size: 24px;
  color: #fff;
  position: relative;
  margin-bottom: 15px;
  max-width: -webkit-fit-content;
  max-width: -moz-fit-content;
  max-width: fit-content; 
}

.footer-widget ul {
  width: 50%;
  float: left;
  list-style: none;
  margin: 0;
  padding: 0; 
}

.footer-widget li {
  margin-bottom: 18px; }

.footer-widget p {
  margin-bottom: 27px; }

.footer-widget a {
  color: #878787;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s; 
}
.back-to-top {
  position: relative;
  z-index: 2; 
}
.back-to-top .btn-dark {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  padding: 0;
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #2e2e2e;
  border-color: #2e2e2e;
  display: none;
  z-index: 999;
  -webkit-transition: all 0.3s linear;
  -o-transition: all 0.3s linear;
  transition: all 0.3s linear; 
}
.back-to-top .btn-dark:hover {
  cursor: pointer;
  background: #FA6742;
  border-color: #FA6742; 
}


</style>
</head>
<body>
<!-- fixed navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="head">
        <a class="navbar-brand ml-2" href="#">
          <img src="img/n.jpg" class="rounded-circle" width="35" height="35" class="d-inline-block align-top" alt="Logo">
          <b style="padding-top: 10px;">NAMASTE</b> 
        </a>
          <div class="nav-item dropdown ml-auto">
              <a class="navbar-brand" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo $folder; ?>" class="rounded-circle" width="30" height="30" class="d-inline-block align-top" alt="user">
                <?php echo $_SESSION['username']; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
              </a>
              <br>
              <div class="dropdown-menu mt-2 dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="profile.php"><i class="fa fa-user-o" aria-hidden="true"></i> My Profile</a>
                <a class="dropdown-item" href="find.php"><i class="fa fa-handshake-o" aria-hidden="true"></i> Friend List</a>
                <a class="dropdown-item" href="init.php"><i class="fa fa-comments-o" aria-hidden="true"></i> Messenger</a>
                <?php
                  $sql = "SELECT * FROM `profile` WHERE `username` LIKE '$username' ";
                  $result = mysqli_query($conn, $sql);
                  $data = mysqli_fetch_array($result);
                  $check = mysqli_num_rows($result);
                  if($check >= 1)
                  {
                    $sn = $data['sn'];
                    echo "<a class='dropdown-item' href='editprofile.php?id=$sn'><i class='fa fa-cog' aria-hidden='true'></i> Edit Profile</a>";
                  }
                  else{
                    echo "<a class='dropdown-item' href='editprofile.php'><i class='fa fa-cog' aria-hidden='true'></i> Edit Profile</a>";
                  }
                ?>
                <a class="dropdown-item" href="find2.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> My Inbox</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="sessionOut.php">Sign Out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
              </div>
          </div>
        </nav>

  <!-- bootstrap carousel slider -->
  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
        <div class="carousel-item active" style="background-image: url('https://source.unsplash.com/LAaSoL0LrYs/1920x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">Namaste Messaging Website</h2>
            <p class="lead">Created by Yogesh Giri.</p>
          </div>
        </div>
        <!-- Slide Two - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('https://source.unsplash.com/bF2vsubyHcQ/1920x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">User Profile Creation</h2>
            <p class="lead">Create your beautiful profile.</p>
          </div>
        </div>
        <!-- Slide Three - Set the background image for this slide in the line below -->
        <div class="carousel-item" style="background-image: url('https://source.unsplash.com/szFUQoyvrxM/1920x1080')">
          <div class="carousel-caption d-none d-md-block">
            <h2 class="display-4">Real Time Group Chatting</h2>
            <p class="lead">Use realtime and instant chatting feature with numbers of friends.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
    </div>
  </header>
  
  <!-- Page Content -->
  <section class="py-5">
    <div class="container">
    <h2>Introducing, <br><a href="#">Namaste Messaging Application</a></h2>
      <p class="lead">Setup your beautiful profile. Create a <a href="init.php">Group</a> and BOOM!. Use realtime and instant chatting feature with
       numbers of friends. </p>
    </div>
  </section>

<br><br><br>

<footer id="dk-footer" class="dk-footer">
  <div class="container">
      <div class="row">
          <div class="col-md-12 col-lg-4">
              <div class="dk-footer-box-info">
                  <a href="index.html" class="footer-logo">
                      <img src="https://cdn.pixabay.com/photo/2016/11/07/13/04/yoga-1805784_960_720.png" alt="footer_logo" class="img-fluid">
                  </a>
                  <p class="footer-info-text">
                  &#169; NAMASTE APP <br> Created by Yogesh Giri,
                  <br>
                  (Full - Stack Web Developer)
                  </p>
                  <div class="footer-social-link">
                      <h3>Follow Us</h3>
                      <ul>
                          <li>
                              <a href="#">
                                  <i class="fa fa-facebook"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fa fa-twitter"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fa fa-google-plus"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fa fa-linkedin"></i>
                              </a>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fa fa-instagram"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
                  <!-- End Social link -->
              </div>
              <!-- End Footer info -->
              <div class="footer-awarad">
                  <img src="images/icon/best.png" alt="">
                  <p></p>
              </div>
          </div>
                 
        <div id="back-to-top" class="back-to-top">
            <button class="btn btn-dark" title="Back to Top" style="display: block;">
                <a href="#"><i class="fa fa-angle-up"></i></a>
            </button>
        </div>
</footer>


  
</body>
</html>