<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    // Redirect to login page if the user is not logged in
    header('Location:../index.php');
    exit();
}
?>
