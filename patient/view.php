<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./css/view.css">
</head>
<body class="bg-light">
    
    <?php
    include("../include/header.php");
    include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 no-print">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <div class="invoice-container">
                    <div class="invoice-header">
                        <h2 class="text-center mb-0">Invoice Details</h2>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * FROM income WHERE id=?";
                                $stmt = mysqli_prepare($connect, $query);
                                mysqli_stmt_bind_param($stmt, "i", $id);
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_array($res);

                                if ($row) {
                                    ?>
                                    <table class="table invoice-details">
                                        <tr>
                                            <th colspan="2" class="text-center">Invoice #<?php echo $row['id']; ?></th>
                                        </tr>
                                        <tr>
                                            <td>Doctor</td>
                                            <td><?php echo htmlspecialchars($row['doctor']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Patient</td>
                                            <td><?php echo htmlspecialchars($row['patient']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Discharge Date</td>
                                            <td><?php echo date('F d, Y', strtotime($row['date_discharge'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td>₹<?php echo number_format($row['amount_paid'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                                        </tr>
                                    </table>

                                    <div class="text-center mt-4">
                                        <form action="generate_invoice.php" method="POST" class="d-inline">
                                            <input type="hidden" name="invoice_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="download-btn">
                                                <i class="fas fa-download me-2"></i>Download Invoice
                                            </button>
                                        </form>
                                    </div>

                                    <div class="invoice-footer">
                                        <p>Thank you for choosing our services!</p>
                                    </div>
                                    <?php
                                } else {
                                    echo '<div class="alert alert-danger">Invoice not found.</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>