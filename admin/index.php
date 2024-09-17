<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h4 class="my-2">Admin Dashboard</h4>
                    <div class="col-md-12 my-1">
                        <div class="row">
                            <div class="col-md-3 bg-success mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <!-- Php admin query -->
                                            <?php
                                                $ad = mysqli_query($connect,"SELECT * FROM admin");
                                                $num = mysqli_num_rows($ad);
                                            ?>
                                            <h5 class="my-2 text-white fs-1"><?php echo $num; ?></h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Admin</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-user-gear fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-info mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="my-2 text-white fs-1">0</h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Doctor</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-user-doctor fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-warning mx-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="my-2 text-white fs-1">0</h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Patient</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-bed fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="my-2 text-white fs-1">0</h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Report</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-flag fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-warning mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="my-2 text-white fs-1">0</h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Job Request</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-book-open-reader fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-success mx-2 my-2" style="height: 130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="my-2 text-white fs-1">0</h5>
                                            <h5 class="text-white">Total</h5>
                                            <h5 class="text-white">Income</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <a href=""><i class="fa-solid fa-indian-rupee-sign fa-2xl p-5" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>