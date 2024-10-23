<?php
session_start();
include("include/connection.php");

$show = "";

if (isset($_POST['login'])) {

    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array(); 

    // Check if username and password are empty
    if (empty($uname)) {
        $error['login'] = "Enter Username";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
    } else {
        // Prepare query to check if the username and password match
        $q = "SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $qq = mysqli_query($connect, $q);

        // Check if any row is returned
        if (mysqli_num_rows($qq) > 0) {
            $row = mysqli_fetch_array($qq);

            // Check the status of the user
            if ($row['status'] == "pending") {
                $error['status'] = "Please wait for the admin to confirm";
            } else if ($row['status'] == "Rejected") {
                $error['login'] = "Try again later";
            } else {
                // Successful login
                $_SESSION['doctor'] = $uname;
                echo "<script>alert('done')</script>";
                // Redirect to doctor's dashboard or any other page
                header("Location: doctor/index.php");
            }
        } else {
            $error['login'] = "Invalid Account";
        }
    }

    // Display error message
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
    <title>Doctor Login Page</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-size: cover; background-repeat: no-repeat;">
    <?php include("include/header.php"); ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 p-5 bg-dark-subtle mt-5 rounded-4">
                    <h5 class="text-center my-2">Doctors Login</h5>
                    <div>
                        <?php echo $show; ?>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" autocomplete="off">
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
</html>
