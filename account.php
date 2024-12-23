<?php
include("include/connection.php");

$show = ""; // This will hold either the error or success message

if (isset($_POST['create'])) { // Only process if the form is submitted
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $distr = $_POST['dist'];
    $password = $_POST['pass'];
    $con_pass = $_POST['con_pass'];

    $error = array(); // Array to collect error messages

    // Error handling logic
    if (empty($fname)) {
        $error['ac'] = "Enter firstname";
    } else if (empty($sname)) {
        $error['ac'] = "Enter surname";
    } else if (empty($uname)) {
        $error['ac'] = "Enter username";
    } else if (empty($email)) {
        $error['ac'] = "Enter email";
    } else if (empty($phone)) {
        $error['ac'] = "Enter phone";
    } else if (empty($gender)) {
        $error['ac'] = "Select gender";
    } else if (empty($distr)) {
        $error['ac'] = "Select district";
    } else if (empty($password)) {
        $error['ac'] = "Enter password";
    } else if ($con_pass !== $password) { // Password and confirm password match check
        $error['ac'] = "Passwords do not match";
    }

    // If no errors, proceed with data insertion
    if (count($error) == 0) {
        $generatedID = generatePatientID($connect); // Function to generate patient ID

        $query = "INSERT INTO patient(id, firstname, surname, username, email, phone, gender, district, password, date_reg, profile)
                  VALUES('$generatedID', '$fname', '$sname', '$uname', '$email', '$phone', '$gender', '$distr', '$password', NOW(), 'patient.jpg')";

        $res = mysqli_query($connect, $query);

        if ($res) {
            $show = "<h5 class='text-center alert alert-success'>Account created successfully! Please <a href='patientlogin.php'>login here</a>.</h5>";
        } else {
            echo "<script>alert('Failed to insert record: " . mysqli_error($connect) . "')</script>";
        }
    } else {
        // If there are errors, set the error message
        $s = $error['ac'];
        $show = "<h5 class='text-center alert alert-danger'>$s</h5>";
    }
}

// Function to generate a patient ID with daily reset logic
function generatePatientID($connect) {
    $currentDate = date('ymd'); // Get current date in YYMMDD format

    // Query to count how many patients registered today
    $stmt = $connect->prepare("SELECT COUNT(*) as countToday FROM patient WHERE DATE(date_reg) = CURDATE()");
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $countToday = $result['countToday'] ?? 0; // Count for today's registrations

    // Generate the new patient ID
    $newPatientNumber = $countToday + 1;
    $patientID = $currentDate . $newPatientNumber;

    return $patientID;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-repeat: no-repeat; background-size: cover;">
    <?php include("include/header.php"); ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 p-5 bg-light mt-5 rounded-4 my-2">
                    <h5 class="text-center text-info my-2">Create account</h5>
                    <?php echo $show; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Firstname</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <label for="">Surname</label>
                            <input type="text" name="sname" class="form-control" placeholder="Enter Surname">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">District</label>
                            <select name="dist" class="form-control">
                                <option value="">Select your District</option>
                                <option value="Alappuzha">Alappuzha</option>
                                <option value="Idukki">Idukki</option>
                                <option value="Kannur">Kannur</option>
                                <option value="Kasaragod">Kasaragod</option>
                                <option value="Kollam">Kollam</option>
                                <option value="Kottayam">Kottayam</option>
                                <option value="Kozhikode">Kozhikode</option>
                                <option value="Malappuram">Malappuram</option>
                                <option value="Palakkad">Palakkad</option>
                                <option value="Pathanamthitta">Pathanamthitta</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Thrissur">Thrissur</option>
                                <option value="Wayanad">Wayanad</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control" placeholder="Confirm Password">
                        </div>
                        <input type="submit" name="create" value="Create Account" class="btn btn-info">
                        <p>I already have an account <a href="patientlogin.php">Click here.</a></p>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</body>
</html>
