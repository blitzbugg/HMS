<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Navigation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-dark: #2C5282;
            --primary-light: #4299E1;
        }

        .sidenav {
            background-color: white;
            height: calc(100vh - 60px);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding-top: 20px;
        }

        .nav-brand {
            color: var(--primary-dark);
            text-align: center;
            padding: 15px 0;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 2px solid #E2E8F0;
            margin-bottom: 20px;
        }

        .nav-item {
            padding: 12px 20px;
            color: #4A5568;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            margin: 4px 8px;
            border-radius: 8px;
        }

        .nav-item:hover {
            background-color: #EBF8FF;
            color: var(--primary-dark);
            text-decoration: none;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: var(--primary-light);
            color: white;
        }

        .nav-item i {
            width: 24px;
            margin-right: 10px;
            text-align: center;
        }

        /* Animation for nav items */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-item {
            animation: slideIn 0.3s ease forwards;
            opacity: 0;
        }

        .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .nav-item:nth-child(2) { animation-delay: 0.2s; }
        .nav-item:nth-child(3) { animation-delay: 0.3s; }
        .nav-item:nth-child(4) { animation-delay: 0.4s; }
        .nav-item:nth-child(5) { animation-delay: 0.5s; }
        .nav-item:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <div class="sidenav">
        <div class="nav-brand">
            Healthcare Plus
        </div>
        <a href="index.php" class="nav-item active">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>
        <a href="profile.php" class="nav-item">
            <i class="fas fa-person"></i>
            My profile
        </a>
       
    </div>
</body>
</html>