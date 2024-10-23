<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request</title>
    <link rel="stylesheet" href="path_to_bootstrap.css"> <!-- Add Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
        include("../include/header.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h5 class="text-center my-3">Job Request</h5>
                    <div id="show"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        // Function to display the table content
        function show() {
            $.ajax({
                url: "ajax_job_request.php",
                method: "POST",
                success: function(data){
                    $("#show").html(data);
                }
            });
        }

        // Call the function to load data when the page is ready
        show();

        $(document).on('click', '.approve', function(){

            var id = $(this).attr("id");


            $.ajax({
                url:"ajax_approve.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    show();
                }
            });
        });

        $(document).on('click', '.reject', function(){

            var id = $(this).attr("id");


            $.ajax({
                url:"ajax_reject.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    show();
                }
            });
        });
    });
    </script>
</body>
</html>
