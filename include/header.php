<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-info bg-secondary">
    <div class="container-fluid">
    <a class="navbar-brand text-white fs-4 fw-bold" href="./index.php">
      <img src="https://t4.ftcdn.net/jpg/05/75/22/77/240_F_575227735_ZjAc0cnqvCwzsfmsuEuKUW847J0JIGXU.jpg" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      Hospital Management System
    </a>
    </div>

        <ul class="navbar-nav me-4"> 
            <?php
                if(isset($_SESSION['admin'])){

                    $user = $_SESSION['admin'];
                        echo '
            <li class="nav-item ms-3"><a href="" class="nav-link text-white fw-bold">'.$user.'</a></li>
            <li class="nav-item ms-3"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                }else if(isset($_SESSION['doctor'])){
                    $user = $_SESSION['doctor'];
                        echo '
            <li class="nav-item ms-3"><a href="" class="nav-link text-white fw-bold">'.$user.'</a></li>
            <li class="nav-item ms-3"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                }
                else if(isset($_SESSION['patient'])){
                    $user = $_SESSION['patient'];
                        echo '
            <li class="nav-item ms-3"><a href="" class="nav-link text-white fw-bold">'.$user.'</a></li>
            <li class="nav-item ms-3"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                
                }else{
                    echo '
                    <li class="nav-item ms-3"><a href="index.php" class="nav-link text-white fw-bold">Home</a></li>
                    <li class="nav-item ms-3"><a href="adminlogin.php" class="nav-link text-white fw-bold">Admin</a></li>
            <li class="nav-item ms-3"><a href="doctorlogin.php" class="nav-link text-white fw-bold">Doctor</a></li>
            <li class="nav-item ms-3"><a href="patientlogin.php" class="nav-link text-white fw-bold">Patient</a></li>';
                }
            ?>
        </ul>
    </nav>
</body>
</html>