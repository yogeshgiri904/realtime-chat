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
<?php
    if(isset($_POST['submit']))
    {
        $expass = $_POST['expass'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        if($pass == $cpass)
        {
            $sql = "SELECT * FROM `login` WHERE `username` LIKE '$username' AND `pass` LIKE '$expass'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)>=1)
            {
                $data = mysqli_fetch_array($result);
                $sn = $data['sn'];
                $dataPass = $data['pass'];
                if($dataPass == $pass)
                {
                    echo '<div class="alert alert-danger" role="alert">
                    <b>Warning ! </b>Old password and new password can not match.
                    </div>';
                }
                else
                {
                    $updateSql = "UPDATE `login` SET `pass` = '$pass' WHERE `login`.`sn` = '$sn';";
                    $updateResult = mysqli_query($conn, $updateSql);
                    if($updateResult)
                    {
                        echo '<div class="alert alert-success" role="alert">
                        <b>Success ! </b>Your password has been changed successfully. Redirecting to Sign In page...
                        </div>';
                        header("Refresh:4; url=sessionOut.php");                    
                    }
                    else
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        Your password has been not been changed.
                        </div>';
                    }
                }
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">
                <b>Warning ! </b>Old password does not match.
                </div>';            
            }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">
            <b>Warning ! </b>Your password and confirmation password do not match.
            </div>';
        }
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Change Password | Namaste</title>
    <link rel="icon" href="img/n.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
            * {
        font-family: 'Poppins', sans-serif;
      }
      h1,h2,h3,h4,h5,h6{
        font-weight: bold;
      }
        body{
            background:#eee;
        }
        .separator {
            border-right: 1px solid #dfdfe0; 
        }
        .icon-btn-save {
            padding-top: 0;
            padding-bottom: 0;
        }
        .input-group {
            margin-bottom:10px; 
        }

        .pass_show{
            position: relative;
        } 

        .pass_show .ptxt { 
            position: absolute; 
            top: 50%; 
            right: 10px; 
            z-index: 1; 
            color: #f36c01; 
            margin-top: -10px; 
            cursor: pointer; 
            transition: .3s ease all; 
        } 

        .pass_show .ptxt:hover{
            color: #333333;
        } 
    </style>
</head>
<body>
<div class="container pl-5 mt-5">
    <nav aria-label="breadcrumb" class="main-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
    </ol>
    </nav>
</div>

<div class="container bootstrap snippets bootdey pl-5 pr-5 pt-4 pb-5">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change password   
                    </h3>
                </div>
                <form method="post">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                           <img alt="user" class="img-thumbnail" src="<?php echo $folder;?>">                        
                        </div>
                        <div class="col-sm-6 mt-4">
                            <label>Current Password</label>
                            <div class="form-group pass_show"> 
                                <input type="password" name="expass" class="form-control" placeholder="Current Password"> 
                            </div> 
                            <label>New Password</label>
                            <div class="form-group pass_show"> 
                                <input type="password" name="pass" class="form-control" placeholder="New Password"> 
                            </div> 
                            <label>Confirm Password</label>
                            <div class="form-group pass_show"> 
                                <input type="password" name="cpass" class="form-control" placeholder="Confirm Password"> 
                            </div>  
                        </div>  
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-success" name="submit" value="Save">
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
    $('.pass_show').append('<span class="ptxt">Show</span>');  
});
$(document).on('click','.pass_show .ptxt', function(){ 
    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 
    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
});  
</script>