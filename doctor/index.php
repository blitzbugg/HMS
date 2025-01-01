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
    <link rel="stylesheet" href="./css/index.css">
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
                <div class="dashboard-header my-4">
                    <h4>Welcome to the Doctor's Dashboard</h4>
                    <p>Manage your profile, patients, and appointments effectively.</p>
                </div>

                <div class="row">
                    <!-- My Profile Box -->
                    <div class="col-md-4 my-2">
                        <div class="dashboard-box bg-info">
                            <h5>My Profile</h5>
                            <a href="profile.php">
                                <i class="fas fa-user-circle dashboard-icon"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Patients Box -->
                    <div class="col-md-4 my-2">
                        <?php
                            $p = mysqli_query($connect, "SELECT * FROM patient");
                            $pp = mysqli_num_rows($p);
                        ?>
                        <div class="dashboard-box bg-success">
                            <h5><?php echo $pp; ?></h5>
                            <p>Total Patients</p>
                            <a href="patient.php">
                                <i class="fas fa-users dashboard-icon"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Appointments Box -->
                    <div class="col-md-4 my-2">
                        <?php
                            $app = mysqli_query($connect, "SELECT * FROM appointment WHERE status='pending'");
                            $appoint = mysqli_num_rows($app);
                        ?>
                        <div class="dashboard-box bg-warning">
                            <h5><?php echo $appoint; ?></h5>
                            <p>Total Appointments</p>
                            <a href="appointment.php">
                                <i class="fas fa-calendar-alt dashboard-icon"></i>
                            </a>
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
