<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Invoice</title>
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
                    <h2 class="text-center my-3">My Invoice</h2>

                    <?php

                    $pat = $_SESSION['patient'];
                    $query = "SELECT * FROM patient WHERE username = '$pat'";
                    $res = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($res);

                    $fname = $row['firstname'];

                    $querys = mysqli_query($connect,"SELECT * FROM income WHERE patient='$fname'");

                    $output = "";

                    $output .= "
                    <table class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Date Discharge</th>
                    <th>Amount paid</th>
                    <th>Description</th>
                    </tr>
                    ";

                    if (mysqli_num_rows($querys) < 1) {
                        
                        $output .= "
                        <tr>
                        <td colspan='7' class='text-center'>No data available</td>
                        </tr>
                        ";
                    }

                    while ($row = mysqli_fetch_array($querys)) {
                        
                        $output .= "
                        <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['doctor']."</td>
                        <td>".$row['patient']."</td>
                        <td>".$row['date_discharge']."</td>
                        <td>".$row['amount_paid']."</td>
                        <td>
                        <a href='view.php?id=".$row['id']."' class='btn btn-primary'><button class='btn btn-info'>View</button></a>
                        </td>

                        ";
                    }

                    $output .= "</tr></table>";
                    echo $output;

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>