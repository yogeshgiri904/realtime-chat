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
  if(isset($_POST['submit']))
  {
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];

    $emailSql = "SELECT * FROM `login` WHERE `email` LIKE '$email'";
    $userSql = "SELECT * FROM `login` WHERE `username` LIKE '$username'";

    $emailMatchResult = mysqli_query($conn, $emailSql);
    $userMatchResult = mysqli_query($conn, $userSql);

    $emailCheck = mysqli_num_rows($emailMatchResult);
    $UserCheck = mysqli_num_rows($userMatchResult);
    if($pass == $cpass)
    {
      if($emailCheck >= 1)
      {
        echo '<div class="alert alert-danger" role="alert">
        Your email is already registered. <a href="index.php">Sign In</a> instead?
        </div>';
      }
      else if($UserCheck >= 1)
      {
        echo '<div class="alert alert-danger" role="alert">';
        echo "'$username'";
        echo ' username not available. </div>';
      }
      else
      {
        $sql = "INSERT INTO `login` (`username`, `mobile`, `pass`, `email`, `date`) VALUES ('$username', '$mobile', '$pass', '$email', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
          echo '<div class="alert alert-success" role="alert">
          Your account has been created successfully. <a href="index.php">Sign In</a> now?
          </div>';
        }
      }
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
      Your password and confirmation password do not match.
      </div>';
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
    <title>Namaste - Sign Up</title>
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
          <input type="text" name="username" required class="login__input name" value="<?php echo $username; ?>" placeholder="Username"/>
        </div>

        <div class="login__row">
            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
            </svg>
            <input type="text" name="email" required class="login__input name" value="<?php echo $email; ?>" placeholder="Email"/>
        </div>

        <div class="login__row">
        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
        </svg>
        <input type="text" name="mobile" required class="login__input name" value="<?php echo $mobile; ?>" placeholder="Mobile"/>
        </div>

        <div class="login__row">
            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
            </svg>
            <input type="password" name="pass" required class="login__input pass" value="<?php echo $pass; ?>" placeholder="Password"/>
        </div>

        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="cpass" required class="login__input pass" value="<?php echo $cpass; ?>" placeholder="Confirm Password"/>
        </div>
          <input type="submit" name="submit" class="login__submit" value="Sign Up">
          <p class="login__signup">Already have an account? &nbsp;<a href="index.php">Sign In</a></p>

      </form>
    </div>
  </div>
</div>
</body>
</html>