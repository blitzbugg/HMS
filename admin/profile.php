<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    $ad = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE username='$ad'";

    $res = mysqli_query($connect, $query);
    
    while ($row = mysqli_fetch_array($res)) {
        $username = $row['username'];
        $profile = $row['profile'];
    }
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo $username . "'s" ?> profile</h4>

                                <?php
                                    if (isset($_POST['update'])) {
                                        $profile = $_FILES['profile']['name'];
                                        if (empty($profile)) {
                                            echo "Please select a file.";
                                        } else {
                                            $query = "UPDATE admin SET profile='$profile' WHERE username='$ad'";

                                            $result = mysqli_query($connect, $query);

                                            if ($result) {
                                                move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
                                                echo "Profile updated successfully!";
                                            } else {
                                                echo "Failed to update profile.";
                                            }
                                        }
                                    }
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <img src="<?php echo 'img/' . $profile ?>" class="col-md-6" alt="">

                                    <br><br>
                                    <div class="form-group">
                                        <label for="">UPDATE PROFILE</label>
                                        <input type="file" name="profile" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update" value="Update" class="btn btn-success">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <?php
                                if (isset($_POST['change'])) {
                                    $uname = $_POST['uname'];

                                    if (empty($uname)) {
                                        
                                    }else{
                                        $query = "UPDATE admin SET username='$uname' WHERE username='$ad'";

                                        $res = mysqli_query($connect,$query);

                                        if($res){
                                            $_SESSION['admin'] = $uname;
                                        }
                                    }
                                }

                                ?>
                                <form action="" method="post">
                                    <label for="">Change Username</label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off">
                                    <input type="submit" name="change" class="btn btn-success">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
