<h2?php
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
                    <h2 class="text-center my-2">Total appointments</h2>

                    <?php
                    $query = "SELECT * FROM appointment WHERE status='pending'";
                    $res = mysqli_query($connect, $query);

                    $output = "";

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
                            <td><a href='discharge.php?id=".$row['id']."'><button class='btn btn-success'>Check</button></td>
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