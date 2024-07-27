<?php
session_start();
if (!isset($_SESSION['mobile']) || !isset($_SESSION['otp'])) {
    // Redirect to login page if the user is not logged in
    header('Location:../index.php');
    exit();
}
?>
<?php
// session_start();
// if (!isset($_SESSION['mobile']) ||!isset($_SESSION['otp']) ||!isset($_SESSION['role'])) {
//     // Redirect to login page if the user is not logged in
//     header('Location:../index.php');
//     exit();
// }

// // Check the user's role and redirect accordingly
// if ($_SESSION['role'] == 'admin') {
//     // Redirect to admin dashboard
//     header('Location:../admin/dash');
//     exit();
// } elseif ($_SESSION['role'] == 'user') {
//     // Redirect to user dashboard
//     header('Location:../../user/dash/');
//     exit();
// }
?>