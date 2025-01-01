<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total appointments</title>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");

    // Get logged in doctor's ID

    $doctor_username = $_SESSION['doctor']; // Assuming the session stores the doctor's username
    $doc_query = "SELECT id FROM doctors WHERE username='$doctor_username'";
    $doc_result = mysqli_query($connect, $doc_query);

    if ($doc_result && mysqli_num_rows($doc_result) == 1) {
    $doc_row = mysqli_fetch_assoc($doc_result);
    $doctor_id = $doc_row['id']; // Fetch the doctor's ID
    } else {
    die("Doctor not found.");
    }
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <h2 class="text-center my-2">Total appointments</h2>

                    <?php
                    $query = "SELECT * FROM appointment WHERE status='Pending' AND doctor_id='$doctor_id'";
                    $res = mysqli_query($connect, $query);

                    $output = "
                        <table class='table table-bordered table-stripped'>
                        <tr>
                        <th>Appointment ID</th>
                        <th>First Name</th>
                        <th>Sur Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Appointment date</th>
                        <th>Symptoms</th>
                        <th>Date Booked</th>
                        <th>Action</th>
                        </tr>";

                    if (mysqli_num_rows($res) < 1) {
                        $output .= "
                        <tr>
                        <td colspan='9'>No appointments found</td>
                        </tr>
                        ";
                    }

                    while ($row = mysqli_fetch_array($res)) {
                        $output .= "
                        <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['firstname']."</td>
                        <td>".$row['surname']."</td>
                        <td>".$row['gender']."</td>
                        <td>".$row['phone']."</td>
                        <td>".$row['appointment_date']."</td>
                        <td>".$row['symptoms']."</td>
                        <td>".$row['date_booked']."</td>
                        <td><a href='discharge.php?id=".$row['id']."&doctor=".$doctor_id."'><button class='btn btn-success'>Check</button></td>
                        ";
                    }
                    
                    $output .= "
                    </tr>
                    </table>";

                    echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>