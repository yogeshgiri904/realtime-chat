<?php 
    include "conn.php";
    include "auth.php";
    $room = $_SESSION['room'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, minimal-ui, initial-scale=1, minimum-scale=1, user-scalable = no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/data.css" rel="stylesheet" type="text/css" />
        <title><?php echo $room." - NAMASTE"; ?></title>
        <style>
        html {
            scroll-behavior: smooth;
          }
        </style>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() { 
                $("#button").click(function() { 
                    $(document).scrollTop($(document).height()); 
                }); 
                setInterval(() => {
                    $("#autodata").load("hat.php");
                }, 100);
                $('#formbox').on("submit",function(){
                    $.ajax({
                        type: "POST",
                        url: "insert.php",
                        data: $(this).serialize(),
                        success: function(){
                            $('#formbox').trigger('reset');
                        },
                        error:function(){
                            alert("ERROR! Message not sent");
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <div class="top-bar"></div>
        <div class="header-tools">
            <img src="img/n.jpg" alt="Namaste" id="logo"/>
            <div class="heading">
                <p class="headname"><?php echo "NAMASTE - ".$room; ?></p>
                <p><i class="fa fa-circle" aria-hidden="true"></i> Online</p>
            </div>
        </div>
        <div class="convo__wrapper">
            <ul class="bubble__wrapper" id="autodata">
            </ul>
        </div>
        <div class="cui__response">
            <form id="formbox" autocomplete="off"> 
                <input type="text" required name="chat" class="cui_option_input" placeholder="Enter to send">
                <input type="submit" value="Send" id="button" name="submit" class="cui_option_btn_submit">
            </form>
        </div>
        <div class="background">&nbsp;</div>
    </body>
</html>

