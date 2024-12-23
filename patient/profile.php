<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
</head>

<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php
                    include("sidenav.php");

                    $patient = $_SESSION['patient'];
                    $query = "SELECT * FROM patient WHERE username='$patient'";
                    $res = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($res);
                    ?>
                </div>

                <div class="col-md-10">
                    <div class="row">
                        <!-- Profile Picture Section -->
                        <div class="col-md-6">
                            <?php
                            $profileMessage = "";
                            $profileClass = "";

                            if (isset($_POST['upload'])) {
                                $img = $_FILES['img']['name'];

                                if (empty($img)) {
                                    $profileMessage = "No image selected!";
                                    $profileClass = "bg-danger bg-gradient";
                                } else {
                                    $query = "UPDATE patient SET profile='$img' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                                        $profileMessage = "Profile picture updated successfully";
                                        $profileClass = "bg-success bg-gradient";
                                    } else {
                                        $profileMessage = "Failed to update profile picture";
                                        $profileClass = "bg-danger bg-gradient";
                                    }
                                }
                            }
                            ?>

                            <h5>My Profile</h5>
                            <h6 class="<?php echo $profileClass; ?>"><?php echo $profileMessage; ?></h6>
                            <form action="profile.php" method="post" enctype="multipart/form-data">
                                <?php
                                echo "<img src='img/" . $row['profile'] . "' class='col-md-12 h-50 w-50'>";
                                ?>
                                <input type="file" name="img" class="form-control my-2">
                                <input type="submit" name="upload" class="btn btn-primary my-2" value="Update Profile">
                            </form>

                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">My Details</th>
                                </tr>
                                <tr>
                                    <td>First name</td>
                                    <td><?php echo $row['firstname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Surname</td>
                                    <td><?php echo $row['surname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $row['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td><?php echo $row['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $row['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td><?php echo $row['district']; ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Change Username Section -->
                        <div class="col-md-6">
                            <?php
                            $unameMessage = "";
                            $unameClass = "";

                            if (isset($_POST['update_username'])) {
                                $uname = $_POST['uname'];

                                if (empty($uname)) {
                                    $unameMessage = "Username cannot be empty";
                                    $unameClass = "bg-danger bg-gradient";
                                } else {
                                    $query = "UPDATE patient SET username='$uname' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        $_SESSION['patient'] = $uname;
                                        $unameMessage = "Username updated successfully";
                                        $unameClass = "bg-success bg-gradient";
                                    } else {
                                        $unameMessage = "Failed to update username. Please try again.";
                                        $unameClass = "bg-danger bg-gradient";
                                    }
                                }
                            }
                            ?>

                            <h5 class="text-center">Change Username</h5>
                            <h3 class="<?php echo $unameClass; ?> text-white"><?php echo $unameMessage; ?></h3>
                            <form action="profile.php" method="post">
                                <label for="">Enter New Username</label>
                                <input type="text" name="uname" class="form-control" placeholder="Enter new username">
                                <input type="submit" name="update_username" value="Update Username" class="btn btn-primary my-2">
                            </form>

                            <!-- Change Password Section -->
                            <?php
                            $passMessage = "";
                            $passClass = "";

                            if (isset($_POST['change_password'])) {
                                $old = $_POST['old_pass'];
                                $new = $_POST['new_pass'];
                                $conf = $_POST['con_pass'];

                                $q = "SELECT * FROM patient WHERE username='$patient'";
                                $re = mysqli_query($connect, $q);
                                $row = mysqli_fetch_array($re);

                                $errors = [];

                                if (empty($old)) {
                                    $errors['pass'] = "Old password is required";
                                } elseif (empty($new)) {
                                    $errors['pass'] = "Please enter a new password";
                                } elseif ($conf != $new) {
                                    $errors['pass'] = "Passwords do not match";
                                } elseif ($old != $row['password']) {
                                    $errors['pass'] = "Old password is incorrect";
                                }

                                if (!empty($errors)) {
                                    $passMessage = $errors['pass'];
                                    $passClass = "bg-danger bg-gradient";
                                } else {
                                    $query = "UPDATE patient SET password='$new' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        $passMessage = "Password updated successfully";
                                        $passClass = "bg-success bg-gradient";
                                    } else {
                                        $passMessage = "Failed to update password. Please try again.";
                                        $passClass = "bg-danger bg-gradient";
                                    }
                                }
                            }
                            ?>

                            <h5 class="my-4 text-center">Change Password</h5>
                            <h3 class="<?php echo $passClass; ?> text-white"><?php echo $passMessage; ?></h3>
                            <form action="" method="post">
                                <label for="">Old Password</label>
                                <input type="password" name="old_pass" class="form-control" placeholder="Enter old password">
                                <label for="">New Password</label>
                                <input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
                                <label for="">Confirm Password</label>
                                <input type="password" name="con_pass" class="form-control" placeholder="Confirm password">
                                <input type="submit" name="change_password" value="Change Password" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
