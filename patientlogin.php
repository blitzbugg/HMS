<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    if (empty($uname)) {
        echo "<script>alert('Enter username');</script>";
    } else if (empty($pass)) {
        echo "<script>alert('Enter password');</script>";
    } else {
        $stmt = $connect->prepare("SELECT * FROM patient WHERE username=? AND password=?");
        $stmt->bind_param("ss", $uname, $pass);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 1) {
            $_SESSION['patient'] = $uname;
            header("Location: patient/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Account');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login - Healthcare Plus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/patientlogin.css">
</head>
<body>
    <?php include("include/header.php"); ?>

    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="login-container">
                    <h2 class="login-title text-center">Patient Login</h2>
                    
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" 
                                   placeholder="Enter your username" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" 
                                   placeholder="Enter your password" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-login">
                            Login to Dashboard
                        </button>

                        <div class="signup-link">
                            <p>Don't have an account? <a href="account.php">Sign up here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>