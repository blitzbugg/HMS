<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Healthcare Plus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h4 class="dashboard-title">Admin Dashboard</h4>
                <div class="row">

                    <!-- Doctor Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card doctor-card text-white h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <?php
                                            $doctor = mysqli_query($connect,"SELECT * FROM doctors WHERE status='Approved'");
                                            $num2 = mysqli_num_rows($doctor);
                                        ?>
                                        <h5 class="stat-number"><?php echo $num2; ?></h5>
                                        <p class="stat-label">Total Doctors</p>
                                    </div>
                                    <div class="col-4 icon-container">
                                        <a href="doctor.php">
                                            <i class="fas fa-user-md"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card patient-card text-white h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <?php
                                            $p = mysqli_query($connect,"SELECT * FROM patient");
                                            $pp = mysqli_num_rows($p);
                                        ?>
                                        <h5 class="stat-number"><?php echo $pp; ?></h5>
                                        <p class="stat-label">Total Patients</p>
                                    </div>
                                    <div class="col-4 icon-container">
                                        <a href="patient.php">
                                            <i class="fas fa-bed"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card report-card text-white h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <?php
                                            $re = mysqli_query($connect,"SELECT * FROM report");
                                            $ree = mysqli_num_rows($re);
                                        ?>
                                        <h5 class="stat-number"><?php echo $ree; ?></h5>
                                        <p class="stat-label">Total Reports</p>
                                    </div>
                                    <div class="col-4 icon-container">
                                        <a href="report.php">
                                            <i class="fas fa-flag"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Request Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card request-card text-white h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <?php
                                            $job = mysqli_query($connect, "SELECT * FROM doctors WHERE status='pending'");
                                            $num1 = mysqli_num_rows($job);
                                        ?>
                                        <h5 class="stat-number"><?php echo $num1; ?></h5>
                                        <p class="stat-label">Signup Requests</p>
                                    </div>
                                    <div class="col-4 icon-container">
                                        <a href="job_request.php">
                                            <i class="fas fa-book-open"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Income Card -->
                    <div class="col-md-3 mb-4">
                        <div class="card income-card text-white h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <?php
                                            $in = mysqli_query($connect,"SELECT sum(amount_paid) as profit from income");
                                            $row = mysqli_fetch_array($in);
                                            $inc = $row['profit'];
                                        ?>
                                        <h5 class="stat-number"><?php echo $inc; ?>₹</h5>
                                        <p class="stat-label">Total Income</p>
                                    </div>
                                    <div class="col-4 icon-container">
                                        <a href="income.php">
                                            <i class="fas fa-rupee-sign"></i>
                                        </a>
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