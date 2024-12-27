<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check patient appointment</title>
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
                <?php
                include("sidenav.php");
                ?>
                </div>
                
                <div class="col-md-10">
                    <h2 class="text-center my-2">Total Appointment</h2>

                    <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $query = "SELECT * FROM appointment WHERE id='$id'";

                            $res = mysqli_query($connect,$query);

                            $row = mysqli_fetch_array($res);
                        }

                    ?>


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Appointment Details</th>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <th><?php echo $row['firstname'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Sur Name</th>
                                            <th><?php echo $row['surname'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <th><?php echo $row['gender'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Phone No</th>
                                            <th><?php echo $row['phone'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Appointment</th>
                                            <th><?php echo $row['appointment_date'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>Symptoms</th>
                                            <th><?php echo $row['symptoms'] ?></th>
                                        </tr>

                                    </thead>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <h2 class="text-center my-2">Invoice</h2>

                                <?php
                                    if (isset($_POST['send'])) {

                                        $fee = $_POST['fee'];
                                        $des = $_POST['des'];

                                        if (empty($fee)) {

                                        }else if(empty($des)) {

                                        }
                                        else {
                                            
                                            $doc = $_SESSION['doctor'];
                                            $fname = $row['firstname'];

                                            $query = "INSERT INTO income(doctor, patient, date_discharge, amount_paid, description) VALUES('$doc', '$fname', NOW(), '$fee', '$des')";

                                            $res = mysqli_query($connect,$query);

                                            if ($res) {
                                                echo "<script>alert('Invoice sent successfully')</script>";

                                                mysqli_query($connect, "UPDATE appointment SET status='Discharged' WHERE id='$id'");
                                            }
                                        }
                                    }

                                ?>

                                <form action="" method="post">
                                    <label for="">Fee</label>
                                    <input type="number" name="fee" id="" class="form-control" placeholder="Consulting fee" value="250" contenteditable="false">

                                    <label for="">Description</label>
                                    <textarea name="des" id="" cols="30" rows="10" class="form-control" placeholder="Enter the description"></textarea>

                                    <input type="submit" name="send" value="Send" class="btn btn-success my-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>