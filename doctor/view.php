<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Details</title>
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
                    <?php include("sidenav.php"); 
                    ?>
                </div>
                <div class="col-md-10">
                    <h2 class="text-center my-3">View Patient Details</h2>

                    <?php
                    if (isset($_GET['id'])) {

                        $id = $_GET['id'];

                        $query = "SELECT * FROM patient WHERE id = '$id'";
                        $res = mysqli_query($connect, $query);

                        $row = mysqli_fetch_array($res);
                    }

                    ?>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">

                            <?php
                                echo "<img src='../patient/img/".$row['profile']."' class='col-md-12 my-3 h-50' alt='Patient Image'>";

                            ?>
                            
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th class="text-center" colspan="2">Details</th>
                                    </tr>
                                    <tr>
                                        <td>First Name</td>
                                        <td><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sur Name</td>
                                        <td><?php echo $row['surname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>User Name</td>
                                        <td><?php echo $row['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $row['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>District</td>
                                        <td><?php echo $row['district']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date Registered</td>
                                        <td><?php echo $row['date_reg']; ?></td>
                                    </tr>

                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>