<?php 
session_start();
if(isset($_SESSION['username']))
{
  header("location: home.php");
  die();
}
?>

<?php
  include 'conn.php';
  $userCheck = $emailCheck = $mobileCheck = $passCheck = $cpassCheck = false;
  $userError = $emailError = $mobileError = $passError = $cpassError = false;

  if(isset($_POST['submit']))
  {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];

    // Confirm pass input validation
    if(empty($cpass)) {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Confirm Password cannot be empty.</div>';
      $cpassError = true;
    }
    else if($pass == $cpass)
    {
      $cpassCheck = true;
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Your password and confirmation password do not match.</div>';
      $cpassError = true;
    }

    // Password input validation
    if(empty($pass)) {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Password cannot be empty.</div>';
      $passError = true;
    }
    else if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*_.]{6,}$/', $pass)) {
      $passCheck = true;
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Your password is weak. Please enter a strong password.</div>';
      $passError = true;
    }

    // Mobile number input validation
    if(empty($mobile)) {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Mobile Number cannot be empty.</div>';
      $mobileError = true;
    } 
    else if(preg_match('/^[0-9]{10}$/', $mobile)) {
      $mobileCheck = true;
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Invalid Mobile Number</div>';
      $mobileError = true;
    }

    // Email input validation
    if(empty($email)) {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Email Address cannot be empty.</div>';
      $emailError = true;
    } 
    else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailCheck = true;
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Invalid Email Address</div>';
      $emailError = true;
    }

    // Username input validation
    if(empty($username)) {
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Username cannot be empty.</div>';
      $userError = true;
    } 
    else if(preg_match("/^[A-Za-z0-9!@#$%^&*_.]{3,}$/",$username)) {
      $userCheck = true;
    }
    else{
      echo '<div class="alert alert-danger" role="alert"><b>Warning!</b> Invalid Username</div>';
      $userError = true;
    }


    // Checking User and Email Availability
    $emailSql = "SELECT * FROM `login` WHERE `email` LIKE '$email'";
    $userSql = "SELECT * FROM `login` WHERE `username` LIKE '$username'";
    $emailResult = mysqli_query($conn, $emailSql);
    $userResult = mysqli_query($conn, $userSql);
    $emailMatch = mysqli_num_rows($emailResult);
    $userMatch = mysqli_num_rows($userResult);
    if($userCheck && $emailCheck && $mobileCheck && $passCheck && $cpassCheck){
      if($emailMatch >= 1)
      {
        $emailError = true;
        echo '<div class="alert alert-danger" role="alert"><b>Warning! </b>
        Your email is already registered. <a href="index.php">Sign In</a> instead?
        </div>';
      }
      else if($userMatch >= 1)
      {
        $userError = true;
        echo '<div class="alert alert-danger" role="alert"><b>Warning! </b>';
        echo "'$username'";
        echo ' username not available. </div>';
      }
      else
      {
        $sql = "INSERT INTO `login` (`username`, `mobile`, `pass`, `email`, `date`) VALUES ('$username', '$mobile', '$pass', '$email', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
          $username = $pass = $cpass = $email = $mobile = NULL;
          echo '<div class="alert alert-success" role="alert">
          <b>Success! </b>Your account has been created successfully. <a href="index.php">Sign In</a> now?
          </div>';
        }
      }
    }
  }
  else{
    $username = $pass = $cpass = $email = $mobile = NULL;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Namaste</title>
    <link rel="icon" href="img/n.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
      * {
        font-family: 'Poppins', sans-serif;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: bold;
      }
        .login__form {
          top: 3%;
          width: 100%;
          height: 100%;
          text-align: center;
          position: absolute;
          padding-top: 60px;
          background: linear-gradient(to bottom, rgba(146, 135, 187, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
          transition: opacity 0.1s, transform 0.3s cubic-bezier(0.17, -0.65, 0.665, 1.25);
          transform: scale(1);
        }
        .fa-exclamation-circle{
          position: absolute;
          margin-top: 15px;
          margin-left: 3px;
          font-size: 15px;
          color: orange;
        }
    </style>
</head>
<body>
<div class="cont">
  <div class="demo">
    <div class="login__form">
      <form method="POST">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="username" class="login__input name" value="<?php echo $username; ?>" placeholder="Username"/>
          <?php if($userError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>

        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="email" class="login__input name" value="<?php echo $email; ?>" placeholder="Email"/>
          <?php if($emailError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>

        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="mobile" class="login__input name" value="<?php echo $mobile; ?>" placeholder="Mobile"/>
          <?php if($mobileError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>

        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="pass" class="login__input pass" value="<?php echo $pass; ?>" placeholder="Password"/>
          <?php if($passError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>

        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="cpass" class="login__input pass" value="<?php echo $cpass; ?>" placeholder="Confirm Password"/>
          <?php if($cpassError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>
        
        <input type="submit" name="submit" class="login__submit" value="Sign Up">
        <p class="login__signup">Already have an account? &nbsp;<a href="index.php">Sign In</a></p>
      </form>
    </div>
  </div>
</div>
</body>
</html>
