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
    <style>
        body {
            background-color: #f0f2f5;
        }
        .profile-img {
            border-radius: 10px;
            border: 5px solid #28a745;
        }
        .error-msg {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-light p-3">
                <?php
                    include("sidenav.php");
                    include("../include/connection.php");
                ?>
            </div>

            <!-- Main content -->
            <div class="col-md-10">
                <div class="container mt-4">
                    <div class="row">
                        <!-- Profile Picture and Information -->
                        <div class="col-md-6">
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

                            <!-- Profile Image Upload -->
                            <form action="" method="post" enctype="multipart/form-data" class="text-center">
                                <img src='img/<?php echo $row['profile']; ?>' class="profile-img img-fluid my-3" style='height: 350px; width: 80%;'>
                                <div class="mb-3">
                                    <input type="file" name="img" class="form-control">
                                </div>
                                <input type="submit" value="Upload New Photo" name="upload" class="btn btn-success  ">
                            </form>

                            <!-- Doctor Details Table -->
                            <div class="my-4">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-success text-center">
                                        <tr>
                                            <th colspan="2">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Firstname</td>
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
                                            <td>Phone No</td>
                                            <td><?php echo $row['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $row['gender']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><?php echo $row['country']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Salary</td>
                                            <td><?php echo "$" . $row['salary']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Change Username & Password -->
                        <div class="col-md-6">
                            <h5 class="text-center my-3">Change Username</h5>
                            <?php
                                $uname_error = "";  // Variable to store the error message

                                if (isset($_POST['change_uname'])) {
                                    $uname = $_POST['uname'];

                                    if (empty($uname)) {
                                        $uname_error = "Username cannot be empty.";  // Set the error message
                                    } else {
                                        $query = "UPDATE doctors SET username='$uname' WHERE username='$doc'";
                                        $res = mysqli_query($connect, $query);

                                        if ($res) {
                                            $_SESSION['doctor'] = $uname;
                                            echo "<div class='alert alert-success'>Username updated successfully.</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Failed to update username.</div>";
                                        }
                                    }
                                }
                            ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="uname" class="form-label">New Username</label>
                                    <input type="text" name="uname" class="form-control" placeholder="Enter New Username">
                                    <span class="error-msg"><?php echo $uname_error; ?></span>
                                </div>
                                <input type="submit" value="Submit" name="change_uname" class="btn btn-success">
                            </form>

                            <hr class="my-4">

                            <h5 class="text-center">Change Password</h5>

                            <?php
                                if (isset($_POST['change_pass'])) {
                                    $old = $_POST['old_pass'];
                                    $new = $_POST['new_pass'];
                                    $con = $_POST['con_pass'];

                                    $ol = "SELECT * FROM doctors WHERE username='$doc'";
                                    $ols = mysqli_query($connect, $ol);
                                    $row = mysqli_fetch_assoc($ols);

                                    if ($old != $row['password']) {
                                        echo "<div class='alert alert-danger'>Old password is incorrect.</div>";
                                    } elseif (empty($new)) {
                                        echo "<div class='alert alert-danger'>New password cannot be empty.</div>";
                                    } elseif ($con != $new) {
                                        echo "<div class='alert alert-danger'>Passwords do not match.</div>";
                                    } else {
                                        $query = "UPDATE doctors SET password='$new' WHERE username='$doc'";
                                        mysqli_query($connect, $query);
                                        echo "<div class='alert alert-success'>Password updated successfully.</div>";
                                    }
                                }
                            ?>

                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="old_pass" class="form-label">Old Password</label>
                                    <input type="password" name="old_pass" class="form-control" placeholder="Enter old password">
                                </div>
                                <div class="mb-3">
                                    <label for="new_pass" class="form-label">New Password</label>
                                    <input type="password" name="new_pass" class="form-control" placeholder="Enter new password">
                                </div>
                                <div class="mb-3">
                                    <label for="con_pass" class="form-label">Confirm Password</label>
                                    <input type="password" name="con_pass" class="form-control" placeholder="Confirm password">
                                </div>
                                <input type="submit" value="Change Password" name="change_pass" class="btn btn-info btn-block">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
