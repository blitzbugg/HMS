<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
                            <h5 class="text-center">All admin</h5>

                            <?php
                                $ad = $_SESSION['admin'];
                                $query = "SELECT * FROM admin WHERE username !='$ad'";
                                $res = mysqli_query($connect,$query);
                                $output = "
                                    <table class='table table-bordered'>
                                    <tr>
                                <th>Id</th>
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
                                        <button id='$id' class='btn btn-danger'>Remove</button>
                                    </td>";
                                }

                                $output .="
                                  </tr>

                            </table>";

                            echo $output;
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
                                        $error[''] = "Username is required";
                                    }
                                    else if(empty($password)){
                                        $error[''] = "Password is required";
                                    }
                                    else if(empty($image)){
                                            $error[''] = "Image is required";
                                    }

                                    if(count($error) == 0){
                                        $sql = "INSERT INTO admin(username,password,profile) VALUES ('$username','$password','$image')";
                                    }
                                }

                        ?>
                            <h5 class="text-center">Add admin</h5>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="" >Add Image Picture</label>
                                    <input type="file" name="img" id="" class="form-control">
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