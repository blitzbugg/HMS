<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/account.css">
</head>
<body>
    
    <div class="container">
        
        <div class="card">
            <div class="header">
                <div class="medical-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h1>Patient Registration</h1>
                <p>Please fill in your information to create an account</p>
            </div>
            
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>

            <form id="signupForm" method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" placeholder="Enter your first name" required>
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="form-group">
                        <label for="sname">Surname</label>
                        <input type="text" id="sname" name="sname" placeholder="Enter your surname" required>
                        <i class="fas fa-user"></i>
                    </div>

                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" id="uname" name="uname" placeholder="Choose a username" required>
                        <i class="fas fa-at"></i>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                        <i class="fas fa-phone"></i>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <i class="fas fa-venus-mars"></i>
                    </div>

                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" name="pass" placeholder="Create a password" required>
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="form-group">
                        <label for="con_pass">Confirm Password</label>
                        <input type="password" id="con_pass" name="con_pass" placeholder="Confirm your password" required>
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="form-group full-width">
                        <label for="dist">District</label>
                        <select id="dist" name="dist" required>
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
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <button type="submit" name="create" class="btn-submit">
                    Create Account <i class="fas fa-arrow-right"></i>
                </button>

                <div class="login-link">
                    Already have an account? <a href="patientlogin.php">Sign in here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Progress bar functionality
        const form = document.getElementById('signupForm');
        const inputs = form.querySelectorAll('input, select');
        const progressBar = document.getElementById('progress');

        function updateProgress() {
            const totalFields = inputs.length;
            let filledFields = 0;

            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filledFields++;
                }
            });

            const progress = (filledFields / totalFields) * 100;
            progressBar.style.width = `${progress}%`;
        }

        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
        });

        // Password match validation
        const password = document.getElementById('pass');
        const confirmPassword = document.getElementById('con_pass');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);
    </script>
</body>
</html>