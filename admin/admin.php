<?php
session_start();

if(!isset($_SESSION['admin'])) {
    
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <?php
        include("../include/header.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php
                        include("sidenav.php");
                        include("../include/connection.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-center">All Administrators</h5>

                            <?php
                                $ad = $_SESSION['admin'];
                                $query = "SELECT * FROM admin WHERE username !='$ad'";
                                $res = mysqli_query($connect,$query);
                                $output = "
                                    <table class='table table-bordered'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th style='width: 20%;'>Action</th>
                                    </tr>";
                                

                                if(mysqli_num_rows($res) < 1){
                                    $output .= "<tr><td colspan='3' class='text-center'>No new admin</td></tr>";
                                }
                                
                                while($row = mysqli_fetch_array($res)){
                                    $id = $row['id'];
                                    $username = $row['username'];

                                    $output .="
                                         <tr>
                                    <td>$id</td>
                                    <td>$username</td>
                                    <td>
                                        <a href='admin.php?id=$id'><button id='$id' class='btn btn-danger'>Remove</button></a>
                                    </td>";
                                }

                                $output .="
                                  </tr>

                            </table>";

                            echo $output;

                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $dquery = "DELETE FROM admin WHERE id='$id'";
                                mysqli_query($connect,$dquery);
                            }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                if(isset($_POST['add'])){
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $image = $_FILES['img']['name'];

                                    $error = array();

                                    if(empty($username)){
                                        $error['u'] = "Username is required";
                                    }
                                    else if(empty($password)){
                                        $error['u'] = "Password is required";
                                    }
                                    else if(empty($image)){
                                        $error['u'] = "Image is required";
                                    }

                                    if(count($error) == 0){
                                        $sql = "INSERT INTO admin(username,password,profile) VALUES ('$username','$password','$image')";
                                        $result = mysqli_query($connect,$sql);

                                        if($result){
                                            move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
                                        }
                                    }
                                }

                                if(isset($error['u'])){
                                    $er = $error['u'];
                                    $show = "<h5 class='text-center alert alert-danger'>$er</h5>";
                                }   
                                else{
                                    $show = "";
                                }
                            ?>
                            <h5 class="text-center">Add New Administrator</h5>
                            <form action="" method="post" enctype='multipart/form-data'>
                                <div>
                                    <?php echo $show; ?>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="img" class="form-control">
                                </div><br>
                                <input type="submit" name="add" value="Add New Admin" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>