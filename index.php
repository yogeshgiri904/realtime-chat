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
  $login = false;
  $userCheck = $passCheck = false;
  $userError = $passError = false;

  if(isset($_POST['submit']))
  {
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    // Username input validation
    if(empty($username)) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Warning! </strong>Username cannot be empty. 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      </div>";
      $userError = true;
    } 
    else if(preg_match("/^[A-Za-z0-9!@#$%^&*_.]{3,}$/",$username)) {
      $userCheck = true;
    }
    else{
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Warning! </strong>Invalid Username.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      </div>";
      $userError = true;
    }

    // Password input validation
    if(empty($pass)) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Warning! </strong>Password cannot be empty.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      </div>";
      $passError = true;
    }
    else if(preg_match('/^[A-Za-z0-9!@#$%^&*_.]{1,}$/', $pass)) {
      $passCheck = true;
    }
    else{
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Warning! </strong>Trying to Hack me. Not that much EASY :) 
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
      </div>";
      $passError = true;
    }

    if($userCheck && $passCheck)
    {
      $sql = "SELECT * FROM `login` WHERE `username` LIKE '$username' AND `pass` LIKE '$pass'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $check = mysqli_num_rows($result);
      if($check >= 1)
      {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = strtolower($username);
        $_SESSION['mobile'] = $row['mobile'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['pass'] = $row['pass'];
        $_SESSION['timestamp'] = time();
        header("location: home.php");
      }
      else
      {
        $userError = $passError = true;
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Warning! </strong>Either Username or Password is incorrect.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";
      }
    }
  }
  else{
    $username = $pass = NULL;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>Sign In | Namaste</title>
    <link rel="icon" href="img/n.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
      * {
        font-family: 'Poppins', sans-serif;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: bold;
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
    <div class="login">
      <div class="login__check">
        <img src="img/n.jpg" alt="user">
      </div>
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
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="pass" class="login__input pass" value="<?php echo $pass; ?>" placeholder="Password"/>
          <?php if($passError) echo "<i class='fa fa-exclamation-circle' aria-hidden='true'></i>"; ?>
        </div>
        <input type="submit" name="submit" class="login__submit" value="Sign In">
        <p class="login__signup">Don't have an account? &nbsp;<a href="signup.php">Sign Up</a></p>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<script>
    $('.alert').alert()
</script>