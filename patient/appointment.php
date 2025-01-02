<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="./css/appointment.css">
</head>
<body>

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
                <h3 class="text-center page-title my-4 animate__animated animate__fadeIn">Book Your Appointment</h3>

                <?php
                $pat = $_SESSION['patient'] ?? '';

                if (!$pat) {
                    echo "<script>alert('No patient session found. Please log in again.');</script>";
                    exit;
                }

                $sel = mysqli_query($connect, "SELECT * FROM patient WHERE username='$pat'");
                if (!$sel) {
                    die("Query failed: " . mysqli_error($connect));
                }

                $row = mysqli_fetch_assoc($sel);
                if (!$row) {
                    echo "<script>alert('Patient details not found.');</script>";
                    exit;
                }

                $firstname = $row['firstname'];
                $surname = $row['surname'];
                $gender = $row['gender'];
                $phone = $row['phone'];

                // Get available doctors
                $doctors_query = "SELECT * FROM doctors WHERE status='Approved'";
                $doctors_result = mysqli_query($connect, $doctors_query);

                if (isset($_POST['book'])) {
                    $doctor_id = $_POST['doctor_id'];
                    $date = $_POST['date'];
                    $sym = $_POST['sym'];

                    if (empty($sym) || empty($doctor_id)) {
                        echo "<script>alert('Please fill all fields');</script>";
                    } else {
                        $query = "INSERT INTO appointment(firstname, surname, gender, phone, appointment_date, symptoms, status, date_booked, doctor_id) 
                                VALUES ('$firstname', '$surname', '$gender', '$phone', '$date', '$sym', 'Pending', NOW(), '$doctor_id')";

                        $res = mysqli_query($connect, $query);
                        if ($res) {
                            echo '<div class="toast-container">
                                    <div class="toast show animate__animated animate__fadeInRight" role="alert">
                                        <div class="toast-header bg-success text-white">
                                            <strong class="me-auto">Success</strong>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                                        </div>
                                        <div class="toast-body">
                                            Your appointment has been successfully booked!
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                }
                ?>

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="appointment-card p-5 animate__animated animate__fadeInUp">
                            <form action="" method="post">
                                <div class="mb-4">
                                    <label for="doctor">Select Doctor</label>
                                    <select id="doctor" name="doctor_id" class="form-control" required>
                                        <option value="">Choose a doctor...</option>
                                        <?php while($doctor = mysqli_fetch_assoc($doctors_result)) { ?>
                                            <option value="<?php echo $doctor['id']; ?>">
                                                Dr. <?php echo $doctor['firstname'] . ' ' . $doctor['surname']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="date">Appointment Date</label>
                                    <input type="date" id="date" name="date" class="form-control" required 
                                           min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="mb-4">
                                    <label for="symptoms">Symptoms</label>
                                    <textarea id="symptoms" name="sym" class="form-control symptoms-input" 
                                            required placeholder="Please describe your symptoms..."></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="book" class="btn btn-book btn-lg">
                                        Book Appointment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>