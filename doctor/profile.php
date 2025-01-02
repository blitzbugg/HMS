<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Profile</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-light p-3">
                <?php
                    include("sidenav.php");
                    include("../include/connection.php");
                ?>
            </div>

            <div class="col-md-10 main-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-card">
                                <?php
                                    $doc = $_SESSION['doctor'];
                                    $query = "SELECT * FROM doctors WHERE username='$doc'";
                                    $res = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_array($res);

                                    if (isset($_POST['upload'])) {
                                        $img = $_FILES['img']['name'];
                                        if (!empty($img)) {
                                            $query = "UPDATE doctors SET profile='$img' WHERE username='$doc'";
                                            $res = mysqli_query($connect, $query);
                                            if ($res) {
                                                move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                                            }
                                        }
                                    }
                                ?>

                                <form action="" method="post" enctype="multipart/form-data" class="text-center">
                                    <img src='img/<?php echo $row['profile']; ?>' class="profile-img img-fluid mb-4" style='height: 350px; width: 80%; object-fit: cover;'>
                                    <div class="mb-3">
                                        <input type="file" name="img" class="form-control">
                                    </div>
                                    <button type="submit" name="upload" class="btn btn-success">
                                        <i class="fas fa-upload me-2"></i>Upload New Photo
                                    </button>
                                </form>

                                <div class="mt-4">
                                    <h4 class="section-title">Profile Details</h4>
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td><i class="fas fa-user detail-icon"></i>Firstname</td>
                                                <td><?php echo $row['firstname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-user detail-icon"></i>Surname</td>
                                                <td><?php echo $row['surname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-user-circle detail-icon"></i>Username</td>
                                                <td><?php echo $row['username']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-envelope detail-icon"></i>Email</td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-phone detail-icon"></i>Phone No</td>
                                                <td><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-venus-mars detail-icon"></i>Gender</td>
                                                <td><?php echo $row['gender']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-globe detail-icon"></i>department</td>
                                                <td><?php echo $row['department']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-dollar-sign detail-icon"></i>Salary</td>
                                                <td><?php echo "$" . $row['salary']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-card">
                                <h4 class="section-title">Update Profile</h4>
                                
                                <?php
                                    $uname_error = "";
                                    if (isset($_POST['change_uname'])) {
                                        $uname = $_POST['uname'];
                                        if (empty($uname)) {
                                            $uname_error = "Username cannot be empty.";
                                        } else {
                                            $query = "UPDATE doctors SET username='$uname' WHERE username='$doc'";
                                            $res = mysqli_query($connect, $query);
                                            if ($res) {
                                                $_SESSION['doctor'] = $uname;
                                                echo "<div class='alert alert-success'><i class='fas fa-check-circle me-2'></i>Username updated successfully.</div>";
                                            } else {
                                                echo "<div class='alert alert-danger'><i class='fas fa-times-circle me-2'></i>Failed to update username.</div>";
                                            }
                                        }
                                    }
                                ?>

                                <form action="" method="post" class="mb-5">
                                    <div class="mb-3">
                                        <label class="form-label">New Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="uname" class="form-control" placeholder="Enter New Username">
                                        </div>
                                        <?php if ($uname_error): ?>
                                            <span class="error-msg"><i class="fas fa-exclamation-circle me-1"></i><?php echo $uname_error; ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <button type="submit" name="change_uname" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i>Update Username
                                    </button>
                                </form>

                                <h4 class="section-title">Change Password</h4>

                                <?php
                                    if (isset($_POST['change_pass'])) {
                                        $old = $_POST['old_pass'];
                                        $new = $_POST['new_pass'];
                                        $con = $_POST['con_pass'];

                                        $ol = "SELECT * FROM doctors WHERE username='$doc'";
                                        $ols = mysqli_query($connect, $ol);
                                        $row = mysqli_fetch_assoc($ols);

                                        if ($old != $row['password']) {
                                            echo "<div class='alert alert-danger'><i class='fas fa-times-circle me-2'></i>Old password is incorrect.</div>";
                                        } elseif (empty($new)) {
                                            echo "<div class='alert alert-danger'><i class='fas fa-times-circle me-2'></i>New password cannot be empty.</div>";
                                        } elseif ($con != $new) {
                                            echo "<div class='alert alert-danger'><i class='fas fa-times-circle me-2'></i>Passwords do not match.</div>";
                                        } else {
                                            $query = "UPDATE doctors SET password='$new' WHERE username='$doc'";
                                            mysqli_query($connect, $query);
                                            echo "<div class='alert alert-success'><i class='fas fa-check-circle me-2'></i>Password updated successfully.</div>";
                                        }
                                    }
                                ?>

                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Old Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="old_pass" class="form-control" placeholder="Enter old password">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                            <input type="password" name="con_pass" class="form-control" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <button type="submit" name="change_pass" class="btn btn-info w-100">
                                        <i class="fas fa-lock me-2"></i>Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>