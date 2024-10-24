<?php
include("include/connection.php");

$show = "";  // Initialize the $show variable

if (isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];

    $error = array();

    if (empty($firstname)) {
        $error['apply'] = "Enter Firstname";
    } else if (empty($surname)) {
        $error['apply'] = "Enter Surname";
    } else if (empty($username)) {
        $error['apply'] = "Enter Username";
    } else if (empty($email)) {
        $error['apply'] = "Enter Email Address";
    } else if ($gender == "") {
        $error['apply'] = "Select Your Gender";
    } else if (empty($phone)) {
        $error['apply'] = "Enter Phone Number";
    } else if ($country == "") {
        $error['apply'] = "Select Country";
    } else if (empty($password)) {
        $error['apply'] = "Enter Password";
    } else if ($confirm_password != $password) {
        $error['apply'] = "Both Passwords do not match";
    }

    if (count($error) == 0) {
        $query = "INSERT INTO doctors(firstname, surname, username, email, gender, phone, country, password, salary, date_reg, status, profile) 
                  VALUES('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$country', '$password', '0', NOW(), 'pending', 'doctor.jpg')";

        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "<script>alert('You have Successfully Applied')</script>";
            header("Location: doctorlogin.php");
        } else {
            echo "<script>alert('Failed')</script>";
        }
    }

    if (isset($error['apply'])) {
        $s = $error['apply'];
        $show = "<h5 class='text-center alert alert-danger'>$s</h5>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Apply Now!!!</title>
</head>
<body style="background-image: url(img/admin-back.jpg); background-size: cover; background-repeat: no-repeat;">
    <?php
        include("include/header.php");
      ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 p-4 bg-dark-subtle mt-5 rounded-4">
                    <h5 class="text-center">SignUp</h5>
                        <div>
                            <?php echo $show; ?>
                        </div>
                    <form method="post">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="fname" class="form-control"
                            autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>">
                        </div>

                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="sname" class="form-control"
                            autocomplete="off" placeholder="Enter Surname" value="<?php if(isset($_POST['sname'])) echo $_POST['sname'];?>">
                        </div>

                        <div class="form-group">
                            <label>User name</label>
                            <input type="text" name="uname" class="form-control"
                            autocomplete="off" placeholder="Enter User name" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                            autocomplete="off" placeholder="Enter Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                        </div>

                        <div class="form-group">
                            <label for="">Select Gender</label>
                            <select name="gender" id="" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Male">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter phone Number"
                            value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">
                        </div>

                        <div class="from-group">
                            <label>Select Country</label>
                            <select name="country" class="form-control">
                                <option value="">Select Country</option>
                                <option value="Russia">Russia</option>
                                <option value="India">India</option>
                                <option value="Germany">Germany</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control"
                            autocomplete="off" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control"
                            autocomplete="off" placeholder="Confirm Password">
                        </div>
                        <input type="submit" name="apply" value="Signup" class="btn btn-success">
                        <p>I already have an account <a href="doctorlogin.php">Click here</a></p>
                    </form>

                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
      </div>
</body>
</html>