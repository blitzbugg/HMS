<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .navbar {
            background: linear-gradient(135deg, #2C5282, #4299E1) !important;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-brand img {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        @media (max-width: 991px) {
            .navbar-nav {
                padding: 1rem 0;
            }
            
            .nav-link {
                margin: 0.5rem 0;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white fs-4 fw-bold" href="./index.php">
                <img src="https://t4.ftcdn.net/jpg/05/75/22/77/240_F_575227735_ZjAc0cnqvCwzsfmsuEuKUW847J0JIGXU.jpg" alt="Logo" width="30" height="30" class="d-inline-block">
                Hospital Management System
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if(isset($_SESSION['admin'])) {
                        echo '
                        <li class="nav-item"><a href="" class="nav-link text-white fw-bold">'.$_SESSION['admin'].'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                    } elseif(isset($_SESSION['doctor'])) {
                        echo '
                        <li class="nav-item"><a href="" class="nav-link text-white fw-bold">'.$_SESSION['doctor'].'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                    } elseif(isset($_SESSION['patient'])) {
                        echo '
                        <li class="nav-item"><a href="" class="nav-link text-white fw-bold">'.$_SESSION['patient'].'</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-link text-white fw-bold">Logout</a></li>';
                    } else {
                        echo '
                        <li class="nav-item"><a href="index.php" class="nav-link text-white fw-bold">Home</a></li>
                        <li class="nav-item"><a href="adminlogin.php" class="nav-link text-white fw-bold">Admin</a></li>
                        <li class="nav-item"><a href="doctorlogin.php" class="nav-link text-white fw-bold">Doctor</a></li>
                        <li class="nav-item"><a href="patientlogin.php" class="nav-link text-white fw-bold">Patient</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>