<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total income</title>
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
                    <h2 class="text-center my-3">Total Income</h2>

                    <?php
                    $query = "SELECT * FROM income";

                    $res = mysqli_query($connect,$query);

                    $output = "";

                    $output = "
                    <table class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Patient</th>
                    <th>Date Discharge</th>
                    <th>Fee</th>
                    </tr>
                    </thead>
                    ";

                    if (mysqli_num_rows($res) < 1) {

                        $output .= "
                        <tr>
                        <td class='text-center' colspan='5'>No data found</td>

                        </tr>
                        ";
                        
                    }

                    while ($row = mysqli_fetch_array($res)) {

                        $output .= "
                        <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['doctor']."</td>
                        <td>".$row['patient']."</td>
                        <td>".$row['date_discharge']."</td>
                        <td>".$row['amount_paid']."</td>
                        </tr>

                        ";
                        
                    }

                    $output .= "</table>";

                    echo $output;

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>