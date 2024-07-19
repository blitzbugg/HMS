<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-repeat: no-repeat; background-size: cover;">
    <?php
        include("include/header.php")
    ?>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                    <div class="col-md-6 p-4 bg-dark-subtle mt-5 rounded-4">
                    <img src="img/admin-login.jpg" alt="" class="col-md-5 rounded mx-auto d-block">
                    <form action="" method="post" class="my-2">
                        <div class="form-group my-4">
                            <label for="">Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter your name">
                        </div>
                        <div class="form-group my-4">
                            <label for="">Password</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter your password">
                         </div>

                         <input type="submit" name="login" class="btn btn-success mx-auto d-block" value="Submit">
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>