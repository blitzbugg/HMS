<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login Page</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-size: cover;
    background-repeat: no-repeat;">
    <?php
    include("include/header.php");
      ?>
      <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 p-5 bg-dark-subtle mt-5 rounded-4">
                    <h5 class="text-center my-2">Doctors Login</h5>
                    <form method="post">
                        <div class="form-group">
                        <label>Username</label>
                            <input type="text" name="uname" class="form-control"
                            autocomplete="off" placeholder="Enter Username">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control"
                            autocomplete="off">
                        </div>
                        <input type="submit" name="login" class="btn btn-success" value="Login">

                        <p>I don't have any account <a href="apply.php">Apply now</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>