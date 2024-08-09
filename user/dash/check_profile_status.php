<?php include('../config/dbconnection.php') ?>
<?php include('../config/session_check.php') ?>
<?php
// Include your database connection file

// Get the username from the AJAX request
$username = $_POST['username'] ?? null;

$response = ['status' => 0];

if ($username) {
    // Query to get the status of the user
    $query = "SELECT status FROM userlogin WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response['status'] = $row['status'];
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
