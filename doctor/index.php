<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .dashboard-box {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            transition: transform 0.3s ease-in-out;
        }
        .dashboard-box:hover {
            transform: scale(1.05);
        }
        .dashboard-box h5 {
            font-size: 22px;
            font-weight: bold;
        }
        .dashboard-icon {
            font-size: 3rem;
            color: white;
        }
    </style>
</head>
<body>
    <?php include("../include/header.php"); 
    include("../include/connection.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="container-fluid">
                    <h5 class="my-3">Doctor's Dashboard</h5>
                    <div class="row">
                        <!-- My Profile Box -->
                        <div class="col-md-3 bg-info text-light rounded dashboard-box mx-2 my-2">
                            <div>
                                <h5>My Profile</h5>
                            </div>
                            <div>
                                <a href="profile.php"><i class="fas fa-user-circle dashboard-icon"></i></a>
                            </div>
                        </div>

                        <!-- Total Patients Box -->
                        <div class="col-md-3 bg-success text-light rounded dashboard-box mx-2 my-2">
                        <?php

                            $p = mysqli_query($connect,"SELECT * FROM patient");

                            $pp = mysqli_num_rows($p);

                        ?>
                            <div>
                                <h5 class="text-center" style="font-size: 30px;"><?php echo $pp; ?></h5>
                                <h5 class="text-center">Total Patients</h5>
                            </div>
                            <div>
                                <a href="patient.php"><i class="fas fa-users dashboard-icon"></i></a>
                            </div>
                        </div>

                        <!-- Total Appointments Box -->
                        <div class="col-md-3 bg-warning text-light rounded dashboard-box mx-2 my-2">
                            <div>
                                <?php
                                $app = mysqli_query($connect,"SELECT * FROM appointment WHERE status='pending'");
                                $appoint = mysqli_num_rows($app);
                                ?>
                                <h5 class="text-center" style="font-size: 30px;"><?php echo $appoint; ?></h5>
                                <h5 class="text-center">Total Appointments</h5>
                            </div>
                            <div>
                                <a href="appointment.php"><i class="fas fa-calendar-alt dashboard-icon"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap and JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
