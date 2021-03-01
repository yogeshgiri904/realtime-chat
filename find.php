<?php 
    include "conn.php";
    include "auth.php";
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
    <title>Find Friends</title>
    <style>
        .container
            {
                position: absolute;
                left: 50%;
                transform: translate(-50%,0%);
                width: 100vw;
                height: 100vh;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                flex-direction: row;
                flex-wrap: wrap;

            }
        .card
            {
                margin: 5px;
            }
    </style>
</head>
<body>
    <h4 class="text-center my-4 mt-3">Find Your Friends Here</h4>
    <div class='container'>
        <?php
            $findSql = "SELECT * FROM `login`;";
            $result = mysqli_query($conn, $findSql);
            if(mysqli_num_rows($result)>0)
            {
                while($data = mysqli_fetch_assoc($result))
                {
                    $username = $data['username'];
                    $email = $data['email'];
                    $mobile = $data['mobile'];
                    echo "    <div class='card' style='width: 18rem;'>
                    <img src='asset/user.png' class='card-img-top' alt='user-image'>
                    <div class='card-body'>
                        <h5 class='card-title'>$username <i class='fa fa-check-circle text-success' aria-hidden='true'></i></h5>
                        <p class='card-text'><i class='fa fa-phone' aria-hidden='true'></i> $mobile</p>
                        <p class='card-text'><i class='fa fa-envelope' aria-hidden='true'></i> $email</p>
                        <a href='create.php?id=$username' class='btn btn-primary'>Message</a>
                    </div>
                </div>";
                }
            }
        ?>
    </div>

</body>
</html>
