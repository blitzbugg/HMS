<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <?php
        include("../include/header.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <?php
                    include("sidenav.php");
                    include("../include/connection.php");
                ?>
            </div>
            <div class="col-md-10 px-4">
                <h4 class="my-4 text-dark">Patient Dashboard</h4>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="dashboard-card profile-card">
                            <a href="profile.php" class="card-link">
                                <div class="h-100 d-flex align-items-center px-4">
                                    <div class="d-flex justify-content-between align-items-center w-100 card-content">
                                        <h5 class="text-white mb-0">My Profile</h5>
                                        <i class="fa fa-user-circle fa-2x text-white card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card appointment-card">
                            <a href="appointment.php" class="card-link">
                                <div class="h-100 d-flex align-items-center px-4">
                                    <div class="d-flex justify-content-between align-items-center w-100 card-content">
                                        <h5 class="text-white mb-0">Book Appointment</h5>
                                        <i class="fa fa-calendar-days fa-2x text-white card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card invoice-card">
                            <a href="invoice.php" class="card-link">
                                <div class="h-100 d-flex align-items-center px-4">
                                    <div class="d-flex justify-content-between align-items-center w-100 card-content">
                                        <h5 class="text-white mb-0">My Invoice</h5>
                                        <i class="fa fa-file-invoice-dollar fa-2x text-white card-icon"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                    if (isset($_POST['send'])){
                        $title = $_POST['send'];
                        $message = $_POST['message'];

                        if (empty($title)) {
                            # code...
                        }else if(empty($message)){

                        }else{
                            $user = $_SESSION['patient'];
                            $query = "INSERT INTO report(title,message,username,date_send) VALUES('$title','$message','$user',NOW())";
                            $res = mysqli_query($connect,$query);

                            if ($res) {
                                echo "<script>alert('You have sent your Report')</script>";
                            }
                        }
                    }
                ?>

                <div class="row mt-5">
                    <div class="col-md-8 mx-auto">
                        <div class="enquiry-form">
                            <h5 class="text-center mb-4">Send an Enquiry</h5>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="4" placeholder="Enter your message or problem"></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="send" class="btn btn-submit text-white">Send Enquiry</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>