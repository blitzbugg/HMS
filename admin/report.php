<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("../include/header.php");
    include("../include/connection.php");
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
                    <h2 class="text-center my-3">Total Report</h2>
                    <?php
                        $query = "SELECT * FROM report";
                        $res = mysqli_query($connect,$query);

                        $output = "";

                        $output = "
                        <table class='table table-striped'>
                        <thead>
                        <tr>
                        <th>Report ID</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Username</th>
                        <th>Report Date</th>
                        </tr>
                        </thead>";
                        
                        if(mysqli_num_rows($res) < 1) {
                            $output .= "<tr><td class='text-center' colspan='5'>No report found</td></tr>";
                        }

                        while ($row = mysqli_fetch_array($res)) {
                            $output .= "
                                <tr>
                                <td>".$row['id']."</td>
                                <td>".$row['title']."</td>
                                <td>".$row['message']."</td>
                                <td>".$row['username']."</td>
                                <td>".$row['date_send']."</td>
                                </tr>
                            ";
                        }

                        $output .= "</tr></table>";

                        echo $output;

                    ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>