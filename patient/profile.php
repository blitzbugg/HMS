<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body class="bg-light">
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid py-4">
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
                    <!-- Profile Picture and Details Section -->
                    <div class="col-md-6">
                        <div class="profile-section">
                            <?php
                            $profileMessage = "";
                            $profileClass = "";

                            if (isset($_POST['upload'])) {
                                $img = $_FILES['img']['name'];

                                if (empty($img)) {
                                    $profileMessage = "No image selected!";
                                    $profileClass = "alert-danger";
                                } else {
                                    $query = "UPDATE patient SET profile='$img' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                                        $profileMessage = "Profile picture updated successfully";
                                        $profileClass = "alert-success";
                                    } else {
                                        $profileMessage = "Failed to update profile picture";
                                        $profileClass = "alert-danger";
                                    }
                                }
                            }
                            ?>

                            <h3 class="text-center mb-4"><i class="fas fa-user-circle me-2"></i>My Profile</h3>
                            
                            <?php if($profileMessage): ?>
                                <div class="alert alert-custom <?php echo $profileClass; ?>">
                                    <?php echo $profileMessage; ?>
                                </div>
                            <?php endif; ?>

                            <div class="profile-picture">
                                <?php
                                echo "<img src='img/" . $row['profile'] . "' class='img-fluid'>";
                                ?>
                                <form action="profile.php" method="post" enctype="multipart/form-data" class="upload-overlay">
                                    <div class="input-group">
                                        <input type="file" name="img" class="form-control">
                                        <button type="submit" name="upload" class="btn btn-primary btn-custom">
                                            <i class="fas fa-upload me-2"></i>Update
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <table class="table details-table">
                                <tr>
                                    <th colspan="2" class="text-center bg-primary text-white">Personal Information</th>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-user me-2"></i>First Name</td>
                                    <td><?php echo $row['firstname']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-user me-2"></i>Surname</td>
                                    <td><?php echo $row['surname']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-at me-2"></i>Username</td>
                                    <td><?php echo $row['username']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-envelope me-2"></i>Email</td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-phone me-2"></i>Phone Number</td>
                                    <td><?php echo $row['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-venus-mars me-2"></i>Gender</td>
                                    <td><?php echo $row['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-map-marker-alt me-2"></i>District</td>
                                    <td><?php echo $row['district']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Account Settings Section -->
                    <div class="col-md-6">
                        <!-- Username Change Form -->
                        <div class="form-section">
                            <?php
                            $unameMessage = "";
                            $unameClass = "";

                            if (isset($_POST['update_username'])) {
                                $uname = $_POST['uname'];

                                if (empty($uname)) {
                                    $unameMessage = "Username cannot be empty";
                                    $unameClass = "alert-danger";
                                } else {
                                    $query = "UPDATE patient SET username='$uname' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        $_SESSION['patient'] = $uname;
                                        $unameMessage = "Username updated successfully";
                                        $unameClass = "alert-success";
                                    } else {
                                        $unameMessage = "Failed to update username";
                                        $unameClass = "alert-danger";
                                    }
                                }
                            }
                            ?>

                            <h3 class="text-center mb-4"><i class="fas fa-user-edit me-2"></i>Change Username</h3>
                            
                            <?php if($unameMessage): ?>
                                <div class="alert alert-custom <?php echo $unameClass; ?>">
                                    <?php echo $unameMessage; ?>
                                </div>
                            <?php endif; ?>

                            <form action="profile.php" method="post">
                                <div class="form-group">
                                    <label><i class="fas fa-user me-2"></i>New Username</label>
                                    <input type="text" name="uname" class="form-control" placeholder="Enter new username">
                                </div>
                                <button type="submit" name="update_username" class="btn btn-primary btn-custom w-100 mt-3">
                                    <i class="fas fa-save me-2"></i>Update Username
                                </button>
                            </form>
                        </div>

                        <!-- Password Change Form -->
                        <div class="form-section">
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

                                if (empty($old)) {
                                    $passMessage = "Old password is required";
                                    $passClass = "alert-danger";
                                } elseif (empty($new)) {
                                    $passMessage = "New password is required";
                                    $passClass = "alert-danger";
                                } elseif ($conf != $new) {
                                    $passMessage = "Passwords do not match";
                                    $passClass = "alert-danger";
                                } elseif ($old != $row['password']) {
                                    $passMessage = "Incorrect old password";
                                    $passClass = "alert-danger";
                                } else {
                                    $query = "UPDATE patient SET password='$new' WHERE username='$patient'";
                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        $passMessage = "Password updated successfully";
                                        $passClass = "alert-success";
                                    } else {
                                        $passMessage = "Failed to update password";
                                        $passClass = "alert-danger";
                                    }
                                }
                            }
                            ?>

                            <h3 class="text-center mb-4"><i class="fas fa-lock me-2"></i>Change Password</h3>
                            
                            <?php if($passMessage): ?>
                                <div class="alert alert-custom <?php echo $passClass; ?>">
                                    <?php echo $passMessage; ?>
                                </div>
                            <?php endif; ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label><i class="fas fa-lock me-2"></i>Old Password</label>
                                    <input type="password" name="old_pass" class="form-control" placeholder="Enter old password">
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-key me-2"></i>New Password</label>
                                    <input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-check-circle me-2"></i>Confirm Password</label>
                                    <input type="password" name="con_pass" class="form-control" placeholder="Confirm new password">
                                </div>
                                <button type="submit" name="change_password" class="btn btn-primary btn-custom w-100 mt-3">
                                    <i class="fas fa-save me-2"></i>Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>