<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .appointment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .appointment-card:hover {
            transform: translateY(-5px);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
        }
        
        .btn-book {
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(45deg, #0dcaf0, #0d6efd);
            border: none;
            transition: all 0.3s;
        }
        
        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 202, 240, 0.4);
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
        
        .toast {
            animation: slideInRight 0.5s ease-out;
        }
        
        .page-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(45deg, #0dcaf0, #0d6efd);
            border-radius: 2px;
        }

        label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .symptoms-input {
            min-height: 100px;
            resize: vertical;
        }
    </style>
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


                if ($row) {
                    $firstname = $row['firstname'];
                    $surname = $row['surname'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];
                } else {
                    echo "<script>alert('Patient details not found.');</script>";
                    exit;
                }

                if (isset($_POST['book'])) {
                    // Extract patient details from $row
                    $firstname = $row['firstname'];
                    $surname = $row['surname'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];
                
                    // Get form input values
                    $date = $_POST['date'];
                    $sym = $_POST['sym'];
                
                    // Validate symptoms
                    if (empty($sym)) {
                        echo "<script>alert('Please enter your symptoms');</script>";
                    } else {
                        // Prepare and execute the insert query
                        $query = "INSERT INTO appointment(firstname, surname, gender, phone, appointment_date, symptoms, status, date_booked) 
                                  VALUES ('$firstname', '$surname', '$gender', '$phone', '$date', '$sym', 'Pending', NOW())";


                
                        $res = mysqli_query($connect, $query);
                
                        if ($res) {
                            // Success toast
                            echo '
                                <div class="toast-container">
                                    <div class="toast show animate__animated animate__fadeInRight" role="alert">
                                        <div class="toast-header bg-success text-white">
                                            <strong class="me-auto">Success</strong>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                                        </div>
                                        <div class="toast-body">
                                            Your appointment has been successfully booked!
                                        </div>
                                    </div>
                                </div>
                            ';
                        } else {
                            // Error handling for query failure
                            echo "<script>alert('Failed to book the appointment: " . mysqli_error($connect) . "');</script>";
                        }
                    }
                }
                
            ?>


                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="appointment-card p-5 animate__animated animate__fadeInUp">
                            <form action="" method="post">
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