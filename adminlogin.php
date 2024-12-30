<?php
session_start();
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
            $_SESSION['admin'] = $username;
            header("Location: admin/index.php");
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
    <title>Admin Login - Healthcare Plus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/adminlogin.css">
</head>
<body>
    <?php include("include/header.php") ?>

    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="login-container">
                    <img src="img/admin-login.jpg" alt="Admin Login" class="img-fluid mx-auto d-block">
                    <form action="" method="post" name="adm-login">
                        <?php if(isset($alert) && !empty($alert)): ?>
                            <div class="<?=$alert?>">
                                <?php
                                if(isset($error['username'])) echo $error['username'];
                                elseif(isset($error['password'])) echo $error['password'];
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="uname" class="form-control" 
                                   autocomplete="on" placeholder="Enter your username">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" 
                                   autocomplete="on" placeholder="Enter your password">
                        </div>

                        <button type="submit" name="login" class="btn btn-login">
                            Login to Dashboard
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>