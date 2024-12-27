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
                <div class="col-md-2">
                    <?php
                        include("sidenav.php");

                    ?>

                </div>
                <div class="col-md-10">
                    <h2 class="text-center my-3">View Invoice</h2>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <?php
                                if (isset($_GET['id'])) {
                                    
                                    $id = $_GET['id'];

                                    $query = "SELECT * FROM income WHERE id='$id'";
                                    $res = mysqli_query($connect, $query);

                                    $row = mysqli_fetch_array($res);
                                }

                                ?>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">Details</th>
                                        </tr>
                                        <tr>
                                            <td>Doctor</td>
                                            <td><?php echo $row['doctor']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Patient</td>
                                            <td><?php echo $row['patient']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Discharge Date</td>
                                            <td><?php echo $row['date_discharge']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td>₹<?php echo $row['amount_paid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Discription</td>
                                            <td><?php echo $row['description']; ?></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>