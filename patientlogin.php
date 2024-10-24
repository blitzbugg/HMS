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
        // Use prepared statements to avoid SQL injection
        $stmt = $connect->prepare("SELECT * FROM patient WHERE username=? AND password=?");
        $stmt->bind_param("ss", $uname, $pass);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows == 1) {
            $_SESSION['patient'] = $uname;
            header("Location: patient/index.php");
            exit(); // Always exit after a header redirect
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
    <title>Patient Login Page</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-repeat: no-repeat; background-size: cover;">
    <?php include("include/header.php"); ?>

    <div class="container-fluid mt-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 my-5 p-5 rounded-4 bg-light">
                    <h5 class="text-center">Patient Login</h5>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Username" required>
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-info my-3" value="Login">
                        <p>I don't have an account <a href="account.php">Click here.</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>
