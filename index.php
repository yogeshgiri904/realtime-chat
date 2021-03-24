<?php 
session_start();
if(isset($_SESSION['username']))
{
  header("location: home.php");
  die();
}
?>

<?php
if($_POST)
{
  include 'conn.php';
  $login = false;
  $username = $_POST["username"];
  $pass = $_POST["pass"];

  $sql = "SELECT * FROM `login` WHERE `username` LIKE '$username' AND `pass` LIKE '$pass'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $check = mysqli_num_rows($result);
  if($check >= 1)
  {
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['mobile'] = $row['mobile'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['pass'] = $row['pass'];
    $_SESSION['timestamp'] = time();
    header("location: home.php");
  }
  else
  {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Warning! </strong>Either Username or Password is incorrect.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Namaste - Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
            * {
        font-family: 'Poppins', sans-serif;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: bold;
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
          <input type="text" name="username" required class="login__input name" placeholder="Username"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="pass" required class="login__input pass" placeholder="Password"/>
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