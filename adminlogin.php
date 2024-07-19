<?php

include("include/connection.php");

if(isset($_POST['login'])){
    $username = $_POST['uname'];
    $password = $_POST['password'];

    $alert = "";
    
    $error = array();

    if (empty($username)) {
        $error['username'] = 'Enter username';
        $alert = "alert alert-danger";
    }
    elseif(empty($password)){
        $error['password'] = 'Enter password';
        $alert = "alert alert-danger";
    }

    if (count($error)==0) {
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($connect,$query);

        if (mysqli_num_rows($result) == 1) {
            echo "<script>alert('You have loggined as admin')</script>";

            $_SESSION['admin'] == $username;

            header("Location:admin/index.php");
            exit();
        }
        else{
            echo "<script>alert('Invalid username or password')</script>";
        }
    }
}

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
                    <form action="" method="post" name="adm-login" class="my-2">
                        
                        <div class="<?=$alert?>">
                            <?php
                           if(isset($error['username'])){
                            echo $error['username'];
                        }
                        elseif(isset($error['password'])){
                            echo $error['password'];
                        }
                           ?>
                        </div>
                        <div class="form-group my-4">
                            <label for="">Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="on" placeholder="Enter your name">
                        </div>
                        <div class="form-group my-4">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control" autocomplete="on" placeholder="Enter your password">
                         </div>

                         <input type="submit" name="login" class="btn btn-success mx-auto d-block" value="Login">
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>