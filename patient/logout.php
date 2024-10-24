<?php
session_start();
if (isset($_SESSION['patient'])) {
    # code...
    unset($_SESSION['patient']);

    header("Location: ../index.php");
}