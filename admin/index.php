<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <h4 class="my-2">Admin Dashboard</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-success text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- Php admin query -->
                                        <?php
                                            $ad = mysqli_query($connect,"SELECT * FROM admin");
                                            $num = mysqli_num_rows($ad);
                                        ?>
                                        <h5 class="my-2 fs-1"><?php echo $num; ?></h5>
                                        <h5>Total</h5>
                                        <h5>Admin</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="admin.php"><i class="fa-solid fa-hospital-user fa-2xl p-4" style="color: #ffffff;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php
                                        $doctor = mysqli_query($connect,"SELECT * FROM doctors WHERE status='Approved'");
                                        $num2 = mysqli_num_rows($doctor);
                                        ?>
                                        <h5 class="my-2 fs-1"><?php echo $num2; ?></h5>
                                        <h5>Total</h5>
                                        <h5>Doctor</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="doctor.php"><i class="fa-solid fa-user-doctor fa-2xl p-4" style="color: #ffffff;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">

                                    <?php

                                    $p = mysqli_query($connect,"SELECT * FROM patient");

                                    $pp = mysqli_num_rows($p);

                                    ?>
                                        <h5 class="my-2 fs-1"><?php echo $pp ?></h5>
                                        <h5>Total</h5>
                                        <h5>Patient</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="patient.php"><i class="fa-solid fa-bed fa-2xl p-4" style="color: #ffffff;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="my-2 fs-1">0</h5>
                                        <h5>Total</h5>
                                        <h5>Report</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href=""><i class="fa-solid fa-flag fa-2xl p-4" style="color: #ffffff;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                    <?php

                                        $job = mysqli_query($connect, "SELECT * FROM doctors WHERE status='pending'");
                                        $num1 = mysqli_num_rows ($job);

                                    ?>
                                        <h5 class="my-2 fs-1"><?php echo $num1; ?></h5>
                                        <h5>Total</h5>
                                        <h5>Signup Request</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href="job_request.php"><i class="fa-solid fa-book-open-reader fa-2xl p-4" style="color: #ffffff;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white m-1 mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="my-2 fs-1">0</h5>
                                        <h5>Total</h5>
                                        <h5>Income</h5>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a href=""><i class="fa-solid fa-indian-rupee-sign fa-2xl p-4" style="color: #ffffff;"></i></a>
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