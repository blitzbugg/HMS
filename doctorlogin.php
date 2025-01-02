<?php
session_start();
include("include/connection.php");

$show = "";

if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = $_POST['pass'];
    $error = array();

    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        $q = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $qq = mysqli_query($connect, $q);

        if (mysqli_num_rows($qq) > 0) {
            $row = mysqli_fetch_array($qq);
            if ($row['status'] == "pending") {
                $error['status'] = "Please wait for the admin to confirm";
            } else if ($row['status'] == "Rejected") {
                $error['login'] = "Try again later";
            } else {
                $_SESSION['doctor'] = $uname;
                echo "<script>alert('done')</script>";
                header("Location: doctor/index.php");
            }
        } else {
            $error['login'] = "Invalid Account";
        }
    }

    if (isset($error['login'])) {
        $l = $error['login'];
        $show = "<h5 class='text-center alert alert-danger'>$l</h5>";
    } else {
        $show = "";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login - Healthcare Plus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/doctorlogin.css">
</head>
<body>
    <?php include("include/header.php"); ?>
    
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="login-card">
                    <h2 class="login-title">Doctor Login</h2>
                    <?php echo $show; ?>
                    
                    <form method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" 
                                   placeholder="Enter your username">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off"
                                   placeholder="Enter your password">
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