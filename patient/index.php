<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
</head>
<body>
    <?php
        include("../include/header.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php
                        include("sidenav.php");
                        include("../include/connection.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="my-3">Patient Dashboard</h5>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-3 bg-info mx-2" style="height: 150px;">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="text-white my-4">My Profile</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#"><i class="fa fa-user-circle fa-3x my-4 text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <div class="col-md-3 bg-warning mx-2" style="height: 150px;">
                                <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="text-white my-4">Book Appointment</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#"><i class="fa fa-calendar-days fa-3x my-4 text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="col-md-3 bg-success mx-2" style="height: 150px;">
                                <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h5 class="text-white my-4">My Invoice</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="#"><i class="fa fa-file-invoice-dollar fa-3x my-4 text-white"></i></a>
                                                </div>
                                            </div>
                                        </div>
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

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 my-5 p-5 rounded-4 bg-info">   
                                    <h5 class="text-center my-2 text-white">Enquiry</h5>
                                    <form action="" method="post">
                                        <label for="">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title">

                                        <label for="">Message</label>
                                        <input type="text" name="message" class="form-control" placeholder="Enter your message"></>

                                        <input type="submit" value="Send" class="btn btn-success my-2">
                                    </form>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>