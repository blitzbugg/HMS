<?php
session_start();
include("../include/header.php");
include("../include/connection.php");

// Ensure the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); // Redirect if session is not active
    exit();
}

$ad = $_SESSION['admin'];

// Fetch admin details using a prepared statement for security
$stmt = $connect->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $ad);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

$username = $row['username'];
$profile = $row['profile'];
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <h4><?php echo $username; ?>'s Profile</h4>

                        <!-- Update Profile Image -->
                        <?php
                        if (isset($_POST['update_profile'])) {
                            $profile = $_FILES['profile']['name'];
                            $tmp_name = $_FILES['profile']['tmp_name'];

                            if (empty($profile)) {
                                echo "<div class='alert alert-danger'>Please select a profile image.</div>";
                            } else {
                                // Use prepared statement to update profile image
                                $stmt = $connect->prepare("UPDATE admin SET profile=? WHERE username=?");
                                $stmt->bind_param("ss", $profile, $ad);
                                $result = $stmt->execute();

                                if ($result) {
                                    move_uploaded_file($tmp_name, "img/$profile");
                                    echo "<div class='alert alert-success'>Profile updated successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Failed to update profile.</div>";
                                }
                                $stmt->close();
                            }
                        }
                        ?>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <img src="<?php echo 'img/' . $profile ?>" class="col-md-6 img-thumbnail" alt="Profile Image">
                            <br><br>
                            <div class="form-group">
                                <label for="profile" class="form-label">Update Profile</label>
                                <input type="file" name="profile" class="form-control">
                            </div>
                            <br>
                            <input type="submit" name="update_profile" value="Update Profile" class="btn btn-success">
                        </form>
                    </div>

                    <div class="col-md-6 border border-success rounded-4 my-4">
                        <!-- Change Username -->
                        <?php
                        if (isset($_POST['change_username'])) {
                            $uname = trim($_POST['uname']);

                            if (empty($uname)) {
                                echo "<div class='alert alert-danger'>Please enter a valid username.</div>";
                            } else {
                                // Update username using a prepared statement
                                $stmt = $connect->prepare("UPDATE admin SET username=? WHERE username=?");
                                $stmt->bind_param("ss", $uname, $ad);
                                if ($stmt->execute()) {
                                    $_SESSION['admin'] = $uname;
                                    $username = $uname;
                                    echo "<div class='alert alert-success'>Username updated successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Failed to update username.</div>";
                                }
                                $stmt->close();
                            }
                        }
                        ?>
                        <form action="" method="post" class="mt-4">
                            <label class="form-label">Change Username</label>
                            <input type="text" name="uname" class="form-control" value="<?php echo $username; ?>" autocomplete="off"><br>
                            <input type="submit" name="change_username" value="Change Username" class="btn btn-success">
                        </form>

                        <!-- Change Password -->
                        <?php
                        if (isset($_POST['update_password'])) {
                            $old_pass = $_POST['old_pass'];
                            $new_pass = $_POST['new_pass'];
                            $con_pass = $_POST['con_pass'];
                            $errors = [];

                            // Check if all fields are filled
                            if (empty($old_pass)) {
                                $errors[] = "Please enter the old password.";
                            }
                            if (empty($new_pass)) {
                                $errors[] = "Please enter the new password.";
                            }
                            if (empty($con_pass)) {
                                $errors[] = "Please confirm the new password.";
                            }

                            // Fetch the current password from the database
                            $stmt = $connect->prepare("SELECT password FROM admin WHERE username=?");
                            $stmt->bind_param("s", $ad);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $row = $res->fetch_assoc();
                            $stored_pass = $row['password'];
                            $stmt->close();

                            // Validate old password and confirm new password
                            if (!empty($old_pass) && $old_pass !== $stored_pass) {
                                $errors[] = "The old password is incorrect.";
                            }
                            if (!empty($new_pass) && $new_pass !== $con_pass) {
                                $errors[] = "New passwords do not match.";
                            }

                            // Display errors or update password
                            if (count($errors) > 0) {
                                foreach ($errors as $error) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            } else {
                                // Use prepared statement to update password
                                $stmt = $connect->prepare("UPDATE admin SET password=? WHERE username=?");
                                $stmt->bind_param("ss", $new_pass, $ad);
                                if ($stmt->execute()) {
                                    echo "<div class='alert alert-success'>Password updated successfully!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Failed to update password.</div>";
                                }
                                $stmt->close();
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <h5 class="text-center my-4">Change Password</h5>
                            <div class="form-group">
                                <label for="old_pass">Old Password</label>
                                <input type="password" name="old_pass" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="new_pass">New Password</label>
                                <input type="password" name="new_pass" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="con_pass">Confirm Password</label>
                                <input type="password" name="con_pass" class="form-control" autocomplete="off">
                            </div>
                            <input type="submit" name="update_password" value="Update Password" class="btn btn-success my-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
