<?php
include("../include/connection.php");
session_start();
$show = "";  // Initialize the $show variable

if (isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
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
    } else if ($department == "") {
        $error['apply'] = "Select department";
    } else if (empty($password)) {
        $error['apply'] = "Enter Password";
    } else if ($confirm_password != $password) {
        $error['apply'] = "Both Passwords do not match";
    }

    if (count($error) == 0) {
        $query = "INSERT INTO doctors(firstname, surname, username, email, gender, phone, department, password, salary, date_reg, status, profile) 
                  VALUES('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$department', '$password', '0', NOW(), 'pending', 'doctor.jpg')";

        $result = mysqli_query($connect, $query);

        
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
    <title>Doctor Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-image: url(img/admin-back.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        select.form-control {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 40px;
            appearance: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            transform: translateY(-1px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #4299e1;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .form-icon {
            margin-right: 8px;
            color: #4a5568;
        }
    </style>
</head>
<body>
    <?php include("../include/header.php"); ?>
    
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>Doctor Registration</h2>
            </div>

            <?php if(!empty($show)) echo $show; ?>

            <form method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-user form-icon"></i>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="Enter First Name" 
                               value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user form-icon"></i>Surname</label>
                        <input type="text" name="sname" class="form-control" placeholder="Enter Surname"
                               value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-user-tag form-icon"></i>Username</label>
                        <input type="text" name="uname" class="form-control" placeholder="Enter Username"
                               value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-envelope form-icon"></i>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email"
                               value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-venus-mars form-icon"></i>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if(isset($_POST['gender']) && $_POST['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-phone form-icon"></i>Phone Number</label>
                        <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number"
                               value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-globe form-icon"></i>department</label>
                        <select name="department" class="form-control">
                            <option value="">Select department</option>
                            <option value="Russia" <?php if(isset($_POST['department']) && $_POST['department'] == 'Paediatrics') echo 'selected'; ?>>Paediatrics</option>
                            <option value="India" <?php if(isset($_POST['department']) && $_POST['department'] == 'Psychiatry') echo 'selected'; ?>>Psychiatry</option>
                            <option value="Germany" <?php if(isset($_POST['department']) && $_POST['department'] == 'Radiology') echo 'selected'; ?>>Radiology</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-lock form-icon"></i>Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-lock form-icon"></i>Confirm Password</label>
                        <input type="password" name="con_pass" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>

                <button type="submit" name="apply" class="btn btn-success">
                    <i class="fas fa-user-plus"></i> Add new Doctor
                </button>

            </form>
        </div>
    </div>
</body>
</html>