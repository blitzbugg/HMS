
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS Home Page</title>
</head>
<body>
<?php

include("include/header.php");

?>
    <div class="container mt-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mx-1 shadow">
                    <img src="./img/info.png" alt="" srcset="" width=100% height=190>

                    <h5 class="text-center">Click on the button for more information</h5>
                    <div class="text-center">
                    <a href="">
                        <button class="btn btn-info p-3 text-white">More Information</button>
                    </a>
                    </div>
                </div>
                <div class="col-md-4 mx-1 shadow">
                    <img src="./img/patient.jpg" alt="" srcset="" width=100% height=250>

                    <h5 class="text-center">We will take care of you</h5>
                    <div class="text-center">
                    <a href="">
                        <button class="btn btn-success p-3">Create Account!</button>
                    </a>
                    </div>
                </div>
                <div class="col-md-4 mx-1 shadow">
                    <img src="./img/doctor.jpg" alt="" srcset="" width=100% height=250>

                    <h5 class="text-center">We are hiring doctors</h5>
                    <div class="text-center">
                    <a href="">
                        <button class="btn btn-success p-3">Apply Now!</button>
                    </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>