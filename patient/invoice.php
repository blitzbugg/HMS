<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/invoice.css">
</head>
<body class="bg-light">
    
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
                <div class="invoice-header">
                    <h2 class="text-center mb-0">My Invoice</h2>
                </div>

                <div class="table-container">
                    <?php
                    $pat = $_SESSION['patient'];
                    $query = "SELECT * FROM patient WHERE username = ?";
                    $stmt = mysqli_prepare($connect, $query);
                    mysqli_stmt_bind_param($stmt, "s", $pat);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_array($res);

                    $fname = $row['firstname'];

                    $querys = mysqli_query($connect, "SELECT * FROM income WHERE patient = '$fname'");

                    echo '<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Date Discharge</th>
                                    <th scope="col">Amount Paid</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>';

                    if (mysqli_num_rows($querys) < 1) {
                        echo '<tr><td colspan="6" class="no-data">No invoices available</td></tr>';
                    } else {
                        while ($row = mysqli_fetch_array($querys)) {
                            echo '<tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['doctor'].'</td>
                                    <td>'.$row['date_discharge'].'</td>
                                    <td>$'.number_format($row['amount_paid'], 2).'</td>
                                    <td>'.$row['description'].'</td>
                                    <td>
                                        <a href="view.php?id='.$row['id'].'" class="btn btn-info btn-view">View</a>
                                    </td>
                                </tr>';
                        }
                    }

                    echo '</tbody></table>';
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>